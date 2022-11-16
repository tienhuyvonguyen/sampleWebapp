<?php
include('../auth/session.php');
// Check if image file is a actual image or fake image
// if (isset($_POST["submit"])) {
//     $target_dir  = "../uploads/avatars/";
//     $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//     $uploadOk = 1;
//     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if ($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
//     // Check file size
//     if ($_FILES["fileToUpload"]["size"] > 500000) { // 500kb
//         echo "<script>alert('Sorry, your Avatar is too large.')</script>";
//         $uploadOk = 0;
//     }
//     $whiteList = array('png', 'jpg', 'jpeg');
//     if (
//         !in_array($imageFileType, $whiteList)
//     ) {
//         echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//         $uploadOk = 0;
//     }
//     if ($uploadOk == 0) {
//         echo "Sorry, your file was not uploaded.";
//         // if everything is ok, try to upload file
//     } else {
//         if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//             echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded";
//         } else {
//             echo "Sorry, there was an error uploading your file.";
//         }
//     }
//     $newAvatar = $target_file;
// }
//error_reporting(0);
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
        $newMail = ($_POST['email']);
        if ($newMail == $oldMail) {
            $newMail = $oldMail;
        }
        $oldPhone = $row['phone'];
        $newPhone = $_POST['phone'];
        if ($newPhone == $oldPhone) {
            $newPhone = $oldPhone;
        }
        $ollFirstName = $row['firstname'];
        $newFirstName = $_POST['firstname'];
        if ($newFirstName == $ollFirstName) {
            $newFirstName = $ollFirstName;
        }
        $oldLastName = $row['lastname'];
        $newLastName = $_POST['lastname'];
        if ($newLastName == $oldLastName) {
            $newLastName = $oldLastName;
        }
        
        //error
        $oldAvatar = $row['avatar'];
        $newAvatar = avaHandle();
        if ($newAvatar == $oldAvatar) {
            $newAvatar = $oldAvatar;
        }

        $oldCreditCard = $row['creditCard'];
        $newCreditCard = $_POST['creditCard'];
        if ($newCreditCard == $oldCreditCard) {
            $newCreditCard = $oldCreditCard;
        }
        // working right here LOGIC error
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
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':email', $newMail);
                $stmt->bindParam(':phone', $newPhone);
                $stmt->bindParam(':firstname', $newFirstName);
                $stmt->bindParam(':lastname', $newLastName);
                $stmt->bindParam(':card', $newCreditCard);
                $stmt->bindParam(':avatar', $newAvatar);
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
            $stmt->bindParam(':email', $newMail);
            $stmt->bindParam(':phone', $newPhone);
            $stmt->bindParam(':firstname', $newFirstName);
            $stmt->bindParam(':lastname', $newLastName);
            $stmt->bindParam(':card', $newCreditCard);
            $stmt->bindParam(':avatar', $newAvatar);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            echo "<script>alert('Profile updated successfully!2');window.location.href='userProfile.php';</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
