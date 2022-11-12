<?php
$host = "localhost";
$user = "user";
$pass = "user";
$db = "webapp";

$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ($conn) {
    echo "Connected to the <strong>$db</strong> as user <strong>$user</strong> to database successfully!";
} else {
    echo "Unable to establish a connection.";
}