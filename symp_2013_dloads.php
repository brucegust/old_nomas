<?php 
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_nav/nav_site_001.php"; // top nav menu

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle = "2013 SYMPOSIUM SLIDES AND PRESENTATIONS";
$pageSubTitle = 'Click an Archive or Individual Presentation to Download';

//*****************************************************************
//*****************************************************************
//*****************************************************************

if(!isset($_SESSION['dloads']) || empty($_SESSION['dloads']))  {
   header("Location: symp_2013.php");
   exit;	
}	
unset($_SESSION['dloads']);
$dloadpath  = "_docs/symp2013_talks/"; 

$dloaddays  = array(
"Day 01 (Talks 01-05)" => "Day1.zip",
"Day 2a (Talks 06-12)" => "Day2a.zip",
"Day 2b (Talks 13-17)" => "Day2b.zip",
"Day 03 (Talks 18-21)" => "Day3.zip",
"Day 04 (Talks 22-26)" => "Day4.zip",
"Day 05 (Talks 27-30)" => "Day5.zip"
);

$dloadtalks = array(
"01_Bergman_Context_NICU_Newborn.pdf",
"02_Wilkins_Gastrointestinal_Tract.pdf",
"03_Young_thickening_feedings.pdf",
"04_Gewolb_Respiration.pdf",
"05_Palmer_NOMAS.pdf",
"06_Bingham_Olfaction.pdf",
"07_Gewolb_GER.pdf",
"08_Young_Pharmocological.pdf",
"09_Chappel_body_development.pdf",
"10_Fuller_Successful_Feeding_NICU.pdf",
"11_Vandenberg_NIDCAP.pdf",
"12_Chappel_Therapeutic_Interventions.pdf",
"13_Niemann_Cardiac_Infant.pdf",
"14_Stanford_VFSS.pdf",
"15_Sturdivan_Cue-Based.pdf",
"16_Scott_Breastfeeding_Challenges.pdf",
"17_Wilkins_Feeding_Premature_Infant.pdf",
"18_Vandenberg_Supporting_Emerging_development.pdf",
"19_Bingham_NNS_in_Oral_Feeding.pdf",
"20_Dodrill_Initial_Oral_Feeding_Milestones.pdf",
"21_Palmer_Poor_Feeder.pdf",
"22_Adams-Chapman_Predictors.pdf",
"23_Hyman_Tube_to_Oral.pdf",
"24_Reilly_Motor_Concerns.pdf",
"25_Dodrill_Feeding_Diet_Growth.pdf",
"26_Arvedson_objectives.pdf",
"27_Arvedson_management_decisions.pdf",
"28_Comrie_Motor_based.pdf",
"29_Dordill_Behavioral_Feeding.pdf",
"30_Palmer_Incremental_Progression.pdf"
);

function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor] . "b";
}

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
<link href="_css/css_cms.css" rel="stylesheet" type="text/css">
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">
<?php 
echo $jq_google . "\n";
echo $jq_ui . "\n";
echo $jq_slidemenu . "\n"; 
?>
</head>
<body>
<div id="playground">

   <div id='site_logo'><?php showBigLogo(); ?></div>
  
   <div class='clearAll'></div>
  
   <!--TOP NAV-->  
   <div id='nav_box'>
      <div id='slidemenu' class='jqueryslidemenu'><?php showTopNav($topNav) ?></div>      
   </div><!--end top nav box-->
  
   <div class='clearAll'></div>  
    
   <!-- CONTENT -->
    
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
       </div>   
      
       <!-- LEFT COLUMN-->
       <div id='column_left_wide'>
          <div class='l_item'>
             <div class='text'>
                  <!--DAYS-->
                  <table class='contact' style='border:1px dotted #FF6699;'>
                     <tr>
                        <td colspan='5' style='font-weight:bold;padding-left:8px;'>ARCHIVES CONTAIN ALL OF EACH DAY'S PRESENTATIONS IN .ZIP FORMAT:</td>
                     </tr>                  
                     <tr>
                        <?php
						echo "<td style='padding-left:8px;'>";
						foreach($dloaddays as $key => $val) {
						   if(file_exists($dloadpath . $val)) {
						      echo "<a href='" . $dloadpath . $val . "'>" . $key . " - (file size: " . human_filesize(filesize($dloadpath.$val)) . ")</a><br>";
						   } else {
						      echo $key . " Not yet available";
						   }
						}
						echo "</td>";
						?>
                     </tr>
                  </table>     
                  <!--TALKS-->
                  <table class='contact' style='margin-top:12px;border:1px dotted #FF6699;'>
                     <tr>
                        <td style='font-weight:bold;padding-left:8px;'>DOWNLOAD INDIVIDUAL PRESENTATIONS:</td>
                     </tr>
                     <?php 
					 if(isset($dloadtalks) && is_array($dloadtalks) && count($dloadtalks)) {
						$cnt = "1";
					    foreach ($dloadtalks as $val) {
                        echo "<tr>";
						   if(!empty($val)) {
							  if(file_exists($dloadpath.$val)) {
                                 echo "<td style='padding-left:8px;'>
								 Talk: <a href=" . $dloadpath . $val . " type='application/octet-stream' download>" . $val . " - (file size: " . human_filesize(filesize($dloadpath.$val)) . ")</a></td>";
							  }
						   } else {
							  echo "<td style='padding-left:8px;'>Talk: " . $cnt . " Not yet available</td>\n";
						   }
                        echo "</tr>\n";
						$cnt++;
						}
					 }
					 ?>
                     </table>                  
               </div><!--end text-->
          </div><!--end l_item-->  
          
          <div class='spacer_26'></div>
          
       </div><!--END COLUMN LEFT-->   
    <div class='clearAll'></div>
    </div> <!-- end content  -->  
  
    <!--FOOTER-->
    <div id="footer"> 
       <?php showBottomMenu(); showCopyright($thisYear); ?>
    </div><!-- end footer -->
 
    <div class='clearAll'></div>

</div><!-- end #playround -->
</body>
</html>
