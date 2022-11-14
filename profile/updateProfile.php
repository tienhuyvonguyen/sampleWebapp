<?php
include('../auth/session.php');
include('../db/dbConnect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $login_session;
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    // handle avatar upload
    $avatar = $_FILES['avatar'];
    $avatar_name = $avatar['name'];
    $avatar_tmp_name = $avatar['tmp_name'];
    $avatar_size = $avatar['size'];
    $avatar_error = $avatar['error'];
    $avatar_type = $avatar['type'];

    $avatar_ext = explode('.', $avatar_name);
    $avatar_actual_ext = strtolower(end($avatar_ext));
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($avatar_actual_ext, $allowed)) {
        if ($avatar_error === 0) {
            if ($avatar_size < 1000000) {
                $avatar_name_new = uniqid('', true) . "." . $avatar_actual_ext;
                $avatar_destination = '../upload/avatars/' . $avatar_name_new;
                move_uploaded_file($avatar_tmp_name, $avatar_destination);
                $avatar_path = $avatar_destination;
            } else {
                echo "<script>alert('Your file is too big!');window.location.href='userProfile.php';</script>";
            }
        } else {
            echo "<script>alert('There was an error uploading your file!');window.location.href='userProfile.php';</script>";
        }
    } else {
        echo "<script>alert('You cannot upload files of this type!');window.location.href='userProfile.php';</script>";
    }
    
    try {

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
