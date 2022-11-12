<?php
include("./dbConnect.php");
session_start();
$user_check = $_SESSION['login_user'];
$ses_sql = $conn->prepare("SELECT username FROM users WHERE username = '$user_check' limit 1");
$ses_sql->execute();
$row = $ses_sql->fetch(PDO::FETCH_ASSOC);
$login_session = $row['username'];
if (!isset($login_session)) {
    header("location: ./auth/login.php");
    die();
}
