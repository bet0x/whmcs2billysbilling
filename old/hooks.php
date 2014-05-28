<?php

/**
 * Whmcs to BillysBilling Hooks
 *
 *
 * @package    whmcs2billysbilling
 * @author     Kim Vinberg <info@dicm.dk>
 * @copyright  Copyright (c) Kim Vinberg 2014
 * @license    http://dicm.dk
 * @version    $Id$
 * @link       http://dicm.dk/
 * @github	https://github.com/dicm/whmcs2billysbilling
 */


if (!defined("WHMCS"))
    die("This file cannot be accessed directly");



/* ALL SETTINGS FOR THE SCRIPT */
$q = @mysql_query("SELECT * FROM tbladdonmodules WHERE module = 'whmcs2billysbilling'"); // 
global $whmcs2billysbilling_settings;
while ($arr = mysql_fetch_array($q)) {
    $whmcs2billysbilling_settings[$arr['setting']] = $arr['value'];
} 



if (!function_exists("curl_init")) {
    die("Billy needs the CURL PHP extension.");
} 

if (!function_exists("json_decode")) {
    die("Billy needs the JSON PHP extension.");
   
}


/* Load the class for billysBilling */
	require(dirname(__FILE__) . "/BillysBilling/v2class.php");

	
	

/* Logging */
	//require(dirname(__FILE__) . "/functions/saveLog.php");

	
/* Save the new client postContact */
	require(dirname(__FILE__) . "/functions/postContact.php");	
	

/* Converts country codes from WHMCS to BillysBilling country codes */
	require(dirname(__FILE__) . "/functions/convertCountryId.php");


/* Get localeId */
	//require(dirname(__FILE__) . "/functions/getLocaleId.php");

	
/* Get getContactId */
	//require(dirname(__FILE__) . "/functions/getContactId.php");

	
/* Update client information in BillysBilling */
	//require(dirname(__FILE__) . "/functions/updateClient.php");


/* Save the invoice */
	//require(dirname(__FILE__) . "/functions/postInvoice.php");
	

/* Save product */
	//require(dirname(__FILE__) . "/functions/postProduct.php");	
	
	
/* get account id */
	//require(dirname(__FILE__) . "/functions/getAccountId.php");	
	
	
/* get account id */
	//require(dirname(__FILE__) . "/functions/getVatModelId.php");	


/* get account id */
	//require(dirname(__FILE__) . "/functions/getProductId.php");		

?>    
