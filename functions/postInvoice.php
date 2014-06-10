<?php

function billysbilling_hook_InvoiceCreated($vars)
{
    
    global $whmcs2billysbilling_settings;
    $logText = "";
    
    $adminuser = $whmcs2billysbilling_settings['option100'];
    $command = 'getinvoice';
    $values = array('invoiceid' => $vars['invoiceid']);
    $results = localAPI($command, $values, $adminuser);
    $currencyId = "" . $whmcs2billysbilling_settings['option97'] . "";
    
    if ($results['result'] == "success") {
        
        $client = new BillyClient($whmcs2billysbilling_settings['option99']);
        //API KEY
        
        //Get organizationId
        $res = $client->request("GET", "/organization");
        if ($res->status !== 200) {
            echo "Something went wrong:\n\n";
            print_r($res->body);
            exit;
        }
        
        $organizationId = $res->body->organization->id;
        $defaultSalesAccountId = $res->body->organization->defaultSalesAccountId;
        $defaultSalesTaxRulesetId = $res->body->organization->defaultSalesTaxRulesetId;
        
        
        $command_client = "getclientsdetails";
        $values_client['clientid'] = $results['userid'];
        $values_client['stats'] = false;
        $values_client['responsetype'] = "xml";
        $results_client = localAPI($command_client, $values_client, $adminuser);
        
        
        if ($results_client['result'] == "success") {
            
            //Get the client ID , if not found. It will be created.
            $contactId = "" . whmcs2billysbilling_hook_ClientAdd($results_client['client']) . "";
            
            
            foreach($results['items']['item'] AS $item => $line)
            {
                
                $id = $line['id'];
                // 1991
                $type = $line['type'];
                // Hosting
                $relid = $line['relid'];
                // 797
                $description = $line['description'];
                // UbegrÃ¦nset backup (07/04/2014 - 06/05/2014)
                $amount = $line['amount'];
                // 25.00
                $taxed = $line['taxed'];
                // 1
                $taxrate = $results['taxrate'];
                //25.00
                $fixTax =  "1.".str_replace(".","",$taxrate);
                
                $productamount = $line['amount'];
                
                if ($line['taxed'] == 1) {
                    
                    $accountId = $defaultSalesAccountId;
                    //default Sales account
                    $vatModelId = $defaultSalesTaxRulesetId;
                    //default vat model id
                    $productamount = ($productamount / $fixTax);
                    //remove vat from product price
                    
                } else {
                    
                    $productamount = $productamount;
                    $accountId = $defaultSalesAccountId;
                    $vatModelId = $defaultSalesTaxRulesetId;
                    // GET momsfrit fra DB
                    
                    
                }
                
                if ($productamount < 0) {
                    $productamount = "0";
                }
                
                
                $prices = array("currencyId" => $results_client['client']['currency_code'], "unitPrice" => $productamount);
                
                
                //Get product from function , create it in function if not exists.
                $productVars = array("name" => "$description", "price" => $prices, "accountId" => $accountId, "vatModelId" => $vatModelId);
                $productId = whmcs2billysbilling_hook_ProductAdd($productVars);
                
                
                
                
                $lines[] = array("productId" => $productId, "description" => $line['description'], "quantity" => "1", "unitPrice" => $productamount);
                
                
                
                
                
            }
            
            $contactId = whmcs2billysbilling_hook_ClientAdd($results_client['client']);
            $res = $client->request("POST", "/invoices", array('invoice' => array('organizationId' => $organizationId,
            'type' => 'invoice',
            'contactId' => $contactId,
            'entryDate' => date("Y-m-d"),
            'state' => 'draft',
            'sentState' => 'unsent',
            'invoiceNo' => $vars['invoiceid'],
            'currencyId' => $results_client['client']['currency_code'],
            'lines' => $lines
            )
            ));
            
            if ($res->status !== 200) {
                echo "Something went wrong:\n\n";
                print_r($res->body);
                exit;
            }
            
        }
        //result fails.
        
        
    }
}
add_hook("InvoiceCreated", 1, "billysbilling_hook_InvoiceCreated");
?>