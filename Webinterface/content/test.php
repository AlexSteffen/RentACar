<?php

include_once('main.php');

$user = $webservice->checkLogin(array("email"=>"a.steffen@me.com",
                              "password"=>"test"));

var_dump($user->return);
?>