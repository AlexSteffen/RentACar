<?php
class Converter{
    
    //*********
    // Converts a german date and time (e.g. 01.12.2012 and 13:20) to a
    // default DateTime format like "2012-12-01 13:20:00"
    //*********
    public static function toDateTime($germanDate, $germanTime) {
        list($day, $month, $year) = explode('.', $germanDate);
        
        $datetime = $year."-".$month."-".$day." ".$germanTime.":00";
        return $datetime;
    }
    
    public static function toDecimalString($number, $decimals=2) {
        return number_format($number, $decimals, ",", "");
    }
}

?>