<?php
require_once("../auth/session.php");
try {
  $sql = "SELECT * FROM users WHERE username = :username";
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
    $preExpireDate = date("d-m-Y", strtotime($preExpireDate));
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
    <center>Welcome <?php echo "<em style=color:red> $login_session </em>" ?> to profile page</center>
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
  <!-- transaction -->
  <div class="container">
    <div class="row">
      <div class="col">
        <a href="./transaction.php" class="btn btn-primary float-lg-right ">Send Money</a>
      </div>
    </div>
  </div>
  <br>
  <!--  premium  -->
  <h2>
    <center>Premium Tier: <?php echo htmlspecialchars($premium) ?></center>
    <center><small class="text-muted d-sm-table-cell">Premium expire date: <?php echo htmlspecialchars($preExpireDate) ?></small></center>
    <center><a href="./premium.php" class="btn small">Click here to upgrade</a></center>
  </h2>
  <!-- display balance -->
  <h2>
    <center>Balance: <?php echo htmlspecialchars($balance) ?> ฿฿฿</center>
  </h2>
  <!-- top up balance -->
  <form action="topup.php" method="POST">
    <center>
      <input type="number" name="topup" placeholder="Top up amount of ฿฿฿" required="required" min="0" step="0.01">
      <button type="submit" name="submit">Top up</button>
    </center>
  </form>
  <!-- top up balance -->
  <div class="container my-4 ">
    <!-- show user informations from database -->
    <form method="POST" action="./updateProfile.php">

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
        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo  htmlspecialchars($firstname) ?>" />
      </div>

      <div class="form-group">
        <label>Lastname</label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo  htmlspecialchars($lastname) ?>" />
      </div>

      <div class="form-group">
        <label>Credit Card</label>
        <input type="text" class="form-control" id="creditCard" name="creditCard" value="<?php echo  htmlspecialchars($creditCard) ?>" />
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" id="email" name="email" required="required" value="<?php echo  htmlspecialchars($userEmail) ?>" />
      </div>

      <div class="form-group">
        <label>Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" required="required" value="<?php echo  htmlspecialchars($phone) ?>" />
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