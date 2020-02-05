<?php 
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

if (isset($_REQUEST['id']) && $_REQUEST['id'] > '') { // QUIZ NUMBER
  $id = $_SESSION['id'] = $_POST['id'] = trim($_REQUEST['id']);
} else {
  $id = $_POST['id'] = trim($_SESSION['id']); 
}  

if(isset($_REQUEST['qt']) && $_REQUEST['qt'] > '') { // QUIZ TYPE
   $qt = $_SESSION['qt'] = $_POST['qt'] = trim($_REQUEST['qt']);      
} else {
   $qt = $_POST['qt'] = trim($_SESSION['qt']);
}

if(isset($_REQUEST['sid']) && $_REQUEST['sid'] > '') { // SID
   $sid = $_POST['sid'] = trim($_REQUEST['sid']);
} else {
   $sid = $_POST['sid'] = trim($_SESSION['u_sid']);
}

if(isset($_REQUEST['at']) && $_REQUEST['at'] > '')  // ATTEMPTS
   $attempts_msg = ($_REQUEST['at'] == 'at1') ? " (Attempt 1 of 2)." : " (Attempt 2 of 2).";

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle      = "Online Continuing Education Quiz";
$pageSubTitle   = '';
$QuizResumeLink = "<a href='" . $ceuHomePage . "?sid=$sid'>Click to continue.</a>";
$continue = $showForm = $showTakeLater = true;
$showHint = $done = $showAnswers = false;
$ansError = $showquizno = '';

//*****************************************************************
//*****************************************************************
//*****************************************************************

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['skip']) ) {
   $sid   = $_SESSION['u_sid'];
   $redir = $ceuHomePage . "?sid=$sid";
   unset($_POST);
   header("Location: $redir");
   exit;
} 
	  	  	  
//*****************************************************************
//*****************************************************************
//*****************************************************************

initPostVars($id,$qt,$sid); // initialize form vars

$errorMsg = initQuestionVars($id,$qt); // initialize question vars
if ($errorMsg > '') {
   $continue = false;
   $done     = true;
   $showForm = false;	
   unset($_POST);	  	   
   $errorMsg = $errorMsg . " " . $QuizResumeLink;
}

//*****************************************************************
//*****************************************************************
//*****************************************************************

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit']) ) {
	
   // returns array with pass/attempts numbers or error string on fail
   $status = checkQuizStatus($sid,$id);	
   // make sure the quiz is "takeable"
   if(is_array($status) && count($status) > 0) {
	  $pass     = (isset($status['pass']) && $status['pass'] > '') ? $status['pass'] : "Status information (pass) not available";
	  $attempts = (isset($status['attempts']) && $status['attempts'] > '') ? $status['attempts'] : "Status information (attempts) not available";
   } else {
	  $continue = false;	   
	  $done = true; 
	  $showForm = false;	
	  $errorMsg = $status . " " . $QuizResumeLink; 	
   }
   
   if($continue && is_numeric($pass) && is_numeric($attempts)) {
	  if($pass == '1')	{
		 $continue = false;	   
		 $done     = true; 
		 $showForm = false;      	   
		 $errorMsg = "Quiz " . $_POST['id'] . " Passed! " . $QuizResumeLink;
	  }
   } else {	
	  $continue = false;	   
	  $done     = true; 
	  $showForm = false;      	   
	  $errorMsg = "System Problem - (pass/attempts) - " . $pleaseContact;		
   }
   
   if($continue) {
	  if($attempts == '2') {	
		 $continue = false;
		 $done     = true;
		 $showForm = false;			
		 $showTakeLater = false; 
		 $errorMsg =  "Quiz cannot be taken more than twice. " . $QuizResumeLink;   
	  } elseif ($attempts == '0' ) {
		 $continue = true;
		 $done     = false;
		 $showForm = true;			 
		 $attempts_msg = " (Attempt 1 of 2)";	 
	  } elseif ($attempts == '1' ) {
		 $continue = true;
		 $done     = false;
		 $showForm = true;			 
		 $attempts_msg = " (Attempt 2 of 2)";	 	    	
	  }   	
   }
   
   if($continue) {

	  // if quiz is "takeable"
	  if(!$done) {  		 
		 // compares number of quiz questions asked and answered
		 $ansError = checkAskedAnswered($_POST);
		 if($ansError == '')	{
			// grade the quiz only if all questions were answered	  
			$tot = 0;
			if ($ua_1  <> $a_1)  { $tot++; }
			if ($ua_2  <> $a_2)  { $tot++; }
			if ($ua_3  <> $a_3)  { $tot++; }
			if ($ua_4  <> $a_4)  { $tot++; }
			if ($ua_5  <> $a_5)  { $tot++; }
			if($qt <> "qts") {
			   if ($ua_6  <> $a_6)  { $tot++; }
			   if ($ua_7  <> $a_7)  { $tot++; }
			   if ($ua_8  <> $a_8)  { $tot++; }
			   if ($ua_9  <> $a_9)  { $tot++; }
			   if ($ua_10 <> $a_10) { $tot++; }
			   if($qt == "qt11" || $qt == "qt12") {
				  if ($ua_11 <> $a_11) { $tot++; }
			   }
			}
			
			$pass = ($tot == 0) ? 1 : 0;
			$incorrect = ($tot == 1) ? $tot . " incorrect answer. " : $tot . " incorrect answers. ";
				 
			// update table with results of this test
			if(!$link = db_connect_site()) {
			   $errorMsg = "Database problem. Please try again later.";
   
			} else {
			 
			   $sql = "UPDATE $ceuresultsTBL SET attempts = attempts+1, pass='$pass', quiz_date='$today' WHERE sid='$sid' AND itemnumber='$id' LIMIT 1";
			   if($result = mysqli_query($link,$sql)) {
				  
				  // retrieve latest status for this quiz						
				  $sql = "SELECT attempts,pass FROM $ceuresultsTBL WHERE sid='$sid' AND itemnumber='$id' LIMIT 1";
				  if($result  = mysqli_query($link,$sql)) {
					 $attempt = mysqli_fetch_assoc($result);
					 
					 if ($attempt['pass'] == 1) {
						$done     = true;
						$showHint = false;
						$showForm = false;
						unset($_POST);
						prepEmail($sid,"PASSED",$id);
						$errorMsg = "All answers correct! " . $QuizResumeLink;
									  
					 } elseif ($attempt['pass'] <> 1 && $attempt['attempts'] >= 2) {
				   
						$done     = true;
						$showHint = false;
						$showForm = false;
                        $showTakeLater = false; 
						unset($_POST);		
						prepEmail($sid,"FAILED",$id);									 		
						$errorMsg =  $incorrect . " Quiz cannot be taken a third time. " . $QuizResumeLink;
					  
					 } else {
					   
						$done         = false;
						$showHint     = true;		
						$attempts_msg = " (Attempt 2 of 2)";					 		
						$errorMsg     = $incorrect;
						if($errorMsg > '') {
						   if($qt == "qtv" || $qt == "qt11" && $attempt['attempts'] < 2) {
							  $errorMsg = $errorMsg . " Please review the help text below each question.<br>
										               You may change your answers now and resubmit. Resubmitting will count as your final quiz attempt.<br> 
										               To take the quiz later, click 'Skip Quiz For Now,' below. (Help text and current answers will be lost).";
						   } elseif ($qt == "qts" && $attempt['attempts'] < 2) {
							  $errorMsg = $errorMsg . " You may change your answers now and resubmit. Resubmitting will count as your final quiz attempt.<br> 
										               To take the quiz later, click 'Skip Quiz For Now,' below. (All current answers will be lost).";							   
						   }
						}
					 }
				  } else { $errorMsg = "Status could not be confirmed. " . $pleaseContact; }
			   } else { $errorMsg = "Status update failed. " . $pleaseContact; }
			} // end db connection OK
		 } else { $errorMsg = $ansError; initPostVars($id,$qt,$sid); initQuestionVars($id,$qt); }  
	  } // end !done loop
   }  // end if continue
}  // end submit  

//*****************************************************************
//*****************************************************************
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
                For CEU credit, all questions must be answered and all answers must be correct. Depending on the course, quizzes may be 5, 10 or 11 questions in length. 
                Click <span class='bld'>'Submit Quiz for Scoring'</span> to sumbit your quiz for grading. Results will appear shortly thereafter. A submitted quiz may be taken 
                a second time, if necessary, but no more than twice.<br><br>
                <?php if($showTakeLater) {?>
                Click <span class='bld'>'Skip Quiz for Now'</span> to take the quiz at a later time, to review course materials before or between quiz attempts, or if you are
                not interested in CEU credit. <span class='bld'>Problems or questions? <?php echo $pleaseContact; ?></span>.
                <?php } ?>

                <div style='font:.7em Courier New, Courier, monospace; font-weight:bold;'>
                
                <?php				  
				if($showAnswers) {
				  $sep = str_repeat("&nbsp;",2);
				  echo "<br>[CORRECT ANSWERS:<br>";
				  echo ($a_1) ? "answer01: T" : "answer01: F";
				  echo $sep;
				  echo ($a_2) ? "answer02: T" : "answer02: F";
				  echo $sep;				  
				  echo ($a_3) ? "answer03: T" : "answer03: F";
				  echo $sep;				  
				  echo ($a_4) ? "answer04: T" : "answer04: F";
				  echo $sep;				  
				  echo ($a_5) ? "answer05: T" : "answer05: F";
				  //echo "<br>";							  
				  if($qt <> 'qts') {
					 echo ($a_6) ? "answer06: T" : "answer06: F";
					 echo $sep;					 
					 echo ($a_7) ? "answer07: T" : "answer07: F";
					 echo $sep;					 
					 echo ($a_8) ? "answer08: T" : "answer08: F";
					 echo $sep;					 
					 echo ($a_9) ? "answer09: T" : "answer09: F";
					 echo $sep;					 
					 echo ($a_10) ? "answer10: T" : "answer10: F";
					 //echo "<br>";								  					  
					  
					 if($qt == 'qt11' || $qt == 'qt11') { 
					    echo ($a_11) ? "answer11: T" : "answer11: F"; 				
					 }
				  }
				  echo "<br>";
				}
				?>
                
                </div>
             </div>
          </div>
          
          <div class='spacer_12'></div>   
          
          <?php if(isset($errorMsg) && $errorMsg > '') { ?>
          <!--ERROR MESSAGES-->
          <table class='quiz_msg_table'>
             <tr>
                <td><?php echo $errorMsg; ?></td>
             </tr>             
          </table>			  
		  <?php } ?>
          
          <!--10 QUESTIONS-->        
          <?php if($showForm) { ?>
             <div class='pink_box'>
                <div class='l_item'>
                   <?php $showquizno = (isset($id) && $id > '') ? " for quiz " . $id . ".&nbsp;&nbsp;<span class='feature'>" . $attempts_msg . "</span>" : '' ?>
                   <h1>Please provide an answer to all questions<?php echo $showquizno; ?></h1> 
                   <h2><?php echo (isset($description) && !empty($description)) ? ucwords($description) : ''; ?></h2>
                   <form class='signin_form' action='<?php echo "{$_SERVER['PHP_SELF']}"?>' method="POST">    
                   <table class='links_table'>
                      <tr><td colspan='3' style='height:5px;'><input type="hidden" name="id" value=" <?php echo $id ?> "></td></tr>
                      <tr><td colspan='3' style='height:5px;'><input type="hidden" name="qt" value=" <?php echo $qt ?> "></td></tr>
                      <tr>
                         <td width='5%'><input type='radio'  name='ua_1' value='1' <?php if ($ua_1 == '1') echo 'checked="checked"'; ?> />T</td>
                         <td width='5%'><input type='radio'  name='ua_1' value='0' <?php if ($ua_1 == '0') echo 'checked="checked"'; ?> />F</td>
                         <td><?php echo $q_1 ?></td>
                      </tr>
                      <?php if ($showHint == 1 && $qt <> 'qts') { echo "<tr><td></td><td></td><td class='showHint'>" . "Note: " . $e_1 . "</td></tr>"; } ?>
			  
                      <tr>
                         <td width='5%'><input type='radio'  name='ua_2' value='1' <?php if ($ua_2 == '1') echo 'checked="checked"'; ?> />T</td>
                         <td width='5%'><input type='radio'  name='ua_2' value='0' <?php if ($ua_2 == '0') echo 'checked="checked"'; ?> />F</td>
                         <td><?php echo $q_2 ?></td>
                      </tr>        
                      <?php if ($showHint == 1 && $qt <> 'qts') { echo "<tr><td></td><td></td><td class='showHint'>" . "Note: " . $e_2 . "</td></tr>"; } ?>
        
                      <tr>
                         <td width='5%'><input type='radio'  name='ua_3' value='1' <?php if ($ua_3 == "1") echo 'checked="checked"'; ?> />T</td>
                         <td width='5%'><input type='radio'  name='ua_3' value='0' <?php if ($ua_3 == "0") echo 'checked="checked"'; ?> />F</td>
                         <td><?php echo $q_3 ?></td>
                      </tr>
                      <?php if ($showHint == 1 && $qt <> 'qts') { echo "<tr><td></td><td></td><td class='showHint'>" . "Note: " . $e_3 . "</td></tr>"; } ?>
        
                      <tr>
                         <td width='5%'><input type='radio'  name='ua_4' value='1' <?php if ($ua_4 == "1") echo 'checked="checked"'; ?> />T</td>
                         <td width='5%'><input type='radio'  name='ua_4' value='0' <?php if ($ua_4 == "0") echo 'checked="checked"'; ?> />F</td>
                         <td><?php echo $q_4 ?></td>
                      </tr>
                      <?php if ($showHint == 1 && $qt <> 'qts') { echo "<tr><td></td><td></td><td class='showHint'>" . "Note: " . $e_4 . "</td></tr>"; } ?>
        
                      <tr>
                         <td width='5%'><input type='radio'  name='ua_5' value='1' <?php if ($ua_5 == "1") echo 'checked="checked"'; ?> />T</td>
                         <td width='5%'><input type='radio'  name='ua_5' value='0' <?php if ($ua_5 == "0") echo 'checked="checked"'; ?> />F</td>
                         <td><?php echo $q_5 ?></td>
                      </tr>        
                      <?php if ($showHint == 1 && $qt <> 'qts') { echo "<tr><td></td><td></td><td class='showHint'>" . "Note: " . $e_5 . "</td></tr>"; }      
                      
                      if($qt <> 'qts') { ?>
        
                          <tr>
                             <td width='5%'><input type='radio'  name='ua_6' value='1' <?php if ($ua_6 == "1") echo 'checked="checked"'; ?> />T</td>
                             <td width='5%'><input type='radio'  name='ua_6' value='0' <?php if ($ua_6 == "0") echo 'checked="checked"'; ?> />F</td>
                             <td><?php echo $q_6 ?></td>
                          </tr>
                          <?php if ($showHint == 1) { echo "<tr><td></td><td></td><td class='showHint'>" . "Note: " . $e_6 . "</td></tr>"; } ?>        
            
                          <tr>
                             <td width='5%'><input type='radio'  name='ua_7' value='1' <?php if ($ua_7 == "1") echo 'checked="checked"'; ?> />T</td>
                             <td width='5%'><input type='radio'  name='ua_7' value='0' <?php if ($ua_7 == "0") echo 'checked="checked"'; ?> />F</td>
                             <td><?php echo $q_7 ?></td>
                          </tr>
                          <?php if ($showHint == 1) { echo "<tr><td></td><td></td><td class='showHint'>" . "Note: " . $e_7 . "</td></tr>"; } ?>
            
                          <tr>
                             <td width='5%'><input type='radio'  name='ua_8' value='1' <?php if ($ua_8 == "1") echo 'checked="checked"'; ?> />T</td>
                             <td width='5%'><input type='radio'  name='ua_8' value='0' <?php if ($ua_8 == "0") echo 'checked="checked"'; ?> />F</td>
                             <td><?php echo $q_8 ?></td>
                          </tr>
                          <?php if ($showHint == 1) { echo "<tr><td></td><td></td><td class='showHint'>" . "Note: " . $e_8 . "</td></tr>"; } ?>        
            
                          <tr>
                             <td width='5%'><input type='radio'  name='ua_9' value='1' <?php if ($ua_9 == "1") echo 'checked="checked"'; ?> />T</td>
                             <td width='5%'><input type='radio'  name='ua_9' value='0' <?php if ($ua_9 == "0") echo 'checked="checked"'; ?> />F</td>
                             <td><?php echo $q_9 ?></td>
                          </tr>
                          <?php if ($showHint == 1) { echo "<tr><td></td><td></td><td class='showHint'>" . "Note: " . $e_9 . "</td></tr>"; } ?>
            
                          <tr>
                             <td width='5%'><input type='radio'  name='ua_10' value='1' <?php if ($ua_10 == "1") echo 'checked="checked"'; ?> />T</td>
                             <td width='5%'><input type='radio'  name='ua_10' value='0' <?php if ($ua_10 == "0") echo 'checked="checked"'; ?> />F</td>
                             <td><?php echo $q_10 ?></td>
                          </tr>
                          <?php if ($showHint == 1) { echo "<tr><td></td><td></td><td class='showHint'>" . "Note: " . $e_10 . "</td></tr>"; }  
                      
                          if($qt == 'qt11' || $qt == 'qt12') { ?>     
                                       
                             <tr>
                                <td width='5%'><input type='radio'  name='ua_11' value='1' <?php if ($ua_11 == "1") echo 'checked="checked"'; ?> />T</td>
                                <td width='5%'><input type='radio'  name='ua_11' value='0' <?php if ($ua_11 == "0") echo 'checked="checked"'; ?> />F</td>
                                <td><?php echo $q_11 ?></td>
                             </tr>
                             <?php if ($showHint == 1) { echo "<tr><td></td><td></td><td class='showHint'>" . "Note: " . $e_11 . "</td></tr>"; } 
						  }
					  } ?>   
                      <tr>       
                         <td colspan='3'>
                            <button type="submit" name="submit" value="submit">Submit Quiz for Scoring</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="submit" name="skip" value="skip">Skip Quiz For Now</button>
                         </td>
                      </tr>  
                      <tr>
						<td colspan='3' style='height:5px;'><input type="hidden" name="sid" value=" <?php echo $sid ?> "></td>
					</tr>                      
                   </table>
                   </form>   
                </div><!--end l_item--> 
             <div class='clearAll'></div>                       
          </div><!--end pink box--> 
          <?php } // end showForm ?>
                   
          <div class='clearAll'></div>                       
          <div class='spacer_12'></div>
          
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
