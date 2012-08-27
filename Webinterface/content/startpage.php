<?php
//*********************
// Author: G.Böselager
// Date: 16.08.2012
//
// Description:
// This file contains the code for the startpage with the form to search for vehicles.
//*********************

//******** read all locations from the webservice **********
$returnObj = $webservice->getAllLocations();
$locations = array();

// check if there are some records in the result
if(isset($returnObj->return)){
    
    // loop at all records and store them in an array for better handling
    foreach($returnObj->return as $item){
        $location = new Location();
        $location = $item;
        
        $locations[] = $location;
    }
}


$currentDate = date("d.m.Y");
$currentTime = date("H:i");
$tomorrowDate =  date("d.m.Y", strtotime("+1 days"));

$output .= "
<script type='text/javascript'>
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
</script>";


foreach($locations as $l){
        $locationOptions .= "<option value='".$l->id."'>".$l->city."</option>";
}

$output .= "
<form action='index.php' method='get'>
<input type='hidden' name='section' value='search'>

<div class='box'>

    <table>
        <tr>
            <td colspan='2'><span class='hWhite'>Abholung</span></td>
        </tr>
        <tr>
            <td>Ort wählen:</td>
            <td>
                <select class='locationPicker' name='startLocation'>
                $locationOptions
                </select>
            </td>
        </tr>
        <tr>
            <td>Datum:</td>
            <td>
                <input type='text' id='datepicker' name='startSearchDate' class='large' style='width:140px;' value='$currentDate'>
            </td>
            <td>Uhrzeit:</td>
            <td>
                <input type='text' id='timepicker' name='startSearchTime' class='large' style='width:100px;' value='$currentTime'>
            </td>
        </tr>
    </table>
</div>

<div class='box'>
    <table>
        <tr>
            <td colspan='2'><span class='hWhite'>Rückgabe</span></td>
        </tr>
        <tr>
            <td><br><br></td>
            <td>
            </td>
        </tr>
        <tr>
            <td>Datum:</td>
            <td>
                <input type='text' id='datepicker2' name='returnSearchDate' class='large' style='width:140px;' value='$tomorrowDate'>
            </td>
            <td>Uhrzeit:</td>
            <td>
                <input type='text' id='timepicker2' name='returnSearchTime' class='large' style='width:100px;' value='$currentTime'>
            </td>
        </tr>
    </table>
</div>


<input type='image' src='Bilder/bg-start.png' name='btSend' id='btSend'>

</form>
";

?>