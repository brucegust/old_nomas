<?php

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getAllSites() {
global $trainingSitesTBL, $trainingDatesTBL;

   $allSites = array();
   $loc      = "loc_";
   $numLocs  = "1";
   
   if($link = db_connect_site()) {   
	  if($result = mysqli_query($link, "SELECT * FROM $trainingSitesTBL ORDER BY visible")) {
		  if(mysqli_num_rows($result) == 0) {
			  $errorMsg['table_empty'] = "Database is empty.";
			  return $errorMsg;
			  exit;
		  }	   	     
		  
		  while($row = mysqli_fetch_assoc($result)) {
			 $row = array_map("stripslashes", $row);			   
			 $allSites[$loc.$numLocs] = $row; 
			 $numLocs++;
		  }	
		  
		  mysqli_free_result($result);	
		  return $allSites;
		  exit;	   	   
	  }   
   } 
   
   $errorMsg['dbf_problem'] = "Problem: Cannot open Database.";
   return $errorMsg;
   exit;		   		  	
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getandShowSites() {
global $trainingSitesTBL, $trainingDatesTBL;

	if($link = db_connect_site()) {   	
		  
	   if($result_s = mysqli_query($link, "SELECT * FROM $trainingSitesTBL ORDER BY visible DESC")) {	
		 if (mysqli_num_rows($result_s) > '0' ) {
			echo "<form style='margin:30px 0;' method='POST' novalidate>";
			echo "<table class='sked_table'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th class='th_1'>Site</th>";
			echo "<th class='th_2'>Facility</th>";
			echo "<th class='th_3'>Schedule</th>";
			echo "<th class='th_4'>Visible?</th>";		 
			echo "</tr>";
			echo "</thead>";	
			echo "<tbody>";	  
			while($row = mysqli_fetch_assoc($result_s)) {
			   $id = $rid = $row['id'];
			   $city      = $row['loc_city'];
			   $location  = $row['loc'];
			   $url       = $row['loc_url'];			
			   $site_id   = $lid = $row['loc_id'];
			   $visible   = $row['visible'];
			   $viz_disp  = ($row['visible'] == '1') ? "YES" : "NO";
			   //$vizChk   = ($row['visible']) ? "checked='checked'" : "";
			   
			   if($result_d = mysqli_query($link, "SELECT starts FROM $trainingDatesTBL WHERE loc_id = '{$site_id}' ORDER BY starts ASC")) {
				  if (mysqli_num_rows($result_d) > '0' ) {
					 $date_show = '';
					 while($row = mysqli_fetch_assoc($result_d)) {					  
						$starts    = strtotime($row['starts']);
						$ends      = strtotime("+2 days",$starts);
						$starts    = date("n/j", $starts);
						$ends      = date("n/j", $ends);
						$date_line = $starts . "-" . $ends;		
						$date_show = $date_show . $date_line . "&nbsp;&nbsp;&nbsp;";
					 } // endwhile training date info is available
				  } else { $date_show = "No info available"; } // endif training date info is available
				  
				echo "<tr>";
				//echo "<td class='td_1'><a href='index_app_trainingsked_edit.php?lid=$lid'>" . $city . "</a></td>";
				echo "<td class='td_1'><a href='#'>" . $city . "</a></td>";
				echo "<td class='td_2'>" . $location . "</td>";
				echo "<td class='td_3'>" . $date_show . "</td>";
				echo "<td class='td_4'>" . $viz_disp . "</td>";
			   // echo "<td class='td_4'><input name='viz' type='checkbox' value='" . $viz . "'" . $vizChk . " size='10' maxlength='1'></td>";
				echo "</tr>";	
				
			   } else { echo "<tr><td colspan='4'>Database problem</td></tr>";} 
			}
			echo "</tbody>";
			echo "</table>"; 
			echo "</form>";			 
		 } else { $errorMsg['dbf_empty'] = "No info available"; return $errorMsg; exit; }
	   } else { $errorMsg['dbf_prob'] = "Database problem"; return $errorMsg; exit; }	
	} else { $errorMsg['no_connect'] = "Cannot Connect to Database";return $errorMsg;exit; }
	mysqli_free_result($result_s);
	mysqli_free_result($result_d);
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************
function getTestNumsArray() {
global $testskedTBL;

   $testNumbers = array();
   
   if($link = db_connect_site()) {
   
	  if($result = mysqli_query($link, "SELECT DISTINCT test_num FROM $testskedTBL ORDER BY test_num ASC")) {
		  if(mysqli_num_rows($result) == 0) {
			  $errorMsg['table_empty'] = "Database is empty";
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
   
   $errorMsg['dbf_problem'] = "Problem: Can't open Database";
   return $errorMsg;
   exit;	
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************
/*

function getTestTot($val) {
global $testskedTBL;		 

   $link = db_connect_site();
   
   if($result = mysqli_query($link, "SELECT COUNT(*) FROM $testskedTBL WHERE test_num = '{$val}'")) {	
   
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return  "0";
   exit;               				 
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getTestStatus($val,$status) {
global $testskedTBL;		 

   $link = db_connect_site();
   
   if($result = mysqli_query($link, "SELECT COUNT(*) FROM $testskedTBL WHERE test_num = '{$val}' AND $status IS NOT NULL")) {	
   
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return  "0";
   exit;               				 
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getOTestTot() {
global $olceUsersTBL;		 

   $link = db_connect_olce();
   
   if($result = mysqli_query($link, "SELECT COUNT(*) FROM $olceUsersTBL")) {	
   
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return  "0";
   exit;               				 
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getOTestStatus($status) {
global $olceUsersTBL;		 

   $link = db_connect_olce();
   
   if($result = mysqli_query($link, "SELECT COUNT(*) FROM $olceUsersTBL WHERE '{$status}' IS NOT NULL")) {	
   
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return  "0";
   exit;               				 
}
			
//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getSked($sid) {
global $testskedTBL;

   $link = db_connect_site();
   
   $sid_search = (isset($sid) && !empty($sid)) ? "SELECT * FROM $testskedTBL WHERE test_num = '{$sid}' ORDER BY week_begin DESC": "SELECT * FROM $testskedTBL ORDER BY week_begin DESC";
   
   if($result = mysqli_query($link, $sid_search)) {
	   if(mysqli_num_rows($result) == 0) {
		   $errorMsg['table_empty'] = "Database is empty";
		   return $errorMsg;
		   exit;
	   }	   
   return $result;
   exit;	   
   }   
   $errorMsg['dbf_problem'] = "Problem: Can't open Database";
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
      $link      = db_connect_site();   
   
      foreach($delMe as $val) {
         if($result = mysqli_query($link, "DELETE FROM $testskedTBL WHERE id = '{$val}' LIMIT $limit")) {
		    $nuked++;
		 } else {
			$returnMsg[] = "ID: " . $val . " not deleted.";
		 }		 
	  }
	  	 
	  if(count($returnMsg)) {
	     return $returnMsg;
	     exit;	  	  
      }	
	  
	  $numnuked = ($nuked > 1) ? "entries" : "entry";
	  $returnMsg['success'] = $nuked . " " . $numnuked . " deleted.";
	  return $returnMsg;
	  exit;	   	  					      	  
  } 
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function addTest($post, $redir) {
global $testskedTBL, $min_test_num, $max_test_num;	   

   if(is_array($post) && count($post)) {

	  $form_vals = array_map("trim", $post);
	  
      foreach($form_vals as $key => $val) {
         $val = strip_tags($val);
	  }	  	  		  	  
	  
      foreach($form_vals as $key => $val) {
		  if(strlen($val) > 20) {
		     $errorMsg[] = $key . " entry is too long.";
		  }		
	  }
	  
	  $week_begin = $form_vals['week_begin'];
      $week_end   = $form_vals['week_end'] = date("Y-m-d", strtotime("+7 days $week_begin")); 	  
	  	  	  
	  if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $form_vals['week_begin'])){
		    $errorMsg[] = 'Date must be formatted as YYYY-MM-DD.';
		    return $errorMsg;
	  }
	  
      foreach($form_vals as $key => $val) {
         if(empty($val)) {
	        $errorMsg[] = $key . " must be provided.";
		 }
	  }	  	  	  	  	  
	  
	  if( $form_vals['test_num'] < $min_test_num || $form_vals['test_num'] > $max_test_num ) {
		  $errorMsg[] = 'Test number must be between ' . $min_test_num . " and " . $max_test_num;
	  }
	  
	  if(strpos($form_vals['uname']," ") || strpos($form_vals['pword'], " ")) {
		  $errorMsg[] = 'No spaces allowed in uname or pword';
	  }	  	  	  
	  
      if(isset($errorMsg) && count($errorMsg)) {
	     return $errorMsg;
		 exit;			  
	  }		  	  	  
	  	  	  
      $link = db_connect_site();
	  
	  realEscape($form_vals,$link);
	  
	  $uname      = $form_vals['uname'];
	  $pword      = $form_vals['pword'];
	  $test_num   = $form_vals['test_num'];

	  $result = mysqli_query($link, "INSERT INTO $testskedTBL (id,uname,pword,test_num,week_begin,week_end) 
	                                 VALUES (NULL,'{$uname}','{$pword}','{$test_num}','{$week_begin}','{$week_end}')
		                            ");
	  	  
	  if(!$result) {
	     $errorMsg['no_save'] = 'Problem: could not save this entry';
		 return $errorMsg;
		 exit;  	   
      }
	  
   	$redir = $redir . "?ok=1";
    header("Location: $redir");
    exit;  	  						  	  
   }
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function updateTest($post, $redir) {
global $testskedTBL, $min_test_num, $max_test_num, $rlli_numbers, $today;	   

   if(is_array($post) && count($post)) {

	  $form_vals = array_map("trim", $post);
	  
      foreach($form_vals as $key => $val) {
         $val = strip_tags($val);
	  }	  	  		  	  
	  
      foreach($form_vals as $key => $val) {
		  if(strlen($val) > 20) {
		     $errorMsg[] = $key . " field is too long.";
		  }		
	  }	  	
	  
      foreach($form_vals as $key => $val) {
         if($key == 'id' || $key == 'uname' || $key == 'pword' || $key == 'test_num' || $key == 'week_begin') {
            if(empty($val)) {
	            $errorMsg[] = $key . " field must be filled.";
			}
		 }
	  }	  	    
	  
	  if(strpos($form_vals['uname']," ") || strpos($form_vals['pword'], " ")) {
		  $errorMsg[] = 'No spaces allowed in user name or password';
	  }	  	  	 	  
	  
	  if($form_vals['week_begin'] < $today) {
		  $errorMsg[] = "Beginning of new week must start today or later.";
	  }
	  
	  if( $form_vals['test_num'] < $min_test_num || $form_vals['test_num'] > $max_test_num ) {
		  $errorMsg[] = 'Test number must be ' . $rlli_numbers;
	  }	  
	  	  		
      if(isset($errorMsg) && count($errorMsg)) {
	     return $errorMsg;
		 exit;			  
	  }		  	  				  
	  
	  $form_vals['week_end']   = "NULL";
	  $form_vals['view_begin'] = "NULL";
	  $form_vals['view_end']   = "NULL";
	  	  	
	  $week_begin = $form_vals['week_begin'];
      $week_end   = $form_vals['week_end'] = date("Y-m-d", strtotime("+7 days $week_begin")); 	  	  
	    
	  /*
	  if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $form_vals['week_end'])){
		    $errorMsg[] = 'Date must be formatted as YYYY-MM-DD.';
		    return $errorMsg;
		    exit;			  		  
	  }
	  
	  if(!empty($form_vals['week_begin']) && !empty($form_vals['week_end'])) {
	     if(dateDiff($form_vals['week_begin'],$form_vals['week_end']) < 7 ) {
		    $errorMsg[] = 'The difference between Week Begins and Week Ends is less than seven days.';
		    return $errorMsg;
		    exit;			
	     }
	  }
	  
	  if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $form_vals['view_end'])){
		    $errorMsg[] = 'Date must be formatted as YYYY-MM-DD.';
		    return $errorMsg;
		    exit;			  		  
	  }	  
	  if(!empty($form_vals['view_begin']) && !empty($form_vals['view_end'])) {
		 if(dateDiff($form_vals['view_begin'],$form_vals['view_end']) < 2 ) {
			$errorMsg[] = 'The difference between Window Opens and Window Closes is less than two days.';
		    return $errorMsg;
		    exit;				
		 }		  		  
	  }	  	  
	 	  	  
      $link = db_connect_site();
	  
	  realEscape($form_vals,$link);
	  
	  $id  = $mid = $form_vals['id'];
	  $uname      = $form_vals['uname'];
	  $pword      = $form_vals['pword'];
	  $test_num   = $form_vals['test_num'];
	  $week_begin = $form_vals['week_begin'];
      $week_end   = $form_vals['week_end']; 
	  
	  $result = mysqli_query($link, "UPDATE $testskedTBL 
                                     SET 
									 uname      = '$uname',
									 pword      = '$pword',
									 test_num   = '$test_num',
									 week_begin = '$week_begin',
									 week_end   = '$week_end',
									 view_begin = NULL,
									 view_end   = NULL									 
									 WHERE id   = $id"); 
	  	  
	  if(!$result) {
	     $errorMsg['no_save'] = 'Problem: did not update this entry.';
		 return $errorMsg;
		 exit;  	   
      }
	  
   	 $redir = $redir . "?ok=1";
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
*/
?>