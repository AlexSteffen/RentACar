<?php
//*********************
// Author: G.Boeselager
// Date: 20.08.2012
//
// Description:
// This file contains the code for viewing the user an interface to reservate a vehicle. The user can do a
// registration as a new or as an existing customer.
//*********************

//load all passed get parameters passed from the site before
include("parameter.php");

if($invalidParameters==true){
    //stop execution of this file
    return;
}


//webservice call to get the vehicle
$result = $webservice->getVehicleById(array("id" => $vehicleId));
$vehicle = new Vehicle();
$vehicle = $result->return;

//JavaScripts to show or hide the forms for new customers or existing customers
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

$output .= "<h1>Registrierung</h1>";

if($error != ""){
    $errorOutput .= "<div id='error_box'>Es sind Fehler aufgetreten:<br><ul>$error</ul></div>";
}


$output .= "
<div style='float:left;width:300px;'>
    <img width='300px' style='float:left;' src='renderVehicleImage.php?id=".$vehicleId."'>
</div>

<div style='float:left;margin-left:20px;border:1px solid gray; width:360px;'>
    <div style='float:left;margin:10px;width:340px;'>
    $errorOutput
    
    <form action='index.php?section=registration&".$urlGetParams."' method=post>
";

    if($logincustomer != NULL){
        $output .= "Sie sind bereits eingeloggt und können mit der Reservierung fortfahren.";
        
    }else{
        $output .= "    
        <input type='radio' name='newOrExistingCustomer' value='existingCustomer' id='existingCustomer' onclick='showExistingCustomer()'>
        <label for='existingCustomer'><b>Ich bin bereits Kunde</b></label><br>
        <div id='formExistingCustomer' style='margin-left:22px;'>
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
        <input type='radio' name='newOrExistingCustomer' value='newCustomer' id='newCustomer' onclick='showNewCustomer()'>
        <label for='newCustomer'><b>Ich bin Neukunde</b></label><br>
        
        <div id='formNewCustomer' style='margin-left:22px;'>
            <table cellspacing='0' cellpadding='0'>
            <tr>
                <td width='100'>E-Mail: (*)</td>
                <td><input type='text' name='email' size='35' value='".$email."' class='registration'></td>
            </tr>
            <tr>
                <td>Passwort: (*)</td>
                <td><input type='password' name='password' size='35' value='".$password."' class='registration'></td>
            </tr>
            <tr>
                <td><br></td>
                <td></td>
            </tr>
            <tr>
                <td>Anrede: (*)</td>
                <td>
                <select name='salutation' class='registration'>
                <option value='Herr' ".($salutation=="Herr"?"selected":"").">Herr</option>
                <option value='Frau' ".($salutation=="Frau"?"selected":"").">Frau</option>
                <option value='Firma' ".($salutation=="Firma"?"selected":"").">Firma</option>
                </select>
                </td>
            </tr>
            <tr>
                <td>Nachname: (*)</td>
                <td><input type='text' name='lastname' size='35' value='".$lastname."' class='registration'></td>
            </tr>
            <tr>
                <td>Vorname: (*)</td>
                <td><input type='text' name='forename' size='35' value='".$forename."' class='registration'></td>
            </tr>
            <tr>
                <td>Straße: (*)</td>
                <td><input type='text' name='street' size='35' value='".$street."' class='registration'></td>
            </tr>
            <tr>
                <td>PLZ: (*)</td>
                <td><input type='text' name='zip' size='35' value='".$zip."' class='registration'></td>
            </tr>
            <tr>
                <td>Wohnort: (*)</td>
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
    <input type='submit' name='register' style='width:330px;font-size:22px;' value='Weiter >>'>
    </form>
    </div>
</div>
";


?>

