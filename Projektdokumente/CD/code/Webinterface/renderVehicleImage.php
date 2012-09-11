<?php
//*********************
// Author: G.Boeselager
// Date: 16.08.2012
//
// Description:
// This file contains the code to render an vehicle image that is stored as binary in the database.
// Example (how to use):
// echo "<img width='200' src='renderVehicleImage.php?id=1'><br>";
//*********************
//
// ALTERNATIVE
// To save a image as a file into the filesystem use the following codeing:
/*
//Example for saving a picture by the binary data.
$fp = fopen("content/test.jpg","w"); 
fwrite($fp, $bin); 
fclose($fp);
*/
//*********************


include_once("main.php");

//read the passed id
$id = $_REQUEST["id"];

//webservice call to get the binary vehicle image
$result = $webservice->getVehicleById(array("id"=>$id));
$vehicle = new Vehicle;
$vehicle = $result->return;

//binary image
$bin = $vehicle->binaryImage;

//use this for a specific mime type 
//header("Content-type: image/jpg");

print $bin;

exit; 
?>