<?php

function whmcs2billysbilling_hook_ProductAdd($vars)
{
    
    global $whmcs2billysbilling_settings;
    $logText = "";
    $productId = "0";
    
    
    
    $client = new BillyClient($whmcs2billysbilling_settings['option99']);
    //API KEY
    
    //Get organizationId
    $res = $client->request("GET", "/organization");
    if ($res->status !== 200) {
        echo " postProdcut 18 : Something went wrong:\n\n";
        print_r($res->body);
        exit;
    }
    
    $organizationId = $res->body->organization->id;
    
    
    
    //First check if the contact exists
    $res = $client->request("GET", "/products?q=$productName");
    
    if ($res->status !== 200) {
        echo " postProdcut 31 : Something went wrong:\n\n";
        print_r($res->body);
        //exit;
    }
    
    $count = count($res->body->products);
    //If 1 , then the product exists and we use the data from it - if 0, we need to create it first.
    
    //No product found with this name, then we can create it.
    if ($count == 0) {
        
        //Create
        
        $res = $client->request("POST", "/products", array('product' => array('organizationId' => $organizationId,
        'name' => $vars['name'],
        'accountId' => $vars['accountId'],
        'salesTaxRulesetId' => $vars['vatModelId'],
        'prices' => $vars['prices']
        )
        ));
        
        if ($res->status !== 200) {
            echo " postProdcut 53 : Something went wrong:\n\n";
            print_r($res->body);
            //exit;
        }
        
        $productId = $res->body->products[0]->id;
        
        
        //Something is found, output the id
    } else {
        
        $productId = $res->body->products[0]->id;
        
    }
    
    
    return $productId;
}

/* NO HOOK NEEDED, FUNCTION IS LOADED FROM OTHER HOOKS */
?>