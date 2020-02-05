<?php
// **************************************************************************************************
// lkcustom.php
// Determines clients IP address and sends it though Paypal encoded in the buttons custom field.
// Copyright (c) 2005 - 2009 Vibralogix
// www.vibralogix.com
// sales@vibralogix.com
// **************************************************************************************************

$LinkKey="DiN#l1h-Z53@7_29x";		// Set to same value as in linklokipn.php

// **************************************************************************************************
// The code below normally will not need modifying. Do so at your own risk!
// **************************************************************************************************
$custom="I=".$_SERVER['REMOTE_ADDR'];
if (isset($slusername))
{
  if ($slusername!="")
  $custom.=",U=".$slusername;
}
$custom=md5($LinkKey.$custom)."^".$custom;
$custom=base64_encode($custom);
$custom=rawurlencode($custom);
?>
