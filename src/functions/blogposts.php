<?php
include __DIR__ . "/../db/connect.php";

function createBlogpost($content, $imagelink) {
    $content = str_replace("\r\n", "\n", $content);
    $content = "\n" . trim($content) . "\n";

    $pdo= connectDb();
    $stmt = $pdo->prepare(
        "INSERT INTO blogpost (content, imagelink)
        VALUES (?, ?)"
    );
    $stmt->execute([$content, $imagelink]);
}

function deleteBlogpost($id) {
    $pdo = connectDb();
    $stmt = $pdo->prepare(
        "DELETE FROM blogpost WHERE id= ?"
    );
    $stmt->execute([$id]);
}

function updateBlogpost($id, $content, $imagelink) {
    $content = str_replace("\r\n", "\n", $content);
    $content = "\n" . trim($content) . "\n";

    $pdo = connectDb();
    $stmt = $pdo->prepare(
        "UPDATE blogpost SET content = ?, imagelink = ? WHERE id = ?"
    );
    $stmt->execute([$content, $imagelink, $id]);
}

function getBlogpost() {
    $pdo = connectDb();
    $stmt = $pdo->query("SELECT * FROM blogpost");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>