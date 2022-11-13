<?php

$showError = false;

require("../dbConnect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];
    $capt1 = $_POST["vercode"];
    $capt2 = $_SESSION["vercode"];

    // $hash = password_hash(
    //     $mypassword,
    //     PASSWORD_DEFAULT
    // );

    $sql = "SELECT * FROM users WHERE username = '$myusername' and userPassword = '$mypassword'";
    $result = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $result->execute();
    $num = $result->rowCount();
    //captcha variables

    //   If result matched $myusername and $mypassword, table row must be 1 row & check captcha
    if ($capt1 != $capt2 or $capt2 == '') {
        $showError = "Invalid Captcha";
    } else if ($num == 1) {
        if (!empty($_POST["remember"])) {
            //COOKIES for username
            setcookie("user_login", htmlspecialchars($_POST["username"]), time() + (86400 * 7));
            //COOKIES for password
            setcookie("userpassword", htmlspecialchars($_POST["password"]), time() + (86400 * 7));
        } else {
            if (isset($_COOKIE["user_login"])) {
                setcookie("user_login", "");
                if (isset($_COOKIE["userpassword"])) {
                    setcookie("userpassword", "");
                }
            }
        }
        $_SESSION['login_user'] = $myusername;
        header("location: ../profile/profile.php");
    } else {
        $showError = "Your Login Name or Password is invalid";
    }
    // test in case of error
    // if ($num == 1) {
    //     $_SESSION['login_user'] = $myusername;
    //     header("location: ../profile.php");
    // } else {
    //     $showError = "Your Login Name or Password is invalid";
    // }
}

?>

<!doctype html>

<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
		shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>

    <?php

    if ($showAlert) {

        echo ' <div class="alert alert-success
			alert-dismissible fade show" role="alert">
	
			<strong>Success!</strong> Your account is
			now created and you can login.
			<button type="button" class="close"
				data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div> ';
    }

    if ($showError) {

        echo ' <div class="alert alert-danger
			alert-dismissible fade show" role="alert">
		<strong>Error!</strong> ' . $showError . '
	
	<button type="button" class="close"
			data-dismiss="alert aria-label="Close">
			<span aria-hidden="true">×</span>
	</button>
	</div> ';
    }

    if ($exists) {
        echo ' <div class="alert alert-danger
			alert-dismissible fade show" role="alert">
	
		<strong>Error!</strong> ' . $exists . '
		<button type="button" class="close"
			data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div> ';
    }

    ?>

    <div class="container my-4 ">

        <h1 class="text-center">Login</h1>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" value="<?php if (isset($_COOKIE["user_login"])) {
                                                                                                                                echo htmlspecialchars($_COOKIE["user_login"]);
                                                                                                                            } ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php if (isset($_COOKIE["userpassword"])) {
                                                                                                        echo htmlspecialchars($_COOKIE["userpassword"]);
                                                                                                    } ?>">
            </div>
            <!-- captcha -->
            <div class="form-group small clearfix">
                <label class="checkbox-inline">Verification Code</label>
                <img src="captcha.php">
            </div>
            <div class="form-group">
                <input type="text" name="vercode" class="form-control" placeholder="Verfication Code" required="required">
            </div>
            <!-- captcha -->

            <!-- remember me -->
            <div class="field-group">
                <div><input type="checkbox" name="remember" id="remember" <?php if (isset($_COOKIE["user_login"])) { ?> checked <?php } ?> /> </div>
                <label for="remember-me">Remember me</label>
            </div>
            <!-- remember me -->
            <button type="submit" class="btn btn-primary">
                Login
            </button>
            <a href="signup.php" class="btn btn-primary">
                Signup
            </a>

        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="
https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="
sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="
https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <script src="
https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>