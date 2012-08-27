<?php
class Validation{
    
    //*********
    // Checks if the passed DateTime is valid.
    //*********
    public static function isValidDateTime($data) {
        
        if (date('Y-m-d H:i:s', strtotime($data)) == $data) {
            return true;
        } else {
            return false;
        }
    }
}

?>