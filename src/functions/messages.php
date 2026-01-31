<?php
include __DIR__ . "/../db/connect.php";



function getBlogpostById($id) {
    $pdo = connectDb();
    $stmt = $pdo->prepare("SELECT * FROM blogpost WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
