<?php
//*********************
// Author: G.Böselager
// Date: 20.08.2012
//
// Description:
// This file contains the code for viewing the user an interface to reservate a vehicle. The user can do a
// registration as a new or as an existing customer.
//*********************

//load all passed get parameters passed from the site before
$vehicleId = $_REQUEST["vehicle_id"];
$startLocation = $_REQUEST["startLocation"];
$startDate = $_REQUEST["startDate"];
$returnDate = $_REQUEST["returnDate"];

//users search parameters have to be passed to each site 
$urlGetParams = "startDate=".$startDate."&startLocation=".$startLocation.
                "&returnDate=".$returnDate."&vehicle_id=".$vehicleId;
                
                
//webservice call to get the customer
$result = $webservice->getCustomerById(array("id" => 1));
$cust = new Customer();
$cust = $result->return;

//webservice call to get the vehicle
$result = $webservice->getVehicleById(array("id" => $vehicleId));
$vehicle = new Vehicle();
$vehicle = $result->return;

//calculate the difference between the dates to get the total_price
$rentalDays = Converter::dateDifferenceInDays($startDate, $returnDate);
$sum = $vehicle->pricePerDay * $rentalDays;

$output .= "
<script type='text/javascript'>

function showNewCustomer(){
    $('#formNewCustomer').show('fast');
    $('#formExistingCustomer').hide('fast');
}

function showExistingCustomer(){
    $('#formNewCustomer').hide('fast');
    $('#formExistingCustomer').show('fast');
}

function toggleForm(){
    if($('#formExistingCustomer').is(':visible')) {
        $('#formNewCustomer').show('fast');
        $('#formExistingCustomer').hide('fast');
    }else{
        $('#formNewCustomer').hide('fast');
        $('#formExistingCustomer').show('fast');
    }
}

$(document).ready(function(){
    
    if('".$newOrExistingCustomer."' == 'existingCustomer'){
    
        $('#formExistingCustomer').show();
        $('#existingCustomer').click();

    }else{
        $('#formNewCustomer').show();
        $('#newCustomer').click();
    }
    
});


</script>";

if($error != ""){
    $errorOutput .= "<div id='error_box'>Es sind Fehler aufgetreten:<br><ul>$error</ul></div>";
}


$output .= "
<div style='float:left;margin-left:20px;width:300px;'>
    <img width='300px' style='float:left;' src='renderVehicleImage.php?id=".$vehicleId."'>
    
    <div id='reservation_information'>
    <table class='detail'>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style='width: 170px'><b>Ihr Tarif:</b></td>
            <td style='width: 100px'></td>
        </tr>
        <tr>
            <td>Buchungsdauer:</td>
            <td>".$rentalDays." Tag(e)</td>
        </tr>
        <tr>
            <td>Preis/Tag:</td>
            <td>".Converter::toDecimalString($vehicle->pricePerDay)." € / Tag</td>
        </tr>
        <tr>
            <td colspan='2'><hr></td>
        </tr>
        <tr>
            <td><b>Ihr Gesamtbetrag</b>:</td>
            <td>".Converter::toDecimalString($sum)." €</td>
        </tr>
    </table>
    </div>

</div>


<div style='float:left;margin-left:20px;'>
    <form action='index.php?section=registration&".$urlGetParams."' method=post>
";

    if($logincustomer != NULL){
        $output .= "Sie sind bereits eingeloggt und können mit der Reservierung fortfahren.";
        
    }else{
        $output .= "    
        $errorOutput
    
        
        <input type='radio' name='newOrExistingCustomer' value='existingCustomer' id='existingCustomer' onclick='showExistingCustomer()'><label for='existingCustomer'>Ich bin bereits Kunde</label><br>
        <div id='formExistingCustomer'>
            <table cellspacing='0' cellpadding='0'>
            <tr>
                <td width='100'>E-Mail:</td>
                <td><input type='text' name='login_email' size='35' value='".$loginEmail."' class='registration'></td>
            </tr>
            <tr>
                <td>Passwort:</td>
                <td><input type='password' name='login_password' size='35' value='".$loginPassword."' class='registration'></td>
            </tr>
            <tr>
                <td><br></td>
                <td></td>
            </tr>
            </table>
        </div>
        
        <br>
        <input type='radio' name='newOrExistingCustomer' value='newCustomer' id='newCustomer' onclick='showNewCustomer()'><label for='newCustomer'>Ich bin Neukunde</label><br>
        <div id='formNewCustomer'>
            <table cellspacing='0' cellpadding='0'>
            <tr>
                <td width='100'>E-Mail:</td>
                <td><input type='text' name='email' size='35' value='".$email."' class='registration'></td>
            </tr>
            <tr>
                <td>Passwort:</td>
                <td><input type='password' name='password' size='35' value='".$password."' class='registration'></td>
            </tr>
            <tr>
                <td><br></td>
                <td></td>
            </tr>
            <tr>
                <td>Anrede:</td>
                <td>
                <select name='salutation' class='registration'>
                <option value='Herr' ".($salutation=="Herr"?"selected":"").">Herr</option>
                <option value='Frau' ".($salutation=="Frau"?"selected":"").">Frau</option>
                <option value='Firma' ".($salutation=="Firma"?"selected":"").">Firma</option>
                </select>
                </td>
            </tr>
            <tr>
                <td>Nachname:</td>
                <td><input type='text' name='lastname' size='35' value='".$lastname."' class='registration'></td>
            </tr>
            <tr>
                <td>Vorname:</td>
                <td><input type='text' name='forename' size='35' value='".$forename."' class='registration'></td>
            </tr>
            <tr>
                <td>Straße:</td>
                <td><input type='text' name='street' size='35' value='".$street."' class='registration'></td>
            </tr>
            <tr>
                <td>PLZ:</td>
                <td><input type='text' name='zip' size='35' value='".$zip."' class='registration'></td>
            </tr>
            <tr>
                <td>Wohnort:</td>
                <td><input type='text' name='city' size='35' value='".$city."' class='registration'></td>
            </tr>
            <tr>
                <td>Telefon:</td>
                <td><input type='text' name='phone' size='35' value='".$phone."' class='registration'></td>
            </tr>
            <tr>
                <td><br></td>
                <td></td>
            </tr>
            
        </table>
        </div>
        
        ";
    }
    
$output .= "
    <br>
    <input type='submit' name='register' style='width:300px;font-size:22px;' value='Weiter >>'>
    </form>
</div>
";


?>

