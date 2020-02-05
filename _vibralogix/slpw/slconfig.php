<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Sitelok                                                                                            	 //
// Copyright 2003-2013 Vibralogix                                                                        //
// You are licensed to use this on one domain only. Please contact us for extra licenses                 //
// www.vibralogix.com																														                         //
///////////////////////////////////////////////////////////////////////////////////////////////////////////

$DbHost="localhost";         													  // Database host
$DbName="nomasint_sitelokpw";				    													// Database name
$DbUser="nomasint_s0r3n";    																  		// Database username
$DbPassword="Edzp0DyR7H";       												  	// Database user password

// Usually the settings below don't need changing

$DbTableName="sitelok";        													// Database table name
$DbLogTableName="log";                                  // Database log tablename
$DbConfigTableName="slconfig";                          // Database config tablename
$DbGroupTableName="usergroups";                          // Database config tablename

// Message text
define("MSG_ACCDEN","Access Denied");
define("MSG_DBPROB","There was a database problem");
define("MSG_WRONGGROUP","Your membership does not allow access to this page");
define("MSG_EXPIRED","Access to this page is blocked because your membership has expired");
define("MSG_ACCESSFILE","You are not allowed access to this file");
define("MSG_FILEOPEN","Sitelok could not open the file");
define("MSG_TURING1","CAPTCHA code did not match");
define("MSG_PASSEMAIL","Your login details have been emailed to you");
define("MSG_NOMATCH","No match for username or email");
define("MSG_AUTHFAIL","Authentication failed");
define("MSG_DISABLED","Access is currently disabled");
define("MSG_ACCESSLOC","Access not allowed from this location");
define("MSG_SESSEXP","Session has expired");
define("MSG_INACTEXP","Session was inactive and expired");
define("MSG_ENTERUSER","Please enter your username");
define("MSG_ENTERPASS","Please enter your password");
define("MSG_ENTERTURING","Please enter the displayed CAPTCHA code");
define("MSG_FORGOT1","Please enter your username or email address and the display CAPTCHA code");
define("MSG_FORGOT2","Please enter your username or email address");
define("MSG_PASS5","Password must be at least 5 characters long");
define("MSG_PASSNG","Password contains invalid characters");
define("MSG_PASSVER","Verify password does not match");
define("MSG_ENTERNAME","Please enter your name");
define("MSG_ENTEREMAIL","Please enter your valid email address");
define("MSG_DOWNAUTH","Permission to download denied. Authentication failed");
define("MSG_DOWNEXP","Sorry but this download link has expired");
define("MSG_FORMTAMP","It appears this form has been tampered with");
define("MSG_CANTJOIN","You cannot join this usergroup");
define("MSG_EMAILVER","Your email addresses do not match");
define("MSG_USERNG","Username contains invalid characters");
define("MSG_USEREXISTS","Sorry this username already exists");
define("MSG_EMAILEXISTS","Sorry this email address is already registered");
define("MSG_LINKAUTH","Sorry this link failed. Authentication failed");
define("MSG_LINKEXP","Sorry but this link has expired");
define("MSG_USERAPP","has been approved");
define("MSG_USERDIS","has been disabled");
define("MSG_USERDEL","has been permanently deleted");
define("MSG_NEWPASS","now has the password");
define("MSG_ACCOUNTUPDATE","Your account has been updated");
define("MSG_EMAILNG","Email address is not valid");
define("MSG_PROFUPDATED","Your profile has been updated");
define("MSG_PROFPROBLEM","An error occurred and your profile was NOT updated");
define("MSG_UPLOADERROR","File upload failed");
define("MSG_UPLOADTYPE","Files of this type cannot be uploaded");
define("MSG_EXPASSREQ","You must enter your existing password");
define("MSG_EMAILCONFIRM","Your email address has been set as");
define("MSG_EMAILCONFIRMFAILED","Your email address could not be set to");
define("MSG_USERNAMECONFIRM","Your username has been set as");
define("MSG_USERNAMECONFIRMFAILED","Your username could not be set to");
define("MSG_PROFUPDATEDVEREMAIL","Your profile has been updated. A confirmation link has been sent for you to verify the email address change.");
define("MSG_EMAILSENT","An email has been sent to you");
define("MSG_LOGINLINKHASH","Login link not valid");
define("MSG_LOGINLINKEXPIRED","Login link has expired");
  
?>