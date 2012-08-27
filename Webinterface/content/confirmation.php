<?php
//load all passed get parameters passed from the site before
$vehicleId = $_REQUEST["vehicle_id"];
$startLocation = $_REQUEST["startLocation"];
$startDate = $_REQUEST["startDate"];
$returnDate = $_REQUEST["returnDate"];

$renting = $webservice->doReservation(array("vehicleId"=>$vehicleId, "customerId"=>$logincustomer->id,
                                            "startDate"=>$startDate, "returnDate"=>$returnDate, "totalPrice"=>1111.34));


echo var_dump($renting->return->id);


if($renting->return != null)
{
    $output .= "Vielen Dank für Ihre Reservierung!";
}
else
{
    $output .= "Bei Ihrer Reservierung ist ein Fehler aufgetreten!";
}

?>