whmcs2billysbilling
===================


 * Whmcs to BillysBilling Hooks
 *
 *
 * @package    whmcs2billysbilling
 * @author     Kim Vinberg <info@dicm.dk>
 * @copyright  Copyright (c) Kim Vinberg 2014
 * @license    http://dicm.dk/
 * @version    1.0.0
 * @link       http://dicm.dk/
 * @github	https://github.com/dicm/whmcs2billysbilling
 * Tested and workig on WHMCS 5.3.2, 5.3.3, 5.3.4, 5.3.5, 5.3.6 and 5.3.7

Changelog:
* 28-05-2014 : Went from dev version to stable release. Version: 1.0.0

v 1.0.0
* Saves new clients in BillysBilling when created in WHMCS.
* Converts country codes from WHMCS to BillysBilling country codes for clients / invoices.
* Transfers invoices from WHMCS to BillysBilling.
* Creating products in BillysBilling when sending the invoice.
* Updating invoice to "Paid" when WHMCS status changes.

Everything automatically


How to install and use:
*** ALWAYS BACKUP FILES AND DATABASE BEFORE INSTALLING ANYTHING ***
1) Download the files. 
2) Create the directory "whmcs2billysbilling" in: WHMCS-DIR/modules/addons/
3) Upload the files to your WHMCS installation in following directory: WHMCS-DIR/modules/addons/whmcs2billysbilling/
4) Login as Admin in WHMCS
5) Goto: Setup -> Addon Modules (/admin/configaddonmods.php)

** NOTE **  You will get errors just by uploading the files, it is highly important to configure the addon asap.

6) Find the addon "Whmcs to BillysBilling" and activate it. If you get a white page with a lot of errors on it, then just navigate to the url /admin/configaddonmods.php again. 
7) Now click configure on the addon. 
