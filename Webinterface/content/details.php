<?php
include_once('main.php');
$location = new Location;
$returnObj = $webservice->getLocationById(array("id" => 1));
$location = $returnObj->return;

echo $location->city;
?>

<table class='detail'>
<tr>
    <td>
        <img src='Bilder\Audi_A1.jpg' id='pic' title='Picture' width='300px'>
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
                    Audi
                </td>
            </tr>
            <tr>
                <td>
                    Modell:
                </td>
                <td>
                    A1
                </td>
            </tr>
            <tr>
                <td>
                    Typ:
                </td>
                <td>
                    Coupé
                </td>
            </tr>
            <tr>
                <td>
                    Farbe:
                </td>
                <td>
                    Weiß
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
                    Diesel
                </td>
            </tr>
            <tr>
                <td>
                    PS:
                </td>
                <td>
                    160 PS
                </td>
            </tr>
            <tr>
                <td>
                    kW:
                </td>
                <td>
                    119 kW
                </td>
            </tr>
            <tr>
                <td>
                    Verbrauch:
                </td>
                <td>
                    5,5 l/100km
                </td>
            </tr>
            <tr>
                <td>
                    Schaltung:
                </td>
                <td>
                    Automatik
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
                    5
                </td>
            </tr>
            <tr>
                <td>
                    Raucherfahrzeug:
                </td>
                <td>
                    Ja
                </td>
            </tr>
            <tr>
                <td>
                    Navigation:
                </td>
                <td>
                    Ja
                </td>
            </tr>
            <tr>
                <td>
                    Sitze:
                </td>
                <td>
                    Leder
                </td>
            </tr>
            <tr>
                <td>
                    Klimaanlage:
                </td>
                <td>
                    Ja
                </td>
            </tr>
            <tr>
                <td><br></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <b>Reservierung:</b>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Verfügbarkeit:</td>
                <td>Nein</td>
            </tr>
            <tr>
                <td>
                    Preis:
                </td>
                <td>
                    39 € / Tag
                </td>
            </tr>
            <tr>
                <td><br><br></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                    <input type='button' id='order' value='Hier geht´s zur Reservierung'>
                </td>
            </tr>
            
            
        </table>
    </td>
</tr>
</table>