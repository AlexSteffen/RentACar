<?php
//load all passed get parameters passed from the site before
include("parameter.php");

if($invalidParameters==true){
    //stop execution of this file
    return;
}

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