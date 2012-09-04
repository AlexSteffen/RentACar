<?php
//*********************
// Author: G.Böselager
// Date: 27.08.2012
//
// Description:
// This file contains code to do a reservation and show a confirmation for the user.
//*********************

//load all passed get parameters passed from the site before
include("parameter.php");


if($invalidParameters==true){
    //stop execution of this file
    return;
}

//webservice call to get the vehicle
$result = $webservice->getVehicleById(array("id" => $vehicleId));
$vehicle = new Vehicle();
$vehicle = $result->return;

//calculate the difference between the dates to get the total_price
$rentalDays = Converter::dateDifferenceInDays($startDate, $returnDate);
$sum = round($vehicle->pricePerDay * $rentalDays, 2);

//webservice call to excecute the reservation
$renting = $webservice->doReservation(array("vehicleId"=>$vehicleId, "customerId"=>$logincustomer->id,
                                            "startDate"=>$startDate, "returnDate"=>$returnDate, "totalPrice"=>$sum));


if($renting->return != null)
{
    $output .= "Vielen Dank für Ihre Reservierung!";
}
else
{
    $output .= "Bei Ihrer Reservierung ist ein Fehler aufgetreten! Möglicherweise haben Sie die Seite nach der Reservierung aktualisiert.
    In dem Fall wurde die Reservierung erflgreich abgeschlossen.";
}

?>