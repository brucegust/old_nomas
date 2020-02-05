<?php
// *********************************************************
// **************** SHOW TOP NAV BAR ***********************
// *********************************************************

function showTopNav($topNav) {
global $nomasHomePage;	
	
   $topNav = 
   "<ul>
	   <li><a href='" . $nomasHomePage . "'>NOMAS<sup>$reg;</sup> International Home Page</a></li>
   </ul>";
   echo $topNav;
}

?>