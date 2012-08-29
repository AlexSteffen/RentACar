<?php
//*********************
// Author: G.Bšselager
// Date: 23.08.2012
//
// Description:
// The class CustomerLogin contains function to login or logout a customer.
//*********************

class CustomerLogin{
    
    //*********
    // This function will login a customer and sets the SESSION.
    //*********
    public static function login($loginEmail, $loginPassword) {
        global $webservice;
        
        //webservice call to check the login
        $loginResult = $webservice->checkLogin(array("email" => $loginEmail, "password" => $loginPassword));
        $customer = $loginResult->return;
        
        if($customer != NULL){
            $_SESSION["customer_id"] = $customer->id;
            return true;
        }else{
            return false;
        }
    }
    
    //*********
    // This function will returns the object of the logged in user.
    //*********
    public static function getLoginCustomer() {
        global $webservice;
        
        //get the logged in customer
        if(isset($_SESSION["customer_id"])){
            $customerResult = $webservice->getCustomerById(array("id" => $_SESSION["customer_id"]));
                            
            //get the customer
            $logincustomer = new Customer;
            $logincustomer = $customerResult->return;
            
            return $logincustomer;
        }else{
            return NULL;
        }
    }
    
    //*********
    // This function will destroy all SESSIONs for the login and the customer will be logged out.
    //*********
    public static function logout() {
        //remove all the variable in the session 
        session_unset(); 
       
        //destroy the session 
        session_destroy(); 
    }
    
    
}

?>