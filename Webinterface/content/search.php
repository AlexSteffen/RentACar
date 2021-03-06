<?php
//*********************
// Author: G.Boeselager
// Date: 18.08.2012
//
// Description:
// This file contains the code for viewing a list of vehicles after the user starts a search.
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
}

//load all passed get parameters passed from the site before
include("parameter.php");

if($invalidParameters==true){
    //stop execution of this file
    return;
}


//users search parameters have to be passed to each site 
$urlGetParams = "startDate=".$startDate."&startLocation=".$startLocation."&returnDate=".$returnDate;


//webservice call to find all available vehicles
$vehiclesResult = $webservice->findVehicles(array("startDate"=>$startDate,
                                       "startLocation"=>$startLocation,
                                       "returnDate"=>$returnDate                                       
                                       ));


$output .= "<h1>Verfügbare Fahrzeuge</h1>";

//if no available vehicles found show an error message else show a list of vehicles
if(count($vehiclesResult->return) == 0){
        
        $output .= "Keine verfügbaren Fahrzeuge gefunden. Bitte ändern Sie Ihre Suchparameter.";
        
}else{
        //If there is a return of only 1 record you have to convert the value into an array.
        //This is an fault of axis2
        if(count($vehiclesResult->return) == 1){
            $vehiclesResult->return = array($vehiclesResult->return);
        }
        
        //create the filter form
        $currentFilterManufacturer = $_REQUEST["filter_manufacturer"];
        
        //generate a link for removing filter
        if($currentFilterManufacturer != "")
                $filterRemove = "<a href='index.php?section=search&$urlGetParams'>Filter entfernen</a>";
                
        $output.="
        <div id='filter'>
        <span style='float:left;margin-top:10px;margin-left:5px;'>Mietzeitraum von: <b>".
        Converter::toGermanDateTimeString($startDate) .
        "</b> bis <b>".
        Converter::toGermanDateTimeString($returnDate)."</b></span>
        
        <form action='index.php?section=search&$urlGetParams' method='post' style='float:right;margin-top:8px;'>
        Filter nach Hersteller: 
        <select name='filter_manufacturer'>
        <option value=''>--kein Filter--</option>
        ";
        
        //loop at all found vehicles to create the filter
        $filterValues=array();
        foreach($vehiclesResult->return as $item){
                if(!in_array($item->manufacturer, $filterValues, true)){
                        $filterValues[count($filterValues)] = $item->manufacturer;
                        
                        //select the filtered vehicle in the drop-down list
                        if($currentFilterManufacturer == $item->manufacturer) $selection=" selected"; else  $selection="";
                        
                        $output.="<option value='".$item->manufacturer."' $selection>".$item->manufacturer."</option>";
                }
        }
        $output.="
        </select>
        <input type='submit' value='Filtern'>
        $filterRemove
        </form>
        </div>";
        
        //loop at all found vehicles and render HTML
        foreach($vehiclesResult->return as $item){
                
                //cast to an vehicle
                $vehicle = new Vehicle;
                $vehicle = $item;       
                
                //do not display the vehicle if it is not allowed by the filter
                if($currentFilterManufacturer != "" && $currentFilterManufacturer != $vehicle->manufacturer) continue;
        
                //webservicec call to get the location
                $location = new Location;
                $locationResult = $webservice->getLocationById(array("id"=>$vehicle->locationId));
                $location = $locationResult->return;
                
                //webservicec call to get the rating
                $ratingResult = $webservice->getRating(array("vehicleId"=>$vehicle->id));
                $ratingValue = $ratingResult->return;
                $ratingValue = round($ratingValue,0);
                
                $stars="";
                //generate the rating stars                
                for($i=1; $i <= 5; $i++){
                      
                      //decide if there has to be a gray or yellow star
                      if($i > $ratingValue) $gray = "_gray";
                      else $gray = "";
                      
                      $stars.="<img src='Bilder/star".$gray.".png'>";
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