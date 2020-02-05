<?php

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function update_facility($post) {
global $trainingSitesTBL;
   
   // connect
   if(!$link = db_connect_site()) {   	
      $errorMsg['no_connect'] = "Cannot connect to Sites Database"; return $errorMsg; exit; 
   }
   
   // trim
   $post = array_map("trim",$post);   
      
   // check URL length
   if(isset($post['loc']) && strlen($post['loc']) > 250) {
	  $errorMsg['too_long'] = "Facility name is too long"; return $errorMsg; exit;
   }
   
   // check URL length
   if(isset($post['loc_city']) && strlen($post['loc_city']) > 100) {
	  $errorMsg['city_too_long'] = "City name is too long"; return $errorMsg; exit;
   }   
            
   // escape vars		 
   $loc      = mysqli_real_escape_string($link,$post['loc']);
   $loc_city = mysqli_real_escape_string($link,$post['loc_city']);
   $loc_id   = mysqli_real_escape_string($link,$post['loc_id']);
   $visible  = $post['visible'];   
	  
   // update table	  
   if(!$result = mysqli_query($link, "UPDATE $trainingSitesTBL SET loc = '$loc', loc_city = '$loc_city', visible = '$visible' WHERE loc_id = '$loc_id' LIMIT 1")) {	
	  $errorMsg['dbf_query'] = "Sites Database access error"; return $errorMsg; exit; }
	  
   // check for success	  
   if (mysqli_affected_rows( $link ) == -1) {
      $errorMsg['dbf_problem'] = "Could not save the change"; return $errorMsg; exit; 
   }
		 
  // return	     
   $ok = 'Updated OK';
   $redir = $trainingskedEDIT . "?loc_id=$loc_id&ok_facility=$ok";
   header("Location: $redir");   	
   exit;
}


//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function delete_location_dates($dates,$loc_id) {
global $trainingDatesTBL;

   if(is_array($dates) && count($dates)) {
	   
      $errorMsg = array(); 	   
      $link     = db_connect_site();   
   
      foreach($dates as $key => $val) {
         if(!$result = mysqli_query($link, "DELETE FROM $trainingDatesTBL WHERE did = '{$val}'")) {			 	 
			$errorMsg[] = "ID: " . $val . " not deleted.";
		 }		 
	  }
	  
	  if(count($errorMsg)) {
	     return $errorMsg;
	     exit;	  	  
      }	
	  
	  $ok = 'Deleted OK';
      $redir = $trainingskedEDIT . "?loc_id=$loc_id&ok_dates=$ok";
      header("Location: $redir");   	  
	  exit;	   	  					      	  
  } 
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************
function add_course_date($post) {
global $trainingDatesTBL,$trainingskedEDIT;
   
   // connect
   if(!$link = db_connect_site()) {   	
      $errorMsg['no_connect'] = "Cannot connect to Sites Database"; return $errorMsg; exit; 
   }
   
   // trim
   $post = array_map("trim",$post);
   
   // validate
   if(!isset($post['date_0']) || empty($post['date_0'])) {
      $errorMsg['missing'] = "Date required."; return $errorMsg; exit; 	   
   }   
   
   if(!is_numeric(str_replace("-","",$post['date_0'])) ) {
      $errorMsg['not_numeric'] = "Check date format."; return $errorMsg; exit; 	   
   }
   
   if(strlen($post['date_0']) > 10 ) {
      $errorMsg['too_long'] = "Check date format Should be YYYY-MM-DD."; return $errorMsg; exit; 	   
   }      
   
   if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$post['date_0'])){
      $errorMsg['too_long'] = "Check date format. Should be YYYY-MM-DD."; return $errorMsg; exit; 	   
   }    
         
   // escape vars		 
   $loc_id = mysqli_real_escape_string($link,$post['loc_id']); 
   $date   = mysqli_real_escape_string($link,$post['date_0']);
   $year   = substr($post['date_0'],0,4);
	  
   // update table	  
   if(!$result = mysqli_query($link, "INSERT INTO $trainingDatesTBL SET year = '$year', loc_id = '$loc_id', starts = '$date'")) {	
	  $errorMsg['dbf_query'] = "Date Database save error"; return $errorMsg; exit; }
	  
   // check for success	  
   if (mysqli_affected_rows( $link ) == -1) {
      $errorMsg['dbf_problem'] = "Could not save the date"; return $errorMsg; exit; 
   }
		 
  // return	     
   $ok = 'Date Added';
   $redir = $trainingskedEDIT . "?loc_id=$loc_id&ok_date=$ok";
   header("Location: $redir");   	
   exit;
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function delete_location($post) {
global $trainingSitesTBL,$trainingDatesTBL,$trainingskedMain;
	
   // connect
   if(!$link = db_connect_site()) {   	
      $errorMsg['no_connect'] = "Cannot connect to Database"; return $errorMsg; exit; 
   }
   
   // trim
   $post = array_map("trim",$post);	
      
   $loc_id = mysqli_real_escape_string($link,$post['loc_id']); 
   
   // update site table	  
   if(!$result = mysqli_query($link, "DELETE FROM $trainingSitesTBL WHERE loc_id = '$loc_id' LIMIT 1")) {	
	  $errorMsg['dbf_query'] = "Sites Database access error. "; }
	  
   // check for success	  
   if (mysqli_affected_rows( $link ) == -1) {
      $errorMsg['dbf_query'] .= "Could not delete the Site. "; }	  
	  
   // update dates table	  
   if(!$result = mysqli_query($link, "DELETE FROM $trainingDatesTBL WHERE loc_id = '$loc_id'")) {	
	  $errorMsg['dbf_query'] .= "Dates Database access error. "; }	  
	  
   // check for success	  
   if (mysqli_affected_rows( $link ) == -1) {
      $errorMsg['dbf_query'] .= "Could not delete Date(s). "; }
	  
   if(isset($errorMsg) && !empty($errorMsg)) {
	   return $errorMsg;
	   exit;
   }
		 
   // return	     
   $redir = $trainingskedMain;
   header("Location: $redir");   	
   exit;         	
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************
function add_training_site($post) {
global $trainingSitesTBL,$trainingDatesTBL,$trainingskedMain;
   
   // connect
   if(!$link = db_connect_site()) {   	
      $errorMsg['no_connect'] = "Cannot connect to Sites Database"; return $errorMsg; exit; 
   }
   
   // trim
   $post = array_map("trim",$post);
   
   // validate
   // check facility info
   if(!isset($post['loc'])) {
	  $errorMsg['no_loc'] = "Facility name required. "; return $errorMsg; exit;
   } 
   
   if(!isset($post['loc_city']) || empty($post['loc_city']) ) {
	  $errorMsg['no_loc_city'] = "City name required. "; return $errorMsg; exit;
   }        
   
   if(!isset($post['loc_id']) || empty($post['loc_id']) ) {
	  $errorMsg['no_loc_id'] = "Location ID required. "; return $errorMsg; exit;
   }     
   
   // check URL length
   if(isset($post['loc_url']) && strlen($post['loc_url']) > 250) {
	  $errorMsg['too_long'] = "URL is too long"; return $errorMsg; exit;
   }   
 
   // date_0
   if(!is_numeric(str_replace("-","",$post['date_0'])) ) {
      $errorMsg['not_numeric'] = "Check date format."; return $errorMsg; exit; 	   
   }
   
   if(strlen($post['date_0']) > 10 ) {
      $errorMsg['too_long'] = "Check date format Should be YYYY-MM-DD."; return $errorMsg; exit; 	   
   }      
   
   if(isset($post['date_0']) && !empty($post['date_0'])) {
      if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$post['date_0'])){
         $errorMsg['too_long'] = "Check date format. Should be YYYY-MM-DD."; return $errorMsg; exit; 	   
      }    
   }
         
   // escape vars		 
   $loc      = mysqli_real_escape_string($link,$post['loc']); 
   $loc_id   = mysqli_real_escape_string($link,$post['loc_id']); 
   $loc_city = mysqli_real_escape_string($link,$post['loc_city']); 
   $loc_url  = (isset($post['loc_url']) && !empty($post['loc_url'])) ? mysqli_real_escape_string($link,$post['loc_url']) : '';
   $date     = (isset($post['date_0'])  && !empty($post['date_0']))  ? mysqli_real_escape_string($link,$post['date_0']) : '';
   $year     = (isset($post['date_0'])  && !empty($post['date_0']))  ? mysqli_real_escape_string($link,substr($post['date_0'],0,4)) : '';
   
   if(isset($date) && !empty($date)) {
	   	  
	  // insert date into dates table	  
	  if(!$result = mysqli_query($link, "INSERT INTO $trainingDatesTBL SET year = '$year', loc_id = '$loc_id', starts = '$date'")) {	
		 $errorMsg['dbf_query'] = "Date Database save error"; return $errorMsg; exit; }
		 
	  // check for success	  
	  if (mysqli_affected_rows( $link ) == -1) {
		 $errorMsg['dbf_problem'] = "Could not save the date"; return $errorMsg; exit; 
	  }
   }
   
   // insert other vars into site table
   $sql = "INSERT INTO $trainingSitesTBL (id,loc,loc_id,loc_city,loc_url,visible) VALUES (NULL,'$loc','$loc_id','$loc_city','$loc_url','$visible')";
   if(!$result = mysqli_query($link, $sql)) {	
	  $errorMsg['dbf_query'] = "Date Database save error"; return $errorMsg; exit; }
	  
   // check for success	  
   if (mysqli_affected_rows( $link ) == -1) {
	  $errorMsg['dbf_problem'] = "Could not save the data"; return $errorMsg; exit; 
   }   
		 
   // return	     
   $redir = $trainingskedMain;
   header("Location: $redir");   	
   exit;
}

?>