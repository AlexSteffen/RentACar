<?php

//load all passed values from the search-form
$startLocation = $_REQUEST["startLocation"];
$startDate = $_REQUEST["startDate"];
$startTime = $_REQUEST["startTime"];

$returnLocation = $_REQUEST["returnLocation"];
$returnDate = $_REQUEST["returnDate"];
$returnTime = $_REQUEST["returnTime"];

//convert the date and time to a DateTime string
$startDateTime = Converter::toDateTime($startDate, $startTime);
$returnDateTime = Converter::toDateTime($returnDate, $returnTime);

$ret = $webservice->findVehicles(array("startDate"=>$startDateTime,
                                       "startLocation"=>$startLocation,
                                       "returnDate"=>$returnDateTime,
                                       "returnLocation"=>$returnLocation
                                       ));


foreach($ret->return as $item){
  $vehicle = new Vehicle;
  $vehicle = $item;
  
  echo "
        <div id='cardetails'>
                <div id='picture'>
                        <img width='200' src='renderVehicleImage.php?id=".$vehicle->id."'>
                </div>
                
                <div id='left'>
                        <span style='font-size: 14pt;'>".$vehicle->manufacturer." ".$vehicle->model."</span><br><br>
                        <span style='font-size: 11pt;'>Standort: Osnabrück</span><br>
                </div>
                
                <div id='center'>
                        <table id='detailInfos'>
                        <tr><td>Farbe:</td><td>".$vehicle->color."</td></tr>
                        <tr><td>Türen:</td><td>".$vehicle->doors."</td></tr>
                        <tr><td>PS:</td><td>".$vehicle->engineHp."</td></tr>
                        <tr><td>Hubraum:</td><td>".Converter::toDecimalString($vehicle->engineSize, 1)."</td></tr>
                        <tr><td>Verbrauch:</td><td>".Converter::toDecimalString($vehicle->engineConsum, 1)." Liter / 100 km</td></tr>
                        </table>
                </div>
                <div id='right'>
                        <span style='font-size: 14pt;'>
                        nur <b>".Converter::toDecimalString($vehicle->pricePerDay, 2)." €</b> pro Tag<br>
                        <img src='Bilder/verfuegbar.png'><br>
                        <a href='index.php?section=details&vehicle_id=".$vehicle->id."' style='font-size: 10pt;'>Details anzeigen</a><br>
                        <a href='index.php?section=reservation&vehicle_id=".$vehicle->id."'>Jetzt reservieren</a>
                        </span>
                </div>
        </div>
        
        
        ";
  
}

?>