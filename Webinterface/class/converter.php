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
    
    //*********
    // Converts a number to a decimal string.
    // The parameter 'decimals' sets the number of digits after the decimal point
    // E.g. input:   14.5 with 2 digits after the decimal point
    //      output:  14,50
    //*********
    public static function toDecimalString($number, $decimals=2) {
        return number_format($number, $decimals, ",", "");
    }
    
    //*********
    // Converts a datetime to a german format. (without seconds)
    // E.g. input:  2012-12-01 13:20:00
    //      output: 01.12.2012 13:20
    //*********
    public static function toGermanDateTimeString($datetime) {
        list($date, $time) = explode(' ', $datetime);
        list($year, $month, $day) = explode('-', $date);
        list($hour, $minute, $second) = explode(':', $time);
        
        $output = $day.".".$month.".".$year." ".$hour.":".$minute;
        return $output;
    }
    
    //*********
    // Calculates the difference in days between the passed dates.
    // The result is rounded up to the next integer.
    // E.g. input:  2012-12-01 13:20:00 and 2012-12-04 16:20:00
    //      output: 4
    //*********
    public static function dateDifferenceInDays($startdate, $enddate) {
        $diffSeconds = strtotime($enddate) - strtotime($startdate);
        $diffMinutes = $diffSeconds / 60;
        $diffHours = $diffMinutes / 60;
        $diffDays = $diffHours / 24;
        return ceil($diffDays);
    }
}

?>