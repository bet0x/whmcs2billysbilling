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

if (!defined("WHMCS"))
	die("This file cannot be accessed directly");

function whmcs2billysbilling_config() {

    $configarray = array(

    "name" => "Whmcs to BillysBilling",
    "description" => "Addon til at importere data fra WHMCS til billysbilling",
    "version" => "1.0.0",
    "author" => "Kim Vinberg - info@dicm.dk",
    "language" => "english",
    "fields" => array(
		"option1" => array ("FriendlyName" => "", "Type" => "yesno", "Size" => "25", "Description" => "Activate \"Create clients automatically (If create invoice option is active, the client will be created) (Not yet available)\" ", ),
		"option2" => array ("FriendlyName" => "", "Type" => "yesno", "Size" => "25", "Description" => "Activate \"Update clients data automatically (Not yet available)\" ", ),	
		"option3" => array ("FriendlyName" => "", "Type" => "yesno", "Size" => "25", "Description" => "Activate \"Create invoices (Not yet available)\" ", ),	
		"option4" => array ("FriendlyName" => "", "Type" => "yesno", "Size" => "25", "Description" => "Activate \"Tilf&oslash;j PDF fil til faktura (Not yet available)\" ", ),	
		"option5" => array ("FriendlyName" => "", "Type" => "yesno", "Size" => "25", "Description" => "Activate \"S&aelig;t fakturaer som betalt, n&aring;r betalt (Not yet available)\" ", ),	
		"option6" => array ("FriendlyName" => "", "Type" => "yesno", "Size" => "25", "Description" => "Activate \"Tilf&oslash;j betalinger automatisk til fakturaer og opdater bel&oslash;b (Not yet available)\" ", ),	
		"option7" => array ("FriendlyName" => "", "Type" => "yesno", "Size" => "25", "Description" => "Activate \"Annuller fakturaer (Not yet available)\" ", ),		
		"option8" => array ("FriendlyName" => "BillysBilling account for payments", "Type" => "text", "Size" => "50", "Description" => "", "Default" => "Bank"),
		"option95" => array ("FriendlyName" => "countryId", "Type" => "text", "Size" => "50", "Description" => "The contacts home/business country. See https://dev.billysbilling.dk/api/v1/types/countries for possible values. This will be used for ALL countries if the script cannot find a suitable ID from WHMCS.", "Default" => "DK"),
		"option97" => array ("FriendlyName" => "currencyId", "Type" => "text", "Size" => "50", "Description" => "Default currency to use for invoices to the contact. Has no effect in the API, as currency for invoice always is required. See https://dev.billysbilling.dk/api/v1/types/currencies for possible values. This will be used for ALL contacts.", "Default" => "DKK"),
		"option98" => array ("FriendlyName" => "Activate \"Log\"", "Type" => "yesno", "Size" => "25", "Description" => "Log file location: /modules/addons/whmcs2billysbilling/whmcs2billysbilling_log.html ", ),	
		"option99" => array ("FriendlyName" => "BillysBilling API key", "Type" => "text", "Size" => "50", "Description" => "", "Default" => "Xx0XXXxX00Xxx0xxXXxXXXXxXXXXXxx0"),
		"option100" => array ("FriendlyName" => "WHMCS admin username", "Type" => "text", "Size" => "50", "Description" => "Requires full access", "Default" => "")
    ));

    return $configarray;

}
function whmcs2billysbilling_activate() {

    # Create Custom DB Table
    $query = "CREATE TABLE `mod_whmcs2billysbilling` (`id` INT( 1 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,`demo` TEXT NOT NULL )";
	$result = mysql_query($query);

    # Return Result
    return array('status'=>'success','description'=>'This is an demo module only. In a real module you might instruct a user how to get started with it here...');
    return array('status'=>'error','description'=>'You can use the error status return to indicate there was a problem activating the module');
    return array('status'=>'info','description'=>'You can use the info status return to display a message to the user');

}

function whmcs2billysbilling_deactivate() {

    # Remove Custom DB Table
    $query = "DROP TABLE `mod_whmcs2billysbilling`";
	$result = mysql_query($query);

    # Return Result
    return array('status'=>'success','description'=>'If successful, you can return a message to show the user here');
    return array('status'=>'error','description'=>'If an error occurs you can return an error message for display here');
    return array('status'=>'info','description'=>'If you want to give an info message to a user you can return it here');

}

function whmcs2billysbilling_upgrade($vars) {

    $version = $vars['version'];

}

function whmcs2billysbilling_output($vars) {

    $modulelink = $vars['modulelink'];
    $version = $vars['version'];

    $LANG = $vars['_lang'];

    echo '<p>'.$LANG['intro'].'</p>
<p>'.$LANG['description'].'</p>
<p>'.$LANG['documentation'].'</p>';

}
