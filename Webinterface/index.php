<?php
session_start();
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
	<div id='logo'></div>
    </div>
    
    <div id='content'>
	<?php
	    //loads the page which is requested in the URL
	    //e.g. http://localhost/index.php?section=startpage
	    include_once("content.php");
	?>
    </div>
</body>
</html>



