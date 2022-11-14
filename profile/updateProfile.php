<?php
include('../auth/session.php');
include('../db/dbConnect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $login_session;
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    try {
        $sql = "SELECT * FROM users WHERE username = ':username'";
        $result = $conn->prepare($sql);
        $result->bindParam(':username', $username);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
        //working right here
        $oldMail = $row['userEmail'];
        $oldPhone = $row['phone'];
        $ollFirstName = $row['firstName'];
        $oldLastName = $row['lastName'];
        $oldAvatar = $row['avatar'];
        $oldCreditCard = $row['creditCard'];
        if (isset($password) && isset($cpassword) && $password != "" && $cpassword != "") {
            $sql = "select userPassword from users where username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $oldpassword = $row['userPassword'];
            if ($password == $cpassword && $oldpassword != $password) {
                $sql = "UPDATE users SET
                                    userEmail = :email,
                                    userPassword = :password,
                                    phone = :phone,
                                    firstname = :firstname,
                                    lastname = :lastname,
                                    creditCard = :card,
                                    avatar =  :avatar
                                WHERE username = :username";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':email', $_POST['email']);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':phone', $_POST['phone']);
                $stmt->bindParam(':firstname', $_POST['firstname']);
                $stmt->bindParam(':lastname', $_POST['lastname']);
                $stmt->bindParam(':card', $_POST['creditCard']);
                $stmt->bindParam(':avatar', $avatar_path);
                $stmt->bindParam(':username', $username);
                $stmt->execute();
                echo "<script>alert('Profile updated successfully!1');window.location.href='userProfile.php';</script>";
            } elseif ($oldpassword == $password) {
                echo "<script>alert('New password cannot be the same as the old password!1');window.location.href='userProfile.php';</script>";
            } else {
                echo "<script>alert('Password does not match!1');window.location.href='userProfile.php';</script>";
            }
        } elseif ($password == "" && $cpassword == "") {
            $sql = "UPDATE users SET
                                userEmail = :email,
                                phone = :phone,
                                firstname = :firstname,
                                lastname = :lastname,
                                creditCard = :card,
                                avatar =  :avatar
                            WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':phone', $_POST['phone']);
            $stmt->bindParam(':firstname', $_POST['firstname']);
            $stmt->bindParam(':lastname', $_POST['lastname']);
            $stmt->bindParam(':card', $_POST['creditCard']);

            $stmt->bindParam(':avatar', $avatar_path);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            echo "<script>alert('Profile updated successfully!2');window.location.href='userProfile.php';</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
