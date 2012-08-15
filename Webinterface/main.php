<?php
//*********************
// Author: G.Böselager
// Date: 15.8.2012
//
// Description:
// In this file are important scripts which have to be included in all PHP-Files of this project.
// To include use the following code at the top of the file: include_once('main.php');
//*********************

//** IMPORTANT!!
//** These configuration information for the Apache-Webserver is needed. If they are not set the WSDL document
//** will be cached for a long time and it cause unexpected errors.
ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0');

?>