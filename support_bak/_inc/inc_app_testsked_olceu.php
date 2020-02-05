<?php

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function deleteTest($delMe) {
global $ceuusersTBL;

   if(isset($delMe) && count($delMe) > 0 ) {
	   
      $returnMsg = array(); 	   
	  $limit     = count($delMe); 	
	  $nuked     = 0;  	  
	  
      if($link   = db_connect_site()) {   
   
		 foreach($delMe as $val) {
			if($result = mysqli_query($link, "DELETE FROM $ceuusersTBL WHERE orderno = '{$val}' LIMIT $limit")) {
			   $nuked++;
			} else {
			   $returnMsg[] = "Order Number: " . $val . " not deleted.";
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

function updateTest($post, $redir) {
global $ceuusersTBL;	   

   if(is_array($post) && count($post) > 0) {

      // all
	  $form_vals = array_map("trim", $post);	  	    
	  
	  // all
      foreach($form_vals as $key => $val) {
		  if(strlen($val) > 10) {
		     $errorMsg = $key . " entry is too long.";
		  }		
	  }	  	  	  
	  
	  // winclose
	  if(isset($form_vals['winclose']) && !empty($form_vals['winclose'])) {
		 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $form_vals['winclose'])){
			$errorMsg = 'Window Olose date must be formatted as yyyy-mmm-ddd.';			
		 }	  	  
      }	  	  	  
	  
      if(isset($errorMsg) && count($errorMsg) > 0) {
	     return $errorMsg;
		 exit;			  
	  }		  	  	      	  	  
	  	 	  	  
      if($link = db_connect_site()) {			 
	     
		 $orderno  = mysqli_real_escape_string($link,$form_vals['orderno']);		 
		 $winclose = mysqli_real_escape_string($link,$form_vals['winclose']);	 		 		 		 
		 
		 $result = mysqli_query($link,"UPDATE $ceuusersTBL SET winclose  = '{$winclose}' WHERE orderno  = '{$orderno}'");
										
		 if(!$result) {
			$errorMsg = 'Problem: Could not save this entry';
			return $errorMsg;
			exit;  	   
		 }		
	     		
	  } else { $errorMsg = 'Could not connect to the database'; return $errorMsg; exit; }
	  
   	 $redir = $redir . "?ok=1&name=$name";
     header("Location: $redir");
     exit;  	  						  	  
   }
}

?>