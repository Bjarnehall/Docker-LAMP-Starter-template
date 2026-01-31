<?php
include "../functions/blogposts.php";
$blogposts = getBlogpost();
?>
<ul>
  <a href="./forms/createpost.php">
      <button>Create new post</button>
  </a>
  <?php foreach ($blogposts as $blogpost): ?>
    <li class="blog-post" data-id="<?= $blogpost['id']?>">
      <a href="./forms/editpost.php?id=<?= $blogpost['id'] ?>">
          <button class="edit-blogpost">Edit</button>
      </a>
      <a href="../controllers/remove-blogpost.php?id=<?= $blogpost['id'] ?>">
          <button class="remove-blogpost">Remove</button>
      </a>
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
