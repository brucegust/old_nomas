<?php
if(session_id() == '') { session_start(); }

// *********************************************************
// **************** SHOW TOP NAV BAR ***********************
// *********************************************************
function showTopNav($topNav) {
global $trainingskedMain,$quit;	

  $topNav = 
      "<ul>
        <li><a href='$trainingskedMain'>TRAINING SITE MAIN MENU</a></li>
        <li><a href='#'>||||||</a></li>		
        <li><a href='$quit'>Logout</a></li>	
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