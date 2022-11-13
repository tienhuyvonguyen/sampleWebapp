<?php
include "./auth/session.php";
?>
<!-- simple welcome page in php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>

<body>
    <h1>Welcome <?php echo "<strong> $login_session </strong> " ?> to the site</h1>
    <a href="../auth/logout.php">Logout</a>


    <!-- top up money -->
    <form action="profile.php" method="post">
        <input type="number" name="topup" placeholder="top up money $">
        <input type="submit" name="submit" value="top up" onclick="">
    </form>

</body>

</html>