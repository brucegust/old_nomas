<?php

// *********** strip CR/LF ***************************************
// strings only

function stripCRLF($hash) {
  $hash = str_replace('\r\n', "\n", $hash);
  return $hash;
}   

//*****************************************************************
//*****************************************************************
//*****************************************************************

function checkDloadCode($hash) { // to list Symposium presentation download page
global $dloadPass;

   unset($_SESSION['dloads']);
   
   if(!isset($hash) || empty($hash)) {
     return;
	 exit;
   }
   
   if(!isset($hash['dloadPass']) || empty($hash['dloadPass'])) {
	 return;
	 exit;
   }      

   $hash      = array_map("trim",$hash);
   $hash      = array_map("strip_tags",$hash);
   $hashPword = preg_replace ('/[^a-z0-9]/i', '', $hash['dloadPass']);
   $hashPword = strtolower($hash['dloadPass']);
   
   if(strlen($hashPword) <> 9 ) {
     return;
	 exit;
   }         
   
   if($hashPword <> $dloadPass) {
     return;
	 exit;
   }  
   
   $_SESSION['dloads'] = $dloadPass;
   return true;
   exit;
   
}

//****************************************************************************************
//****************************************************************************************
//****************************************************************************************

function checkContact($hash) {
global $formError, $toEmail, $Subject;
   
	include_once '_inc/securimage/securimage.php';
    $securimage = new Securimage();   
   
    $sent = '';
    $form_vals = array_map("trim", $hash);  
	$form_vals = array_map("strip_tags", $form_vals);	   	
	
	if(!isset($form_vals["name"]) || empty($form_vals["name"])) {		
	   $formError['name'] = "Name required.";	   	   
	}	

	if(!isset($form_vals['email']) || empty($form_vals['email'])) {
	   $formError['email'] = "An email address is required.";	   	   	   
	}
	
	if(isset($form_vals['email']) || !empty($form_vals['email'])) {
       if(!preg_match('/^([A-Z0-9]+[._]?){1,}[A-Z0-9]+\@(([A-Z0-9]+[-]?){1,}[A-Z0-9]+\.){1,}[A-Z]{2,4}$/i', $form_vals['email'])) {
          $formError['email'] = "Please double-check email address.";
	   }
	}
	
	if(!isset($form_vals['message']) || empty($form_vals['message'])) {
	   $formError['message'] = "A message is required.";	   	   	   
	}		

	if (count($formError) > 0) {
		return $formError;
		exit;
	}
	
    if ($securimage->check($form_vals['captcha_code']) == false) {
       $formError['captcha_code'] = "Please enter correct anti-spam code";
	   return $formError;
       exit;
    }
	
    $link = db_connect_site();
	
	$renew    = mysqli_real_escape_string($link,$form_vals["renew"]);
	$nomas    = mysqli_real_escape_string($link,$form_vals["nomas"]);
	$olce     = mysqli_real_escape_string($link,$form_vals["olce"]);
	$update   = mysqli_real_escape_string($link,$form_vals["update"]);
	$other    = mysqli_real_escape_string($link,$form_vals["other"]);
	$name     = mysqli_real_escape_string($link,$form_vals["name"]);	
    $addr1    = mysqli_real_escape_string($link,$form_vals["addr1"]);	
    $addr2    = mysqli_real_escape_string($link,$form_vals["addr2"]);
    $city     = mysqli_real_escape_string($link,$form_vals["city"]);
    $state    = mysqli_real_escape_string($link,$form_vals["state"]);
    $country  = mysqli_real_escape_string($link,$form_vals["country"]);
    $zip      = mysqli_real_escape_string($link,$form_vals["zip"]);
	$email    = mysqli_real_escape_string($link,$form_vals["email"]);
    $phone    = formatPhone($form_vals["phone"]);		
	$message  = mysqli_real_escape_string($link,$form_vals["message"]); 
	$message  = str_replace("\\r\\n",' ',$message);
		
	// build and send e-mail
	$body     = "INQUIRY FROM NOMAS INTL. WEB SITE VISITOR: $name\n\n";
	$body    .= "Note: do not reply directly to this email.\n";
	$body    .= "Use the email address provided below.\n";
	$body    .= "--------------------------------------------------\n\n";
	$body    .= "REQUESTED MATERIAL\n";
	$body    .= "Renew License  : $renew\n";
	$body    .= "NOMAS brochure : $nomas\n";
	$body    .= "Continuing Ed  : $olce\n";	
	$body    .= "Update registry: $update\n";	
	$body    .= "Other          : $other\n\n";		
	$body    .= "CONTACT INFO:\n";
	$body    .= "Name           : $name\n";		
	$body    .= "EMAIL          : $email\n";	
	$body    .= "Addr1          : $addr1\n";	
	$body    .= "Addr2          : $addr2\n";
	$body    .= "City           : $city\n";
	$body    .= "State          : $state\n";
	$body    .= "Country        : $country\n";
	$body    .= "Zip            : $zip\n";
	$body    .= "Phone          : $phone\n\n";
	$body    .= "MESSAGE:\n";
    $body    .= "$message\n\n";
    $body    .= "--------------------------------------------------\n";	
	$body    .= "Sent by IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
	$headers  = "From: $name\r\n";
	$headers .= "Reply-To: $email\r\n";
	$headers .= "X-Mailer: PHP/\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
	
	if(!@mail($toEmail, $Subject, $body, $headers)) {
	   $formError['problem'] = "Technical problem. Sorry. Please send again";
	   return $formError;
	   exit;
	}	
    
	$sent = "OK";
	return $sent;
	exit;
}	

//****************************************************************************************
//****************************************************************************************
//****************************************************************************************

function checkSymposiumForm($hash) {
global $formError, $toEmail, $Subject, $symposiumRegTBL;

	include_once '_inc/securimage/securimage.php';
    $securimage = new Securimage(); 
   
    $sent = '';
    $form_vals = array_map("trim", $hash);  
	$form_vals = array_map("strip_tags", $form_vals);	   	
		
	if(!isset($form_vals["name"]) || empty($form_vals["name"])) {		
	   $formError['name'] = "Name required.";	   	   
	}	
	
	if(isset($form_vals["nomas_num"]) && $form_vals["nomas_num"] > '') {		
	   if(!is_numeric($form_vals["nomas_num"]) || strlen($form_vals["nomas_num"]) > '10') {
		  $formError['nomas_num'] = "Double check NOMAS license number";
	   }
	}
	
	if (isset($form_vals["s1_a"]) && $form_vals["s1_a"] > '3' ) {
	   $formError['s1'] = "At least one number above is out of range";
	}	
	if (isset($form_vals["s1_a"]) && !is_numeric($form_vals["s1_a"]) ) {
	   $formError['s1'] = "At least one entry above is not a digit";
	}	
		
	if (isset($form_vals["s1_b"]) && $form_vals["s1_b"] > '3' ) {
		$formError['s1'] = "At least one number above is out of range";
	}
	if (isset($form_vals["s1_b"]) && !is_numeric($form_vals["s1_b"]) ) {
	   $formError['s1'] = "At least one entry above is not a digit";
	}	
		
	if (isset($form_vals["s1_c"]) && $form_vals["s1_c"] > '3' ) {
		$formError['s1'] = "At least one number above is out of range";
	}		
	if (isset($form_vals["s1_c"]) && !is_numeric($form_vals["s1_c"]) ) {
	   $formError['s1'] = "At least one entry above is not a digit";
	}	
		
	if (isset($form_vals["s2_a"]) && $form_vals["s2_a"] > '3' ) {
		$formError['s2'] = "At least one number above is out of range";
	}
	if (isset($form_vals["s2_a"]) && !is_numeric($form_vals["s2_a"]) ) {
	   $formError['s2'] = "At least one entry above is not a digit";
	}	
		
	if (isset($form_vals["s2_b"]) && $form_vals["s2_b"] > '3' ) {
		$formError['s2'] = "At least one number above is out of range";
	}
	if (isset($form_vals["s2_b"]) && !is_numeric($form_vals["s2_b"]) ) {
	   $formError['s2'] = "At least one entry above is not a digit";
	}
		
	if (isset($form_vals["s2_c"]) && $form_vals["s2_c"] > '3' ) {
		$formError['s2'] = "At least one number above is out of range";
	}
	if (isset($form_vals["s2_c"]) && !is_numeric($form_vals["s2_c"]) ) {
	   $formError['s2'] = "At least one entry above is not a digit";
	}
		
	if (isset($form_vals["s3_a"]) && $form_vals["s3_a"] > '3' ) {
		$formError['s3'] = "At least one number above is out of range";
	}
	if (isset($form_vals["s3_a"]) && !is_numeric($form_vals["s3_a"]) ) {
	   $formError['s3'] = "At least one entry above is not a digit";
	}
		
	if (isset($form_vals["s3_b"]) && $form_vals["s3_b"] > '3' ) {
		$formError['s3'] = "At least one number above is out of range";
	}
	if (isset($form_vals["s3_b"]) && !is_numeric($form_vals["s3_b"]) ) {
	   $formError['s3'] = "At least one entry above is not a digit";
	}
		
	if (isset($form_vals["s3_c"]) && $form_vals["s3_c"] > '3' ) {
		$formError['s3'] = "At least one number above is out of range";
	}				
	if (isset($form_vals["s3_c"]) && !is_numeric($form_vals["s3_c"]) ) {
	   $formError['s3'] = "At least one entry above is not a digit";
	}
		
	if (isset($form_vals["s4_a"]) && $form_vals["s4_a"] > '3' ) {
		$formError['s4'] = "At least one number above is out of range";
	}
	if (isset($form_vals["s4_a"]) && !is_numeric($form_vals["s4_a"]) ) {
	   $formError['s4'] = "At least one entry above is not a digit";
	}
		
	if (isset($form_vals["s4_b"]) && $form_vals["s4_b"] > '3' ) {
		$formError['s4'] = "At least one number above is out of range";
	}
	if (isset($form_vals["s4_b"]) && !is_numeric($form_vals["s4_b"]) ) {
	   $formError['s4'] = "At least one entry above is not a digit";
	}
		
	if (isset($form_vals["s4_c"]) && $form_vals["s4_c"] > '3' ) {
		$formError['s4'] = "At least one number above is out of range";
	}				
	if (isset($form_vals["s4_c"]) && !is_numeric($form_vals["s4_c"]) ) {
	   $formError['s4'] = "At least one entry above is not a digit";
	}	
	
	if (isset($form_vals["d_a"]) && $form_vals["d_a"] > '4' ) {
		$formError['da'] = "At least one number above is out of range";
	}				
	if (isset($form_vals["d_a"]) && !is_numeric($form_vals["d_a"]) ) {
	   $formError['da'] = "At least one entry above is not a digit";
	}		
	if (isset($form_vals["d_b"]) && $form_vals["d_b"] > '4' ) {
		$formError['db'] = "At least one number above is out of range";
	}				
	if (isset($form_vals["d_b"]) && !is_numeric($form_vals["d_b"]) ) {
	   $formError['db'] = "At least one entry above is not a digit";
	}	
	if (isset($form_vals["d_c"]) && $form_vals["d_c"] > '4' ) {
		$formError['dc'] = "At least one number above is out of range";
	}				
	if (isset($form_vals["d_c"]) && !is_numeric($form_vals["d_c"]) ) {
	   $formError['dc'] = "At least one entry above is not a digit";
	}				
	if (isset($form_vals["d_d"]) && $form_vals["d_d"] > '4' ) {
		$formError['dd'] = "At least one number above is out of range";
	}				
	if (isset($form_vals["d_d"]) && !is_numeric($form_vals["d_d"]) ) {
	   $formError['dd'] = "At least one entry above is not a digit";
	}				
	
	if (count($formError)) {
		return $formError;
		exit;
	}			
		
    if ($securimage->check($form_vals["captcha_code"]) == false) {
       $formError['captcha_code'] = "Please enter correct anti-spam code";
	   return $formError;
       exit;
    }		
    		
	$link       = db_connect_site();
	$form_vals  = realEscape($form_vals,$link);
		
	$symp_year  = $form_vals["symp_year"];
	$date_in    = $form_vals["date_in"];
	$check_amt  = (isset($form_vals["check_amt"]) && !empty($form_vals["check_amt"])) ? str_replace("$", "", $form_vals["check_amt"]) : $form_vals["check_amt"];
	$phone1     = formatPhone($form_vals["phone1"]);
	$city_state = (isset($form_vals["city_state"]) && !empty($form_vals["city_state"])) ? ucwords($form_vals["city_state"]) : $form_vals["city_state"];	
	$name       = $form_vals["name"];
	$profession = $form_vals["profession"];
	$employer   = $form_vals["employer"];
	$email      = $form_vals["email"];
	$home_addr  = stripCRLF($form_vals["home_addr"]);
	$nurses_num = $form_vals["nurses_num"];
	$nomas_num  = $form_vals["nomas_num"];
	$s1_a       = $form_vals["s1_a"];
	$s1_b       = $form_vals["s1_b"];
	$s1_c       = $form_vals["s1_c"];
	$s2_a       = $form_vals["s2_a"];
	$s2_b       = $form_vals["s2_b"];
	$s2_c       = $form_vals["s2_c"];
	$s3_a       = $form_vals["s3_a"];
	$s3_b       = $form_vals["s3_b"];
	$s3_c       = $form_vals["s3_c"];
	$s4_a       = $form_vals["s4_a"];
	$s4_b       = $form_vals["s4_b"];
	$s4_c       = $form_vals["s4_c"];	
    $d_a        = $form_vals["d_a"];
    $d_b        = $form_vals["d_b"];
    $d_c        = $form_vals["d_c"];
    $d_d        = $form_vals["d_d"];			
	$message    = stripCRLF($form_vals["message"]);
	
    if($result = mysqli_query($link,"INSERT INTO $symposiumRegTBL (date_in,symp_year,check_amt,name,profession,employer,city_state,phone1,email,home_addr,nomas_num,nurses_num,
                                     s1_a,s1_b,s1_c,s2_a,s2_b,s2_c,s3_a,s3_b,s3_c,s4_a,s4_b,s4_c,d_a,d_b,d_c,d_d,message) 
															
                                     VALUES ('$date_in','$symp_year','$check_amt','$name','$profession','$employer','$city_state','$phone1','$email','$home_addr','$nomas_num','$nurses_num',
								     '$s1_a','$s1_b','$s1_c','$s2_a','$s2_b','$s2_c','$s3_a','$s3_b','$s3_c','$s4_a','$s4_b','$s4_c','$d_a','$d_b','$d_c','$d_d','$message')")) { 
    }
	
    mysqli_free_result($result);		
	
	$symp_year  = stripslashes($symp_year);
	$date_in    = stripslashes($date_in);
	$check_amt  = (isset($form_vals["check_amt"]) && !empty($form_vals["check_amt"])) ? str_replace("$", "", $form_vals["check_amt"]) : $form_vals["check_amt"];
	$phone1     = stripslashes($phone1);
	$city_state = (isset($form_vals["city_state"]) && !empty($form_vals["city_state"])) ? ucwords($form_vals["city_state"]) : $form_vals["city_state"];	
	$name       = stripslashes($name);
	$profession = stripslashes($profession);
	$employer   = stripslashes($employer);
	$email      = stripslashes($email);
	$home_addr  = stripslashes($home_addr);
	$nurses_num = stripslashes($nurses_num);
	$nomas_num  = stripslashes($nomas_num);
	$message    = stripslashes($message);			
	
	// build and send e-mail
	$body     = "SYMPOSIUM REGISTRATION FROM WEB SITE VISITOR: $name\n";
	$body    .= "\nnote: do not reply directly to this email.\n";
	$body    .= "use the email address provided below.\n";
	$body    .= "--------------------------------------------------\n";
	$body    .= "\nRECEIVED: $date_in\n";
	$body    .= "\nName    : $name\n";		
	$body    .= "Job     : $profession\n";		
	$body    .= "Employer: $employer\n";	
	$body    .= "City/St : $city_state\n";	
	$body    .= "Phone   : $phone1\n";		
	$body    .= "Email   : $email\n";	
	$body    .= "Address : $home_addr\n";
	$body    .= "\nNOMAS # : $nomas_num\n";	
	$body    .= "CA BRN# : $nurses_num\n";		
	$body    .= "\nLearning Modules:\n";
	$body    .= "\nSession 1 - Talk A: $s1_a | Talk B: $s1_b | Talk C: $s1_c\n";
	$body    .= "\nSession 2 - Talk A: $s2_a | Talk B: $s2_b | Talk C: $s2_c\n";
	$body    .= "\nSession 3 - Talk A: $s3_a | Talk B: $s3_b | Talk C: $s3_c\n";
	$body    .= "\nSession 4 - Talk A: $s4_a | Talk B: $s4_b | Talk C: $s4_c\n";
	$body    .= "\nIn-Depth Modules:\n";
	$body    .= "\nTalk A: $d_a\n";
	$body    .= "\nTalk B: $d_b\n";
	$body    .= "\nTalk C: $d_c\n";
	$body    .= "\nCheck?    $check_amt\n";
	$body    .= "\nMESSAGE:\n\n";
    $body    .= "$message\n";
    $body    .= "\n--------------------------------------------------\n";	
	$body    .= "Sent by IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
	$headers  = "From: $name\r\n";
	$headers .= "Reply-To: $email\r\n";
	$headers .= "X-Mailer: PHP/\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";    
	
	if(!@mail($toEmail, $Subject, $body, $headers)) {
	   $formError['problem'] = "Technical (email) problem. Sorry! Please send registration again";
	   return $formError;
	}    		 
	
    $sent = "OK";
    return $sent;	
	exit;
}	

?>