<?php
$host = "localhost";
$user = "valen";
$pass = "valen123";
$db = "webapp";

$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ($conn) {
    echo "Connected to the <strong>$db</strong> as <strong>$user</strong> to database successfully!";
} else {
    echo "Unable to establish a connection.";
}