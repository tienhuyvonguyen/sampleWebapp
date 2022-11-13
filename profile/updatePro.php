<?php
include_once('../auth/session.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // update profile
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    // check if password match
    if ($password == $cpassword) {
        // update query
        $query = "UPDATE users
                    SET
                        userEmail = :email,
                        userPassword = :password,
                        phone = :phone,
                        firstname = :firstname,
                        lastname = :lastname
                    WHERE username = :username";
        // prepare query for execution
        $stmt = $conn->prepare($query);
        // bind the parameters
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone', $_POST['phone']);
        $stmt->bindParam(':firstname', $_POST['firstname']);
        $stmt->bindParam(':lastname', $_POST['lastname']);
        $stmt->bindParam(':username', $login_session);
        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('Update successfully!');window.location.href='userProfile.php';</script>";
        } else {
            echo "<script>alert('Update failed!');window.location.href='userProfile.php';</script>";
        }
    } else {
        echo "<script>alert('Password not match');window.location.href='userProfile.php';</script>";
    }
}
