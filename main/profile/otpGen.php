<?php
include "./auth/session.php";
// generate otp
if (isset($_POST['otpGen'])) {
    $otp = rand(100000, 999999);
    $sql = "UPDATE users SET otp = :otp WHERE username = :username";
    try {
        $result = $conn->prepare($sql);
        $result->bindParam(':otp', $otp, PDO::PARAM_STR);
        $result->bindParam(':username', $login_session, PDO::PARAM_STR);
        $result->execute();
        $num = $result->rowCount();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    // send otp to email
    $to = $login_session;
    $subject = "OTP";
    $message = "Your OTP is: " . $otp;
    $headers = "From:
    " . $login_session;
    mail($to, $subject, $message, $headers);
    // redirect to otp page
    header("Location: otp.php");
}
?>