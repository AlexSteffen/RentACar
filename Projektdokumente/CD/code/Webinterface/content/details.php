<?php
//*********************
// Author: G.Boeselager
// Date: 17.08.2012
//
// Description:
// This file contains code to view a detail page for a vehicle.
//*********************

//load all passed get parameters passed from the site before
include("parameter.php");

if($invalidParameters==true){
    //stop execution of this file
    return;
}

//webservice call to read the requested vehicle
$vehicle = new Vehicle;
$returnObj = $webservice->getVehicleById(array("id" => $vehicleId));
$vehicle = $returnObj->return;

$output .= "<span style='font-size:12pt;'>Mietzeitraum von: <b>".
        Converter::toGermanDateTimeString($startDate) .
        "</b> bis <b>".
        Converter::toGermanDateTimeString($returnDate)."</b></span><br><br>";

        
$output .= "

<table class='detail'>
<tr>
    <td style='width:330px;'>
        <img width='300px' id='pic' src='renderVehicleImage.php?id=".$vehicle->id."'>
    </td>
    <td align='left'>
        <div style='float:left;border:1px solid gray; width:400px;'>
        <table>
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
                    ".Converter::toDecimalString($vehicle->pricePerDay)." € / Tag
                </td>
            </tr>
            <tr>
                <td colspan='2' align='center'>
                <br><br>
                    <a style='font-size: 14pt;' href='index.php?section=reservation&vehicle_id=".$vehicle->id."&".$urlGetParams."'>Dieses Fahrzeug jetzt reservieren >> </a>
                </td>
            </tr>            
        </table>
        </div>
    </td>
</tr>
</table>
";
?>