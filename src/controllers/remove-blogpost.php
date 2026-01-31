<?php

include __DIR__ . '/../functions/blogposts.php';

deleteBlogpost(
    $_GET['id'],
);

header("Location: ../views/admin.php");
exit;