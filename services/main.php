<?php
include '../auth/session.php';
include '../db/dbConnect.php';

$userTier = $_SESSION['premiumTier'];
if ($userTier === 1) {
  $saleOff = 0.2;
} elseif ($userTier === 2) {
  $saleOff = 0.3;
} elseif ($userTier === 3) {
  $saleOff = 0.4;
} else {
  $saleOff = 0;
}

// show products from database
try {
  $sql = "SELECT * FROM product";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>☜︎☹︎✋︎❄︎☜︎ MEME NFT</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body class="text-center">
  <center>
    <h1>☜︎☹︎✋︎❄︎☜︎ MEME NFT</h1>
  </center>
  <?php
  if ($userTier != 0) {
    echo "<h>You are a premium member! You get " . $saleOff * 100 . "% off on all product!</h>";
  }
  ?>
  <div class="container">
    <div class="row">
      <div class="col">
        <a href="../auth/logout.php" class="btn btn-primary float-lg-right ">Logout</a>
      </div>
    </div>
  </div>
  <br>
  <div class="container">
    <div class="row">
      <div class="col">
        <a href="../profile/userProfile.php" class="btn btn-primary float-lg-right ">Profile</a>
        <a href="./cart.php" class="btn btn-primary float-lg-right ">Cart</a>
      </div>
    </div>
  </div>
  <br>
  <div class="container">
    <div class="row">
      <?php foreach ($result as $row) {
        $price = $row["price"];
        $price -= ($price * $saleOff); ?>
        <div class="col-md-3">
          <form method="POST" action="addToCart.php?action=add&id=<?php echo htmlspecialchars($row["productID"]); ?>">
            <div class="product">
              <!-- item to show -->
              <img src="<?php echo htmlspecialchars($row["picture"]); ?>" class="img-responsive" height="250px" width="250px">
              <h5 class="text-info"><?php echo htmlspecialchars($row["name"]); ?></h5>
              <h5 class="text-danger">฿฿฿ <?php
                                          echo number_format($price, 2);  ?></h5>
              <h5 class="text-center">Stock: <?php echo htmlspecialchars($row["stock"]); ?></h5>
              <!-- item to show -->
              <!-- hidden item to pass through -->
              <input type="number" name="quantity" class="form-control" value="1" min="0" maxlength="10" max="<?php echo $row["stock"] ?>">
              <input type="hidden" name="hidden_name" value="<?php echo htmlspecialchars($row["name"]); ?>">
              <input type="hidden" name="hidden_price" value="<?php echo htmlspecialchars($price); ?>">
              <input type="hidden" name="hidden_stock" value="<?php echo htmlspecialchars($row["stock"]); ?>">
              <input type="hidden" name="hidden_id" value="<?php echo htmlspecialchars($row["productID"]); ?>">
              <input type="hidden" name="hidden_picture" value="<?php echo htmlspecialchars($row["picture"]); ?>">
              <!-- hidden item to pass through -->
              <input type="submit" name="add_to_cart" id="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
            </div>
          </form>
        </div>
      <?php } ?>
    </div>
  </div>
  <br>
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