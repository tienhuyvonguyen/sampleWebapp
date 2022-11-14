<?php
require("../auth/session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST["amount"];
    $cvv = $_POST["cvv"];
    $receiver = $_POST["address"];
    $sender = $_SESSION["login_user"];

    if ($amount < 0) {
        echo "<script>alert('Amount must be positive');window.location.href='transaction.php';</script>";
    }
    $sql = "SELECT username from users where username = :reveiver";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':receiver', $receiver);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row == null) {
        echo "<script>alert('Receiver does not exist');window.location.href='transaction.php';</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
		shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <!-- welcome -->
    <br>
    <small>User: <?php echo "<em style=color:red> $login_session </em>" ?></small>
    <h1>
        <center>Transaction page</center>
    </h1>
    <!-- transaction -->
    <form action="transaction.php" method="POST">
        <center>
            <input type="text" id="address" name="address" placeholder="Wallet Username">
            <input type="number" id="cvv" name="cvv" placeholder="CVV number">
            <input type="number" id="amount" name="amount" placeholder="Amount of ฿฿฿ to send">
            <button type="submit" name="submit">Send</button>
        </center>
    </form>
    <!-- Back to main menu -->
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="../main.php" class="btn btn-primary float-lg-right ">Main menu</a>
            </div>
        </div>
    </div>
</body>