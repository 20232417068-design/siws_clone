<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Login – SIWS College</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    body {
      background: #f0f4f8;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-box {
      background: #fff;
      padding: 30px 40px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 400px;
    }
    .login-box h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #003366;
    }
    .login-box label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #333;
    }
    .login-box input {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .login-box button {
      width: 100%;
      padding: 10px;
      background: #003366;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-weight: bold;
      cursor: pointer;
    }
    .login-box button:hover {
      background: #0055aa;
    }
    .login-box .note {
      text-align: center;
      font-size: 13px;
      color: #666;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Student Login</h2>
    <form method="post" action="dashboard.php">
      <label for="student_id">Student ID</label>
      <input type="text" name="student_id" id="student_id" required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">Login</button>
      <div class="note">Use your registered Student ID and password</div>
    </form>
  </div>
</body>
</html>