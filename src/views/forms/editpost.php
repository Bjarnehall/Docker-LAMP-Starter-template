<?php
include '../../functions/messages.php';

$id = $_GET['id'] ?? null;
if (!$id) die("Missing id");

$post = getBlogpostById($id);
?>

<!DOCTYPE html>
<html>
    <body>
        <h1>Edit blogpost</h1>

        <form method="post" action="../../controllers/update-blogpost.php">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <textarea name="content" rows="15"><?= htmlspecialchars($post['content']) ?></textarea>
            <input type="text" name="imagelink" value"<?= htmlspecialchars($post['imagelink']) ?>">
            <button type="submit">Save</button>
        </form>
    </body>
</html>
