<?php

// *************************************************************************************************************
// **************** CREATES UNIQUE RFC SECURE STRING 32 HEX CHARS and 4 HYPHENS IN LENGTH **********************
// ************************************************************************************************************* 

function makeSecureUUID() {

   if (function_exists('com_create_guid') === true) {
      return trim(com_create_guid(), '{}');
   }
   
   return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', 
          mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

// *************************************************************************************************************
// ********************************* LOGIN TO APPLICATION ******************************************************
// *************************************************************************************************************

function cms_login($hash) {  
global $loginTBL, $activityTBL, $homeMenuPage, $loginPage, $u_lvl_min, $u_lvl_max, $today, $pw_salt;
  
  $form_vals = array_map('trim', $hash);  

  // check to make sure all fields populated
  if( isset($form_vals['fname']) && isset($form_vals['lname']) && isset($form_vals['password']) ) {
	 if($form_vals['fname'] == '' || $form_vals['lname'] == '' || $form_vals['password'] == '' ) {
	   return 'Please try again 1';
	   exit;
	 }	
  } else {  
	 return 'All fields required';
	 exit;	  
  }
  
  // validate length
  if(strlen($form_vals['fname']) > 20 || strlen($form_vals['lname']) > 20 ) {
	 return "Please try again 2";
	 exit;
  }
  
  // validate length
  if(strlen($form_vals['password']) > 16 ) {
	 return "Please try again 3";
	 exit;
  }    

  // strip html tags from fname,lname; encrypt pword for comparison to stored pword  
  $form_vals = array_map('strip_tags',$form_vals);
  $form_vals = str_replace(' ','',$form_vals); 
  //hash('sha256', str_replace(" ", "", $form_vals['password']) . $pw_salt);
  
  // connect to db
  $link = db_connect_site(); 
  // real_escape the input
  $form_vals = realEscape($form_vals, $link);  
  
  // send query
  if($result = mysqli_query($link,"SELECT fname,lname,pword,level FROM $loginTBL WHERE fname='{$form_vals['fname']}' AND lname='{$form_vals['lname']}' AND pword='{$form_vals['password']}' LIMIT 1")) {  						
  					 
     while ($row = mysqli_fetch_assoc($result)) {        
        $lname = $row['lname'];
        $level = is_numeric($row['level']) ? $row['level'] : '0';
     }
	 
  } else {
	  
     return 'Please try again 4';
     exit;
	 
  }	  	  
			 
  // if User Level has not been previously entered or is not "1" or "2", don't log in
  if ( $level < $u_lvl_min || $level > $u_lvl_max ) {
	return 'Sorry, not able to log you in.';
	exit;
  }	 

  $remoteAddress = $_SERVER['SERVER_ADDR'];
  $serverAddress = $_SERVER['REMOTE_ADDR'];      			
			
  // save user and user-level to SESSIONS  
  $uuid = makeSecureUUID();
  $_SESSION['cms']['u_token'] = $uuid;
  $_SESSION['cms']['u_lname'] = $lname;
  $_SESSION['cms']['u_level'] = $level;
  $action = 'ON';    
  $when   = date("Y-m-d H:i:s");  
  
  // insert login into Usage Table
  $lname  = mysqli_real_escape_string($link,$lname);  
  $result = mysqli_query($link,"INSERT INTO $activityTBL (id,uuid,lname,u_date,server_addr,remote_addr,action) VALUES (NULL,'$uuid','$lname','$when','$serverAddress','$remoteAddress','$action')");
   
  $gotoPage = ($level > $u_lvl_min) ? $homeMenuPage : $loginPage;     	  
  
  header("Location: $gotoPage");
  exit;
 
}

// *************************************************************************************************************
// ********************************* GENERATE RANDOM SALT VALUE ************************************************
// *************************************************************************************************************

function makeSalt() {
    $string = md5(uniqid(rand(), true));
    return substr($string, 0, 3);
}

/*$salt = createSalt();
$hash = hash('sha256', $salt . $hash);
*/

//*****************************************************************
//*****************************************************************
//*****************************************************************

function cms_add_admin($hash,$nextPage) {  
global $loginTBL, $pw_salt, $today;
  
  $form_vals = array_map('trim', $hash);    
  $link      = db_connect();  
  $form_vals = realEscape($form_vals, $link);
  
  $form_vals['password'] = sha1($pw_salt . $form_vals['password']);
  
  // see if already in the database
  $result = mysql_query("SELECT COUNT(*) AS count FROM $loginTBL WHERE fname='{$form_vals['fname']}' AND lname='{$form_vals['lname']}' AND pword='{$form_vals['password']}'");  
  
  if(!$result){
    return "System unavailable.";
	exit;
  }	
  
  $row = mysql_fetch_assoc($result);
  
  if($row['count'] > 0 ) {  
    return "User already exists.";
	exit;
  }	
  
  $result = mysql_query("INSERT INTO $loginTBL (id,in_date,fname,lname,pword,level) 
                         VALUES (
						 NULL,
						 '$today',
						 '{$form_vals['fname']}',
						 '{$form_vals['lname']}',
						 '{$form_vals['password']}',
						 '{$form_vals['level']}' 
						 )"
						 );
  
  if(mysql_affected_rows() <> 1 ) {
    return "Problem creating user.";
	exit;
  }	
			
  db_disconnect($link);  			
  
  header("Location: $nextPage");
  exit;
}

?>