<?php
if(session_id() == '') { session_start(); }

// *********************************************************
// **************** SHOW TOP NAV BAR ***********************
// *********************************************************
function showTopNav($topNav) {

  $topNav = 
      "<ul>
        <li><a href='index_app_testsked_add.php'>ADD NEW TEST APPOINTMENT</a></li>
        <li><a href='index_app_testsked_list.php'>Licensing/Reliability</a>
		<ul>
		  <li><a href='index_app_testsked_list.php'>See All Test Takers</a></li>
		  <li><a href='index_app_testsked_list.php?sid=2'>Reliability Test 2 Takers</a></li>
		  <li><a href='index_app_testsked_list.php?sid=3'>Reliability Test 3 Takers</a></li>
		  <li><a href='index_app_testsked_list.php?sid=4'>Re-Licensing Test 1 Takers</a></li>
		  <li><a href='index_app_testsked_list.php?sid=5'>Re-Licensing Test 2 Takers</a></li>
		</ul>		        
		</li>
        <li><a href='#'>||||||</a></li>		
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