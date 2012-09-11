<?php
//*********************
// Author: G.Boeselager
// Date: 15.08.2012
//
// Description:
// In this file are important scripts which have to be included in all PHP-Files of this project.
// To include use the following code at the top of the file: include_once('main.php');
//*********************

//** IMPORTANT!
//** These configuration information for the Apache-Webserver is needed. If they are not set the WSDL document
//** will be cached for a long time and it cause unexpected errors.
ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0');

//set the correct timezone
date_default_timezone_set("Europe/Paris");

//** Include all required classes
include_once("core/converter.php");
include_once("core/validation.php");

include_once("model/location.php");
include_once("model/vehicle.php");
include_once("model/customer.php");
include_once("model/renting.php");

//** Create a SoapClient-Object to determine the place of the WSDL file.
//** The first parameter requires the URI to the WSDL document. The second parameter is optional for
//** several options of the connection.
//** If you want to handle complex types from the webservice you have to set the option "classmap"
//** with a mapping of the internal classname to the extenal classname. e.g. 'classmap' => array('Vehicle' => "vehicle")

//$wsdl = "http://193.22.73.246:8080/axis2/services/RentACar?wsdl"; //FHDW Server (VPN-Connection is required)
$wsdl = "http://localhost:8080/axis2/services/RentACar?wsdl"; //local

$webservice = new SoapClient($wsdl, array('soap_version'=>SOAP_1_2,
																				'trace'=>1,
																				'classmap' => array('Vehicle' => "Vehicle",
																														'Location' => "Location",
																														'Customer' => "Customer",
																														'Renting' => "Renting")
																				));

//** Include the CustomerLogin. This include has to be called AFTER the SoapClient is created.
include_once("core/customerLogin.php");

?>