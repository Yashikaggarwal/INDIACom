<?php
$server="localhost";
$username="root";
$password="";
$database="user";

$conn=mysqli_connect($server, $username, $password, $database);
if(!$conn){
     die("Error".mysqli_connect_error());
 }


?> 


<!-- 
// $servername = "localhost";
// $username = "root";
// $password = "";

// //$servername = "localhost";
// //$username = "root";
// //$password = "" ;
// //$dbname = "bvicam_admissionenquiry";
// $dbname = "user";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// //echo "DB Connect Called";die();
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed test: " . $conn->connect_error);
// }
?> -->