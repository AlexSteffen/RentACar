<?php
//*********************
// Author: G.Böselager
// Date: 15.8.2012
//
// Description:
// In this file are important scripts which have to be included in all PHP-Files of this project.
// To include use the following code at the top of the file: include_once('main.php');
//*********************

//** IMPORTANT!!
//** These configuration information for the Apache-Webserver is needed. If they are not set the WSDL document
//** will be cached for a long time and it cause unexpected errors.
ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0');

//** Include all required classes
include_once("class/location.php");
include_once("class/vehicle.php");

//** Create a SoapClient-Object to determine the place of the WSDL file.
//** The first parameter requires the URI to the WSDL document. The second parameter is optional for
//** several options of the connection.
//** If you want to handle complex types from the webservice you have to set the option "classmap"
//** with a mapping of the internal classname to the extenal classname. e.g. 'classmap' => array('Vehicle' => "vehicle")
$webservice = new SoapClient("http://localhost:8080/axis2/services/RentACar?wsdl", array('soap_version'=>SOAP_1_2,
                                                                                     'trace'=>1,
                                                                                     'classmap' => array('Vehicle' => "Vehicle",
													 'Location' => "Location"
													 )
                                                                                     ));

										     
										     
										     

//*************
//** Parameterübergabe an eine Webservice-Methode per Array mit korrekten Bezeichnern der Parameter
//$result = $client->sayHello(array("name" =>"Mein Name Test"));
//echo $result->return;

//*************
//** Für Problembehebungen kann mit diesem Code der komplette Inhalt der SOAP-Antwort auf der Webseite
//** ausgegeben werden.
//echo "<br>LastResponse:".htmlentities($client->__getLastResponse())."<br>";
//echo "<br>LastRequest:".htmlentities($client->__getLastRequest())."<br>";

//*************
//** Folgende Codes können verwendet werden, um alle Funktionen des Webservices bzw. alle
//** Typen des Webservices auszugeben.
//echo "Functions: " . var_dump($client->__getFunctions())."<br>";
//echo "Types: " . var_dump($client->__getTypes());

//*************
//** Um den Inhalt einer SOAP-Antwort als Text auszugeben kann folgender Code verwendet werden
//echo "Inhalt: " .var_dump($soapReturnObject->return);

//*************
//** Beispiel für den Auftruf einer Webmethod und Ausgabe des Rückgabewertes
//$returnObj = $client->getVehicle();
//echo $resultObj->return;

//*************
//** Beispiel, um ein zurückgegebenen Array zu durchlaufen
//$returnObj = $client->getVehicle();
//foreach($returnObj->return as $item){
//    $v = new vehicle();
//    $v = $item;
//    echo "<br>".$v->model;
//    echo "<br>".$v->number;
//    echo "<br>".$v->other;
//}

?>