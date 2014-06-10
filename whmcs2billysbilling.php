<?php
/**
* Whmcs to BillysBilling
*
*
* @package    whmcs2billysbilling
* @author     Kim Vinberg <info@dicm.dk>
* @copyright  Copyright (c) Kim Vinberg 2014
* @license    http://dicm.dk
* @version    1.0.0
* @link       http://dicm.dk/
* @github	https://github.com/dicm/whmcs2billysbilling
*/

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

/* ALL SETTINGS FOR THE SCRIPT */
$q = @mysql_query("SELECT * FROM tbladdonmodules WHERE module = 'whmcs2billysbilling'");
//
global $whmcs2billysbilling_settings;
while ($arr = mysql_fetch_array($q)) {
    $whmcs2billysbilling_settings[$arr['setting']] = $arr['value'];
}
require_once(dirname(__FILE__) . "/BillysBilling/v2class.php");

function getAccounts($showName = 0)
{
    global $whmcs2billysbilling_settings;
    
    $output = "";
    
    /* Load the class for billysBilling */
    
    $client = new BillyClient($whmcs2billysbilling_settings['option99']);
    //API KEY
    //First check if the contact exists
    $res = $client->request("GET", "/accounts");
    
    if ($res->status !== 200) {
        echo "Something went wrong:\n\n";
        print_r($res->body);
        //exit;
    }
    
    $salesTaxRuleset = "";
    $count = count($res->body->accounts);
    
    $i = "0";
    foreach($res->body->accounts AS $id => $values) {
        
        $i++;
        
        if ($showName == 1) {
            $output .= "".$values->id." = ".$values->name."";
        } else {
            $output .= "".$values->id." (".$values->name.")"; // $output .= "".$values->id."";
        }
        
        if ($count != $i) {
            $output .= ",";
        }
    }
    
    return $output;
    
}

function getSalesTaxRuleset($showName = 0)
{
    global $whmcs2billysbilling_settings;
    
    $output = "";
    
    /* Load the class for billysBilling */
    
    
    $client = new BillyClient($whmcs2billysbilling_settings['option99']);
    //API KEY
    //First check if the contact exists
    $res = $client->request("GET", "/salesTaxRulesets?include=salesTaxRuleset.rules:embed");
    
    if ($res->status !== 200) {
        echo "Something went wrong:\n\n";
        print_r($res->body);
        //exit;
    }
    
    $salesTaxRuleset = "";
    $count = count($res->body->salesTaxRulesets);
    
    $i = "0";
    foreach($res->body->salesTaxRulesets AS $id => $values) {
        
        $i++;
        
        if ($showName == 1) {
            $output .= "".$values->id." = ".$values->name."";
        } else {
           $output .= "".$values->id." (".$values->name.")"; // $output .= "".$values->id."";
        }
        
        if ($count != $i) {
            $output .= ",";
        }
    }
    
    return $output;
    
}

function whmcs2billysbilling_config()
{
    
    $configarray = array("name" => "Whmcs to BillysBilling",
    "description" => "Addon til at importere data fra WHMCS til billysbilling",
    "version" => "1.0.0",
    "author" => "Kim Vinberg - info@dicm.dk",
    "language" => "english",
    "fields" => array("option95" => array("FriendlyName" => "Default payment account id", "Type" => "dropdown", "Options" => getAccounts(),"", "Description" => "Normally 'Bank'", "Default" => "0", ),
   // "option95a" => array("FriendlyName" => "Explanation of default payment account id", "Type" => "dropdown", "Options" => getAccounts(1),"", "Description" => "", "Default" => "0", ),
    "blank0" => array("FriendlyName" => "", "Type" => "none", "", "Description" => "", "Default" => "0", ),
    "option96" => array("FriendlyName" => "Default revenue account id", "Type" => "dropdown", "Options" => getAccounts(),"", "Description" => "Normally 'Sales'", "Default" => "0", ),
  //  "option96a" => array("FriendlyName" => "Explanation of default revenue account id", "Type" => "dropdown", "Options" => getAccounts(1),"", "Description" => "", "Default" => "0", ),
    "blank" => array("FriendlyName" => "", "Type" => "none", "", "Description" => "", "Default" => "0", ),
    "option97" => array("FriendlyName" => "Select salesNoTaxRule", "Type" => "dropdown", "Options" => getSalesTaxRuleset(),"", "Description" => "Select salesNoTaxRule", "Default" => "0", ),
    "option98" => array("FriendlyName" => "Select default salesTaxRule", "Type" => "dropdown", "Options" => getSalesTaxRuleset(),"", "Description" => "Select salesTaxRule", "Default" => "0", ),
   // "option98a" => array("FriendlyName" => "Explanation of tax rules", "Type" => "dropdown", "Options" => getSalesTaxRuleset(1),"", "Description" => "", "Default" => "0", ),
    "blank1" => array("FriendlyName" => "", "Type" => "none", "", "Description" => "", "Default" => "0", ),
    "option99" => array("FriendlyName" => "BillysBilling API key", "Type" => "text", "Size" => "50", "Description" => "", "Default" => ""),
    "option100" => array("FriendlyName" => "WHMCS admin username", "Type" => "text", "Size" => "50", "Description" => "Requires full access", "Default" => "")
    ));
    
    return $configarray;
    
}
function whmcs2billysbilling_activate()
{
    
    # Create Custom DB Table
    $query = "CREATE TABLE `mod_whmcs2billysbilling` (`id` INT( 1 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,`demo` TEXT NOT NULL )";
    $result = mysql_query($query);
    
    # Return Result
    return array('status'=>'success','description'=>'This is an demo module only. In a real module you might instruct a user how to get started with it here...');
    return array('status'=>'error','description'=>'You can use the error status return to indicate there was a problem activating the module');
    return array('status'=>'info','description'=>'You can use the info status return to display a message to the user');
    
}

function whmcs2billysbilling_deactivate()
{
    
    # Remove Custom DB Table
    $query = "DROP TABLE `mod_whmcs2billysbilling`";
    $result = mysql_query($query);
    
    # Return Result
    return array('status'=>'success','description'=>'If successful, you can return a message to show the user here');
    return array('status'=>'error','description'=>'If an error occurs you can return an error message for display here');
    return array('status'=>'info','description'=>'If you want to give an info message to a user you can return it here');
    
}

function whmcs2billysbilling_upgrade($vars)
{
    
    $version = $vars['version'];
    
}

function whmcs2billysbilling_output($vars)
{
    
    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    
    $LANG = $vars['_lang'];
    
    echo '<p>'.$LANG['intro'].'</p>
<p>'.$LANG['description'].'</p>
<p>'.$LANG['documentation'].'</p>';
    
}
