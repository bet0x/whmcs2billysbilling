<?php

function whmcs2billysbilling_hook_ClientAdd($vars)
{
    
    global $whmcs2billysbilling_settings;
    $logText = "";
    $contactId = "0";
    
    $userid      = $vars['userid'];
    $firstname   = $vars['firstname'];
    $lastname    = $vars['lastname'];
    $companyname = $vars['companyname'];
    $email       = $vars['email'];
    $address1    = $vars['address1'];
    $address2    = $vars['address2'];
    $city        = $vars['city'];
    $state       = $vars['state'];
    $postcode    = $vars['postcode'];
    $country     = countryId($vars['country']);
    $phonenumber = $vars['phonenumber'];
    
    if ($firstname == '') {
        $firstname = $vars['olddata']['firstname'];
    }
    if ($lastname == '') {
        $lastname = $vars['olddata']['lastname'];
    }
    if ($companyname == '') {
        $companyname = $vars['olddata']['companyname'];
    }
    if ($email == '') {
        $email = $vars['olddata']['email'];
    }
    if ($address1 == '') {
        $address1 = $vars['olddata']['address1'];
    }
    if ($address2 == '') {
        $address2 = $vars['olddata']['address2'];
    }
    if ($city == '') {
        $city = $vars['olddata']['city'];
    }
    if ($state == '') {
        $state = $vars['olddata']['state'];
    }
    if ($postcode == '') {
        $postcode = $vars['olddata']['postcode'];
    }
    if ($country == '') {
        $country = countryId($vars['olddata']['country']);
    }
    if ($phonenumber == '') {
        $phonenumber = $vars['olddata']['phonenumber'];
    }
    
    
    
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
    
    
    
    //First check if the contact exists
    $res = $client->request("GET", "/contacts?q=%5Bwhmcs%3A$userid%5D%20$firstname%20$lastname");
    //V2 query on $userid and name, to avoid dublicates, cant post e-mail adresse to BB and always have 1 or 0 results.
    
    if ($res->status !== 200) {
        echo "Something went wrong:\n\n";
        print_r($res->body);
        //exit;
    }
    
    $userCount = count($res->body->contacts);
    //If 1 , then the user exists and we use the data from it - if 0, we need to create it first.
    
    //No users found with this name, then we can create it.
    if ($userCount == 0) {
        
        //Create user
        
        $res = $client->request("POST", "/contacts", array('contact' => array('organizationId' => $organizationId,
        'name' => "[whmcs:$userid] $firstname $lastname",
        'countryId' => $country
        )
        ));
        
        if ($res->status !== 200) {
            echo "Something went wrong:\n\n";
            print_r($res->body);
            //exit;
        }
        
        $contactId = $res->body->contacts[0]->id;
        
        
        //Use with this name / ID found, output the contact ID.
    } else {
        
        $contactId = $res->body->contacts[0]->id;
        
    }
    
    
    return $contactId;
}

add_hook("ClientAdd", 1, "whmcs2billysbilling_hook_ClientAdd");
?>