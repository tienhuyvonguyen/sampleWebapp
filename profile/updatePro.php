<!-- update profile -->
<?php
// include database connection
include '../config/database.php';
// include session
include '../auth/session.php';
// check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // update query
        $query = "UPDATE users
                    SET
                        password = :password,
                        firstname = :firstname,
                        lastname = :lastname,
                        address = :address
                    WHERE username = :username";
        // prepare query for execution
        $stmt = $con->prepare($query);
        // posted values
        $password = htmlspecialchars(strip_tags($_POST['password']));
        $firstname = htmlspecialchars(strip_tags($_POST['firstname']));
        $lastname = htmlspecialchars(strip_tags($_POST['lastname']));
        $address = htmlspecialchars(strip_tags($_POST['address']));
        // bind the parameters
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':username', $login_session);
        // Execute the query
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Record was updated.</div>";
        } else {
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
    }
    // show error
    catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }
}
