<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "reservation_restau";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("conection failed". $conn->connect_error);
}
?>