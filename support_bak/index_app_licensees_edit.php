<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') { session_start(); }

include_once "_inc/_always.php";
include_once "_nav/nav_app_licensees_3.php";
include_once "_inc/inc_app_licensees.php";

$pg_level = $lvl_2;
$u_token  = getToken(); 

check_permission($pg_level,$u_token);

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle    = "Contact Info For: ";
$pageSubTitle = "Make changes as required, click 'Save Changes' below to preserve changes, 'Cancel Changes' to quit without saving.";
$errorMsg     = array();
$deleteMsg    = "";
$showForm     = true;

//*****************************************************************
//*****************************************************************
//*****************************************************************

// vars for practitioners
$id           = (isset($_POST["id"])           && !empty($_POST["id"]))           ? $_POST["id"]           : "";
$cert_num     = (isset($_POST["cert_num"])     && !empty($_POST["cert_num"]))     ? $_POST["cert_num"]     : "";
$cert_year    = (isset($_POST["cert_year"])    && !empty($_POST["cert_year"]))    ? $_POST["cert_year"]    : "";
$lname        = (isset($_POST["lname"])        && !empty($_POST["lname"]))        ? $_POST["lname"]        : "";
$fname        = (isset($_POST["fname"])        && !empty($_POST["fname"]))        ? $_POST["fname"]        : "";
$addr1        = (isset($_POST["addr1"])        && !empty($_POST["addr1"]))        ? $_POST["addr1"]        : "";
$addr2        = (isset($_POST["addr2"])        && !empty($_POST["addr2"]))        ? $_POST["addr2"]        : "";
$city         = (isset($_POST["city"])         && !empty($_POST["city"]))         ? $_POST["city"]         : "";
$state        = (isset($_POST["state "])       && !empty($_POST["state "]))       ? $_POST["state"]        : "";
$country      = (isset($_POST["country"])      && !empty($_POST["country"]))      ? $_POST["country"]      : "";
$region       = (isset($_POST["region "])      && !empty($_POST["region "]))      ? $_POST["region "]      : "";
$postal       = (isset($_POST["postal"])       && !empty($_POST["postal"]))       ? $_POST["postal"]       : "";
$discipline   = (isset($_POST["discipline"])   && !empty($_POST["discipline"]))   ? $_POST["discipline"]   : "";
$email        = (isset($_POST["email"])        && !empty($_POST["email"]))        ? $_POST["email"]        : "";
$phone        = (isset($_POST["phone"])        && !empty($_POST["phone"]))        ? $_POST["phone"]        : "";
$license      = (isset($_POST["license"])      && !empty($_POST["license"]))      ? $_POST["license"]      : 1;

// check for parameter that identifies which record to select from practitioners table
if(isset($_REQUEST['mnm'])) {
  $mnm = $_REQUEST['mnm'];
}

if(isset($_REQUEST['mid'])) {
  $mid = $_REQUEST['mid'];
}

if(isset($_REQUEST['sid'])) {
  $sid = $_REQUEST['sid'];
}

// Cancel operation
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cancel'])) {
  $cancel_redir = $membersList . "?sid=$sid";
  header("Location: $cancel_redir");
  exit;
}    

// request data from practitioners
if($link = db_connect_site()) {
	
   if($result = mysqli_query($link,"SELECT * FROM $practitionersTBL WHERE id = $mid LIMIT 1")) {
      if (mysqli_num_rows($result) == 0) {
	     $errorMsg['dbf_empty1'] = "Database empty";
	  } else {
		  if(!isset($_REQUEST['ok']) || $_REQUEST['ok'] <> 1) {
             $row = mysqli_fetch_assoc($result);  
			 // assign vars
			 $id = $mid = $row['id'];
			 $sid             = $sid;
			 $cert_num = $mnm = $row['cert_num'];
			 $cert_year       = $row['cert_year'];
			 $discipline      = $row['discipline'];  
			 $fname           = $row['fname'];
			 $lname           = $row['lname'];
			 $addr1           = $row['addr1'];
			 $addr2           = $row['addr2'];
			 $city            = $row['city'];
			 $country         = $row['country'];   
			 $state           = ($row['country'] == "USA") ? $row['region_state'] : '';
			 $region          = ($row['country'] <> "USA") ? $row['region_state'] : '';
			 $postal          = $row['postal'];	
			 $email           = $row['email'];
			 $phone           = $row['phone'];
			 $license         = $row['license'];
			 $licChk = ($row['license'] == '1') ? "checked='checked'" : "";    
		 }
	  }
   }
}

// save edited data 
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
   $_POST['license'] = (isset($_POST['license'])) ? 1 : 0;
   $edit_redir = $membersEdit . "?mid=$mid&mnm=$mnm&sid=$sid&ok=";         
   $errorMsg = updateMember($_POST, $edit_redir);	   
}   

if(isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
  unset($errorMsg);
  $okMsg = "Update successful! To proceed, click a menu option above.";
  $showForm = false;
}    

// Permanently delete record
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['nuke'])) {
   $edit_redir = $membersEdit . "?mid=$mid&mnm=$mnm&sid=$sid&ok=";         
   $deleteMsg = deleteLicensee($_POST['cert_num'], $edit_redir);
}    

if(isset($_REQUEST['ok']) && $_REQUEST['ok'] == 2) {
   unset($errorMsg);
   $deleteMsg = "Practitioner deleted. To proceed, click a menu option above.";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="cleartype" content="on" />
<title>NOMAS International CMS</title>
<meta name="viewport" content="width=device-width" />
<meta name="robots" content="noindex">
<link href="_css/css_cms.css" rel="stylesheet" type="text/css">
<link href="_css/css_forms_cms.css" rel="stylesheet" type="text/css">
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">

<?php 
echo $jq_google . "\n";
echo $jq_ui . "\n"; 
echo $jq_ui_themes . "\n";
echo $jq_slidemenu . "\n"; 
?>

</head>
<body>
<div id="playground">
  <div id='header'><?php showBigLogo(); ?></div>
  <div class='clearAll'></div>
  <!--TOP NAV-->  
  <div id='nav_box'>
     <div id='slidemenu' class='jqueryslidemenu'>
        <?php showTopNav($topNav) ?>
     </div>      
  </div><!--end top nav box-->
      
    <!-- CONTENT -->
    
    <div id='content'>
    
       <?php 
	   if(isset($pageTitle) && $pageTitle > '') {
          echo "<div class='pageTitle'>" . $pageTitle . " " . $fname . " " . $lname . "</div>\n";
	   }
       if(isset($pageSubTitle) && $pageSubTitle > '') {
          echo "<div class='pageSubTitle'>" . $pageSubTitle . "</div>\n";
	   } 	  
	   //error messages
       if (isset($errorMsg) && !empty($errorMsg)) {		  
		  echo "<div class='error_box'>\n";
          echo "<table class='problem_msg_table'>\n";
		  echo "<tr><td>ENTRY NOT SAVED!</td></tr>\n";
		  foreach($errorMsg as $val) {
		     echo "<tr><td>* " . $val . "</td></tr>\n";
		  }
          echo "</table>\n";                
       }
	   
       if (isset($deleteMsg) && count($deleteMsg) > 0 ) {
		  echo "<div class='error_box'>\n";
          echo "<table class='problem_msg_table'>\n";
		  echo "<tr><td>" . $deleteMsg . "</td></tr>\n";
          echo "</table>\n";                 
       }	   
		  
	   // add another entry
	   if(isset($okMsg) && !empty($okMsg)) {
	      echo "<div class='ok_msg'>" . $okMsg . "<br></div>\n";			
	   } 	 	  		  
	   echo "</div>"; 
	   
	   if($showForm) {
	   ?>     
    
        <form id="form_members" action='<?php echo "{$_SERVER['PHP_SELF']}"?>' method="POST" novalidate>
        
           <input name="id" type="hidden" value="<?php echo $id ?>">  
           <input name="mid" type="hidden" value="<?php echo $mid ?>">  
           <input name="mnm" type="hidden" value="<?php echo $mnm ?>">         
           <input name="sid" type="hidden" value="<?php echo $sid ?>">     
           
           <label for='cert_year'>Cert Year:</label>
           <input name="cert_year" type="text" value="<?php echo $cert_year ?>" size="20" maxlength="4">              
               
           <label for='cert_num'>License Number:</label>
           <input name="cert_num" type="text" value="<?php echo $cert_num ?>" size="10" maxlength="10">                                             
           
           <label for="license">License?</label>
           <input style='width:3%;' name='license' type='checkbox' value='<?php echo $license ?>' <?php echo $licChk ?> size='10' maxlength='5'>
    
           <label for='fname'>First:</label>
           <input name="fname" type="text" value="<?php echo $fname ?>" size="50" maxlength="50">          
                
           <label for='lname'>Last:</label>
           <input name="lname" type="text" value="<?php echo $lname ?>" size="50" maxlength="50">                        
           
           <label for='addr1'>Address 1:</label>
           <input name="addr1" type="text" value="<?php echo $addr1 ?>" size="50" maxlength="100">
    
           <label for='addr2'>Address 2:</label>
           <input name="addr2" type="text" value="<?php echo $addr2 ?>" size="50" maxlength="100">           
           
           <label for='city'>City:</label>
           <input name="city" type="text" value="<?php echo $city ?>" size="50" maxlength="50"><br>               
    
           <label for='state'>State: (USA only)</label>
           <select name="state">
              <option value="<?php echo $state;?>"><?php echo $state;?></option>
              <option value="AL">Alabama</option>
              <option value="AK">Alaska</option>
              <option value="AZ">Arizona</option>
              <option value="AK">Arkansas</option>
              <option value="CA">California</option>
              <option value="CO">Colorado</option>
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="DC">District of Columbia</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="HI">Hawaii</option>
              <option value="ID">Idaho</option>
              <option value="IL">Illinois</option>
              <option value="IN">Indiana</option>
              <option value="IA">Iowa</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="MN">Minnesota</option>
              <option value="MS">Mississippi</option>
              <option value="MO">Missouri</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NJ">New Jersey</option>
              <option value="NY">New York</option>
              <option value="NV">Nevada</option>
              <option value="NH">New Hampshire</option>
              <option value="NM">New Mexico</option>
              <option value="NC">North Carolina</option>
              <option value="ND">North Dakota</option>
              <option value="OH">Ohio</option>
              <option value="OK">Oklahoma</option>
              <option value="OR">Oregon</option>
              <option value="PA">Pennsylvania</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="SD">South Dakota</option>
              <option value="TN">Tennessee</option>
              <option value="TX">Texas</option>
              <option value="UT">Utah</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WA">Washington</option>
              <option value="WV">West Virginia</option>
              <option value="WI">Wisconsin</option>
              <option value="WY">Wyoming</option>
           </select>
           <?php $state = $_POST['selected']; ?>
           
           <label for='country'>Country:</label>
           <select name="country"> 
             <option value="<?php echo $country;?>" SELECTED><?php echo $country;?></option>  
             <option value="Afghanistan">Afghanistan</option> 
             <option value="Albania">Albania</option> 
             <option value="Algeria">Algeria</option> 
             <option value="American Samoa">American Samoa</option> 
             <option value="Andorra">Andorra</option> 
             <option value="Angola">Angola</option> 
             <option value="Anguilla">Anguilla</option> 
             <option value="Antarctica">Antarctica</option> 
             <option value="Antigua and Barbuda">Antigua and Barbuda</option> 
             <option value="Argentina">Argentina</option> 
             <option value="Armenia">Armenia</option> 
             <option value="Aruba">Aruba</option> 
             <option value="Australia">Australia</option> 
             <option value="Austria">Austria</option> 
             <option value="Azerbaijan">Azerbaijan</option> 
             <option value="Bahamas">Bahamas</option> 
             <option value="Bahrain">Bahrain</option> 
             <option value="Bangladesh">Bangladesh</option> 
             <option value="Barbados">Barbados</option> 
             <option value="Belarus">Belarus</option> 
             <option value="Belgium">Belgium</option> 
             <option value="Belize">Belize</option> 
             <option value="Benin">Benin</option> 
             <option value="Bermuda">Bermuda</option> 
             <option value="Bhutan">Bhutan</option> 
             <option value="Bolivia">Bolivia</option> 
             <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
             <option value="Botswana">Botswana</option> 
             <option value="Bouvet Island">Bouvet Island</option> 
             <option value="Brazil">Brazil</option> 
             <option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
             <option value="Brunei Darussalam">Brunei Darussalam</option> 
             <option value="Bulgaria">Bulgaria</option> 
             <option value="Burkina Faso">Burkina Faso</option> 
             <option value="Burundi">Burundi</option> 
             <option value="Cambodia">Cambodia</option> 
             <option value="Cameroon">Cameroon</option> 
             <option value="Canada">Canada</option> 
             <option value="Cape Verde">Cape Verde</option> 
             <option value="Cayman Islands">Cayman Islands</option> 
             <option value="Central African Republic">Central African Republic</option> 
             <option value="Chad">Chad</option> 
             <option value="Chile">Chile</option> 
             <option value="China">China</option> 
             <option value="Christmas Island">Christmas Island</option> 
             <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
             <option value="Colombia">Colombia</option> 
             <option value="Comoros">Comoros</option> 
             <option value="Congo">Congo</option> 
             <option value="Congo, Democratic Republic">Congo, Democratic Republic</option> 
             <option value="Cook Islands">Cook Islands</option> 
             <option value="Costa Rica">Costa Rica</option> 
             <option value="Cote D'ivoire">Cote D'ivoire</option> 
             <option value="Croatia">Croatia</option> 
             <option value="Cuba">Cuba</option> 
             <option value="Cyprus">Cyprus</option> 
             <option value="Czech Republic">Czech Republic</option> 
             <option value="Denmark">Denmark</option> 
             <option value="Djibouti">Djibouti</option> 
             <option value="Dominica">Dominica</option> 
             <option value="Dominican Republic">Dominican Republic</option> 
             <option value="Ecuador">Ecuador</option> 
             <option value="Egypt">Egypt</option> 
             <option value="El Salvador">El Salvador</option> 
             <option value="Equatorial Guinea">Equatorial Guinea</option> 
             <option value="Eritrea">Eritrea</option> 
             <option value="Estonia">Estonia</option> 
             <option value="Ethiopia">Ethiopia</option> 
             <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
             <option value="Faroe Islands">Faroe Islands</option> 
             <option value="Fiji">Fiji</option> 
             <option value="Finland">Finland</option> 
             <option value="France">France</option> 
             <option value="French Guiana">French Guiana</option> 
             <option value="French Polynesia">French Polynesia</option> 
             <option value="French Southern Territories">French Southern Territories</option> 
             <option value="Gabon">Gabon</option> 
             <option value="Gambia">Gambia</option> 
             <option value="Georgia">Georgia</option> 
             <option value="Germany">Germany</option> 
             <option value="Ghana">Ghana</option> 
             <option value="Gibraltar">Gibraltar</option> 
             <option value="Greece">Greece</option> 
             <option value="Greenland">Greenland</option> 
             <option value="Grenada">Grenada</option> 
             <option value="Guadeloupe">Guadeloupe</option> 
             <option value="Guam">Guam</option> 
             <option value="Guatemala">Guatemala</option> 
             <option value="Guinea">Guinea</option> 
             <option value="Guinea-bissau">Guinea-bissau</option> 
             <option value="Guyana">Guyana</option> 
             <option value="Haiti">Haiti</option> 
             <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
             <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
             <option value="Honduras">Honduras</option> 
             <option value="Hong Kong">Hong Kong</option> 
             <option value="Hungary">Hungary</option> 
             <option value="Iceland">Iceland</option> 
             <option value="India">India</option> 
             <option value="Indonesia">Indonesia</option> 
             <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
             <option value="Iraq">Iraq</option> 
             <option value="Ireland">Ireland</option> 
             <option value="Israel">Israel</option> 
             <option value="Italy">Italy</option> 
             <option value="Jamaica">Jamaica</option> 
             <option value="Japan">Japan</option> 
             <option value="Jordan">Jordan</option> 
             <option value="Kazakhstan">Kazakhstan</option> 
             <option value="Kenya">Kenya</option> 
             <option value="Kiribati">Kiribati</option> 
             <option value="Korea">Korea</option> 
             <option value="Korea, Republic of">Korea, Republic of</option> 
             <option value="Kuwait">Kuwait</option> 
             <option value="Kyrgyzstan">Kyrgyzstan</option> 
             <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
             <option value="Latvia">Latvia</option> 
             <option value="Lebanon">Lebanon</option> 
             <option value="Lesotho">Lesotho</option> 
             <option value="Liberia">Liberia</option> 
             <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
             <option value="Liechtenstein">Liechtenstein</option> 
             <option value="Lithuania">Lithuania</option> 
             <option value="Luxembourg">Luxembourg</option> 
             <option value="Macao">Macao</option> 
             <option value="Macedonia">Macedonia</option> 
             <option value="Madagascar">Madagascar</option> 
             <option value="Malawi">Malawi</option> 
             <option value="Malaysia">Malaysia</option> 
             <option value="Maldives">Maldives</option> 
             <option value="Mali">Mali</option> 
             <option value="Malta">Malta</option> 
             <option value="Marshall Islands">Marshall Islands</option> 
             <option value="Martinique">Martinique</option> 
             <option value="Mauritania">Mauritania</option> 
             <option value="Mauritius">Mauritius</option> 
             <option value="Mayotte">Mayotte</option> 
             <option value="Mexico">Mexico</option> 
             <option value="Micronesia">Micronesia</option> 
             <option value="Moldova">Moldova</option> 
             <option value="Monaco">Monaco</option> 
             <option value="Mongolia">Mongolia</option> 
             <option value="Montserrat">Montserrat</option> 
             <option value="Morocco">Morocco</option> 
             <option value="Mozambique">Mozambique</option> 
             <option value="Myanmar">Myanmar</option> 
             <option value="Namibia">Namibia</option> 
             <option value="Nauru">Nauru</option> 
             <option value="Nepal">Nepal</option> 
             <option value="Netherlands">Netherlands</option> 
             <option value="Netherlands Antilles">Netherlands Antilles</option> 
             <option value="New Caledonia">New Caledonia</option> 
             <option value="New Zealand">New Zealand</option> 
             <option value="Nicaragua">Nicaragua</option> 
             <option value="Niger">Niger</option> 
             <option value="Nigeria">Nigeria</option> 
             <option value="Niue">Niue</option> 
             <option value="Norfolk Island">Norfolk Island</option> 
             <option value="Northern Mariana Islands">Northern Mariana Islands</option> 
             <option value="Norway">Norway</option> 
             <option value="Oman">Oman</option> 
             <option value="Pakistan">Pakistan</option> 
             <option value="Palau">Palau</option> 
             <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
             <option value="Panama">Panama</option> 
             <option value="Papua New Guinea">Papua New Guinea</option> 
             <option value="Paraguay">Paraguay</option> 
             <option value="Peru">Peru</option> 
             <option value="Philippines">Philippines</option> 
             <option value="Pitcairn">Pitcairn</option> 
             <option value="Poland">Poland</option> 
             <option value="Portugal">Portugal</option> 
             <option value="Puerto Rico">Puerto Rico</option> 
             <option value="Qatar">Qatar</option> 
             <option value="Reunion">Reunion</option> 
             <option value="Romania">Romania</option> 
             <option value="Russian Federation">Russian Federation</option> 
             <option value="Rwanda">Rwanda</option> 
             <option value="Saint Helena">Saint Helena</option> 
             <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
             <option value="Saint Lucia">Saint Lucia</option> 
             <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
             <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
             <option value="Samoa">Samoa</option> 
             <option value="San Marino">San Marino</option> 
             <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
             <option value="Saudi Arabia">Saudi Arabia</option> 
             <option value="Senegal">Senegal</option> 
             <option value="Serbia and Montenegro">Serbia and Montenegro</option> 
             <option value="Seychelles">Seychelles</option> 
             <option value="Sierra Leone">Sierra Leone</option> 
             <option value="Singapore">Singapore</option> 
             <option value="Slovakia">Slovakia</option> 
             <option value="Slovenia">Slovenia</option> 
             <option value="Solomon Islands">Solomon Islands</option> 
             <option value="Somalia">Somalia</option> 
             <option value="South Africa">South Africa</option> 
             <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
             <option value="Spain">Spain</option> 
             <option value="Sri Lanka">Sri Lanka</option> 
             <option value="Sudan">Sudan</option> 
             <option value="Suriname">Suriname</option> 
             <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
             <option value="Swaziland">Swaziland</option> 
             <option value="Sweden">Sweden</option> 
             <option value="Switzerland">Switzerland</option> 
             <option value="Syrian Arab Republic">Syrian Arab Republic</option> 
             <option value="Taiwan, Province of China">Taiwan, Province of China</option> 
             <option value="Tajikistan">Tajikistan</option> 
             <option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
             <option value="Thailand">Thailand</option> 
             <option value="Timor-leste">Timor-leste</option> 
             <option value="Togo">Togo</option> 
             <option value="Tokelau">Tokelau</option> 
             <option value="Tonga">Tonga</option> 
             <option value="Trinidad and Tobago">Trinidad and Tobago</option> 
             <option value="Tunisia">Tunisia</option> 
             <option value="Turkey">Turkey</option> 
             <option value="Turkmenistan">Turkmenistan</option> 
             <option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
             <option value="Tuvalu">Tuvalu</option> 
             <option value="Uganda">Uganda</option> 
             <option value="Ukraine">Ukraine</option> 
             <option value="United Arab Emirates">United Arab Emirates</option> 
             <option value="UK">United Kingdom</option> 
             <option value="USA">USA</option> 
             <option value="US Minor Outlying Islands">United States Minor Outlying Islands</option> 
             <option value="Uruguay">Uruguay</option> 
             <option value="Uzbekistan">Uzbekistan</option> 
             <option value="Vanuatu">Vanuatu</option> 
             <option value="Venezuela">Venezuela</option> 
             <option value="Viet Nam">Viet Nam</option> 
             <option value="Virgin Islands, British">Virgin Islands, British</option> 
             <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
             <option value="Wallis and Futuna">Wallis and Futuna</option> 
             <option value="Western Sahara">Western Sahara</option> 
             <option value="Yemen">Yemen</option> 
             <option value="Zambia">Zambia</option> 
             <option value="Zimbabwe">Zimbabwe</option>
            </select>
            <?php $country = $_POST['selected']; ?>		
           
            <label for='region'>Foreign Region:</label>
            <input name="region" type="text" value="<?php echo $region ?>" size="20" maxlength="50">  
           
            <label for='postal'>Postal Code:</label>
            <input name="postal" type="text" value="<?php echo $postal ?>" size="20" maxlength="15">     
           
            <label for='email'>Email:</label>
            <input name="email" type="text" value="<?php echo $email ?>" size="30" maxlength="100">    
           
            <label for='phone'>Phone:</label>
            <input name="phone" type="text" value="<?php echo $phone ?>" size="20" maxlength="50">    
           
            <label for='discipline'>Discipline:</label>
            <input name="discipline" type="text" value="<?php echo $discipline ?>" size="20" maxlength="255">                              
        
            <div class='clearAll'></div>    
           
            <button type="submit" name="submit" value="submit">Save Changes</button>  
            <button type="submit" name="cancel" value="submit">Cancel Changes / Return to Main List</button>           
            <button type="submit" name="nuke" class="delete_button" style="width:40%;" title= "This cannot be undone" value="submit">Permanently Delete This Licensee</button>  
         </form>
      <?php } ?>   
      
    </div> <!-- end content  -->
  
  <!--FOOTER-->
  <div id="footer"> 
    <?php showBottomMenu(); showCopyright($thisYear); ?>
  </div><!-- end footer -->
 
<div class='clearAll'></div>

</div><!-- end #playround -->

</body>
</html>
