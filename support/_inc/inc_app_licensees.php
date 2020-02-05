<?php

//**********************************************************************************************
// Checks whether a var is an array. Quits if not an array or if array is empty
//**********************************************************************************************

function isValidArray($theArray) {
   if(!isset($theArray) || !is_array($theArray) || empty($theArray)) {
      echo "Problem. Please try again later";
	  exit;   
   }   
   return true;
}

//**********************************************************************************************
//
//**********************************************************************************************

function getMemTotalL() {
global $link, $practitionersTBL;

   if($result = mysqli_query($link, "SELECT COUNT(*) FROM $practitionersTBL WHERE license")) {	
   
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return "Practitioners database problem";
   exit;      
}

function getMemTotalU() {
global $link, $practitionersTBL;

   if($result = mysqli_query($link, "SELECT COUNT(*) FROM $practitionersTBL WHERE NOT license")) {	
   
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return "Practitioners database problem";
   exit;      
}


function getMemUSAL() {
global $link, $practitionersTBL;	

   if($result = mysqli_query($link, "SELECT COUNT(*) FROM $practitionersTBL WHERE license AND country = 'USA'")) {	
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return "Practitioners database problem";
   exit;      
}

function getMemUSAU() {
global $link, $practitionersTBL;	

   if($result = mysqli_query($link, "SELECT COUNT(*) FROM $practitionersTBL WHERE NOT license AND country = 'USA'")) {	
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return "Practitioners database problem";
   exit;      
}


function getUsaStates() {
global $link, $practitionersTBL;	

   if($result = mysqli_query($link, "SELECT COUNT(DISTINCT region_state) FROM $practitionersTBL WHERE country = 'USA'")) {
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return "Practitioners database problem";
   exit;      
}

function getUsaCities() {
global $link, $practitionersTBL;	

   if($result = mysqli_query($link, "SELECT COUNT(DISTINCT city) FROM $practitionersTBL WHERE country = 'USA'")) {
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return "Practitioners database problem";
   exit;      
}

function getMemIntlL() {
global $link, $practitionersTBL;	

   if($result = mysqli_query($link, "SELECT COUNT(*) FROM $practitionersTBL WHERE license AND country <> 'USA'")) {
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return "Practitioners database problem";
   exit;      
}

function getMemIntlU() {
global $link, $practitionersTBL;	

   if($result = mysqli_query($link, "SELECT COUNT(*) FROM $practitionersTBL WHERE NOT license AND country <> 'USA'")) {
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return "Practitioners database problem";
   exit;      
}

function getIntlCountries() {
global $link, $practitionersTBL;	

   if($result = mysqli_query($link, "SELECT COUNT(DISTINCT country) FROM $practitionersTBL WHERE country <> 'USA'")) {
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return "Practitioners database problem";
   exit;      
}

function getIntlCities() {
global $link, $practitionersTBL;	

   if($result = mysqli_query($link, "SELECT COUNT(DISTINCT city) FROM $practitionersTBL WHERE country <> 'USA'")) {
      while ($row = mysqli_fetch_row($result)) {
         $answer = $row[0];
	  }
      mysqli_free_result($result);	  
	  return $answer;
	  exit;
   }
   
   return "Practitioners database problem";
   exit;      
}

//*****************************************************************
//*****************************************************************
//*****************************************************************

function removeLicense($post) {
global $practitionersTBL;

   if(is_array($post) && count($post) ) {
	   
      $returnMsg = array();
      $deletes   = (count($post) > 1) ? " practitioners" : " practitioner";
	  $howMany   = 0;
	  
      $link = db_connect_site();   
   
      foreach($post as $value) {	  
	     $result = mysqli_query($link, "UPDATE $practitionersTBL SET license = '0' WHERE cert_num = '{$value}'");	     	     
		 $howMany++;
	  }

	  if(!$result) {
		 $returnMsg['dbf_problem'] = "Practitioners database problem.";
	     return $returnMsg;
		 exit;
	  } 
	  	  
	  $returnMsg['member_un'] = $howMany . $deletes . " un-licensed. To re-license, find them in the 'Unlicensed' section.";  
	  return $returnMsg;  	  
   }
}

//*****************************************************************
//*****************************************************************
//*****************************************************************

function restoreLicense($post) {
global $practitionersTBL;

   if(is_array($post) && count($post) ) {
	   
      $returnMsg = array();
      $deletes   = (count($post) > 1) ? " practitioners" : " practitioner";
	  $howMany   = 0;
	  
      $link = db_connect_site();   
   
      foreach($post as $value) {	  
	     $result = mysqli_query($link, "UPDATE $practitionersTBL SET license = '1' WHERE cert_num = '{$value}'");	     	     
		 $howMany++;
	  }

	  if(!$result) {
		 $returnMsg['dbf_problem'] = "Practitioners database problem.";
	     return $returnMsg;
		 exit;
	  } 
	  	  
	  $returnMsg['member_re'] = $howMany . $deletes . " restored to Licensed status.";  
	  return $returnMsg;  	  
   }
}

//*****************************************************************
//*****************************************************************
//*****************************************************************

function deleteLicensee($nomas_num, $redir) {
global $practitionersTBL;

   $returnMsg = array();

   if(isset($nomas_num) && $nomas_num > '') {
	   	  
      $link = db_connect_site();   
   
      if($result = mysqli_query($link, "DELETE FROM $practitionersTBL WHERE cert_num = '{$nomas_num}' LIMIT 1")) {	     	     
         $redir = $redir . "2";
         header("Location: $redir");
         exit;  	  					
      }
	  
      $returnMsg['dbf_problem'] = "Problem: Licensee NOT deleted.";
	  return $returnMsg;
	  exit;
  } 

  $returnMsg['cannot_find'] = "Problem: Cannot find that licensee.";
  return $returnMsg;
  exit;

}
//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************
   
function getScope($sscope) {
global $practitionersTBL;

  if($link = db_connect_site()) {
  
	 // $sscope is set in nav_app_members_2.php as $sid and passed as $_REQUEST variable to index_app_members_list
	 
	 if($sscope == 'all') {
	   $result  = mysqli_query($link, "SELECT * FROM $practitionersTBL ORDER BY lname ASC");
   
	 } elseif ($sscope  == 'usa') {
	   $result  = mysqli_query($link, "SELECT * FROM $practitionersTBL WHERE country = 'USA' ORDER BY lname ASC");
   
	 } elseif ($sscope  == 'intl') {
	   $result  = mysqli_query($link, "SELECT * FROM $practitionersTBL WHERE country <> 'USA' ORDER BY lname ASC");
	   
	 } elseif ($sscope  == 'licensed') {
	   $result  = mysqli_query($link, "SELECT * FROM $practitionersTBL WHERE license ORDER BY lname ASC");
   
	 } elseif ($sscope  == 'unlicensed') {
	   $result  = mysqli_query($link, "SELECT * FROM $practitionersTBL WHERE NOT license ORDER BY lname ASC");	  
	 
     } elseif ($sscope  == 'usa_l') {
       $result  = mysqli_query($link, "SELECT * FROM $practitionersTBL WHERE license AND country = 'USA' ORDER BY lname ASC");	
	 
     } elseif ($sscope  == 'usa_u') {
       $result  = mysqli_query($link, "SELECT * FROM $practitionersTBL WHERE NOT license AND country = 'USA' ORDER BY lname ASC");
	   
     } elseif ($sscope  == 'intl_l') {
       $result  = mysqli_query($link, "SELECT * FROM $practitionersTBL WHERE license AND country <> 'USA' ORDER BY lname ASC");	
	 
     } elseif ($sscope  == 'intl_u') {
       $result  = mysqli_query($link, "SELECT * FROM $practitionersTBL WHERE NOT license AND country <> 'USA' ORDER BY lname ASC");	
	 }
	 
	 if($result) {
		 if(mysqli_num_rows($result) > '0') {
			 return $result;
			 exit;
		 }
	 }
  }
  return '0';
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getScopeName($sid) {
   
   switch($sid) {
	   
	   case 'all':
	   return "Practitioners in Database";
	   break;
	   
	   case 'usa':
	   return "Practitioners in the USA";
	   break;	
	   
	   case 'usa_l':	   
	   return "Licensed Practitioners in the USA";
	   break;	
	   
	   case 'intl':
	   return "Practitioners Abroad";
	   break;	   
	   
	   case 'intl_l':
	   return "Licensed Practitioners Abroad";
	   break;	     
	   
	   case 'usa_u':	   
	   return "Unlicensed Practitioners in the USA";
	   break;	
	   
	   case 'intl_u':
	   return "Unlicensed Practitioners Abroad";
	   break;	      	   
	   
	   case 'licensed':
	   return "Licensed Practitioners";
	   break;	   

	   case 'unlicensed':
	   return "Unlicensed Practitioners";
	   break;	   
   }
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getNewMemNum() {
global $practitionersTBL;
	
   $newnum = '';
   if($link = db_connect_site()) {
   
	  if($result = mysqli_query($link,"SELECT MAX(cert_num) FROM $practitionersTBL LIMIT 1")) {
		 
		 while ($row = mysqli_fetch_row($result)) {
			$num = $row[0];
		 }
		 mysqli_free_result($result);	  
		 return $num + 1;
		 exit;
	  }
   }
   
   return  "Practitioners database problem";
   exit;      
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function checkNewCertNum($certnum) {
global $practitionersTBL;

   if($link = db_connect_site()) {
	   
	  if($result = mysqli_query($link,"SELECT cert_num,fname,lname FROM $practitionersTBL where cert_num = '{$certnum}'")) {
         if (mysqli_num_rows($result) > 0) {
		    while ($row = mysqli_fetch_assoc($result)) {
               $cert  = $row['cert_num'];	   
			   $fname = $row['fname'];
			   $lname = $row['lname'];
		    }			 
		    $msg = "License number ". $cert . " is assigned to " . $fname . " " . $lname;
		    mysqli_free_result($result);
			 
            if($result = mysqli_query($link,"SELECT MAX(cert_num) FROM $practitionersTBL LIMIT 1")) {
               while ($row = mysqli_fetch_row($result)) {
			      $num = $row[0];
				  $num = $num+1;
		       }
			}
		    $msg = $msg . ". Next available number is " . $num;
		    mysqli_free_result($result);
		    return $msg;	 
		    exit;			 
	     }
	  }
   }
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function updateMember($post,$redir) {
global $practitionersTBL, $sitelokTBL;
	
	$form_vals = array_map("trim",$post);		

	//cert_num
	if (!isset($form_vals['cert_num']) || empty($form_vals['cert_num'])) {
	   $formError['cert_num'] = "Certificate number required";
	}  						    
	   
	if (isset($form_vals['cert_num'])) {
		if(!is_numeric($form_vals['cert_num'])) {
			$formError['certnum_nonnumeric'] = "License number must contain only numbers";
		}		
		if(strlen($form_vals['cert_num']) > 10 ) {
			$formError['certnum_too_long'] = "Check length of license number";
		}						
	}	
	
	//fname
	if (!isset($form_vals['fname']) || empty($form_vals['fname'])) {
	   $formError['fname'] = "First name required";
	}  	
	if (isset($form_vals['fname'])) {
		if(strlen($form_vals['fname']) > 50) {
		   $formError['fname_too_long'] = "First name too long";
		}
	}
	
	//lname
	if (!isset($form_vals['lname']) || empty($form_vals['lname'])) {
	   $formError['lname'] = "Last name required</div>";
	}  	
	if (isset($form_vals['lname'])) {
		if(strlen($form_vals['lname']) > 50) {
		   $formError['lname_too_long'] = "Last name too long";
		}
	}	
	
	//addr1 & addr2
	if (!isset($form_vals['addr1']) || empty($form_vals['addr1'])) {
	   $formError['addr1'] = "Address required";
	}  		
	if (isset($form_vals['addr1'])) {
	   if(strlen($form_vals['addr1']) > 100) {
	     $formError['addr1a'] = "Address 1 too long";
	   }
	}				
	if (isset($form_vals['addr2']) && !empty($form_vals['addr2'])) {
	   if(strlen($form_vals['addr2']) > 100) {
	     $formError['addr2'] = "Address 2 too long";
	   }
	}				
	
	//country
	if(!isset($form_vals['country']) || empty($form_vals['country'])) {
       $formError['country'] = "Country required";
	} 		
		
	if (isset($form_vals['country'])) {
	   if(strlen($form_vals['country']) > 50) {
	     $formError['countrya'] = "Country name too long";
	   }
	}																
	
	//city
	if (!isset($form_vals['city']) || empty($form_vals['city'])) {
	   $formError['city'] = "City required</div>";
	}  
	if (isset($form_vals['city'])) {
	   if(strlen($form_vals['city']) > 50) {
	     $formError['citya'] = "City name too long";
	   }
	}							
		
    //zip code		
	if (!isset($form_vals['postal']) || empty($form_vals['postal'])) {
	   $formError['postal'] = "Postal code required";
	}  		
	if (isset($form_vals['postal'])) {
	   if(strlen($form_vals['postal']) > 15) {
	     $formError['postala'] = "Postal code too long";
	   }
	}						
	
    // is email value in an email format?
	if(!isset($form_vals['email']) || empty($form_vals['email'])) {
	   $formError['email'] = "Email required";
	} else {
       if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $form_vals['email'])) {
          $formError['email'] = "Check email format";
	   }
    }  	
	
    /*phone		
	if (!isset($form_vals['phone']) || empty($form_vals['phone'])) {
	   $formError['phone'] = "Phone number required";
	} 				
	*/
	
	//discipline
	if (!isset($form_vals['discipline']) || empty($form_vals['discipline'])) {
	   $formError['discipline'] = "Discipline required";
	}  		
	
	if (isset($form_vals['discipline'])) {
		if(strlen($form_vals['discipline']) > 50 ) {
			$formError['discipline_too_long'] = "Check length of Discipline (too long)";
		}						
	}		

	//cert_year
	if (!isset($form_vals['cert_year']) || empty($form_vals['cert_year'])) {
	   $formError['cert_year'] = "Certificate year required";
	} 
	 		
	if (isset($form_vals['cert_year'])) {
		if(!is_numeric($form_vals['cert_year'])) {
			$formError['certyr_nonnumeric'] = "Licensing year must contain only numbers";
		}		
		if(strlen($form_vals['cert_year']) > 4 ) {
			$formError['certyr_too_long'] = "Check length of licensing year (should be 4 digits)";
		}						
	}		
	
	if (count($formError)) {
	   return $formError;
	   exit;
	}  
	
	if($link = db_connect_site()) { 
	
       if($form_vals = realEscape($form_vals,$link)) {

		  $id           = $form_vals['id'];
		  $cert_num     = $form_vals['cert_num'];
		  $cert_year    = $form_vals['cert_year'];
		  $discipline   = $form_vals['discipline'];  
		  $fname        = $form_vals['fname'];
		  $lname        = $form_vals['lname'];
		  $addr1        = $form_vals['addr1'];
		  $addr2        = $form_vals['addr2'];
		  $city         = $form_vals['city'];
		  $state        = $form_vals['state'];
		  $region       = $form_vals['region'];
		  $country      = $form_vals['country'];
		  $region_state = (strtoupper($country) == 'USA') ? strtoupper($form_vals['state']) : $form_vals['region'];
		  $postal       = $form_vals['postal'];	
		  $email        = $form_vals['email'];
		  $phone        = $form_vals['phone'];
		  //$phone        = (strtoupper($country) == 'USA') ? formatPhone($form_vals['phone']) : $form_vals['phone'] ;
		  $license      = $form_vals['license'];	
		  
		  // insert data
		  $result = mysqli_query($link, "UPDATE $practitionersTBL 
								 SET 
								 cert_year     = '$cert_year',
								 cert_num      = '$cert_num',
								 discipline    = '$discipline',
								 fname         = '$fname',
								 lname         = '$lname',
								 addr1         = '$addr1',
								 addr2         = '$addr2',
								 city          = '$city',
								 region_state  = '$region_state',
								 country       = '$country',
								 postal        = '$postal',
								 email         = '$email',
								 phone         = '$phone',
								 license       = '$license'
								 WHERE id = $id"); 								  
	  
		  if(!$result)	{
			  $formError['no_save1'] = "Problem saving to Practitioners.";
			  return $formError;
			  exit;
		  }
	   }
	} else { $formError['no_connect'] = "Database connection problem."; return $formError; exit; }
	
/*	
	$link = db_connect_sl(); 
	
	$result = mysql_query("UPDATE $sitelokTBL 
	                       SET 
						   Username = '$email1',
						   Name     = '$name',
						   Email    = '$email1',
						   Custom2  = '$category',
						   Custom3  = '$employer',	
						   Custom4  = '$position',
						   Custom5  = '$addr1',
						   Custom6  = '$addr2',
						   Custom7  = '$city',
						   Custom8  = '$state',
						   Custom9  = '$zip',
						   Custom10 = '$phone1',
						   Custom11 = '$email1'						   
						   WHERE Custom1 = '$memnum'"); 		
	
    if(!$result)	{
		$formError['no_save2'] = "Problem saving to sitelok.";
		return $formError;
		exit;
	}	
*/	
    $redir = $redir . "1";
    header("Location: $redir");
    exit;  	  					
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function addMember($post,$redir) {
global $practitionersTBL, $sitelokTBL;
	
	$form_vals = array_map("trim",$post);		

	//cert_num
	if (!isset($form_vals['cert_num']) || empty($form_vals['cert_num'])) {
	   $formError['cert_num'] = "Certificate number required";
	}  					
	
	$numexists = checkNewCertNum($form_vals['cert_num']);
    
    if(strlen($numexists) > 10)  {
   	   $formError['certnum_exists'] = $numexists;
    }		
	   
	if (isset($form_vals['cert_num'])) {
		if(!is_numeric($form_vals['cert_num'])) {
			$formError['certnum_nonnumeric'] = "License number must contain only numbers";
		}		
		if(strlen($form_vals['cert_num']) > 10 ) {
			$formError['certnum_too_long'] = "Check length of license number";
		}						
	}	
	
	//fname
	if (!isset($form_vals['fname']) || empty($form_vals['fname'])) {
	   $formError['fname'] = "First name required";
	}  	
	if (isset($form_vals['fname'])) {
		if(strlen($form_vals['fname']) > 50) {
		   $formError['fname_too_long'] = "First name too long";
		}
	}
	
	//lname
	if (!isset($form_vals['lname']) || empty($form_vals['lname'])) {
	   $formError['lname'] = "Last name required</div>";
	}  	
	if (isset($form_vals['lname'])) {
		if(strlen($form_vals['lname']) > 50) {
		   $formError['lname_too_long'] = "Last name too long";
		}
	}	
	
	//addr1 & addr2
	if (!isset($form_vals['addr1']) || empty($form_vals['addr1'])) {
	   $formError['addr1'] = "Address required";
	}  		
	if (isset($form_vals['addr1'])) {
	   if(strlen($form_vals['addr1']) > 100) {
	     $formError['addr1a'] = "Address 1 too long";
	   }
	}				
	if (isset($form_vals['addr2']) && !empty($form_vals['addr2'])) {
	   if(strlen($form_vals['addr2']) > 100) {
	     $formError['addr2'] = "Address 2 too long";
	   }
	}				
	
	//country
	if(!isset($form_vals['country']) || empty($form_vals['country'])) {
       $formError['country'] = "Country required";
	} 		
		
	if (isset($form_vals['country'])) {
	   if(strlen($form_vals['country']) > 50) {
	     $formError['countrya'] = "Country name too long";
	   }
	}																
	
	//city
	if (!isset($form_vals['city']) || empty($form_vals['city'])) {
	   $formError['city'] = "City required</div>";
	}  
	if (isset($form_vals['city'])) {
	   if(strlen($form_vals['city']) > 50) {
	     $formError['citya'] = "City name too long";
	   }
	}						
	
/*	//region
	if(isset($form_vals['country']) || strlen($form_vals['country']) > 0) {
	   if($form_vals['country'] == 'USA') {
		   if(isset($form_vals['region']) || strlen($form_vals['region']) > 0 ) {
			  $formError['region'] = "Region entry was not appropriate for USA resident";
		   }
	   }
	} 		
	
	//state
	if(isset($form_vals['country']) || strlen($form_vals['country']) > 0 ) {
	   if($form_vals['country'] !== 'USA') {
		   if(isset($form_vals['state']) || strlen($form_vals['state']) > 0 ) {
			  $formError['state'] = "State entry not appropriate for non-USA resident";
		   }
	   }
	} 			
*/		
    //zip code		
	if (!isset($form_vals['postal']) || empty($form_vals['postal'])) {
	   $formError['postal'] = "Postal code required";
	}  		
	if (isset($form_vals['postal'])) {
	   if(strlen($form_vals['postal']) > 20) {
	     $formError['postala'] = "Postal code too long";
	   }
	}						
	
    // is email value in an email format?
	if(!isset($form_vals['email']) || empty($form_vals['email'])) {
	   $formError['email'] = "Email required";
	} else {
       if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $form_vals['email'])) {
          $formError['email'] = "Check email format";
	   }
    }  	
	
    //phone		
	/*
	if (!isset($form_vals['phone']) || empty($form_vals['phone'])) {
	   $formError['phone'] = "Phone number required";
	} elseif (isset($form_vals['phone']) && !empty($form_vals['phone'])) {
	   if(strlen($form_vals['phone']) > 20 ) 
	     $formError['phonea'] = "Phone number too long";
	   if(!is_numeric($form_vals['phone'])) 
	     $formError['phoneb'] = "Phone number must be numeric (xx-xxx-xxx-xxxx";
	}
	*/							
	
	//discipline
	if (!isset($form_vals['discipline']) || empty($form_vals['discipline'])) {
	   $formError['discipline'] = "Discipline required";
	}  		
	if (isset($form_vals['discipline'])) {
		if(strlen($form_vals['discipline']) > 50 ) {
			$formError['discipline_too_long'] = "Check length of Discipline (too long)";
		}						
	}		

	//cert_year
	if (!isset($form_vals['cert_year']) || empty($form_vals['cert_year'])) {
	   $formError['cert_year'] = "Certificate year required";
	}  		
	if (isset($form_vals['cert_year'])) {
		if(!is_numeric($form_vals['cert_year'])) {
			$formError['certyr_nonnumeric'] = "Licensing year must contain only numbers";
		}		
		if(strlen($form_vals['cert_year']) > 4 ) {
			$formError['certyr_too_long'] = "Check length of licensing year (should be 4 digits)";
		}						
	}		
	
	if (count($formError) > 0) {
	   return $formError;
	   exit;
	}  
	
	if($link = db_connect_site()) { 
	
       if($form_vals = realEscape($form_vals,$link)) {
	
		  $id           = $form_vals['id'];
		  $cert_num     = $form_vals['cert_num'];
		  $cert_year    = $form_vals['cert_year'];
		  $discipline   = $form_vals['discipline'];  
		  $fname        = $form_vals['fname'];
		  $lname        = $form_vals['lname'];
		  $addr1        = $form_vals['addr1'];
		  $addr2        = $form_vals['addr2'];
		  $city         = $form_vals['city'];	
		  $country      = $form_vals['country'];	
		  $region_state = (strtoupper($form_vals['country']) <> "USA") ? $form_vals['region'] : $form_vals['state'];	
		  $postal       = $form_vals['postal'];	
		  $email        = $form_vals['email'];
		  $phone        = $form_vals['phone'];
		  //$phone        = (strtoupper($country) == 'USA') ? formatPhone($form_vals['phone']) : $form_vals['phone'] ;
		  $license      = $form_vals['license'];	
		  
		  // insert data
		  $result = mysqli_query($link, "INSERT INTO $practitionersTBL 
										 (cert_year,cert_num,discipline,fname,lname,addr1,addr2,city,region_state,country,postal,email,phone,license)
										 VALUES
										 ('$cert_year','$cert_num','$discipline','$fname','$lname','$addr1','$addr2','$city','$region_state','$country','$postal','$email','$phone','$license')
										 ");  
	  
		  if(!$result)	{
			  $formError['no_save1'] = "Problem saving to Practitioners.";
			  return $formError;
			  exit;
		  }
	   }
	} else { $formError['no_connect'] = "Database connection problem."; return $formError; exit; }
	
/*	
	$link = db_connect_sl(); 
	
	$result = mysql_query("UPDATE $sitelokTBL 
	                       SET 
						   Username = '$email1',
						   Name     = '$name',
						   Email    = '$email1',
						   Custom2  = '$category',
						   Custom3  = '$employer',	
						   Custom4  = '$position',
						   Custom5  = '$addr1',
						   Custom6  = '$addr2',
						   Custom7  = '$city',
						   Custom8  = '$state',
						   Custom9  = '$zip',
						   Custom10 = '$phone1',
						   Custom11 = '$email1'						   
						   WHERE Custom1 = '$memnum'"); 		
	
    if(!$result)	{
		$formError['no_save2'] = "Problem saving to sitelok.";
		return $formError;
		exit;
	}	
*/	
    $redir = $redir . "1&lname=$lname&cert_num=$cert_num";
    header("Location: $redir");
    exit;  	  					
}



