<?php

include_once("main.php");

$result = $webservice->getCustomerById(array("id" => 1));

$cust = new Customer();
$cust = $result->return;
// echo var_dump($cust);
echo $cust->lastname;



?>

<table class='detail'>
<tr>
    <td>
        <img src='Bilder\Audi_A1.jpg' id='pic' title='Picture' width='300px'>
        <br><br>
        <div id='reservation_information' style='border: 1px solid black'>
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
                    <td>7 Tage</td>
                </tr>
                <tr>
                    <td>Preis/Tag:</td>
                    <td>39 €</td>
                </tr>
                <tr>
                    <td colspan='2'><hr></td>
                </tr>
                <tr>
                    <td><b>Ihr Gesamtbetrag</b>:</td>
                    <td>273 €</td>
                </tr>
            </table>
        </div>
    </td>
    <td>
        <form action='http://localhost/RentACar/index.php?section=registration' method='post' id='reservation'>
            <table class='detail'>
                <tr>
                    <td style='width: 200'><b>Reservierung</b></td>
                    <td style='width: 200'></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td></td>
                </tr>
                <tr>
                    <td>E-Mail:</td>
                    <td><input type='text' name='email' size='35'></td>
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
                <tr>
                    <td></td>
                    <td align='right'><input type='submit' name='register' value='Jetzt buchen!'></td>
                </tr>
            </table>
        </form>
    </td>
</tr>
</table>