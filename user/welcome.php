<?php
include "./session.php";
?>
<!-- simple welcome page in php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome User Page hello</title>
</head>

<body>
    <h1>Welcome <?php echo "<strong> $login_session </strong> " ?> to the site</h1>
    <a href="./auth/logout.php">Logout</a>
</body>

</html>