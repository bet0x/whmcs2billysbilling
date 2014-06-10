whmcs2billysbilling
===================


 * Whmcs to BillysBilling Hooks
 *
 *
 * @package    whmcs2billysbilling
 * @author     Kim Vinberg <info@dicm.dk>
 * @copyright  Copyright (c) Kim Vinberg 2014
 * @license    http://dicm.dk/billysbilling/
 * @version    1.0.0
 * @link       http://dicm.dk/billysbilling/
 * @github	https://github.com/dicm/whmcs2billysbilling
 * Tested and workig on WHMCS 5.3.2, 5.3.3, 5.3.4, 5.3.5, 5.3.6 and 5.3.7

** 1.0.0 **
* Went from dev version to stable release.


Todo:
* Further testing

What this does:
* Saves new clients in BillysBilling when created in WHMCS.
* Converts country codes from WHMCS to BillysBilling country codes for clients / invoices.
* Transfers invoices from WHMCS to BillysBilling.
* Creating products in BillysBilling when sending the invoice.
* Updating invoice to "Paid" when WHMCS status changes.


** BUGS **
This is a list of known bugs.
* Some users have problems with the invoice using wrong product names. Unknown reason. 



How to install and use:
*** ALWAYS BACKUP FILES AND DATABASE BEFORE INSTALLING ANYTHING ***
1) Download the files. 

2) Create the directory "whmcs2billysbilling" in: WHMCS-DIR/modules/addons/

3) Upload the files to your WHMCS installation in following directory: WHMCS-DIR/modules/addons/whmcs2billysbilling/

4) Login as Admin in WHMCS

5) Goto: Setup -> Addon Modules (/admin/configaddonmods.php)

** NOTE **  

You will get errors just by uploading the files, it is highly important to configure the addon asap.

6) Find the addon "Whmcs to BillysBilling" and activate it. If you get a white page with a lot of errors on it, then just navigate to the url /admin/configaddonmods.php again. 

7) Now click configure on the addon. 

8) Login to your account at http://billysBilling.com / http://billysBilling.dk

9) Find your API key or create one for WHMCS.

10) In "Whmcs to BillysBilling" configure page, insert your API key the the field called "BillysBilling API key" (API key looks like this: x000xx0xxx0x00x0xx000000x000000xx000000

11) Enter your Admin username from WHMCS in the field "WHMCS admin username"

12) Save the configuration and the press configure again. You will now have more options in the fields:


"Default payment account id"
"Explanation of default payment account id"
"Default revenue account id"
"Explanation of default revenue account id"
"Select salesNoTaxRule"
"Select default salesTaxRule"
"Explanation of tax rules"

You will need to setup all fields.
You can find a demo picture of a working setup at: http://dicm.dk/billysbilling/

When done, save and you have now a working addon.


** EXTRA : HIGHLY IMPORTANT **

When a payment come from exmaple Paypal, you maybe not want it to send the money to the "Default payment account id" in BillysBilling, to prevent this. Create a bank account in BillysBilling with the exact same name WHMCS uses. 
Most of the time Paypal uses the name "Paypal" in WHMCS and you should call the bank account "Paypal" in billysBilling. If you call it the same, "Whmcs to BillysBilling" will find the account and use it instead of the "Default payment account id".

All done.


