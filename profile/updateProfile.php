<?php
include('../auth/session.php');
include('../db/dbConnect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = strtoupper($login_session);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    try {
        $sql = "SELECT * FROM users WHERE username = :username";
        $result = $conn->prepare($sql);
        $result->bindParam(':username', $username);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);

        // working right here LOGIC error
        $oldMail = $row['userEmail'];
        $oldMail != $_POST['email'] && $_POST['email'] != "" ? $email = $_POST['email'] : $email = $oldMail;
        $oldPhone = $row['phone'];
        $oldPhone != $_POST['phone'] ? $phone = $_POST['phone'] : $phone = $oldPhone;
        $ollFirstName = $row['firstname'];
        $ollFirstName != $_POST['firstName'] ? $firstName = $_POST['firstName'] : $firstName = $ollFirstName;
        $oldLastName = $row['lastname'];
        $oldLastName != $_POST['lastName'] ? $lastName = $_POST['lastName'] : $lastName = $oldLastName;
        $oldAvatar = $row['avatar'];
        $oldAvatar != $_POST['avatar'] ? $avatar = $_POST['avatar'] : $avatar = $oldAvatar;
        $oldCreditCard = $row['creditCard'];
        $oldCreditCard != $_POST['creditCard'] ? $creditCard = $_POST['creditCard'] : $creditCard = $oldCreditCard;





        
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
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':firstname', $firstName);
                $stmt->bindParam(':lastname', $lastName);
                $stmt->bindParam(':card', $creditCard);
                $stmt->bindParam(':avatar', $avatar);
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
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':firstname', $firstName);
            $stmt->bindParam(':lastname', $lastName);
            $stmt->bindParam(':card', $creditCard);
            $stmt->bindParam(':avatar', $avatar);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            echo "<script>alert('Profile updated successfully!2');window.location.href='userProfile.php';</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
