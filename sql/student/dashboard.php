<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  exit;
}
?>

<h2>Welcome, <?php echo $_SESSION["user"]; ?>!</h2>
<p>This is your student dashboard.</p>
<a href="logout.php">Logout</a>
<?php if ($_SESSION["role"] === "admin"): ?>
  <br><a href="admin.php">Go to Admin Panel</a>
<?php endif; ?>