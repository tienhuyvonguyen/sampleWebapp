<?php
$host = "localhost";
$user = "user";
$pass = "user";
$db = "webapp";
try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // if ($conn) {
    //     echo "Connected to the <strong>$db</strong> as user <strong>$user</strong> to database successfully!";
    // } else {
    //     echo "Unable to establish a connection.";
    // }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
