<?php

$db_pword = "Edzp0DyR7H";
$pw_salt  = "DiN#l1h-Z53@7_29x"; // salt for passwords
//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

function db_connect_site() {
global $environment,$db_pword;
   
   if($environment == "LCL") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_punkysite";
      $g_db_username = "root";
      $g_db_password = "";
   } elseif($environment == "WEB") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_punkysite";
      $g_db_username = "nomasint_s0r3n";
      $g_db_password = $db_pword;
   }
	  	   
   if($link = mysqli_connect($g_db_hostname, $g_db_username, $g_db_password, $g_db_name)) {
      mysqli_set_charset($link, 'utf8'); 
      return $link;
   } else { return "Cannot connect to databases."; }
}

function db_connect() {
global $environment,$db_pword;
   
   if($environment == "LCL") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_punkysite";
      $g_db_username = "root";
      $g_db_password = "";
   } elseif($environment == "WEB") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_punkysite";
      $g_db_username = "nomasint_s0r3n";
      $g_db_password = $db_pword;
   }
	  	   
   if($link = mysqli_connect($g_db_hostname, $g_db_username, $g_db_password, $g_db_name)) {
      mysqli_set_charset($link, 'utf8'); 
      return $link;
   } else { return "Cannot connect to databases."; }
}

//**************************************************************************************************

function db_connect_smf() {
global $environment,$db_pword;

   if($environment == "LCL") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_smf";
      $g_db_username = "root";
      $g_db_password = "";
   } elseif($environment == "WEB") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_smf";
      $g_db_username = "nomasint_s0r3n";
      $g_db_password = $db_pword;
   }
	  	   
   if($link = mysqli_connect($g_db_hostname, $g_db_username, $g_db_password, $g_db_name)) {
      mysqli_set_charset($link, 'utf8'); 
      return $link;
   } else { return "Cannot connect to databases."; }
}

//**************************************************************************************************

function db_connect_sitelok() {
global $environment,$db_pword;

   if($environment == "LCL") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_sitelokpw";
      $g_db_username = "root";
      $g_db_password = "";
   } elseif($environment == "WEB") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_sitelokpw";
      $g_db_username = "nomasint_s0r3n";
      $g_db_password = $db_pword;
   }
	  	   
   if($link = mysqli_connect($g_db_hostname, $g_db_username, $g_db_password, $g_db_name)) {
      mysqli_set_charset($link, 'utf8'); 
      return $link;
   } else { return "Cannot connect to databases. Please try again later"; }
}

function db_disconnect($link) {
  mysqli_close($link);
}

?>