<!-- top up user balance -->
<?php
// include database connection
include '../db/dbConnect.php';
include '../auth/session.php';
// check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // update query
        $query = "UPDATE users
                    SET
                        balance = :balance
                    WHERE username = :username";
        // prepare query for execution
        $stmt = $con->prepare($query);
        // posted values
        $balance = htmlspecialchars(strip_tags($_POST['topup']));
        // bind the parameters
        $stmt->bindParam(':balance', $balance);
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