<?php

include_once('main.php');

$email = $_REQUEST["email"];
$lastname = $_REQUEST["lastname"];
$forename = $_REQUEST["forename"];
$street = $_REQUEST["street"];
$city = $_REQUEST["city"];
$zip = $_REQUEST["zip"];
$phone = $_REQUEST["phone"];

$registrationDone = $webservice->register(array("email"=>$email, "forename"=>$forename, "lastname"=>$lastname,
                            "street"=>$street, "city"=>$city, "zip"=>$zip, "phone"=>$phone));


$returnValue = $registrationDone->return;


if($returnValue == True)
{
    echo "Registrierung erfolgreich!";
}
else
{
    echo "Fehler!!!";
}

?>