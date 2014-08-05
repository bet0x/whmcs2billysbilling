#whmcs2billysbilling
===================

 * Whmcs to BillysBilling Hooks
 *
 *
 * @package    whmcs2billysbilling
 * @author     Kim Vinberg <info@dicm.dk>
 * @copyright  Copyright (c) Kim Vinberg 2014
 * @license    http://dicm.dk/billysbilling/
 * @version    1.0.2
 * @link       http://dicm.dk/billysbilling/
 * @github	https://github.com/dicm/whmcs2billysbilling
 * Tested and workig on WHMCS 5.3.5, 5.3.6 and 5.3.7


## Installation guide 
1. Start by making a backup of all your files and databases.  
2. Download the files from GitHub or http://dicm.dk/billysbilling/ 
3. Upload the files to your WHMCS installation with FTP or your prefered 
uploading method. The files must be uploaded to this directory: 
/modules/addons/whmcs2billysbilling/ If you do not have the directory 
whmcs2billysbilling, then create it. 
4. Login as administrator / admin in WHMCS backend 
5. Goto Setup ­> Addon Modules /admin/configaddonmods.php 

## NOTES
You might get errors just by uploading the files, it is highly importnat to 
configure the addon when the files have been uploaded. 

6. Find the addon “Whmcs to BillysBilling” and activate it. If you get a white 
page with errors on it, just navigate to the admin url /admin/configaddonmods.php 
7. Now click “configure” next to the “Deactivate” button and configure the 
addon. 
8. Login to your account at BillysBilling’s website. Find your API key or 
create one for WHMCS. 9) In “Whmcs to BillysBilling” configure page, insert your API key in the
field called “BillysBilling API key” (API keys look like this: 
x000xx0xxx0x00x0xx000000x000000xx000000 ) 
9. Enter your admin username from WHMCS in the field “WHMCS admin 
username”. Now save the config and the open “Configure” again. 
10. Now you just need 4 more fields to setup. Looks at the image below to 
see a setup. 

##EXTRA
If you get payments tru Paypal and do not want them to be sent to your 
“bank” account in billysBilling when an invoice is paid, then you will have to 
setup an account in billysbilling with the name “whmcs­paypal” in the 
correct currency you use for paypal. When an invoice get payed with 
Paypal and you have that account name in BillysBilling, it will place the 
money correctly in Billysbilling, if there is no account with the name whmcs­paypal, it will place the money in the default bank account from the
config. 
## IN CASE OF ERROR ** 
If there is errors while the script run, it will log them in WHMCS under 
activity log. 
** TESTING THE SETUP ** 
Testing is easy, you already got a wokring WHMCS setup and you just 
need to setup the whmcs to billysbilling part. You have already done this i 
hope. 
 I RECOMMEND YOU USE A TRIAL ACCOUNT THE FIRST TESTS. 
Testing: Using a clean BillysBilling account (easyer) 
1) Go to your website and place an order , just like any normal guest 
would. When you reach the payment page, then take a look in BillysBilling, 
it should already have saved the invoice (unpaid), your whmcs­id will be set 
as client and the product will be created in the invoice. Product names is 
not always 100% accurate, some description can be gone or added. Now pay the invoice and the status of the invoice in BillysBilling will change 
too. In case of error, check the whmcs activity log ( you can find it here: 
/admin/systemactivitylog.php) 






Changelog:
** 1.0.2 **
* Fixed bug with accounts not displaying correctly when a comma is present in name.
* Changes the function accountIdSplit() to avoid errors if users have ( in account names.
* Removed cashExchangeRate from postInvoicepaid.php , use accounts with correct currency.
* Added WHMCS logging. All errors are now logged in WHMCS  (/admin/systemactivitylog.php)

** 1.0.1 **
* Updated Error codes output. Now showing file and line number with the error.
* Added fallback to $defaultSalesAccountId and $defaultSalesTaxRulesetId if not found in Billysbilling it will use the ones set in WHMCS.
* Added 'cashExchangeRate' => '1', in invoicePaid to avoid errors with other currency. Exchangerate is always 1.
* Removing VAT to invoies when sent to BillysBilling, if there is no VAT on the invoice in WHMCS.
* Added file /functions/accountIdSplit.php - used to split the accountId from the name in fields from WHMCS
* When creating the invoice in BillysBilling, save it as invoice and not Draft.
* From line 90 to 103 in postInvoicePaid.php commented out.
* Removed explanation fields and updated backend code to handle this [Suggestion of BillysBilling].
* Changed the automatic payment to account id part, added a prefix (whmcs-XXXX). Previouesly when account name was (example) paypal and the client used paypal to pay with, the addon would find that account and insert the payment into in BillysBilling, now it will search for whmcs-paypal, if no accou with that name is found it will use Default revenue account id

** 1.0.0 **
* Went from dev version to stable release.


##What this does:
* Saves new clients in BillysBilling when created in WHMCS.
* Converts country codes from WHMCS to BillysBilling country codes for clients / invoices.
* Transfers invoices from WHMCS to BillysBilling.
* Creating products in BillysBilling when sending the invoice.
* Updating invoice to "Paid" when WHMCS status changes.


##BUGS **
This is a list of known bugs.
* Some users have problems with the invoice using wrong product names. Unknown reason. 

Please read the pdf readme file before installing.

## EXTRA : HIGHLY IMPORTANT **

When a payment come from exmaple Paypal, you maybe not want it to send the money to the "Default payment account id" in BillysBilling, to prevent this. Create a bank account in BillysBilling with the exact same name WHMCS uses. 
Most of the time Paypal uses the name "Paypal" in WHMCS and you should call the bank account "Paypal" in billysBilling. If you call it the same, "Whmcs to BillysBilling" will find the account and use it instead of the "Default payment account id".

All done.



