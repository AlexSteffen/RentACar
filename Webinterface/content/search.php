<?php
//*********************
// Author: G.Böselager
// Date: 18.08.2012
//
// Description:
// This file contains the code for viewing a list of cars after the user starts a search.
//*********************

//load all passed values from the search-form
$startLocation = $_REQUEST["startLocation"];

//check if the page is loaded in context of a search query
if(isset($_REQUEST["startSearchDate"])){
        
        $startDate = $_REQUEST["startSearchDate"];
        $startTime = $_REQUEST["startSearchTime"];
        $returnDate = $_REQUEST["returnSearchDate"];
        $returnTime = $_REQUEST["returnSearchTime"];
        
        //convert the date and time to a DateTime string
        $startDate = Converter::toDateTime($startDate, $startTime);
        $returnDate = Converter::toDateTime($returnDate, $returnTime);
}else{
        //load all passed get parameters passed from the site before
        include("parameter.php");
        
        if($invalidParameters==true){
            //stop execution of this file
            return;
        }
}

//users search parameters have to be passed to each site 
$urlGetParams = "startDate=".$startDate."&startLocation=".$startLocation."&returnDate=".$returnDate;


//webservice call to find all available vehicles
$vehiclesResult = $webservice->findVehicles(array("startDate"=>$startDate,
                                       "startLocation"=>$startLocation,
                                       "returnDate"=>$returnDate                                       
                                       ));


$output .= "<h1>Verfügbare Fahrzeuge</h1>";
$output .= "<span style='font-size:12pt;'>Mietzeitraum von: <b>".
        Converter::toGermanDateTimeString($startDate) .
        "</b> bis <b>".
        Converter::toGermanDateTimeString($returnDate)."</b></span><br><br>";

if(count($vehiclesResult->return) == 0){
        
        $output .= "Keine verfügbaren Autos gefunden. Bitte ändern Sie Ihre Suchparameter.";
        
}else{
        //loop at all found vehicles and render HTML
        foreach($vehiclesResult->return as $item){
                
          $vehicle = new Vehicle;
          $vehicle = $item;
          
          //webservicec call to get the location
          $location = new Location;
          $locationResult = $webservice->getLocationById(array("id"=>$vehicle->locationId));
          $location = $locationResult->return;
          
          //webservicec call to get the rating
          $ratingResult = $webservice->getRating(array("vehicleId"=>$vehicle->id));
          $ratingValue = $ratingResult->return;
          $ratingValue = round($ratingValue,0);
          
          //generate the rating stars
          $i=1;
          $stars="";
          
          while($i <= 5){
                
                //decide if there has to be a gray or yellow star
                if($i > $ratingValue) $gray = "_gray";
                else $gray = "";
                
                $stars.="<img src='Bilder/star".$gray.".png'>";
                $i++;
          }
          
          $output .= "
                <div id='cardetails'>
                        <div id='picture'>
                                <img width='200' src='renderVehicleImage.php?id=".$vehicle->id."'>
                        </div>
                        
                        <div id='left'>
                                <span style='font-size: 14pt;'>".$vehicle->manufacturer." ".$vehicle->model."</span><br><br>
                                ".$stars."<br><br>
                                <span style='font-size: 11pt;'>Standort: ".$location->city."</span><br>
                                
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
}

?>