<!-- top up user balance -->
<?php
// include database connection
include_once('../db/dbConnect.php');
include_once('../auth/session.php');
// check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $sql = "SELECT balance FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':username' => $login_session));
        $wallet = $stmt->fetchColumn();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    try {
        // update query
        $query = "UPDATE users
                    SET
                        balance = :balance
                    WHERE username = :username";
        // prepare query for execution
        $stmt = $conn->prepare($query);
        // posted values
        $balance = htmlspecialchars(strip_tags($_POST['topup']));
        $wallet = $wallet + $balance;
        if ($wallet < 0) {
            $wallet = 0;
            echo "<script>alert('Ha you fu*ing donkey!');window.location.href='userProfile.php';</script>";
        }
        // bind the parameters
        $stmt->bindParam(':balance', $wallet);
        $stmt->bindParam(':username', $login_session);
        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('Topup Money Successfully!');window.location.href='userProfile.php';</script>";
        } else {
            echo "<script>alert('Topup Fail!');window.location.href='userProfile.php';</script>";
        }
    }
    // show error
    catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }
}
