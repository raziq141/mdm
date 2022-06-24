<?php 
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "mdm";

$conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
if($conn->connect_error){
    echo("Error in connection: ".$conn->error);
}

?>