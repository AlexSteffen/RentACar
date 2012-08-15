<?php
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
    default: 
        include_once("content/startpage.php");
        break;
}

?>