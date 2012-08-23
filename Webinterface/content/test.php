<?php

include_once('main.php');




$webservice->doRating(array("rentingId"=>1, "ratingValue"=>5));
$webservice->doRating(array("rentingId"=>2, "ratingValue"=>4));
$webservice->doRating(array("rentingId"=>3, "ratingValue"=>3));


$rating = $webservice->getRating(array("vehicle_id"=>1));

echo var_dump($rating->return);

$rentings = $webservice->getRentingsByCustomerId(array("customerId"=>1));

echo var_dump($rentings->return);

?>