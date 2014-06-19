whmcs2billysbilling
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


What this does:
* Saves new clients in BillysBilling when created in WHMCS.
* Converts country codes from WHMCS to BillysBilling country codes for clients / invoices.
* Transfers invoices from WHMCS to BillysBilling.
* Creating products in BillysBilling when sending the invoice.
* Updating invoice to "Paid" when WHMCS status changes.


** BUGS **
This is a list of known bugs.
* Some users have problems with the invoice using wrong product names. Unknown reason. 

Please read the pdf readme file before installing.

** EXTRA : HIGHLY IMPORTANT **

When a payment come from exmaple Paypal, you maybe not want it to send the money to the "Default payment account id" in BillysBilling, to prevent this. Create a bank account in BillysBilling with the exact same name WHMCS uses. 
Most of the time Paypal uses the name "Paypal" in WHMCS and you should call the bank account "Paypal" in billysBilling. If you call it the same, "Whmcs to BillysBilling" will find the account and use it instead of the "Default payment account id".

All done.



