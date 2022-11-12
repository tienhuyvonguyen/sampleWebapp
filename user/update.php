<?php
include "./session.php";

if (isset($_POST['password']) && isset($_POST['confirmPassword'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    if ($password == $confirmPassword) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = :password WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':username', $login_session);
        $stmt->execute();
        echo "Password updated successfully!";
    } else {
        echo "Passwords do not match!";
    }
}
?>