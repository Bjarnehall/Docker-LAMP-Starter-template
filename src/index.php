<?php

$dsn = "mysql:host=db;dbname=app;charset=utf8mb4";
$user = "appuser";
$pass = "secret";

try {
  $pdo = new PDO($dsn, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->query("SELECT * FROM messages");
  $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}
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

