<?php

//load all passed get parameters passed from the site before
$vehicleId = $_REQUEST["vehicle_id"];

$startLocation = $_REQUEST["startLocation"];
$startDate = $_REQUEST["startDate"];

$returnLocation = $_REQUEST["returnLocation"];
$returnDate = $_REQUEST["returnDate"];

//users search parameters have to be passed to each site 
$urlGetParams = "startDate=".$startDate."&startLocation=".$startLocation.
                "&returnDate=".$returnDate."&returnLocation=".$returnLocation.
                "&vehicle_id=".$vehicleId;
                
                
//webservice call to get the customer
$result = $webservice->getCustomerById(array("id" => 1));
$cust = new Customer();
$cust = $result->return;

//webservice call to get the vehicle
$result = $webservice->getVehicleById(array("id" => $vehicleId));
$vehicle = new Vehicle();
$vehicle = $result->return;

echo $error;


echo "
<script type='text/javascript'>

function toggleForm(){
    if($('#formExistingCustomer').is(':visible')) {
        $('#formNewCustomer').show('slow');
        $('#formExistingCustomer').hide('slow');
    }else{
        $('#formNewCustomer').hide('slow');
        $('#formExistingCustomer').show('slow');
    }
}

$(document).ready(function(){

    $('#formExistingCustomer').hide();
    $('#existingCustomer').click();
    
});


</script>

<img width='300px' style='float:left;' src='renderVehicleImage.php?id=".$vehicleId."'>


<div style='float:left;margin-left:20px;'>

    <form action='index.php?section=registration&".$urlGetParams."' method=post>
    <input type='radio' name='newOrExistingCustomer' id='existingCustomer' onclick='toggleForm()'><label for='existingCustomer'>Ich bin bereits Kunde</label><br>
    <div id='formExistingCustomer'>
        <table>
        <tr>
            <td>E-Mail:</td>
            <td><input type='text' name='login_email' size='35'></td>
        </tr>
        <tr>
            <td>Passwort:</td>
            <td><input type='password' name='login_password' size='35'></td>
        </tr>
        </table>
    </div>
    
    <input type='radio' name='newOrExistingCustomer' id='newCustomer' onclick='toggleForm()'><label for='newCustomer'>Ich bin Neukunde</label><br>
    <div id='formNewCustomer'>
        <table>
        <tr>
            <td>E-Mail:</td>
            <td><input type='text' name='email' size='35'></td>
        </tr>
        <tr>
            <td>Passwort:</td>
            <td><input type='password' name='password' size='35'></td>
        </tr>
        <tr>
            <td>Anrede:</td>
            <td><input type='text' name='salutation' size='35'></td>
        </tr>
        <tr>
            <td>Nachname:</td>
            <td><input type='text' name='lastname' size='35'></td>
        </tr>
        <tr>
            <td>Vorname:</td>
            <td><input type='text' name='forename' size='35'></td>
        </tr>
        <tr>
            <td>Straße:</td>
            <td><input type='text' name='street' size='35'></td>
        </tr>
        <tr>
            <td>Wohnort:</td>
            <td><input type='text' name='city' size='35'></td>
        </tr>
        <tr>
            <td>PLZ:</td>
            <td><input type='text' name='zip' size='35'></td>
        </tr>
        <tr>
            <td>Telefon:</td>
            <td><input type='text' name='phone' size='35'></td>
        </tr>
        <tr>
            <td><br></td>
            <td></td>
        </tr>
    </table>
    </div>
    
    <input type='submit' name='register' value='Weiter >>'>
    </form>

</div>

";

$rentalDays = Converter::dateDifferenceInDays($startDate, $returnDate);
$sum = $vehicle->pricePerDay * $rentalDays;

echo "
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
";

?>

