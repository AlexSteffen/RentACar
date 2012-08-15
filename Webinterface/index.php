<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
    <title>RentACar Autovermietung</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link type="text/css" href="jquery-ui-1.8.21.custom/css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
        <link type="text/css" href="style.css" rel="stylesheet" />
        <script type="text/javascript" src="jquery-ui-1.8.21.custom/js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="jquery-ui-1.8.21.custom/js/jquery-ui-1.8.21.custom.min.js"></script>
        <script type="text/javascript" src="jquery-ui-1.8.21.custom/js/jquery-ui-timepicker-addon.js"></script>
        
        <script type="text/javascript">
            $(function(){
                // Datepicker
                $('#datepicker').datepicker({
                        inline: true
                });
                $('#datepicker2').datepicker({
                        inline: true
                });
                $('#timepicker').timepicker({});
                
                $('#timepicker2').timepicker({});
                
                $.datepicker.regional['de'] = {
                    clearText: 'löschen', clearStatus: 'aktuelles Datum löschen',
                    closeText: 'schließen', closeStatus: 'ohne Änderungen schließen',
                    prevText: '<zurück', prevStatus: 'letzten Monat zeigen',
                    nextText: 'Vor>', nextStatus: 'nächsten Monat zeigen',
                    currentText: 'heute', currentStatus: '',
                    monthNames: ['Januar','Februar','März','April','Mai','Juni',
                    'Juli','August','September','Oktober','November','Dezember'],
                    monthNamesShort: ['Jan','Feb','Mär','Apr','Mai','Jun',
                    'Jul','Aug','Sep','Okt','Nov','Dez'],
                    monthStatus: 'anderen Monat anzeigen', yearStatus: 'anderes Jahr anzeigen',
                    weekHeader: 'Wo', weekStatus: 'Woche des Monats',
                    dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
                    dayNamesShort: ['So','Mo','Di','Mi','Do','Fr','Sa'],
                    dayNamesMin: ['So','Mo','Di','Mi','Do','Fr','Sa'],
                    dayStatus: 'Setze DD als ersten Wochentag', dateStatus: 'Wähle D, M d',
                    dateFormat: 'dd.mm.yy', firstDay: 1, 
                    initStatus: 'Wähle ein Datum', isRTL: false
                };
                
                $.datepicker.setDefaults($.datepicker.regional['de']);
                
                
                
            });
	</script>
</head>
<body>
    <div id='head'><div id='logo'></div></div>
    <form action="post">
    <div class='box'>

        <table>
            <tr>
                <td colspan="2"><span class="hWhite">Abholung</span></td>
            </tr>
            <tr>
                <td>Ort wählen:</td>
                <td>
                    <select>
                    <option>Osnabrück</option>
                    <option>Bielefeld</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Datum:</td>
                <td>
                    <input type="text" id="datepicker">
                </td>
                <td>Uhrzeit:</td>
                <td>
                    <input type="text" id="timepicker">
                </td>
            </tr>
        </table>
    </div>
    
    <div class='box'>
        <table>
            <tr>
                <td colspan="2"><span class="hWhite">Rückgabe</span></td>
            </tr>
            <tr>
                <td>Ort wählen:</td>
                <td>
                    <select>
                    <option>Osnabrück</option>
                    <option>Bielefeld</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Datum:</td>
                <td>
                    <input type="text" id="datepicker2">
                </td>
                <td>Uhrzeit:</td>
                <td>
                    <input type="text" id="timepicker2">
                </td>
            </tr>
        </table>
    </div>
    
    
    <input type='image' src="Bilder/bg-start.png" name="btSend" id='btSend'>
    </form>
    
    <br><br>
    	<?php
	//** IMPORTANT!!
//** These configuration information for the Apache-Webserver is needed. If they are not set the WSDL document
//** will be cached for a long time and it cause unexpected errors.
ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0');

class vehicle{
    public $model;
    public $other;
    public $number;
}


//*************
//** Create a SoapClient-Object to determine the place of the WSDL file.
//** The first parameter requires the URI to the WSDL document. The second parameter is optional for
//** several options of the connection.
//** If you want to handle complex types from the webservice you have to set the option "classmap"
//** with a mapping of the internal classname to the extenal classname. e.g. 'classmap' => array('Vehicle' => "vehicle")
$client = new SoapClient("http://localhost:8080/axis2/services/RentACar?wsdl", array('soap_version'=>SOAP_1_2,
                                                                                     'trace'=>1,
                                                                                     'classmap' => array('Vehicle' => "vehicle")
                                                                                     ));


//*************
//** Parameterübergabe an eine Webservice-Methode per Array mit korrekten Bezeichnern der Parameter
//$result = $client->sayHello(array("name" =>"Mein Name Test"));
//echo $result->return;

//*************
//** Für Problembehebungen kann mit diesem Code der komplette Inhalt der SOAP-Antwort auf der Webseite
//** ausgegeben werden.
//echo "<br>LastResponse:".htmlentities($client->__getLastResponse())."<br>";
//echo "<br>LastRequest:".htmlentities($client->__getLastRequest())."<br>";

//*************
//** Folgende Codes können verwendet werden, um alle Funktionen des Webservices bzw. alle
//** Typen des Webservices auszugeben.
//echo "Functions: " . var_dump($client->__getFunctions())."<br>";
//echo "Types: " . var_dump($client->__getTypes());

//*************
//** Um den Inhalt einer SOAP-Antwort als Text auszugeben kann folgender Code verwendet werden
//echo "Inhalt: " .var_dump($soapReturnObject->return);

//*************
//** Beispiel für den Auftruf einer Webmethod und Ausgabe des Rückgabewertes
//$returnObj = $client->getVehicle();
//echo $resultObj->return;

//*************
//** Beispiel, um ein zurückgegebenen Array zu durchlaufen
//$returnObj = $client->getVehicle();
//foreach($returnObj->return as $item){
//    $v = new vehicle();
//    $v = $item;
//    echo "<br>".$v->model;
//    echo "<br>".$v->number;
//    echo "<br>".$v->other;
//}


$returnObj = $client->findVehicles(array("a" => "kmk"));

foreach($returnObj->return as $item){
    $v = new vehicle();
    $v = $item;
    echo "<br>".$v->model;
    echo "<br>".$v->number;
    echo "<br>".$v->other;
}

	?>
</body>
</html>
