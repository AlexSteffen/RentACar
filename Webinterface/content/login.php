<?php
//*********************
// Author: G.Böselager
// Date: 24.8.2012
//
// Description:
// This is the customer-login-site with information about his rentings. The customer
// has the possibility to rate a vehicle.
//*********************

//check if the customer is logged in
if($logincustomer != NULL){
    
    //check if the customer is going to rate a vehcle
    if(isset($_REQUEST["rentingId"]) && isset($_REQUEST["ratingValue"])){
      
      $rentingId = $_REQUEST["rentingId"];
      $ratingValue = $_REQUEST["ratingValue"];
      
      //wrong paramter value
      if(!is_numeric($rentingId) || !is_numeric($ratingValue)) {
        $output .= "Fehler bei der Parameterübergabe.";
        exit;
        
      }else{
        
        //webservice call to do a rating
        $webservice->doRating(array("customerId"=>$logincustomer->id, "rentingId"=>$rentingId, "ratingValue"=>$ratingValue));
        $output .= "<span style='color:green'>Vielen Dank für Ihre Bewertung!</span><br><br>";
      }
    }
    
    $output .= "<h1>Willkommen im Loginbereich</h1>";
    
    $rentingsResult = $webservice->getRentingsByCustomerId(array("customerId" => $logincustomer->id));
    
    $output .= "Sie haben bisher ".count($rentingsResult->return)." Fahrzeuge gemietet.<br><br>";
    
    //If there is a return of only 1 record you have to convert the value into an array.
    //This is an fault of axis2
    if(count($rentingsResult->return) == 1){
        $rentingsResult->return = array($rentingsResult->return);
    }
    
    if(count($rentingsResult->return) > 0){

        $output .= "
            <table cellspacing=10>
            <tr>
            <td></td>
            <td><b>Mietbeginn</b></td><td><b>Mietende</b>
            <td><b>Fahrzeughersteller</b></td><td><b>Modell</b></td>
            <td><b>Gesamtbetrag</b></td><td><b>Bewertung</b></td>
            <tr>
        ";
        
        foreach($rentingsResult->return as $renting){
            $vehicle = new Vehicle;
            $vehcileResult = $webservice->getVehicleById(array("id" => $renting->vehicleId));
            $vehicle = $vehcileResult->return;
            
            $output .= "
            <tr>
            <td><img width='100px' id='pic' src='renderVehicleImage.php?id=".$vehicle->id."'></td>
            <td height='40'>".Converter::toGermanDateTimeString($renting->startDate)."</td><td>".Converter::toGermanDateTimeString($renting->returnDate)."
            <td>".$vehicle->manufacturer."</td><td>".$vehicle->model."</td>
            <td align='right'>".Converter::toDecimalString($renting->totalPrice,2)." €</td>
            <td>";
            
            if($renting->rating != 0){
                $output .= "
                Ihre Bewertung: ".$renting->rating;
            }else{
                $output .= "
                <a href='index.php?section=login&rentingId=".$renting->id."&ratingValue=1' title='Mit 1 bewerten'><img src='Bilder/star1.png' border='0'></a>
                <a href='index.php?section=login&rentingId=".$renting->id."&ratingValue=2' title='Mit 2 bewerten'><img src='Bilder/star2.png' border='0'></a>
                <a href='index.php?section=login&rentingId=".$renting->id."&ratingValue=3' title='Mit 3 bewerten'><img src='Bilder/star3.png' border='0'></a>
                <a href='index.php?section=login&rentingId=".$renting->id."&ratingValue=4' title='Mit 4 bewerten'><img src='Bilder/star4.png' border='0'></a>
                <a href='index.php?section=login&rentingId=".$renting->id."&ratingValue=5' title='Mit 5 bewerten'><img src='Bilder/star5.png' border='0'></a>
                ";
            }
            
            $output .= "   
            </td>
            <tr>
            ";
        }
        
        $output .= "</table>";
    }
    
}else{
    
    $output .= "<span style='font-size: 14pt;color:red;'>Fehler beim Login. Bitte prüfen Sie E-Mail-Adresse und Passwort</span>";
}
?>