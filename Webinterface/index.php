<?php
//*********************
// Author: G.Böselager
// Date: 16.08.2012
//
// Description:
// This is the main site. Every request for pages will load this file at first.
//*********************

session_start();

//include the important main.php file
include_once('main.php');
			
//login the customer
if(isset($_REQUEST["login"])){
		//load all passed get parameters passed from the site before
		$loginEmail = $_REQUEST["login_email"];
		$loginPassword = $_REQUEST["login_password"];
		
		//login the customer if its possible
		CustomerLogin::login($loginEmail,$loginPassword);
}

//logout the customer
If($_REQUEST["logout"]=="1"){
		
		CustomerLogin::logout();
}


//if a customer is logged in this method will return the object of the customer
$logincustomer = CustomerLogin::getLoginCustomer();

//Loads the page which is requested in the URL.
//In every content file the output to render is written in the variable $output.
//e.g. http://localhost/index.php?section=startpage
include_once("content.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
    <title>RentACar Autovermietung</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link type="text/css" href="jquery-ui-1.8.21.custom/css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
        <link type="text/css" href="style.css" rel="stylesheet" />
        <script type="text/javascript" src="jquery-ui-1.8.21.custom/js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="jquery-ui-1.8.21.custom/js/jquery-ui-1.8.21.custom.min.js"></script>
        <script type="text/javascript" src="jquery-ui-1.8.21.custom/js/jquery-ui-timepicker-addon.js"></script>
        
</head>
<body>
    
    <div id='head'>
				<a id='logo' href="index.php"></a>
				<div id='login'>
						<form action='index.php?section=login' method='post'>
								<?
								if($logincustomer!=NULL){
										
										echo "Hallo ".$logincustomer->salutation." ".$logincustomer->lastname.", sie sind im <a href='index.php?section=login' style='color:black'>Kundenbereich</a> eingeloggt. <a href='index.php?logout=1' style='color:black'>Logout</a>";
								}else{
								
										echo "
										<b>Kundenlogin:</b><br>
										E-Mail: <input type='text' name='login_email' value='".$_REQUEST['login_email']."'> Passwort: <input type='password' name='login_password'>
										<input type='submit' name='login' value='Login'>
										";
								}
								?>
						</form>
				</div>
    </div>
    
    <div id='content'>
	<?php echo $output; ?>
    </div>
</body>
</html>



