<?php
if(session_id() == '') { session_start(); }

// *********************************************************
// **************** SHOW TOP NAV BAR ***********************
// *********************************************************

function showTopNav($topNav) {
global $homePage,$contactPage,$aboutMmpPage,$successStoriesPage,$nomasTrainingPage,$nomasAgendaPage,$feedingForumPage,$ceuPage,
$practitionersPage,$symp2013Page,$symp2014Page,$symp2015Page,$testingPage,$testingLoginPage,$olceuLoginPage;
	
   $topNav = 
   "<ul>
	   <li><a href='" . $homePage . "'>Home</a></li>
	   <li><a href='" . $practitionersPage . "?sid=all'>Practitioners</a>
		 <ul>		
			<li><a href='" . $practitionersPage . "?sid=all'>Practitioners Worldwide</a></li>
			<li><a href='" . $practitionersPage . "?sid=usa'>USA Practitioners</a></li>
			<li><a href='" . $practitionersPage . "?sid=intl'>International Practitioners</a></li>
			<li><a href='" . $nomasTrainingPage . "'>Become a Practitioner</a></li>			 
		 </ul>   		   
	   </li>			
	   <li><a href='" . $nomasTrainingPage . "'>NOMAS<sup>&reg;</sup> Training/Testing</a>
		  <ul>
			<li><a href='" . $nomasTrainingPage . "'>Training & Testing Info</a></li>
			<li><a href='" . $nomasAgendaPage . "'>NOMAS Training Agenda</a></li>
			<li><a href='" . $testingPage . "'>License Renewal Info</a></li>
			<li><a href='" . $olceuLoginPage . "'>Feeding Disorders Login</a></li>		   
			<li><a href='" . $testingLoginPage . "'>Renewal/Reliability Login</a></li>		
		  </ul>
	   </li>
	   <li><a href='" . $ceuPage . "'>Online CEU</a></li>
	   
	   <li><a href='" . $aboutMmpPage . "'>About</a>
		 <ul>		
			<li><a href='" . $aboutMmpPage . "'>Marjorie Meyer Palmer</a></li>
			<li><a href='" . $successStoriesPage . "'>NOMAS Success Stories</a></li>
		 </ul>   		   		
	   </li>
	   <li><a href='" . $contactPage . "'>Contact</a></li>
	   <li><a href='" . $feedingForumPage . "'>Infant Feeding Forum</a></li>
   </ul>";         
   echo $topNav;
}

// *********************************************************
// ******************* SHOW FOOTER *************************
// *********************************************************

function showBottomMenu() {
global $homePage,$nomasTrainingPage,$ceuPage,$testingPage,$contactPage;	
	
   $menu =
   "<div class='menu'>
	   <a href='" . $homePage . "'>Home</a> &middot; 
	   <a href='" . $nomasTrainingPage . "'>NOMAS<sup>&reg;</sup> Training</a> &middot; 
	   <a href='" . $ceuPage . "'>Online CEU</a> &middot; 
	   <a href='" . $testingPage . "'>Re-Licensing / Reliability Testing</a> &middot; 
	   <a href='" . $contactPage . "'>Contact</a> 
   </div>\n";
   echo $menu;  
}

?>