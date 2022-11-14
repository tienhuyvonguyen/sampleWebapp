<?php
require("../auth/session.php");
require("../db/dbConnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amountToSend = $_POST["amount"];
    $cvv = $_POST["cvv"];
    $receiver = strtoupper($_POST["receiver"]);
    $sender = strtoupper($login_session);
    try {
        if ($amountToSend < 0) {
            echo "<script>alert('Amount must be positive! You donkey');window.location.href='transaction.php';</script>";
        }
        $sql = "SELECT username from users where username = :reveiver";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':reveiver', $receiver);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = $result['username'];
        if ($result == null && $receiver == $sender) {
            echo "<script>alert('Receiver does not exist');window.location.href='transaction.php';</script>";
        } elseif ($result == $receiver) {
            $sql = "SELECT * from users where username = :sender";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':sender', $sender);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $cre_Cvv = substr($row["creditCard"], -3);
            $account_balance = $row["balance"];
            echo $account_balance;
            if ($account_balance < $amountToSend) { //check sender balance
                echo "<script>alert('Insufficient balance');window.location.href='transaction.php';</script>";
            } elseif ($cre_Cvv != $cvv) { //check cvv
                echo "<script>alert('CVV is incorrect');window.location.href='transaction.php';</script>";
            } else {
                $sql = "UPDATE users SET balance = balance - :amount WHERE username = :sender"; //update sender balance
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':amount', $amountToSend);
                $stmt->bindParam(':sender', $sender);
                $stmt->execute();
                $sql = "UPDATE users SET balance = balance + :amount WHERE username = :receiver"; //update receiver balance
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':amount', $amountToSend);
                $stmt->bindParam(':receiver', $receiver);
                $stmt->execute();
                echo "<script>alert('Transaction successful');window.location.href='transaction.php';</script>";
            }
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
