<?php
include "./functions/blogposts.php";
$blogposts = getBlogpost();
?>

<ul>
    <?php foreach ($blogposts as $blogpost): ?>
        <li class="blog-post">
            <img src="../assets/images/<?= htmlspecialchars($blogpost['imagelink']) ?>" alt="">
            <?= ($blogpost['content']) ?>
        </li>
    <?php endforeach; ?>
</ul>
<script src="../assets/javascript/parser.js"></script>
<script>
    const posts = document.querySelectorAll(".blog-post");
        for (let i = 0; i < posts.length; i++) {
            const textContent = posts[i].innerHTML;
            posts[i].innerHTML = parseMarkdown(textContent);
    }
</script>
