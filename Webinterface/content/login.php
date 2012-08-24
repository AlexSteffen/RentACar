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
        echo "Fehler bei der Parameterübergabe.";
        exit;
        
      }else{
        
        //webservice call to do a rating
        $webservice->doRating(array("customerId"=>$logincustomer->id, "rentingId"=>$rentingId, "ratingValue"=>$ratingValue));
        echo "<span style='color:green'>Vielen Dank für Ihre Bewertung!</span><br><br>";
      }
    }
    
    echo "<h1>Willkommen im Loginbereich</h1>";
    
    $rentingsResult = $webservice->getRentingsByCustomerId(array("customerId" => $logincustomer->id));
    
    echo "Sie haben ".count($rentingsResult->return)." Fahrzeuge gemietet, die Sie noch nicht bewertet haben:<br><br>";
    
    echo "
        <table cellspacing=10>
        <tr>
        <td><b>Mietbeginn</b></td><td><b>Mietende</b>
        <td><b>Fahrzeughersteller</b></td><td><b>Modell</b></td>
        <td><b>Bewertung</b></td>
        <tr>
    ";
    
    foreach($rentingsResult->return as $renting){
        $vehicle = new Vehicle;
        $vehcileResult = $webservice->getVehicleById(array("id" => $renting->vehicleId));
        $vehicle = $vehcileResult->return;
        
        echo "
        <tr>
        <td height='40'>".$renting->startDate."</td><td>".$renting->returnDate."
        <td>".$vehicle->manufacturer."</td><td>".$vehicle->model."</td>
        <td>";
        
        if($renting->rating != 0){
            echo "
            Ihre Bewertung: ".$renting->rating;
        }else{
            echo "
            <a href='index.php?section=login&rentingId=".$renting->id."&ratingValue=1' title='Mit 1 bewerten'><img src='Bilder/star1.png' border='0'></a>
            <a href='index.php?section=login&rentingId=".$renting->id."&ratingValue=2' title='Mit 2 bewerten'><img src='Bilder/star2.png' border='0'></a>
            <a href='index.php?section=login&rentingId=".$renting->id."&ratingValue=3' title='Mit 3 bewerten'><img src='Bilder/star3.png' border='0'></a>
            <a href='index.php?section=login&rentingId=".$renting->id."&ratingValue=4' title='Mit 4 bewerten'><img src='Bilder/star4.png' border='0'></a>
            <a href='index.php?section=login&rentingId=".$renting->id."&ratingValue=5' title='Mit 5 bewerten'><img src='Bilder/star5.png' border='0'></a>
            ";
        }
        
        echo "   
        </td>
        <tr>
        ";
    }
    echo "</table>";
    
}else{
    
    echo "<span style='font-size: 14pt;color:red;'>Fehler beim Login. Bitte prüfen Sie E-Mail-Adresse und Passwort</span>";
}
?>