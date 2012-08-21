<?php
//load all passed get parameters passed from the site before
$vehicleId = $_REQUEST["vehicle_id"];
$startLocation = $_REQUEST["startLocation"];
$startDate = $_REQUEST["startDate"];
$returnDate = $_REQUEST["returnDate"];

//users search parameters have to be passed to each site 
$urlGetParams = "startDate=".$startDate."&startLocation=".$startLocation.
                "&returnDate=".$returnDate."&vehicle_id=".$vehicleId;
                
//users information
$newOrExistingCustomer = $_REQUEST["newOrExistingCustomer"];
$loginEmail = $_REQUEST["login_email"];
$loginPassword = $_REQUEST["login_password"];

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];
$salutation = $_REQUEST["salutation"];
$lastname = $_REQUEST["lastname"];
$forename = $_REQUEST["forename"];
$street = $_REQUEST["street"];
$city = $_REQUEST["city"];
$zip = $_REQUEST["zip"];
$phone = $_REQUEST["phone"];

//if the login email isset the user is going to login with an existing customer account
if($newOrExistingCustomer == "existingCustomer"){
    
    //check if the email address is correct
    if (!filter_var($loginEmail, FILTER_VALIDATE_EMAIL)) {
        $error .= "Die E-Mail-Adresse ist nicht korrekt.<br>";
    }
    
    if($loginPassword=="") {
        $error .= "Bitte geben Sie ein Passwort an.<br>";
    }
    
    //if some error occurs reload the registraton-site to allow userchanges
    if($error != ""){
        include_once('reservation.php');
        exit;
    }
    
    //Webservice call to do the customer login
    $loginResult = $webservice->checkLogin(array("email"=>$loginEmail, "password"=>$loginPassword));
    
}else{ //the user is going to register as a new customer
    
    //check if the email address is correct
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "Die E-Mail-Adresse ist nicht korrekt.<br>";
    }
    
    //webservice call to check if there is already a customer with the email address    
    $result = $webservice->customerExists(array("email"=>$email));
    
    if($result==NULL) {
        $error .= "Es existiert bereit ein Kunde mit der angegeben E-Mail-Adresse.<br>";
    }
    
    if($password=="") {
        $error .= "Bitte geben Sie ein Passwort an.<br>";
    }
    
    if($lastname=="") {
        $error .= "Bitte geben Sie Ihren Nachnamen an.<br>";
    }
    
    if($lastname=="") {
        $error .= "Bitte geben Sie Ihren Nachnamen an.<br>";
    }
    
    if($forename=="") {
        $error .= "Bitte geben Sie Ihren Vornamen an.<br>";
    }
    
    if($street=="") {
        $error .= "Bitte geben Sie Ihre Straße an.<br>";
    }
    
    if($zip=="") {
        $error .= "Bitte geben Sie Ihre PLZ an.<br>";
    }
    
    if($city=="") {
        $error .= "Bitte geben Sie Ihre Stadt an.<br>";
    }
       
    //if some error occurs reload the registraton-site to allow userchanges
    if($error != ""){
        include_once('reservation.php');
        exit;
    }

    //No error occurs. Webservice call to register the new customer.
    $registrationResult = $webservice->register(array("email"=>$email, "password"=>$password, "salutation"=>$salutation,
                                                    "forename"=>$forename, "lastname"=>$lastname, "street"=>$street,
                                                    "city"=>$city, "zip"=>$zip, "phone"=>$phone));
    
    $returnValue = $registrationResult->return;

    if($returnValue != True)
    {
        echo "Fehler!!!";
        exit;
    }
    
    //Webservice call to do the customer login
    $loginResult = $webservice->checkLogin(array("email"=>$email, "password"=>$password));
}


if($loginResult->return == NULL){
    $error.="Login nicht möglich. E-Mail und/oder Passwort sind nicht korrekt.";
    include_once('reservation.php');
    exit;
}else{
    $customer = new Customer;
    $customer = $loginResult->return;
    echo $customer->lastname;    
}



?>