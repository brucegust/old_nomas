<?php
if(session_id() == '') { session_start(); }

// *********************************************************
// **************** SHOW TOP NAV BAR ***********************
// *********************************************************
function showTopNav($topNav) {

  $topNav = 
      "<ul>
        <li><a href='index_app_licensees_add.php'>ADD A PRACTITIONER</a></li>
        <li><a href='index_app_licensees_list.php?sid=all'>See Practitioners</a>
		  <ul>		
             <li><a href='index_app_licensees_list.php?sid=all'>ALL</a>
			 <li><a href='index_app_licensees_list.php?sid=usa'>USA</a></li>
			 <li><a href='index_app_licensees_list.php?sid=intl'>International</a></li>
		  </ul>   
		</li>
        <li><a href='index_app_licensees_list.php?sid=licensed'>Licensed</a>
		  <ul>	
             <li><a href='index_app_licensees_list.php?sid=licensed'>ALL</a>	  	
			 <li><a href='index_app_licensees_list.php?sid=usa_l'>USA</a></li>
			 <li><a href='index_app_licensees_list.php?sid=intl_l'>International</a></li>
		  </ul>   		
		</li>
        <li><a href='index_app_licensees_list.php?sid=unlicensed'>Unlicensed</a>
		  <ul>		
             <li><a href='index_app_licensees_list.php?sid=unlicensed'>ALL</a>
			 <li><a href='index_app_licensees_list.php?sid=usa_u'>USA</a></li>
			 <li><a href='index_app_licensees_list.php?sid=intl_u'>International</a></li>
		  </ul>   			
		</li>
        <li><a href='#'>||||||</a></li>
        <li><a href='index_app_licensees.php'>Practitioner Stats</a></li>
        <li><a href='#'>||||||</a></li>
        <li><a href='index_cms_home.php'>Main Menu</a></li>
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