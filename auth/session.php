<?php
include("../db/dbConnect.php");
session_start();
$user_check = $_SESSION['login_user'];
$sql = "SELECT username FROM users WHERE username = :user_check limit 1";
$ses_sql = $conn->prepare($sql);
$ses_sql->bindParam(':user_check', $user_check);
$ses_sql->execute();
$row = $ses_sql->fetch(PDO::FETCH_ASSOC);
$login_session = $row['username'];
if (!isset($login_session)) {
    header("location: ./login.php");
    die();
}
