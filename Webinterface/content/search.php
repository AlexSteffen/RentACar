<?php
$startLocation = $_REQUEST["startLocation"];
$startDate = $_REQUEST["startDate"];
$startTime = $_REQUEST["startTime"];

$returnLocation = $_REQUEST["returnLocation"];
$returnDate = $_REQUEST["returnDate"];
$returnTime = $_REQUEST["returnTime"];

?>

<table class='carlist' cellpadding="10" cellspacing="0">
<tr>
    <td><img src="Bilder/auto1.jpg" width="100"></td>
    <td width="200">
        <span style="font-size: 14pt;">Audi A1</span><br><br>
        <span style="font-size: 11pt;">Standort: Osnabrück</span><br>
    </td>
    <td width="100">
        <span style="font-size: 9pt;">
        Türen: 4<br>	
        PS: 123<br>
        Farbe: rot
        </span>
    </td>
    <td width="200" align="right">
        <span style="font-size: 14pt;">
        <a href="#" style="font-size: 10pt;">Details anzeigen</a><br>
        <a href="#">Jetzt reservieren</a>
        <img src="Bilder/verfuegbar.png">
        </span>
    </td>
</tr>

<tr>
    <td><img src="Bilder/auto4.jpg" width="100"></td>
    <td width="200">
        <span style="font-size: 14pt;">Mini Cabrio</span><br><br>
        <span style="font-size: 11pt;">Standort: Bielefeld</span><br>
    </td>
    <td width="100">
        <span style="font-size: 9pt;">
        Türen: 3<br>	
        PS: 272<br>
        Farbe: gelb
        </span>
    </td>
    <td width="200" align="right">
        <span style="font-size: 14pt;">
        <a href="#" style="font-size: 10pt;">Details anzeigen</a><br>	
        <a href="#">Jetzt reservieren</a>
        <img src="Bilder/nicht_verfuegbar.png">
        </span>
    </td>
</tr>

<tr>
    <td><img src="Bilder/auto3.jpg" width="100"></td>
    <td width="200">
        <span style="font-size: 14pt;">Mercedes A-Klasse</span><br><br>
        <span style="font-size: 11pt;">Standort: Bielefeld</span><br>
    </td>
    <td width="100">
        <span style="font-size: 9pt;">
        Türen: 4<br>	
        PS: 250<br>
        Farbe: rot
        </span>
    </td>
    <td width="200" align="right">
        <span style="font-size: 14pt;">
        <a href="#" style="font-size: 10pt;">Details anzeigen</a><br>	
        <a href="#">Jetzt reservieren</a>
        <img src="Bilder/verfuegbar.png">
        </span>
    </td>
</tr>	
</table>