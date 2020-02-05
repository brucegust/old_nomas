<?php 
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_nav/nav_site_001.php"; // top nav menu

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle = "2014 SYMPOSIUM SLIDES AND PRESENTATIONS";
$pageSubTitle = 'Click an Archive or Individual Presentation to Download';

//*****************************************************************
//*****************************************************************
//*****************************************************************

if(!isset($_SESSION['dloads']) || empty($_SESSION['dloads']))  {
   header("Location: symp_2014.php");
   exit;	
}	
unset($_SESSION['dloads']);
$dloadpath  = "_docs/symp2014_talks/"; 

$dloadtalks = array(
"01_neu-gi-development.pdf",
"02_vandenberg-nicu-newborn.pdf",
"03_gewolb-biorhythms-of-suck.pdf",
"04_bingham-neurologic-dysphagia.pdf",
"05_adams-chapman-predictors.pdf",
"06_palmer-sensory-based-feeding.pdf",
"07_bingham-olfaction.pdf",
"08_gewolb-gi-reflux.pdf",
"09_hyman-diagnostic-criteria.pdf",
"10_stanford-co-regulation.pdf",
"11_frantz-breast-feeding.pdf",
"12_lawhon-feeding-readiness.pdf",
"13_chappel-total-body.pdf",
"14_vandenberg-nidcap.pdf",
"15_fuller-preventative-model.pdf",
"16_dodrill-feeding-difficulties.pdf",
"17_mccalley-cardiac-disease.pdf",
"18_larson-infant-swallowing.pdf",
"19_fuller-early-feeding.pdf",
"20_bigsby-nnns.pdf",
"21_dodrill-feeding-management.pdf",
"22_bergman-feeding-in-nicu.pdf"
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
								 Talk: <a href=" . $dloadpath . $val . " type='application/octet-stream' download style='font-style:normal;'>" . $val . " - (file size: " . human_filesize(filesize($dloadpath.$val)) . ")</a></td>";
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
