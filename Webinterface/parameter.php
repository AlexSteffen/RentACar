<?php
//*********************
// Author: G.Böselager
// Date: 27.08.2012
//
// Description:
// This file can be used to get all the passed parameters from the site before.
// Invalid paramters will cause an error message.
//*********************

//load all passed get parameters passed from the site before
$vehicleId = $_REQUEST["vehicle_id"];
$startLocation = $_REQUEST["startLocation"];
$startDate = $_REQUEST["startDate"];
$returnDate = $_REQUEST["returnDate"];

//check if the parameters are valid
if(!Validation::isValidDateTime($startDate) || !Validation::isValidDateTime($returnDate)){
    $output .= "Parameterübergabe ist fehlerhaft. Bitte führen Sie Ihre Suche erneut aus.";
    $invalidParameters=true;
}
else 
//check if the numeric parameters are valid
if(!is_numeric($startLocation) || (isset($vehicleId) && !is_numeric($vehicleId))){
    $output .= "Parameterübergabe ist fehlerhaft. StartLocation und VehicleId müssen Ganzzahlen sein. Bitte führen Sie Ihre Suche erneut aus.";
    $invalidParameters=true;
}
else
//check if the start date is greater equal the return date
if($startDate >= $returnDate){
    $output .= "Das Startdatum darf nicht größer oder gleich des Rückgabedatums sein.";
    $invalidParameters=true;
}

//users search parameters have to be passed to each site 
$urlGetParams = "startDate=".$startDate.
                "&startLocation=".$startLocation.
                "&returnDate=".$returnDate;

if(isset($vehicleId)){
    $urlGetParams .= "&vehicle_id=".$vehicleId;
}

?>