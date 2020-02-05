<?php
if(session_id() == '') { session_start(); }

// *********************************************************
// **************** SHOW TOP NAV BAR ***********************
// *********************************************************
function showTopNav($topNav) {
global $trainingskedADD,$homeMenuPage,$quit;	

  $topNav = 
      "<ul>
        <li><a href='$trainingskedADD'>ADD A NEW TRAINING SITE</a></li>
        <li><a href='#'>||||||</a></li>
        <li><a href='$homeMenuPage'>Main Menu</a></li>
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