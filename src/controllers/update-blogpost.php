<?php

include __DIR__ . '/../functions/blogposts.php';

updateBlogpost(
    $_POST['id'],
    $_POST['content'],
    $_POST['imagelink']
);

header("Location: ../views/admin.php");
exit;