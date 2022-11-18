<?php
session_start();
include('../auth/session.php');
if (!isset($_SESSION['login_user'])) {
    header("location: ../auth/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Cart</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $total = $total + $value['item_price'];
                                echo "
                                <tr>
                                    <td>" . $value['item_name'] . "</td>
                                    <td>" . $value['item_price'] . "</td>
                                    <td>" . $value['item_quantity'] . "</td>
                                    <td>" . $value['item_price'] * $value['item_quantity'] . "</td>
                                    <td><a href='cart.php?action=delete&id=" . $value['item_id'] . "'><button class='btn btn-danger'>Remove</button></a></td>
                                </tr>
                                ";
                            }
                        }
                        ?>
                        <tr>
                            <td colspan="3" align="right">Total</td>
                            <td align="right">$ <?php echo $total; ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <a href="index.php"><button class="btn btn-primary">Continue Shopping</button></a>
                        <a href="checkout.php"><button class="btn btn-success">Checkout</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>