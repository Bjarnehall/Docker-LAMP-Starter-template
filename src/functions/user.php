<?php
include __DIR__ . "/../db/connect.php";

function createUser($username, $password) {
    $pdo = connectDb();
    $stmt = $pdo->prepare()
}