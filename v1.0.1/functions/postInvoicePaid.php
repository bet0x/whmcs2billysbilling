<?php

function billysbilling_hook_getAccountId($accountName)
{
    
    global $whmcs2billysbilling_settings;
    
    $client = new BillyClient($whmcs2billysbilling_settings['option99']);
    //API KEY
    
    
    $res = $client->request("GET", "/accounts?q=$accountName");
    
    if ($res->status !== 200) {
        echo "postInvoicePaid 15 : Something went wrong:\n\n";
        print_r($res->body);
        exit;
    }
    
    $accountCount = count($res->body->accounts);
    //If 1 , then it exists and we use the data from it - if 0, we need to create it first.
    
    $accountId = accountIdSplit($whmcs2billysbilling_settings['option95']);
    
    if ($accountCount == 1) {
        
        $accountId = $res->body->accounts[0]->id;
        
    } else {
        
        
        foreach($res->body->accounts AS $id=>$account) {
            
            if ($res->body->accounts[$id]->name == $accountName) {
                $accountId = $res->body->accounts[$id]->id;
            }
            
        }
        
    }
    
    
    return $accountId;
    
}


function billysbilling_hook_InvoicePaid($vars)
{
    
    global $whmcs2billysbilling_settings;
    
    $adminuser = $whmcs2billysbilling_settings['option100'];
    $command = 'getinvoice';
    $values = array('invoiceid' => $vars['invoiceid']);
    $results = localAPI($command, $values, $adminuser);
    
    $client = new BillyClient($whmcs2billysbilling_settings['option99']);
    //API KEY
    
    //Get organizationId
    $res = $client->request("GET", "/organization");
    if ($res->status !== 200) {
        echo "postInvoicePaid 64 : Something went wrong:\n\n";
        print_r($res->body);
        exit;
    }
    
    $organizationId = $res->body->organization->id;
    
    $gateway = $results['paymentmethod'];
    
    $res = $client->request("GET", "/invoices?q=".$vars['invoiceid']."");
    
    if ($res->status !== 200) {
        echo "postInvoicePaid 76 : Something went wrong:\n\n";
        print_r($res->body);
        exit;
    }
    
    
    $invoiceCount = count($res->body->invoices);
    //If 1 , then it exists and we use the data from it - if 0, we need to create it first.
    
    //No users found with this name, then we can create it.
    if ($invoiceCount == 1) {
        
        $invoiceId = $res->body->invoices[0]->id;
       
/*	   
        //Update invoice state to Approved and then pay it.
        $res = $client->request("PUT", "/invoices/$invoiceId", array('invoice' => array('state' => 'approved'
        )
        )
        );
 
  
        if ($res->status !== 200) {
            echo "postInvoicePaid 97 : Something went wrong:\n\n";
            print_r($res->body);
            exit;
        }
   */
   
        $associations[] = array("subjectReference" => "invoice:$invoiceId");
        
        $res = $client->request("POST", "/bankPayments", array('bankPayment' => array('organizationId' => $organizationId,
        'entryDate' => date("Y-m-d"),
        'cashAmount' => $results['total'],
        'cashSide' => 'debit',
        'cashAccountId' => billysbilling_hook_getAccountId("whmcs-".$gateway),
		'cashExchangeRate' => '1', //Set exchangerate to 1 all the time. Can't know what rate is used.
        'associations' => $associations
        )
        ));
        
        
        
        
        if ($res->status !== 200) {
            echo "postInvoicePaid 117 : Something went wrong:\n\n";
            print_r($res->body);
            exit;
        }
        
        
    }
    
  
}


add_hook("InvoicePaid", 1, "billysbilling_hook_InvoicePaid");
?>