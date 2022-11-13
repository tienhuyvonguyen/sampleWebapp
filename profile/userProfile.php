<?php
require_once("../auth/session.php");
$sql = "SELECT * FROM users WHERE username = :username";
try {
  $result = $conn->prepare($sql);
  $result->bindParam(':username', $login_session, PDO::PARAM_STR);
  $result->execute();
  $num = $result->rowCount();
  if ($num == 1) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $password = $row['userPassword'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $creditCard = $row['creditCard'];
    $userEmail = $row['userEmail'];
    $phone = $row['phone'];
    $avatar_path = $row['avatar'];
    $balance = $row['balance'];
    $premium = $row['premiumTier'];
    $preExpireDate = $row['premireExpire'];
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
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
    <center>Welcome <?php echo "<em style=color:red> $login_session </em>" ?> to the profile page</center>
  </h1>
  <!-- logout -->
  <div class="container">
    <div class="row">
      <div class="col">
        <a href="../auth/logout.php" class="btn btn-primary float-lg-right ">Logout</a>
      </div>
    </div>
  </div>
  <br>
  <!-- display premium  -->
  <h2>
    <center>Premium Tier: <?php echo htmlspecialchars($premium) ?></center>
  </h2>
  <h2>
    <center>Premium Expired: <?php echo htmlspecialchars($preExpireDate) ?></center>
  </h2>
  <!-- display balance -->
  <h2>
    <center>Balance: <?php echo htmlspecialchars($balance) ?> ฿฿฿</center>
  </h2>
  <!-- top up balance -->
  <form action="../auth/topup.php" method="POST">
    <center>
      <input type="number" name="topup" placeholder="Top up amount of ฿฿฿">
      <button type="submit" name="submit">Top up</button>
    </center>
  </form>
  <div class="container my-4 ">
    <!-- show user informations from database -->
    <form method="POST" action="updatePro.php">

      <div class="form-group">
        <!-- display avatar onclick hover  -->
        <img src="<?php echo $avatar_path ?>" alt="avatar" width="100" height="100">
        <!-- onclick change avatar  using php-->
        <input type="file" name="avatar" id="avatar" accept="image/png, image/jpeg">
      </div>

      <div class="form-group">
        <!-- can not change -->
        <label for="username">Username</label>
        <small id="emailHelp" class="form-text text-muted"> Unique </small>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo  htmlspecialchars($login_session) ?>" readonly>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>

      <div class="form-group">
        <label for="cpassword">Confirm Password</label>
        <input type="password" class="form-control" id="cpassword" name="cpassword">
        <small id="emailHelp" class="form-text text-muted">
          Make sure to type the same password
        </small>
      </div>

      <div class="form-group">
        <label>Firstname</label>
        <input type="text" class="form-control" name="firstname" required="required" value="<?php echo  htmlspecialchars($firstname) ?>" />
      </div>

      <div class="form-group">
        <label>Lastname</label>
        <input type="text" class="form-control" name="lastname" required="required" value="<?php echo  htmlspecialchars($lastname) ?>" />
      </div>

      <div class="form-group">
        <label>Credit Card</label>
        <input type="text" class="form-control" name="address" required="required" value="<?php echo  htmlspecialchars($creditCard) ?>" />
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" name="address" required="required" value="<?php echo  htmlspecialchars($userEmail) ?>" />
      </div>

      <div class="form-group">
        <label>Phone</label>
        <input type="text" class="form-control" name="address" required="required" value="<?php echo  htmlspecialchars($phone) ?>" />
      </div>

      <center><button class="btn btn-primary" name="save">Save</button></center>

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