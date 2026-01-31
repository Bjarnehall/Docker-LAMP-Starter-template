<?php

include __DIR__ . '/../functions/blogposts.php';

createBlogpost(
    $_POST['content'],
    $_POST['imagelink']
);

header("Location: ../views/admin.php");
exit;

