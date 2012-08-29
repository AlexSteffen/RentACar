<?php
//*********************
// Author: G.Bšselager
// Date: 26.08.2012
//
// Description:
// The class Validation contains functions to check various data.
//*********************

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
    
    //*********
    // Checks if the passed E-Mail is valid.
    //*********
    public static function isValidEmail($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }else{
            return true;
        }
    }
}

?>