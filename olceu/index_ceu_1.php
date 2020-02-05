<?php 
// Online Continuing Education:
// Lists Materials that can be accessed (after login)

header("Cache-Control: no-cache, must-revalidate");
header('Pragma: no-cache');
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');
if(session_id() == '') {session_start(); }

require_once "_inc/_always.php";  // procedures and vars

$u_token = getToken(); 
check_permission($u_token);

//*****************************************************************
//*****************************************************************
//*****************************************************************

// fetch URI variable tag
$ordernumber = (isset($_REQUEST['ordno']) && $_REQUEST['ordno'] > '') ? $_REQUEST['ordno'] : $_SESSION['u_orderno'];
$sid         = (isset($_REQUEST['sid'])   && $_REQUEST['sid'] > '')   ? $_REQUEST['sid']   : $_SESSION['u_sid'];

$errorMsg = storeQuizzes($sid);
$errorMsg = ($errorMsg) ? '' : $errorMsg;
 
//*****************************************************************
//*****************************************************************
//*****************************************************************

// MAIN LOOP
// Fetch order and product ID numbers within the order.
if(isset($sid) && $sid > '') 
{
   $all_choices = $sqlids = $itemnumber = array();
   $ends = "";
   
   // GET ORDER INFO FROM DATABASE
   // Fetch order info from mysql ceu_users
   if(!$link = db_connect_site()) {
	  $errorMsg = "System temporarily unavailable. Please try again later."; 
   } else {
	  if(!$result = mysqli_query($link,"SELECT * FROM $ceuusersTBL WHERE sid='$sid' LIMIT 1")) {  
	     $errorMsg = "Database problem. Please try again later.";
	  } else {
		 if(mysqli_num_rows($result) == 0) {
		    $errorMsg = "Cannot find your order.";
		 } else {
		    while ($row = mysqli_fetch_assoc($result)) {   
			   $orderno     = $row['orderno'];
			   $name        = $row['name'];
			   $occupation  = $row['occupation'];
			   $numitems    = $row['numitems'];
			   $itemnumber  = explode("|",$row['itemnumber']);
			   $itemname    = $row['itemname'];
			   $sid         = $row['sid'];
			   $wopen       = $row['winopen'];
			   $wclose      = $row['winclose'];		
		    }
		 } 
	  } 
   } 	
   
   // PRODUCT IDs IN THE  ORDER
   // $all_choices - create array of all product ID numbers in the order
   if(isset($itemnumber) && is_array($itemnumber) && count($itemnumber) > 0) 
   {
      foreach ($itemnumber as $id) {
	     if(substr($id,0,1) !== "p" ) {
            $all_choices[] = "'" . $id . "'";
	     }
      }
   } 
   else { 
   	$errorMsg = "Problem creating all_choices."; 
   }
   
   // QUERY FOR PRODUCT IDs
   // $sqlids - create array for SQL queries that will create links to handouts and videos
   if(isset($itemnumber) && is_array($itemnumber) && count($itemnumber) > 0) 
   {
	    // if all 11 NOMAS courses ordered, add designator v00 (single CEU test) to quiz table
        if(in_array("v00",$itemnumber) && in_array("s00",$itemnumber)) 
        {
		   foreach($all_courses as $id) {
			  if(substr($id,0,1) <> "p" ) { 
                 $sqlids[] = "'" . $id . "'";
			  }
		   }
	    } 
	    elseif (in_array("v00",$itemnumber) && !in_array("s00",$itemnumber))
	    {		 
		   foreach($all_v_courses as $id) {
			  if(substr($id,0,1) <> "p" ) { 
                 $sqlids[] = "'" . $id . "'";
			  }
		   }		   
	    } 
	    elseif (in_array("s00",$itemnumber) && !in_array("v00",$itemnumber))
	    {	
		   foreach($all_s_courses as $id) {
			  if(substr($id,0,1) <> "p" ) { 
                 $sqlids[] = "'" . $id . "'";
			  }
		   }		   
		} 
		
		if (in_array("v03",$itemnumber)) 
		{
		   $sqlids[] = "'v02'";
		   $sqlids[] = "'v03'";
		} 
		
		if (in_array("v10",$itemnumber))
		{
		   $sqlids[] = "'v09'";
		   $sqlids[] = "'v10'";
		}
		
	    // Add tests that are not in either comprehensive category; filter out products
		$filter_products = array('s00','v00','v03','v10');
        foreach ($itemnumber as $id) {
           if(!in_array($id,$filter_products)) {
		      if(substr($id,0,1) !== "p") {
	             $sqlids[] = "'" . $id . "'" ;
			  }
		   }
	    }				
		
   } 
   else { 
   	$errorMsg = "Problem creating sqlids."; 
   }   
   
   // for display: date access to materials ends
   $ends = (isset($wclose) && !empty($wclose)) ? date_format(date_create($wclose),"l, F jS") : '';   

} 
else { 
	$errorMsg = "System temporarily unavailable. Please try again later."; 
}

//*****************************************************************
//*****************************************************************
//*****************************************************************	 

// QUERIES AND DISPLAYS: VIDEO AND HANDOUT LINKS
// Parameter $kind = string. Type of content to display. 'pdf' or 'vid'
function showLinks($kind, $orderno) 
{
	global $sqlids, $ceuproductsTBL, $ceuHandoutsPath, $ceuVideoPath, $ceuVideoPage;	

   if(!$link = db_connect_site()) {
      $errorMsg = "System temporarily unavailable. Please try again later."; 
   } else {
	   //this is a bandaid that I put in place to accommodate 3 customers who I had to manually enter into the user and order database
	  if($_GET['ordno']==1546389225)
	  {
		 $sql="SELECT id,description,location,vidlocation FROM ceu_products WHERE id IN  ('s06');";
	  }
		elseif($_GET['ordno']==1545903710)
		{
			$sql="SELECT id,description,location,vidlocation FROM ceu_products WHERE id IN  ('p05');";
		}
		elseif($_GET['ordno']==1547175064)
		{
			$sql="SELECT id,description,location,vidlocation FROM ceu_products WHERE id IN  ('v00');";
		}
		elseif($_GET['ordno']==1547060290)
		{
			$sql="SELECT id,description,location,vidlocation FROM ceu_products WHERE id IN  ('s01');";
		}
	  else
	  {
		$sql = "SELECT id,description,location,vidlocation FROM $ceuproductsTBL WHERE id IN (" . implode(",",$sqlids) . ");";
	  }
	  $result=mysqli_query($link, $sql);
	  if(!$result) {
         $errorMsg = "Products database problem. Please try again later."; 	
      } else {
	     if(mysqli_num_rows($result) == 0) {
            $errorMsg = "Products database empty.";
			//echo $errorMsg;
	     } else {
		    if(mysqli_num_rows($result) > 0) { 
			   while ($row = mysqli_fetch_assoc($result)) {
			 	  $id          = $row['id'];
				  $description = $row['description'];	  
				  $location    = $row['location'];
				  $vidlocation = $row['vidlocation'];	
				  
				  switch ($location) {
					  case "v03.zip" :
					     $location = "v03.pdf";
					     break;
						
					  case "v10.zip" :
					     $location = "v10.pdf";
						 break;
				  }
				  
				  // ECHO LINK HTML ON PAGE
				  if ($kind == "pdf") 
				  { 
				  	// display links for handouts
				     $popup_specs = "'width=860,height=650,top=60,left=60,resizeable=1,scrollbars=1'";
					 if($id=="p14")
					 {
						echo "<tr><td><span class='bld'>Feeding in the NICU...: </span>
						<a href= javascript:void(window.open('" . $ceuHandoutsPath . $location . "','handoutLinksPg'," . $popup_specs . "))>" . $description . "</a></td></tr>";
					 }			
						//elseif (strpos($id, 'day1a') !== false)
						elseif($id=="p06" OR $id=="p07" OR $id=="p08" OR $id=="p09" OR $id=="p10" OR $id=="p11" OR $id=="p12" OR $id=="p13")
						{
							echo "<tr><td><span class='bld'>NOMAS<sup>&reg;</sup> Articles: </span>
							<a href= javascript:void(window.open('" . $ceuHandoutsPath . $location . "','handoutLinksPg'," . $popup_specs . "))>" . $description . "</a></td></tr>";	
						}
						elseif($id=="n01")
						{
							$quiz_four = showQuizLinks_Series_Four();
							//you're getting an array at this point
							$the_sid=$quiz_four['sid'];
							$the_at=$quiz_four['at'];
							
							//echo $quizLink;
							echo "<tr><td><span class='bld'>Course " . $id . ": </span>
							 <a href=javascript:void(window.open('http://www.nomasinternational.org/olceu/series_four_video.php?the_sid=$the_sid&the_at=$the_at','vidLinksPg','width=960,top=60,resizeable=1,scrollbars=1'))>" . $description . "</a></td></tr>";		
							/*
							echo "<tr><td><span class='bld'>Course " . $id . ": </span>
							  <a href=javascript:void(window.open('http://www.nomasinternational.org/olceu/series_four_video.php','vidLinksPg','width=960,top=60,resizeable=1,scrollbars=1'))>" . $description . "</a></td></tr>";	
							*/							  
						}
					 else
					 {
						 echo "<tr><td><span class='bld'>Course " . $id . ": </span>
						<a href= javascript:void(window.open('" . $ceuHandoutsPath . $location . "','handoutLinksPg'," . $popup_specs . "))>" . $description . "</a></td></tr>";
					 }
				  
				  } 
				  elseif ($kind == "vid") 
				  { 
				  	// display links for videos
					// you need to make allowance for n01 because you've got some products that don't have a corresponding video
					if($location=="pro_articles.pdf")
					{
						continue;
					}
						elseif($id=="n01")
						{
							$quiz_four = showQuizLinks_Series_Four();
							//you're getting an array at this point
							$the_sid=$quiz_four['sid'];
							$the_at=$quiz_four['at'];
							
							//echo $quizLink;
							echo "<tr><td><span class='bld'>Course " . $id . ": </span>
							 <a href=javascript:void(window.open('http://www.nomasinternational.org/olceu/series_four_video.php?the_sid=$the_sid&the_at=$the_at','vidLinksPg','width=960,top=60,resizeable=1,scrollbars=1'))>" . $description . "</a></td></tr>";			
						}
					else
					{
						 $popup_specs = "'width=960,height=960,top=60,left=60,resizeable=1,scrollbars=1'";
						 echo "<tr><td><span class='bld'>Course " . $id . ": </span>
						 <a href=javascript:void(window.open('". $ceuVideoPage ."?id=".$id."','vidLinksPg'," . $popup_specs . "))>" . $description . "</a></td></tr>";	
					}
				  } 				
			   }
		    } 
         } 	  
      }
   }
}   

//*****************************************************************
//*****************************************************************
//*****************************************************************	

// QUERIES AND DISPLAYS QUIZ LINKS
function showQuizLinks() 
{
	global $sid, $ceuresultsTBL, $ceuQuizPage;

   $qtv  = "qtv";  // NOMAS tests (1 test, 10 questions, 10 hints)
   $qts  = "qts";  // Symposia tests (1 test, 5 questions. 0 hints)
   $qt11 = "qt11"; // all 11 Punky courses (1 test, 11 questions, 11 hints)
   //$qt12 = "qt12"; // all 11 Punky courses and all 12 Symposia tests (13 tests, 71 questions, 0 hints)
   
   if(!$link = db_connect_site()) {
      $errorMsg = "System temporarily unavailable. Please try again later."; 
   } 
   else {
	   //echo "results";
   	  // LOOK IN QUIZ RESULTS TABLE
	  $sql = "SELECT * FROM $ceuresultsTBL WHERE sid = '$sid' AND itemnumber 
	 NOT IN('day1a1', 'day1a2', 'day1a3', 'day1a4', 'day1a5', 'day1a6', 'day1a7', 'day1a8', 'day1ch') 
	 ORDER BY itemnumber";
	//echo $sql;
	  if(!$result = mysqli_query($link,$sql)) {
         $errorMsg = "Results database problem. Please try again later."; 	
      } else {
	     if(mysqli_num_rows($result) == 0) {
            $errorMsg = "Results database empty.";
	     } else {
			 
		    if(mysqli_num_rows($result) > 0) { 
			
			   while ($row = mysqli_fetch_assoc($result))
			   {
				  $showQuiz = true;
			 	  $id = $row['itemnumber']; // v01 etc.
				  $description = getDescription($id);	  
				  // check ceu_results table to see whether this quiz has already been taken and was passed or failed
				  $status = checkQuizStatus($sid,$id);
				  
				  // MESSAGES RELATED TO NUMBER OF QUIZ ATTEMPTS
				  if(is_array($status) && count($status) > 0)
				  {
					  extract($status);
					  
					  // Passed Quiz already
					  if(isset($pass) && $pass == '1' ) {
				         echo "<tr><td><span class='bld'>Course " . $id . ": </span>  QUIZ PASSED!</td></tr>";
					     $showQuiz = false;
						 
				      }	
				      else {
					  	 // Quiz taken too many times.     		
                         if(isset($attempts) && $attempts >= '2' ) { 
					        echo "<tr><td><span class='bld'>Course " . $id . ": </span>  QUIZ NO LONGER AVAILABLE.</td></tr>";
					        $showQuiz = false;
						 }
				      }
					  
					  // Show quiz if 0 or 1 attempts so far
					  if(isset($attempts) && $attempts == '0' ) {
						 $showQuiz == true;
					     $at = "at1";
					  }
					  if(isset($attempts) && $attempts == '1' )  {
						 $showQuiz == true;   	  
					     $at = "at2";					 
					  }						 
				  }				  
				  
				  // DISPLAY QUIZ LINKS
				  if($showQuiz) {
					  	//echo "yes";	
					 // All Series 1 courses (v00)
					 if ($id == "v00") {
						   echo "<tr><td><span class='bld'>Course " . $id . ": </span> <a href=". $ceuQuizPage."?id=$id&sid=$sid&qt=$qt11&at=$at>" . $description . "</a></td></tr>";
					 }																  
					 
					 // Individual Series 1 (v) courses
					 if (substr($id,0,1) == "v" && $id <> "v00") {
						   echo "<tr><td><span class='bld'>Course " . $id . ": </span> <a href=". $ceuQuizPage."?id=$id&sid=$sid&qt=$qtv&at=$at>"  . $description . "</a></td></tr>";
					 }
					  
					 // Individual Series 2 (c) courses
					 if (substr($id,0,1) == "s") {
						   echo "<tr><td><span class='bld'>Course " . $id . ": </span> <a href=". $ceuQuizPage."?id=$id&sid=$sid&qt=$qts&at=$at>"  . $description . "</a></td></tr>";
					 }

					 // Individual Series 3 (cpf) courses
					 if (substr($id,0,3) == "cpf") {
						   echo "<tr><td><span class='bld'>Course " . $id . ": </span> <a href=". $ceuQuizPage."?id=$id&sid=$sid&qt=$qtv&at=$at>"  . $description . "</a></td></tr>";
					 }
					 //Series Four course (n01)
					 if (substr($id,0,3) == "n01") {
						   echo "<tr><td><span class='bld'>Course " . $id . ": </span> <a href=". $ceuQuizPage."?id=$id&sid=$sid&qt=$qtv&at=$at>"  . $description . "</a></td></tr>";
					 }
				  }
			   }
			}	   		    	 
         } 	  
      }
   }    
}

//this is in place so as to grab the link to the Series Four quiz

function showQuizLinks_Series_Four() {
	global $sid, $ceuresultsTBL, $ceuQuizPage;

   $qtv  = "qtv";  // NOMAS tests (1 test, 10 questions, 10 hints)
   $qts  = "qts";  // Symposia tests (1 test, 5 questions. 0 hints)
   $qt11 = "qt11"; // all 11 Punky courses (1 test, 11 questions, 11 hints)
   //$qt12 = "qt12"; // all 11 Punky courses and all 12 Symposia tests (13 tests, 71 questions, 0 hints)
   
   if(!$link = db_connect_site()) {
      $errorMsg = "System temporarily unavailable. Please try again later."; 
   } 
   else {
	   //echo "results";
   	  // LOOK IN QUIZ RESULTS TABLE
	  $sql = "SELECT * FROM $ceuresultsTBL WHERE sid = '$sid' AND itemnumber 
	 NOT IN('day1a1', 'day1a2', 'day1a3', 'day1a4', 'day1a5', 'day1a6', 'day1a7', 'day1a8', 'day1ch') 
	 ORDER BY itemnumber";
	//echo $sql;
	  if(!$result = mysqli_query($link,$sql)) {
         $errorMsg = "Results database problem. Please try again later."; 	
      } else {
	     if(mysqli_num_rows($result) == 0) {
            $errorMsg = "Results database empty.";
	     } else {
			 
		    if(mysqli_num_rows($result) > 0) { 
			
			   while ($row = mysqli_fetch_assoc($result))
			   {
				  $showQuiz = true;
			 	  $id = $row['itemnumber']; // v01 etc.
				  $description = getDescription($id);	  
				  // check ceu_results table to see whether this quiz has already been taken and was passed or failed
				  $status = checkQuizStatus($sid,$id);
				  
				  // MESSAGES RELATED TO NUMBER OF QUIZ ATTEMPTS
				  if(is_array($status) && count($status) > 0)
				  {
					  extract($status);
					  
					  // Passed Quiz already
					  if(isset($pass) && $pass == '1' ) {
				         echo "<tr><td><span class='bld'>Course " . $id . ": </span>  QUIZ PASSED!</td></tr>";
					     $showQuiz = false;
						 
				      }	
				      else {
					  	 // Quiz taken too many times.     		
                         if(isset($attempts) && $attempts >= '2' ) { 
					        echo "<tr><td><span class='bld'>Course " . $id . ": </span>  QUIZ NO LONGER AVAILABLE.</td></tr>";
					        $showQuiz = false;
						 }
				      }
					  
					  // Show quiz if 0 or 1 attempts so far
					  if(isset($attempts) && $attempts == '0' ) {
						 $showQuiz == true;
					     $at = "at1";
					  }
					  if(isset($attempts) && $attempts == '1' )  {
						 $showQuiz == true;   	  
					     $at = "at2";					 
					  }						 
				  }				  
				  
				  // DISPLAY QUIZ LINKS
				  if($showQuiz) {
					  	//echo "yes";	
					 // All Series 1 courses (v00)
					 if ($id == "v00") {
						   echo "<tr><td><span class='bld'>Course " . $id . ": </span> <a href=". $ceuQuizPage."?id=$id&sid=$sid&qt=$qt11&at=$at>" . $description . "</a></td></tr>";
					 }																  
					 
					 // Individual Series 1 (v) courses
					 if (substr($id,0,1) == "v" && $id <> "v00") {
						   echo "<tr><td><span class='bld'>Course " . $id . ": </span> <a href=". $ceuQuizPage."?id=$id&sid=$sid&qt=$qtv&at=$at>"  . $description . "</a></td></tr>";
					 }
					  
					 // Individual Series 2 (c) courses
					 if (substr($id,0,1) == "s") {
						   echo "<tr><td><span class='bld'>Course " . $id . ": </span> <a href=". $ceuQuizPage."?id=$id&sid=$sid&qt=$qts&at=$at>"  . $description . "</a></td></tr>";
					 }

					 // Individual Series 3 (cpf) courses
					 if (substr($id,0,3) == "cpf") {
						   echo "<tr><td><span class='bld'>Course " . $id . ": </span> <a href=". $ceuQuizPage."?id=$id&sid=$sid&qt=$qtv&at=$at>"  . $description . "</a></td></tr>";
					 }
					 //Series Four course (n01)
					 if (substr($id,0,3) == "n01") {
						 $result_array = array(); //define the array		
						 $result_array=array("sid"=>$sid, "at"=>$at);
						   //echo "<tr><td><span class='bld'>Course " . $id . ": </span> <a href=". $ceuQuizPage."?id=$id&sid=$sid&qt=$qtv&at=$at>"  . $description . "</a></td></tr>";
						   //return $ceuQuizPage."?id=$id&sid=$sid&qt=$qtv&at=$at"; 
						   return $result_array;
					 }
				  }
			   }
			}	   		    	 
         } 	  
      }
   }    

}

//end of Series Four Quiz location function

//*****************************************************************
//*****************************************************************
//*****************************************************************	   

$pageTitle    = (isset($name) && $name > '' && isset($occupation) && $occupation > '') ? "Online Continuing Education - " . $name . ", " . $occupation : "Online Continuing Education";
$pageSubTitle = (isset($errorMsg) && $errorMsg > '') ? " " : "Welcome! Your access to these materials will end " . $ends .".";

//*****************************************************************
//*****************************************************************
//*****************************************************************

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['logoff'])) {
   log_out();
   exit;
} 
//*****************************************************************
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="cleartype" content="on" />
<title>NOMAS International</title>
<meta name="viewport" content="width=device-width" />
<link href="_css/olce.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="playground">
   <div id='site_logo'><?php showBigLogo(); ?></div>  
   <div class='clearAll'></div>
  
   <!--TOP BLUE-->  
   <div id='nav_box'>&nbsp;</div>   
   <!--end top blue-->
  
   <div class='clearAll'></div>  
    
   <div id='nomas_content'>    
      <div id='nomas_page_headlines'>
         <?php
	     if ( isset($pageTitle) && $pageTitle > '') {
		    echo "<div class='pageTitle'>" . $pageTitle . "</div>";
	     }
         if (isset($pageSubTitle) && $pageSubTitle > '') {
            echo "<div class='pageSubTitle'>" . $pageSubTitle . "</div>";
	     } 
	     ?>
       </div><!--end nomas_page_headlines-->  
      
       <!--COLUMN-->
       <div id='column_left_wide'>          
          <div class='l_item'>
             <div class='reg_text'>       
                <span class='bld'>Course Handouts</span> contain valuable information about what you will be seeing in the <span class='bld'>Video Talks</span>. Take your time while reading and viewing. 
                You may "rewind" the videos to re-watch any portion. Some of the information is quite specific and you may benefit from viewing the videos more than once, particularly if you are not 
                familiar with the terminology.<br><br>
                <span class='bld'>Quizzes</span> must be taken only if you wish to receive CEU credit. You will have two opportunities to successfully complete each quiz. NOMAS courses bought 
                individually each have a companion 10-question quiz. The complete NOMAS course (11 Talks) has a single quiz that encompasses all the material. Symposia talks each have a five question quiz.
                <br><br>
                <span class='bld'>Problems or questions? <?php echo $pleaseContact; ?></span><br>
                
                <form class='signin_form' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="POST" accept-charset="utf-8"> 
                   <button type="submit" name="logoff" value="logoff">Sign Out</button>
                </form>  
                
             </div>
          </div>
          
          <div class='spacer_12'></div>   
          
          <?php if(isset($errorMsg) && !empty($errorMsg)) { ?>
          <!--ERROR MESSAGES-->
          <table class='problem_msg_table'>
             <tr>
                <td><?php echo $errorMsg; ?></td>
             </tr>             
          </table>			  
		  <?php } ?>
          
          <!--TOP NOTE-->        
          <div class='pink_box'>
             <div class='l_item'>
                <h1 style='font-size:1.5em;padding-top:4px;'>
                   The materials below open in separate windows. Be aware that windows may pop-up <span class='ital'>behind</span>&nbsp;&nbsp;this page.
                </h1>             
             </div><!--end l_item--> 
             <div class='clearAll'></div>                       
          </div><!--end pink box-->           
          
          <div class='clearAll'></div>                       
          <div class='spacer_12'></div>          
                  
          <!--HANDOUTS-->        
          <div class='pink_box'>
             <div class='l_item'>
                <h1>Get Handouts</h1>             
                <table class='links_table'>
			       <?php showLinks("pdf"); ?>
                </table>
             </div><!--end l_item--> 
             <div class='clearAll'></div>                       
          </div><!--end pink box--> 
                   
          <div class='clearAll'></div>                       
          <div class='spacer_12'></div>
          
          <!--VIDEOS-->        
          <div class='pink_box'>
             <div class='l_item'>
                <h1>Watch Video Talks</h1>             
                <table class='links_table'>
			       <?php showLinks("vid"); ?>
                </table>             
             </div><!--end l_item--> 
             <div class='clearAll'></div>                       
          </div><!--end pink box--> 
                   
          <div class='clearAll'></div>                       
          <div class='spacer_12'></div>
          
          <!--QUIZZES-->        
          <div class='pink_box'>
             <div class='l_item'>
                <h1>CEU Quizzes</h1>
                <table class='links_table'>
                   <?php showQuizLinks(); ?>
                </table>             
             </div><!--end l_item--> 
             <div class='clearAll'></div>                       
          </div><!--end pink box--> 
                   
          <div class='clearAll'></div>                       
          <div class='spacer_12'></div>     
          
          <form class='signin_form' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="POST" accept-charset="utf-8"> 
             <button type="submit" name="logoff" value="logoff">Sign Out</button>
          </form>            
                            
       </div><!--END COLUMN-->             
       <div class='clearAll'></div>
    </div> <!-- end content  -->
  
    <!--FOOTER-->
    <div id="footer"> 
       <?php showCopyright($thisYear); ?>
    </div><!-- end footer -->
 
</div><!-- end #playround -->
</body>
</html>
