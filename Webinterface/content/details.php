<?php
//load all passed get parameters passed from the site before
$vehicleId = $_REQUEST["vehicle_id"];
$startLocation = $_REQUEST["startLocation"];
$startDate = $_REQUEST["startDate"];
$returnDate = $_REQUEST["returnDate"];


echo Converter::checkDateTime($startDate);

//users search parameters have to be passed to each site 
$urlGetParams = "startDate=".$startDate."&startLocation=".$startLocation.
                "&returnDate=".$returnDate."&vehicle_id=".$vehicleId;

//webservice call to read the requested vehicle
$vehicle = new Vehicle;
$returnObj = $webservice->getVehicleById(array("id" => $vehicleId));
$vehicle = $returnObj->return;

echo "<span style='font-size:12pt;'>Mietzeitraum von: <b>".
        Converter::toGermanDateTimeString($startDate) .
        "</b> bis <b>".
        Converter::toGermanDateTimeString($returnDate)."</b></span><br><br>";

        
echo "
<span style='font-size: 14pt;'>
<a href='index.php?section=reservation&vehicle_id=".$vehicle->id."&".$urlGetParams."'>Jetzt reservieren</a>
</span>

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
        </table>
    </td>
</tr>
</table>
";
?>