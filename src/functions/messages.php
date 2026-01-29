<?php
include "./db/connect.php";

function getMessages() {
    $pdo = connectDb();
    $stmt = $pdo->query("SELECT * FROM messages");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
