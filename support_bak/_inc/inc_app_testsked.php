<?php

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getTestNumsArray() {
global $testskedTBL;

   $testNumbers = array();
   if($link = db_connect_site()) {
   
	  if($result = mysqli_query($link, "SELECT DISTINCT(testnum) FROM $testskedTBL ORDER BY testnum ASC")) {
		  if(mysqli_num_rows($result) == 0) {
			  $errorMsg['table_empty'] = "Test Numbers Database is empty";
			  return $errorMsg;
			  exit;
		  }	   
		  
		  while($row = mysqli_fetch_row($result)) {
			 $testNumbers[] = $row; 
		  }	
		  
		  $testNumbers = flatten($testNumbers);
		  
		  mysqli_free_result($result);	
		  return $testNumbers;
		  exit;	   	   
	  }   
   }
   
   $errorMsg['dbf_problem'] = "Test Numbers Database problem";
   return $errorMsg;
   exit;	
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getTestTot($val) {
global $testskedTBL;		 

   if($link = db_connect_site()) {
   
	  if($result = mysqli_query($link, "SELECT COUNT(*) FROM $testskedTBL WHERE testnum = '{$val}'")) {	
	  
		 while ($row = mysqli_fetch_row($result)) {
			$answer = $row[0];
		 }
		 mysqli_free_result($result);	  
		 return $answer;
		 exit;
	  }
   }
   
   return  "0";
   exit;               				 
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getTestStatus($val,$status) {
global $testskedTBL;		 

   if($link = db_connect_site()) {
   
	  if($result = mysqli_query($link, "SELECT COUNT(*) FROM $testskedTBL WHERE testnum = '{$val}' AND $status <> '0000-00-00'")) {	
	  
		 while ($row = mysqli_fetch_row($result)) {
			$answer = $row[0];
		 }
		 mysqli_free_result($result);	  
		 return $answer;
		 exit;
	  }
   }
   
   return  "0";
   exit;               				 
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getSked($sid) {
global $testskedTBL;

   if($link = db_connect_site()) {
   
	  $sid_search = (isset($sid) && !empty($sid)) ? "SELECT * FROM $testskedTBL WHERE testnum = '{$sid}' ORDER BY weekopen DESC" : "SELECT * FROM $testskedTBL ORDER BY weekopen DESC";
	  
	  if($result = mysqli_query($link, $sid_search)) {
		  if(mysqli_num_rows($result) == 0) {
			  $errorMsg['table_empty'] = "Database is empty";
			  return $errorMsg;
			  exit;
		  }	   
		  
	  return $result;
	  exit;	   
	  }  
   }
   $errorMsg['dbf_problem'] = "Problem: Can't connect to Database";
   return $errorMsg;
   exit;	
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function deleteTest($delMe) {
global $testskedTBL;

   if(isset($delMe) && count($delMe)) {
	   
      $returnMsg = array(); 	   
	  $limit     = count($delMe); 	
	  $nuked     = 0;  	  
	  
      if($link   = db_connect_site()) {   
   
		 foreach($delMe as $val) {
			if($result = mysqli_query($link, "DELETE FROM $testskedTBL WHERE id = '{$val}' LIMIT $limit")) {
			   $nuked++;
			} else {
			   $returnMsg[] = "ID: " . $val . " not deleted.";
			}		 
		 }
			
		 if(count($returnMsg) > 0) {
			return $returnMsg;
			exit;	  	  
		 }	
		 
		 $numnuked = ($nuked > 1) ? "entries" : "entry";
		 $returnMsg['success'] = $nuked . " " . $numnuked . " deleted.";
		 return $returnMsg;
		 exit;	   	  					      
	 }
  } 
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function addTest($post, $redir) {
global $testskedTBL, $min_test_num, $max_test_num;	   

   if(is_array($post) && count($post)) {

      // all
	  $form_vals = array_map("trim", $post);	  	    
	  
	  // all
      foreach($form_vals as $key => $val) {
		  if(strlen($val) > 100) {
		     $errorMsg[] = $key . " entry is too long.";
		  }		
	  }	  

	  // date entered 	  	  
	  if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $form_vals['entered'])){
		 $errorMsg[] = 'Date entered must be formatted as yyyy-mm-ddd.';
	  }	  	  
	  
	  // name
	  if( !isset($form_vals['name']) || empty($form_vals['name'])) {
		 $errorMsg[] = "Name required.";
	  }	 
	   	   		  
	  // email
      if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $form_vals['email'])) {
         $errorMsg[] = "Please check email format and try again.";
      }  	  	  
	  
	  // order number
	  if( !is_numeric($form_vals['ordernum']) || strlen($form_vals['ordernum']) > 15 ) {
		 $errorMsg[] = "Please check Order Number.";
	  }		  
	  
	  // test number
	  if( $form_vals['testnum'] < $min_test_num || $form_vals['testnum'] > $max_test_num ) {
		 $errorMsg[] = 'Test number must be between ' . $min_test_num . " and " . $max_test_num;
	  }	    	  
	  
	  // week open
	  if(!isset($form_vals['weekopen']) || empty($form_vals['weekopen']) || $form_vals['weekopen'] == '0000-00-00') {
         $errorMsg[] = 'Week Open date required.';	  
	  }
	  	  
	  // weekopen 	  	  
	  if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $form_vals['weekopen'])){
		 $errorMsg[] = 'Week open date must be formatted as yyyy-mmm-ddd.';		 
	  }
	  
      if(isset($errorMsg) && count($errorMsg) > 0) {
	     return $errorMsg;
		 exit;			  
	  }		  	  	  
	  	  	  
      if($link = db_connect_site()) {
	  
	     $weekopen  = date("Y-m-d",strtotime($form_vals['weekopen']));
         $weekclose = date("Y-m-d",strtotime("+7 days $weekopen")); 	
		 $form_vals['weekopen']  = $weekopen;
		 $form_vals['weekclose'] = $weekclose;
		 
		 $entered   = mysqli_real_escape_string($link,$form_vals['entered']);
		 $name      = mysqli_real_escape_string($link,$form_vals['name']);
		 $email     = mysqli_real_escape_string($link,$form_vals['email']);
		 $ordernum  = mysqli_real_escape_string($link,$form_vals['ordernum']);
		 $testnum   = mysqli_real_escape_string($link,$form_vals['testnum']);
		 $weekopen  = mysqli_real_escape_string($link,$form_vals['weekopen']);
		 $weekclose = mysqli_real_escape_string($link,$form_vals['weekclose']);
   
		 $result = mysqli_query($link, "INSERT INTO $testskedTBL (entered,name,email,ordernum,testnum,weekopen,weekclose) 
										VALUES ('{$entered}','{$name}','{$email}','{$ordernum}','{$testnum}','{$weekopen}','{$weekclose}')
									   ");
			 
		 if(!$result) {
			$errorMsg['no_save'] = 'Problem: Could not save this entry ' . mysqli_error($link);
			return $errorMsg;
			exit;  	   
		 }
	  } else { $errorMsg['no_connect'] = 'Could not connect to the database'; return $errorMsg; exit; }
	  
   	$redir = $redir . "?ok=1&name=$name";
    header("Location: $redir");
    exit;  	  						  	  
   }
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function updateTest($post, $redir) {
global $testskedTBL, $min_test_num, $max_test_num, $rlli_numbers, $today;	   


   if(is_array($post) && count($post) > 0) {

      // all
	  $form_vals = array_map("trim", $post);	  	    
	  
	  // all
      foreach($form_vals as $key => $val) {
		  if(strlen($val) > 100) {
		     $errorMsg[] = $key . " entry is too long.";
		  }		
	  }	  
	  	  
	  // date entered 	  	  
	  if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $form_vals['entered'])){
		 $errorMsg[] = 'Date Entered must be formatted as yyyy-mmm-ddd.';
	  }	  	  
	  
	  // name
	  if( !isset($form_vals['name']) || empty($form_vals['name'])) {
		 $errorMsg[] = "Name required.";
	  }	 
	   	   		  
	  // email
      if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $form_vals['email'])) {
         $errorMsg[] = "Please check email format and try again.";
      }  	  	  
	  
	  // order number
	  if( !is_numeric($form_vals['ordernum']) || strlen($form_vals['ordernum']) > 15 ) {
		 $errorMsg[] = "Please check Order Number.";
	  }		  
	  
	  // test number
	  if( $form_vals['testnum'] < $min_test_num || $form_vals['testnum'] > $max_test_num ) {
		 $errorMsg[] = 'Test Number must be between ' . $min_test_num . " and " . $max_test_num;
	  }	    	  
	  
	  // week open
	  if(!isset($form_vals['weekopen']) || empty($form_vals['weekopen']) || $form_vals['weekopen'] == '0000-00-00') {
         $errorMsg[] = 'Week Open date required.';	  
	  }
	  	  
	  // week open 	  	  
	  if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $form_vals['weekopen'])){
		 $errorMsg[] = 'Week Open date must be formatted as yyyy-mmm-ddd.';		 
	  }
	  
	  // week close
	  if(!isset($form_vals['weekclose']) || empty($form_vals['weekclose']) || $form_vals['weekclose'] == '0000-00-00') {
         $errorMsg[] = 'Week Close date required.';	  
	  }
	  	  
	  // week close
	  if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $form_vals['weekclose'])){
		 $errorMsg[] = 'Week Close date must be formatted as yyyy-mmm-ddd.';		 
	  }	  
	  
	  // winopen
	  if(isset($form_vals['winopen']) && !empty($form_vals['winopen']) || $form_vals['winopen'] <> '0000-00-00') {
		 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $form_vals['winopen'])){
		    $errorMsg[] = 'Window Open date must be formatted as yyyy-mmm-ddd.';			
		 }	  	  
      } 
	  
	  // winclose
	  if(isset($form_vals['winclose']) && !empty($form_vals['winclose']) || $form_vals['winclose'] <> '0000-00-00') {
		 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $form_vals['winclose'])){
			$errorMsg[] = 'Window Olose date must be formatted as yyyy-mmm-ddd.';			
		 }	  	  
      }	  	  	  
	  
      if(isset($errorMsg) && count($errorMsg) > 0) {
	     return $errorMsg;
		 exit;			  
	  }		  	  	      	  	  
	 	  	  
      if($link = db_connect_site()) {			 
		 
		 $id        = mysqli_real_escape_string($link,(int)$form_vals['id']);
		 $entered   = mysqli_real_escape_string($link,$form_vals['entered']);
		 $name      = mysqli_real_escape_string($link,$form_vals['name']);
		 $email     = mysqli_real_escape_string($link,$form_vals['email']);
		 $ordernum  = mysqli_real_escape_string($link,$form_vals['ordernum']);
		 $testnum   = mysqli_real_escape_string($link,$form_vals['testnum']);
		 $weekopen  = mysqli_real_escape_string($link,$form_vals['weekopen']);
		 $weekclose = mysqli_real_escape_string($link,$form_vals['weekclose']);
		 $winopen   = mysqli_real_escape_string($link,$form_vals['winopen']);
		 $winclose  = mysqli_real_escape_string($link,$form_vals['winclose']);	 		 		 		 
		 
		 $result = mysqli_query($link,"UPDATE $testskedTBL SET 
										entered   = '{$entered}',
										name      = '{$name}',
										email     = '{$email}',
										ordernum  = '{$ordernum}',
										testnum   = '{$testnum}',
										weekopen  = '{$weekopen}',
										weekclose = '{$weekclose}',
										winopen   = '{$winopen}',
										winclose  = '{$winclose}'									 
										WHERE id  = '{$id}'");
										
		 if(!$result) {
			$errorMsg['no_save'] = 'Problem: Could not save this entry';
			return $errorMsg;
			exit;  	   
		 }		
	     		
	  } else { $errorMsg['no_connect'] = 'Could not connect to the database'; return $errorMsg; exit; }
	  
   	 $redir = $redir . "?ok=1&name=$name";
     header("Location: $redir");
     exit;  	  						  	  
   }
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getSidMsg($sid) {
global $rlli_array;

   if(in_array($sid,$rlli_array)) {	   

      switch ($sid) {
         case 2:
            return " (Reliability)";
			break;
		 case 3:
			return " (Reliability)";
			break;
		 case 4:
			return " (Licensing)";
			break;
      }		

   }
   return;
   exit;	
}
?>