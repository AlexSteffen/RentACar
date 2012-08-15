<?php 
// after connecting to and reading the row from the table 
//$image = $row['myimage'];
$bin = $_REQUEST["binary"];
header("Content-type: image/jpg"); // or whatever 
print $bin; 
exit; 
?>