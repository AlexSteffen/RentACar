<?php
//*********************
// Author: G.Böselager
// Date: 27.08.2012
//
// Description:
// This file contains code to register a new customer if he is going to reservate a vehicle.
//*********************

//load all passed get parameters passed from the site before
include("parameter.php");

if($invalidParameters==true){
    //stop execution of this file
    return;
}

//if the customer is not logged in check his inputs and do a registration
if($logincustomer == NULL){        
    //users information
    $newOrExistingCustomer = $_REQUEST["newOrExistingCustomer"];
    $loginEmail = $_REQUEST["login_email"];
    $loginPassword = $_REQUEST["login_password"];
    
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $salutation = $_REQUEST["salutation"];
    $lastname = $_REQUEST["lastname"];
    $forename = $_REQUEST["forename"];
    $street = $_REQUEST["street"];
    $city = $_REQUEST["city"];
    $zip = $_REQUEST["zip"];
    $phone = $_REQUEST["phone"];
    
    //if the login email isset the user is going to login with an existing customer account
    if($newOrExistingCustomer == "existingCustomer"){
        
        //if the login was not successful show an error message else show rental information for confirmation
        if(!CustomerLogin::login($loginEmail,$loginPassword)){
            $error.="<li>Login nicht möglich. E-Mail und/oder Passwort sind nicht korrekt.</li>";
            
        }else{
            //if a customer is logged in this method will return the object of the customer
            $logincustomer = CustomerLogin::getLoginCustomer();
            
        }
        
        //if some error occurs reload the registraton-site to allow userchanges
        if($error != ""){
            include_once('reservation.php');
            return;
        }
        
        
    }else{ //the user is going to register as a new customer
        
        //check if the email address is correct
        if (!Validation::isValidEmail($email)) {
            $error .= "<li>Die E-Mail-Adresse ist nicht korrekt.</li>";
        }
        
        //webservice call to check if there is already a customer with the email address    
        $result = $webservice->customerExists(array("email"=>$email));
        
        if($result==NULL) {
            $error .= "<li>Es existiert bereit ein Kunde mit der angegeben E-Mail-Adresse.</li>";
        }
        
        if($password=="") {
            $error .= "<li>Bitte geben Sie ein Passwort an.</li>";
        }
        
        if($lastname=="") {
            $error .= "<li>Bitte geben Sie Ihren Nachnamen an.</li>";
        }
        
        if($lastname=="") {
            $error .= "<li>Bitte geben Sie Ihren Nachnamen an.</li>";
        }
        
        if($forename=="") {
            $error .= "<li>Bitte geben Sie Ihren Vornamen an.</li>";
        }
        
        if($street=="") {
            $error .= "<li>Bitte geben Sie Ihre Straße an.</li>";
        }
        
        if($zip=="") {
            $error .= "<li>Bitte geben Sie Ihre PLZ an.</li>";
        }
        
        if($city=="") {
            $error .= "<li>Bitte geben Sie Ihre Stadt an.</li>";
        }
           
        //if some error occurs reload the registraton-site to allow userchanges
        if($error != ""){
            include_once('reservation.php');
            return;
        }
    
        //No error occurs. Webservice call to register the new customer.
        $registrationResult = $webservice->doRegistration(array("email"=>$email, "password"=>$password, "salutation"=>$salutation,
                                                        "forename"=>$forename, "lastname"=>$lastname, "street"=>$street,
                                                        "city"=>$city, "zip"=>$zip, "phone"=>$phone));
        
        $returnValue = $registrationResult->return;
    
        if($returnValue != True)
        {
            $output .= "Ein unerwarteter Fehler beim Registrieren des Kunden ist aufgetreten.";
            return;
        }else{            
            //if the login was not successful show an error message else show rental information for confirmation
            if(!CustomerLogin::login($email,$password)){
                $error.="<li>Login nicht möglich. E-Mail und/oder Passwort sind nicht korrekt.</li>";
                include_once('reservation.php');
                return;
            }else{
                //if a customer is logged in this method will return the object of the customer
                $logincustomer = CustomerLogin::getLoginCustomer();
                
            }
        }
    }
}//end of if($logincustomer==NULL)


//if the custoemr is logged in, show the vehicle data to confirm
if($logincustomer != NULL){
    
    //Webservice call to get the vehicle
    $vehicleResult = $webservice->getVehicleById(array("id"=>$vehicleId));
    
    $vehicle = new Vehicle;
    $vehicle = $vehicleResult->return;
    
    //Webservice call to get the location
    $locationResult = $webservice->getLocationById(array("id"=>$vehicle->locationId));
    $location = new Location;
    $location = $locationResult->return;
    
    //calculate the difference between the dates to get the total_price
    $rentalDays = Converter::dateDifferenceInDays($startDate, $returnDate);
    $sum = $vehicle->pricePerDay * $rentalDays;

    
    //show a confirmation to the user
    $output .= "<h1>Reservierung bestätigen</h1>";
    
    $output .= "<b>Guten Tag ".$logincustomer->salutation." ".$logincustomer->lastname.", </b><br>
    bitte prüfen Sie Ihre Auswahl und klicken Sie auf 'Jetzt reservieren' um das Fahrzeug zu reservieren.<br><br>";
    
    
    $output .= "
    <table>
    <tr><td valign='top'>Abholort:</td><td valign='top'><b>".$location->city."</b>
    <br>".$location->street.", ".$location->zip." ".$location->city."</td></tr>
    <tr><td>Mietbeginn:</td><td><b>".Converter::toGermanDateTimeString($startDate)."</b></td></tr>
    <tr><td>Mietende:</td><td><b>".Converter::toGermanDateTimeString($returnDate)."</b></td></tr>
    <tr><td>Miettage:</td><td><b>".$rentalDays."</b></td></tr>
    
    <tr><td>Kosten:</td><td><b>".Converter::toDecimalString($vehicle->pricePerDay)." € / Tag</b></td></tr>
    <tr><td>Gesamtbetrag:</td><td><b>".Converter::toDecimalString($sum)." €</b></td></tr>
    </table>
    <br><br>";

        
    $output .= "
    <table class='detail'>
    <tr>
        <td>
            <img width='300px' id='pic' src='renderVehicleImage.php?id=".$vehicle->id."'>
        </td>
        <td>
            <table class='detail'>
                <tr>
                    <td style='width: 150px'>
                        <b>Allgemeines:</b>
                    </td>
                    <td   style='width: 150px'></td>
                </tr>
                <tr>
                    <td>
                        Hersteller:
                    </td>
                    <td>
                        ".$vehicle->manufacturer."
                    </td>
                </tr>
                <tr>
                    <td>
                        Modell:
                    </td>
                    <td>
                        ".$vehicle->model."
                    </td>
                </tr>
                <tr>
                    <td>
                        Typ:
                    </td>
                    <td>
                        ".$vehicle->type."
                    </td>
                </tr>
                <tr>
                    <td>
                        Farbe:
                    </td>
                    <td>
                        ".$vehicle->color."
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                    <td></td>
                </tr>			
                <tr>
                    <td>
                        <b>Motorisierung:</b>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        Kraftstoff:
                    </td>
                    <td>
                        ".$vehicle->engineType."
                    </td>
                </tr>
                <tr>
                    <td>
                        PS:
                    </td>
                    <td>
                        ".$vehicle->engineHp." PS
                    </td>
                </tr>
                <tr>
                    <td>
                        Verbrauch:
                    </td>
                    <td>
                        ".Converter::toDecimalString($vehicle->engineConsum)." l/100km
                    </td>
                </tr>
                <tr>
                    <td>
                        Schaltung:
                    </td>
                    <td>
                        ".($vehicle->gear == 1 ? "Schaltgetriebe" : "Automatik")."
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                    <td></td>
                </tr>			
                <tr>
                    <td>
                        <b>Ausstattung:</b>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        Anzahl Türen:
                    </td>
                    <td>
                        ".$vehicle->doors."
                    </td>
                </tr>
                <tr>
                    <td>
                        Raucherfahrzeug:
                    </td>
                    <td>
                        ".($vehicle->smokers == 1 ? "Ja" : "Nein")."
                    </td>
                </tr>
                <tr>
                    <td>
                        Navigation:
                    </td>
                    <td>
                        ".($vehicle->navigationSystem == 1 ? "Ja" : "Nein")."
                    </td>
                </tr>
                <tr>
                    <td>
                        Sitze:
                    </td>
                    <td>
                        ".$vehicle->seats."
                    </td>
                </tr>
                <tr>
                    <td>
                        Klimaanlage:
                    </td>
                    <td>
                        ".($vehicle->climatic == 1 ? "Ja" : "Nein")."
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <form action='index.php?section=confirmation&$urlGetParams' method='post'>
                            <input type='submit' value='Jetzt reservieren' style='width:300px;font-size:22px;'>
                        </form>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </table>
    ";
}
?>