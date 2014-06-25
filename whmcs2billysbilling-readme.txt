Whmcs2BillysBilling v1.0.2 
Installation guide 
 
1) Start by making a backup of all your files and databases.  
 
2) Download the files from GitHub or http://dicm.dk/billysbilling/ 
 
3) Upload the files to your WHMCS installation with FTP or your prefered 
uploading method. The files must be uploaded to this directory: 
/modules/addons/whmcs2billysbilling/ If you do not have the directory 
whmcs2billysbilling, then create it. 
 
4) Login as administrator / admin in WHMCS backend 
 
5) Goto Setup ­> Addon Modules /admin/configaddonmods.php 
 
** NOTES ** 
You might get errors just by uploading the files, it is highly importnat to 
configure the addon when the files have been uploaded. 
 
6) Find the addon “Whmcs to BillysBilling” and activate it. If you get a white 
page with errors on it, just navigate to the admin url /admin/configaddonmods.php 
7) Now click “configure” next to the “Deactivate” button and configure the 
addon. 
8) Login to your account at BillysBilling’s website. Find your API key or 
create one for WHMCS. 9) In “Whmcs to BillysBilling” configure page, insert your API key in the
field called “BillysBilling API key” (API keys look like this: 
x000xx0xxx0x00x0xx000000x000000xx000000 ) 
10) Enter your admin username from WHMCS in the field “WHMCS admin 
username”. Now save the config and the open “Configure” again. 
11) Now you just need 4 more fields to setup. Looks at the image below to 
see a setup. 
 
** EXTRA ** 
If you get payments tru Paypal and do not want them to be sent to your 
“bank” account in billysBilling when an invoice is paid, then you will have to 
setup an account in billysbilling with the name “whmcs­paypal” in the 
correct currency you use for paypal. When an invoice get payed with 
Paypal and you have that account name in BillysBilling, it will place the 
money correctly in Billysbilling, if there is no account with the name whmcs­paypal, it will place the money in the default bank account from the
config. 
** IN CASE OF ERROR ** 
If there is errors while the script run, it will log them in WHMCS under 
activity log. 
** TESTING THE SETUP ** 
Testing is easy, you already got a wokring WHMCS setup and you just 
need to setup the whmcs to billysbilling part. You have already done this i 
hope. 
 I RECOMMEND YOU USE A TRIAL ACCOUNT THE FIRST TESTS. 
Testing: Using a clean BillysBilling account (easyer) 
1) Go to your website and place an order , just like any normal guest 
would. When you reach the payment page, then take a look in BillysBilling, 
it should already have saved the invoice (unpaid), your whmcs­id will be set 
as client and the product will be created in the invoice. Product names is 
not always 100% accurate, some description can be gone or added. Now pay the invoice and the status of the invoice in BillysBilling will change 
too. In case of error, check the whmcs activity log ( you can find it here: 
/admin/systemactivitylog.php) 
