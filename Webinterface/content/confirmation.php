<?php
//load all passed get parameters passed from the site before
$vehicleId = $_REQUEST["vehicle_id"];
$startLocation = $_REQUEST["startLocation"];
$startDate = $_REQUEST["startDate"];
$returnDate = $_REQUEST["returnDate"];

$renting = $webservice->doReservation(array("vehicleId"=>$vehicleId, "customerId"=>$newOrExistingCustomer->id,
                                            "startDate"=>$startDate, "returnDate"=>$returnDate, "totalPrice"=>1111));

if($renting->return != null)
{
    echo "Vielen Dank für Ihre Reservierung!";
}
else
{
    echo "Bei Ihrer Reservierung ist ein Fehler aufgetreten!";
}

?>