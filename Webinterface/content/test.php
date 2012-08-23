<?php

include_once('main.php');

$user = $webservice->checkLogin(array("email"=>"a.steffen@me.com",
                              "password"=>"test"));

var_dump($user->return);


$reservation = $webservice->doReservation(array("vehicleId"=>1,"customerId"=>1, "startDate"=>"2012-08-12 13:00:00","returnDate"=>"2012-08-15 13:00:00", "totalPrice"=>345));

echo var_dump($reservation->return);
?>