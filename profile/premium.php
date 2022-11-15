<?php
require_once("../auth/session.php");
$sql = "select * from users where username = :username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $login_session);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$balance = $row['balance'];
$tier = $_GET['tier'];
switch ($tier) {
    case 1:
        break;
    case 2:
        break;
    case 3:
        break;
    default:
        break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Register</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
		shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <!-- welcome -->
    <h1>
        <center>Premium register</center>
    </h1>
    <div class="container">
        <!-- santinize pls -->
        <medium>User: <strong style=color:red><?php echo htmlspecialchars($login_session) ?></strong></medium>
        <br>
        <medium>Tier: <em style=color:red><?php echo htmlspecialchars($tier) ?></em></medium>
        <br>
        <medium>Balance: <em style=color:red><?php echo htmlspecialchars($balance) ?></em> ฿฿฿</medium>
    </div>
    <!-- Back to main menu -->
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="../main.php" class="btn btn-primary float-lg-right ">Main menu</a>
            </div>
        </div>
    </div>
    <!-- Show premmium options -->
    <div class="container">
        <div class="row">
            <center>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://wallpapertops.com/walldb/original/c/2/1/699013.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title`">Premium Tier 1</h5>
                            <p class="card-text">Price: 500฿฿฿</p>
                            <p class="card-text">Expire date: 1 month</p>
                            <p>Benefits: 20% off</p>
                            <a href="./premium.php?tier=1" class="btn btn-primary">Subscribe</a>
                        </div>
                    </div>
                </div>
            </center>
            <center>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="http://wp.production.patheos.com/blogs/laughingindisbelief/files/2016/06/satan.jpeg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title ">Premium 2</h5>
                            <p class="card-text">Price: 1000฿฿฿</p>
                            <p class="card-text">Expire date: 6 months</p>
                            <p>Benefits: Premium 1 & no fee</p>
                            <a href="./premium.php?tier=2" class="btn btn-primary">Subscribe</a>
                        </div>
                    </div>
                </div>
            </center>

            <center>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://images.fineartamerica.com/images/artworkimages/mediumlarge/1/baphomet-satanic-pentagram-black-red-sofia-metal-queen.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title ">Premium 3</h5>
                            <p class="card-text">Price: 2000฿฿฿</p>
                            <p class="card-text">Expire date: 1 year</p>
                            <p>Benefits: Premium 2 & onion site</p>
                            <a href="./premium.php?tier=3" class="btn btn-primary">Subscribe</a>
                        </div>
                    </div>
                </div>
            </center>

        </div>
    </div>

</body>