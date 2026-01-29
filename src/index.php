<?php

include "./db/connect.php";

$pdo = connectDb();

$stmt = $pdo->query("SELECT * FROM messages");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html>
  <head>
    <title>LAMP Docker App</title>
  </head>
<body>
  <h1>Medellanden från databasen</h1>

  <ul>
    <?php foreach ($messages as $message): ?>
      <li><?= htmlspecialchars($message['content']) ?></li>
    <?php endforeach; ?>
  </ul>
</body>
</html>

