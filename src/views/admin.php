<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
// Present header
include "./common/header.php";
?>
<a href="../controllers/logout.php">
  <button>Logout</button>
</a>
<?php
// Present blogpost admin view
include "./blocks/feed-blogpost-admin.php";
// Present footer
include "./common/footer.php";
?>
