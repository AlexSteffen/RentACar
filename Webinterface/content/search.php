<?php

//load all passed values from the search-form
$startLocation = $_REQUEST["startLocation"];
$startDate = $_REQUEST["startDate"];
$startTime = $_REQUEST["startTime"];

$returnLocation = $_REQUEST["returnLocation"];
$returnDate = $_REQUEST["returnDate"];
$returnTime = $_REQUEST["returnTime"];

//convert the date and time to a DateTime string
$startDate = Converter::toDateTime($startDate, $startTime);
$returnDate = Converter::toDateTime($returnDate, $returnTime);

//users search parameters have to be passed to each site 
$urlGetParams = "startDate=".$startDate."&startLocation=".$startLocation."&returnDate=".$startDate."&returnLocation=".$returnLocation;

//webservice call to find all available vehicles
$ret = $webservice->findVehicles(array("startDate"=>$startDate,
                                       "startLocation"=>$startLocation,
                                       "returnDate"=>$returnDate,
                                       "returnLocation"=>$returnLocation
                                       ));

echo "<span style='font-size:12pt;'>Mietzeitraum von: <b>".
        Converter::toGermanDateTimeString($startDate) .
        "</b> bis <b>".
        Converter::toGermanDateTimeString($returnDate)."</b></span><br><br>";

//loop at all found vehicles and render HTML
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
                        <a href='index.php?section=details&vehicle_id=".$vehicle->id."&".$urlGetParams."' style='font-size: 10pt;'>Details anzeigen</a><br>
                        <a href='index.php?section=reservation&vehicle_id=".$vehicle->id."&".$urlGetParams."'>Jetzt reservieren</a>
                        </span>
                </div>
        </div>
        
        
        ";
  
}

?>