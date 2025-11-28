<?php
require __DIR__ . '/../db/config.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';

  $stmt = $conn->prepare("SELECT id, password_hash, role FROM admin_users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->bind_result($id, $hash, $role);

  if ($stmt->fetch()) {
      
    if (password_verify($password, $hash)) {
      $_SESSION['admin_role'] = $role;
      $_SESSION['admin_id'] = $id;
      $_SESSION['admin_name'] = $username;
      header('Location: application.php');
      exit;
    } else {
      $error = 'Invalid credentials';
    }
  } else {
    $error = 'Invalid credentials';
  }

  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="container">
  <section class="section" style="max-width:480px;margin:40px auto;">
    <h2>Admin Login</h2>

    <?php if ($error): ?>
      <div class="alert error">
        <?php echo htmlspecialchars($error); ?>
      </div>
    <?php endif; ?>

    <form class="form" method="post">
      <label for="u">Username</label>
      <input id="u" name="username" required>

      <label for="p">Password</label>
      <input id="p" name="password" type="password" required>

      <button class="btn primary" type="submit">Login</button>
    </form>
  </section>
</body>
</html>