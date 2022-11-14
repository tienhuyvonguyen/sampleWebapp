<?php
require_once("../auth/session.php");
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
    <br>
    <small>User: <?php echo "<em style=color:red> $login_session </em>" ?></small>
    <h1>
        <center>Premium register</center>
    </h1>
    <!-- Back to main menu -->
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="../main.php" class="btn btn-primary float-lg-right ">Main menu</a>
            </div>
        </div>
    </div>
    <br>
    <!-- Show premmium options -->
    <div class="container">
        <div class="row">
            <center>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="http://wp.production.patheos.com/blogs/laughingindisbelief/files/2016/06/satan.jpeg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title ">Premium 2</h5>
                            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </center>

            <center>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="https://i.ytimg.com/vi/qdJFdM5Bk5g/maxresdefault.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title ">Premium 3</h5>
                            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </center>

        </div>
    </div>

</body>