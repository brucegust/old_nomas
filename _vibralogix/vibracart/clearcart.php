<?php
session_start();
$_SESSION['test']="1234";
reset($_SESSION);
if (!empty($_SESSION))
{
  while(list($namepair, $valuepair) = each($_SESSION))
  {
    if (substr($namepair,0,10)=="sess_cart_")
      unset($_SESSION[$namepair]);
  }
}
reset($_SESSION);
?>