<?php
//*********************
// Author: G.Bšselager
// Date: 17.8.2012
//
// Description:
// In this file is implemented which files can be openend by passing the GET-parameter in the URL.
// E.g. In this case (index.php?section=search) the file search.php will be included in the body of the webpage.
//*********************
switch($_REQUEST["section"]){
    case "start":
        include_once("content/startpage.php");
        break;
    case "search":
        include_once("content/search.php");
        break;
    case "details":
        include_once("content/details.php");
        break;
    case "reservation":
        include_once("content/reservation.php");
        break;
    case "registration":
        include_once("content/registration.php");
        break;
    case "confirmation":
        include_once("content/confirmation.php");
        break;
    case "login":
        include_once("content/login.php");
        break;
    case "test":
        include_once("content/test.php");
        break;
    default: 
        include_once("content/startpage.php");
        break;
}

?>