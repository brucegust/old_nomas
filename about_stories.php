<?php 
header("Cache-Control: max-age=2592000, public"); // 30-days (60sec * 60min * 24hours * 30days)
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_nav/nav_site_001.php"; // top nav menu

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle = " ";
$pageSubTitle = "Success Stories";
//$showTrainingSked = checkTrainingSked($thisYear); // T or F 

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
<meta name="viewport" content="width=device-width" />
<title>NOMAS International - Success Stories</title>
<meta name="description" content="Case studies of infant feeding disorder cases helped by the NOMAS&reg; Protocol.">
<link href="_css/css_cms.css" rel="stylesheet" type="text/css">
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">
<?php 
echo $jq_google . "\n";
echo $jq_ui . "\n";
echo $jq_slidemenu . "\n"; 
?>
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-61070902-1', 'auto');
  ga('send', 'pageview');
</script>
</head>
<body>
<div id="playground">

   <div id='site_logo'><?php showBigLogo(); ?></div>
   <div class='clearAll'></div>
  
   <!--TOP NAV-->  
   <div id='nav_box'>
      <div id='slidemenu' class='jqueryslidemenu'><?php showTopNav($topNav) ?></div>      
   </div><!--end top nav box-->
   
   <!--SOCIAL-->  
   <div class='social_links'>
      <?php showSocialLinks($socialLinks) ?>
   </div><!--end social box-->    
  
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
       <div id='column_left_wide' style='width:97%;'>
       
          <div class='l_item'>
               <h1>Kristic</h1>  
               <div class='pink_box'>       
               <div class='text'>
                 <img src="_grafix/success_kristic.jpg" width="" height="" alt="GRAPHIC">              
                 Kristic was full term and seemed to be developing normally until shortly after one year of age when parents noticed several characteristics suggestive of an 
                 autistic spectrum disorder. At two years of age he did not speak and ate only a limited diet of homemade pureed foods and chips. His diet was gluten and casein free and 
                 he drank soy milk and diluted juices. Kristic was first seen for feeding therapy at 28 months of age. 
                 His diet still consisted of homemade pureed foods, soy milk, juice, and chips. If the pureed food was too thick or bumpy it would result in gagging and/or vomiting. 
                 On the other hand, Kristic was able to adequately chew a few "crunchy, crispy" foods that dissolved easily during the oral phase of swallow. He was able to drink and eat 
                 chips independently. The goal for Kristic was for him to be able to manage small cubes of solids that did not dissolve easily in the mouth, e.g. fresh fruits, vegetables, and meats.
                 
                 His feeding program included but was not limited to the following: 1) addition of tiny cubes of solids added to the pureed food offered by spoon; 
                 2) offering several tiny cubes on a spoon without pureed food; 3) gradually reducing the number of pieces on the spoon; 4) gradually increasing the size of the cubes of food; 
                 and 5) transition to single cube of food offered by fork and placed on the lateral tongue border.
                 
                 Approximately four months later Kristic was able to accept single pieces of such foods as banana, avocado, carrot, and sausage from a fork when they were placed just to the 
                 right of midline. When a small amount of mashed food was offered by fork or spoon rather than a large amount the transition onto a single piece of food was easier at any given meal. 
                 Kristic enjoyed a variety of tastes and textures but did not tolerate the sudden change in bolus size. It is expected that Kristic will continue to demonstrate progress in his 
                 repertoire of accepted foods at mealtime and in his independence to eat them.               
               </div><!--end text-->
               </div>
          </div><!--end l_item-->  
          
          <div class='spacer_26'></div>   
                                            
          <div class='l_item'>
             <div class='l_item_box'>          
               <h1>Allezandra</h1>         
               <div class='pink_box'>       
               <div class='text'>
                 <img src="_grafix/success_allezandra.jpg" width="" height="" alt="GRAPHIC">              
                 Alezzandra was born after a 38-week gestation with a birth weight of 3 lbs. 14 oz. Her diagnoses included: intrauterine growth retardation (IUGR), micrognathia, cleft palate, dysmorphic features, and a ventricular septal defect (VSD). In addition, she had a left club foot and a history of a germinal matrix bleed. Alezzandra remained in the intensive care nursery for four months following her birth. A gastrostomy tube was placed before discharge following a regimen of continuous naso-duodenal feedings accompanied by frequent episodes of regurgitation and vomiting. Alezzandra was receiving both Reglan and Zantac for gastroesophageal reflux.

An oral feeding evaluation was done when Alezzandra was 10 months old. At that time her weight was 12 lbs. 7 oz. Gagging and vomiting persisted often with an accompanying nasopharyngeal reflux. Alezzandra was fed 125 cc boluses every four hours of Enfamil Lipil, 22 calories/oz six times per 24 hours.
In addition, she was able to eat one spoonful of cereal or yogurt at a meal and drink small amounts of water or formula from a Haberman Feeder Bottle. Recommendations at the time of the evaluation included: 1) offering a small bolus of liquid or pureed food with a liquid wash just prior to each gastrostomy tube feeding; 2) be sure that all liquid and solid offered orally contains a minimum of 30 calories/oz.; and 3) offer a variety of utensils.

Progress was initially slow due to persistent vomiting, Alezzandra's inability to tolerate an age appropriate volume, and esophageal dysmotility. Parents chose to feed with a syringe or medicine dropper and to offer the bolus to the buccal cheek cavity instead of to midline. Six months later Alezzandra was able to eat three ounces of pureed food three times daily and was taking small amounts of liquid from a spout cut. Calories takes orally were subtracted from gastrostomy tube feedings and all gastrostomy tube feeds were given during waking hours. As Alezzandra began to swallow larger quantities more frequently the esophagus became more competent, the esophageal phase of swallow improved, and the vomiting subsided. She was successfully weaned off all gastrostomy tube feedings and, in fact, even pulled out her own G-tube! Alezzandra then progressed onto solids that required biting and chewing. </div><!--end text-->
               </div>
             </div><!--end l_item_box-->
          </div><!--end l_item-->  
          
          <div class='spacer_26'></div>   
          
          <div class='l_item'>
             <div class='l_item_box'>          
               <h1>Jacob</h1>      
               <div class='pink_box'>                         
               <div class='text'>
                 <img src="_grafix/success_jacob.jpg" width="" height="" alt="GRAPHIC">      
                 Jacob was full term with a birth weight of 6 lbs. 10 oz. Fetal growth arrested at 37 weeks gestation and mother received non-stress tests twice weekly until delivery. 
                 After birth Jacob was discharged to home on full breast feeds. At two months of age he would grimace with feedings and had excessive gas. By three months of age he appeared 
                 to have some discomfort and was pulling off the breast during feeding. At Jacob’s 4-month check-up with the pediatrician his weight gain had slowed, feedings were becoming problematic, 
                 and he was taking only 12-15 ounces per 24 hours.
                 At four-and-a-half months of age Zantac was prescribed for gastroesophageal reflux although Jacob had not been vomiting. At five months of age medication was discontinued and he 
                 began vomiting. When Jacob was seven moths old a nasogastric (NG) tube was placed because of clinical signs of dehydration. Reglan was prescribed but used only briefly. 
                 Once the NG tube was placed vomiting worsened and occurred with coughing, gagging, and illness. In addition, Jacob refused to eat from a spoon and would take only one ounce from the 
                 bottle at a feeding.
                 Jacob was eight months old at the time of the initial evaluation and was receiving 28 oz. of formula by NG tube. Upon clinical examination both the oral and pharyngeal phases of 
                 swallow were within normal limits while compromise was noted during the esophageal phase. Jacob demonstrated clinical signs of both esophageal dysmotility and transient relaxation 
                 of the lower esophageal sphincter (LES). Mealtimes were a challenge for the family because of Jacob’s discomfort during feeding and distraction was used to create a more positive and 
                 successful mealtime experience. With distraction Jacob would accept only one tablespoon of pureed food and 15 ml. of formula. 
                 Mother was taught a prescriptive therapeutic technique that enabled her to feed Jacob small boluses of 1 cc or less. These were delivered to the buccal cheek cavity and lateral 
                 tongue border which helped to avoid placing food or liquid directly on the tongue at midline. Within one month the NG tube was removed and Jacob was receiving all his calories orally. 
                 Jacob is currently able to eat 3.5 to 4 oz. of pureed food at a meal and drink 3 oz. from a soft spout cup by himself at one time. He is interested in picking up Rice Krispies which he 
                 puts into his mouth and is now learning to chew. Weight gain is slow but steady and esophageal motility has improved with the increased intake of pureed foods.               
               </div><!--end text-->
               </div>               
             </div><!--end l_item_box-->
          </div><!--end l_item-->  
          
          <div class='spacer_26'></div> 
            
          <div class='l_item'>
               <h1>Clyde</h1>       
               <div class='pink_box'>                         
               <div class='text'>
                 <img src="_grafix/success_clyde_1.jpg" width="272" height="190" alt="GRAPHIC">
                 <img src="_grafix/success_clyde_2.jpg" width="292" height="190" alt="GRAPHIC">
                 Clyde was born after a 26-week gestation with a birth weight of 1 lb. 15 oz. He remained in the intensive care nursery for 90 days and on a ventilator for 45 days. 
                 Supplemental oxygen by nasal cannulae was continued until Clyde was about 10 months old. He has been diagnosed with gastroesophageal reflux for which both Zantac and Reglan 
                 were prescribed.
                 At 13 months of age he continued to vomit once daily, always when solids were attempted and whenever he coughed. At the time of the evaluation Clyde was able to eat 
                 only a few spoonfuls of commercially prepared pureed baby food and would gag easily.
                 When 1 cc boluses of pureed food were introduced to the buccal cheek cavity using the clinic dropper, however, he was able to manage these small boluses well without gagging or 
                 vomiting. Three weeks later his intake of pureed food increased to 10 ounces per day! Feeding therapy was then focused on teaching Clyde to chew. Using the clinic dropper to present 
                 pureed food to the buccal cheek cavity and lateral tongue border taught him to &ldquo;eat from the side&rdquo; by eliciting the transverse tongue reflex in conjunction 
                 with consecutive jaw excursions. Ten weeks later he was able to manage a variety of crunchy, crispy solids that dissolved easily in the mouth and had developed a volitional transfer 
                 of a solid bolus from midline to the molar surfaces/lateral gums for chewing age appropriate solids.
               </div><!--end text-->
               </div>
          </div><!--end l_item-->  
          
          <div class='spacer_26'></div> 
          
          <div class='l_item'>
               <h1>Anphongsus</h1>
               <div class='pink_box'>                         
               <div class='text'>
                 <img src="_grafix/success_anphongsus.jpg" width="" height="" alt="GRAPHIC">      
                 Anphongsus was full term with a birth weight of 6 lbs. 9 oz. Developmental milestones have been age appropriate and Anphongsus is generally healthy. 
                 At eight months of age he brings his hands to his mouth for oral exploration but has not yet put any toys into his mouth. He is happy, alert, and interested in mealtime activities.
                 When Anphongsus was four months old pureed baby food was introduced by spoon and a variety of foods were offered. Usually he would eat only eight spoonfuls of food which took one hour. 
                 It is estimated that, at the time of the initial evaluation, he was drinking more than 32 ounces of formula but eating only four ounces of pureed food in 24 hours. 
                 Upon clinical examination it was noted that Anphongsus would close his mouth prematurely on the spoon so as to limit the size of the bolus being delivered. 
                 He was much more willing to accept liquids from the spoon.
                 Gaatroesophageal reflux was reported and projectile vomiting continued to occur 1-3 times weekly. The diagnosis was esophageal dysmotility for solids.
                 Treatment recommendations included: 1) limiting the size of pureed food that was delivered with each presentation. For this a 1 cc sterile clinic dropper was used and food was 
                 introduced laterally to the buccal cheek; 2) offering diluted pureed food from the spoon; and 3) use of a “liquid wash” to aid esophageal clearance of pureed foods. After just three 
                 sessions Anphongsus was eating 12.5 ounces of pureed food per day from a spoon. As this transition onto solids occurred and he developed a more age appropriate diet the vomiting subsided.
               </div><!--end text-->
               </div>
          </div><!--end l_item-->  
          
          <div class='spacer_26'></div> 
          
          <div class='l_item'>
               <h1>Erick</h1>         
               <div class='pink_box'>                         
               <div class='text'>
                 <img src="_grafix/success_erick.jpg" width="" height="" alt="GRAPHIC">      
                 Erick was born after a 25-week gestation with a birth weight of 1.8 lbs. He remained in the intensive care nursery for 95 days and on a ventilator for over two months. 
                 Erick was discharged to home at 38-39 weeks PCA on a nasal cannulae and with an apnea monitor. He had retinopathy of prematurity (ROP), Stage 5 with detached retinas resulting 
                 in blindness. Erick initially was bottle fed and did well. When he was about eight months old pureed baby food was introduced by spoon.
                 Although Erick seemed to eat well at first he soon refused to open his mouth to accept the spoon. His lips remained tightly closed and parents would have to force the spoon into his mouth.
                 When Erick was first evaluated at the age of 14 months corrected he presented with an oral aversion to the spoon and only drank Pediasure from the bottle. At that time he presented with 
                 several issues that have since resolved: 1) the intermittent stimulus of the spoon was initially difficult for him because of his visual impairment; 
                 2) the only oral-motor skill available to him for the intake of nutrition was the volitional suck/swallow pattern; and 3) because of a history of gastroesophageal reflux and 
                 related esophageal dysmotility, management of pureed foods was a challenge. Once pureed food was introduced in an Infa-Feeder (Baby Food Nurser) 
                 Erick sucked easily and made a remarkable transition onto pureed foods. He easily accepted the spoon later.               
               </div><!--end text-->
               </div>
          </div><!--end l_item-->  
          
          <div class='spacer_26'></div> 
          
          <div class='l_item'>
               <h1>Mark</h1>         
               <div class='pink_box'>                         
               <div class='text'>
                 <img src="_grafix/success_mark.jpg" width="" height="" alt="GRAPHIC">      
                 Mark was full term with a birth weight of 8 lbs. 15 oz. He was born with a hypoplastic left heart and underwent the first cardiac surgery at four days of age. He remained hospitalized 
                 for three months and was intubated for 1.5 weeks which resulted in a vocal cord paralysis and subsequent pneumonia. An upper GI study revealed gastroesophageal reflux and at 2.5 months 
                 of age a gastrostomy tube was placed with a Nissen fundoplication. 
                 Mark was first evaluated when he was 13 months old. At that time he was fed 60 cc/hour by continuous drip overnight for seven hours.
                 During the day four boluses of 120 cc were delivered over 45 minutes every four hours. Mark frequently would gag and retch with bolus feeds. Oral-motor skills were adequate for the 
                 management of liquids and pureed foods but when nutrition was offered orally Mark would frequently gag and did not usually attempt to swallow. 
                 The Palmer Protocol for Sensory-Based Weaning (<a href="about_mmp.php">see reference list</a>) was used to gradually transition Mark from continuous overnight drip feedings 
                 onto daytime bolus feeds. 
                 During Phase II of the weaning program nutrition taken orally was subtracted from the bolus feeding that followed. As Mark began to swallow the sour cream (his first food) the downward
                 peristalsis during the esophageal phase of swallow improved and both gagging and retching subsided. Mark was weaned successfully from gastrostomy tube feeds onto 100% oral feeding. 
                 Once he was eating pureed food the transition onto crackers and sandwiches occurred quickly. Mastication developed and the gastrointestinal tract was finally ready for a diet of solids. 
               </div><!--end text-->
               </div>
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
