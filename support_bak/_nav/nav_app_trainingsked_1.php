<?php
if(session_id() == '') { session_start(); }

// *********************************************************
// **************** SHOW TOP NAV BAR ***********************
// *********************************************************
function showTopNav($topNav) {

  $topNav = 
      "<ul>
        <!--<li><a href='index_app_trainingsked_edit.php'>SEE ALL LOCATIONS/DATES</a></li>
        <li><a href='#'>||||||</a></li>-->
        <li><a href='index_cms_home.php'>Main Menu</a></li>
        <li><a href='#'>||||||</a></li>		
        <li><a href='index_exit.php'>Logout</a></li>	
	   </ul>
	  ";
  echo $topNav;
}

// *********************************************************
// ******************* SHOW FOOTER *************************
// *********************************************************

function showBottomMenu() {
$menu =
 "<div class='menu'>
  <a href='#'>XXXXX</a> &middot; 
  <a href='#'>XXXXX</a> &middot; 
  <a href='#'>XXXXX</a> &middot; 
  <a href='#'>XXXXX</a> &middot; 
  <a href='#'>XXXXX</a> &middot; 
  <a href='#'>XXXXX</a> &middot; 
  <a href='#'>XXXXX</a> &middot; 
  <a href='#'>XXXXX</a> &middot; 
  <a href='#'>XXXXX</a> &middot; 
  <a href='#'>XXXXX</a>  
  </div>";
  
echo $menu;  

}

?>