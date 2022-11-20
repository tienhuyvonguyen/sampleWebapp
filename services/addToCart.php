<?php
include '../auth/session.php';


// logic conflict
// save the cart to the session
if (isset($_POST["add_to_cart"])) {
    if (!isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], $_GET["id"]);
        if (!in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'item_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
                'item_image' => $_POST["hidden_picture"]
            );

            $_SESSION["shopping_cart"][$count] = $item_array;
            echo '<script>alert("Item Added1");</script>';
            var_dump($item_array);
            die();
        } else {
            echo '<script>alert("Item Already Added")</script>';
            echo '<script>window.location="main.php"</script>';
        }
    } else {
        $item_array = array(
            'item_id' => $_GET["id"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"],
            'item_image' => $_POST["hidden_picture"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
        echo '<script>alert("Item Added2");</script>';
        var_dump($item_array);
        die();
    }
}
