<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['student_name'])) {
    header("Location: login.php");
    exit();
}

// Fetch current student info
$stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, password = ?, photo = ? WHERE email = ?");
$stmt->bind_param("sssss", $newName, $newEmail, $hashedPassword, $photoName, $email);
$stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, photo = ? WHERE email = ?");
$stmt->bind_param("ssss", $newName, $newEmail, $photoName, $email);
$email = $_SESSION['student_email']; // We'll store this during login
$stmt = $conn->prepare("SELECT name, email FROM students WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$photoName = null;

if (!empty($_FILES["photo"]["name"])) {
    $targetDir = "../uploads/profile_photos/";
    $photoName = basename($_FILES["photo"]["name"]);
    $targetFile = $targetDir . $photoName;

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
        echo "✅ Photo uploaded!<br>";
    } else {
        echo "❌ Photo upload failed.<br>";
    }
}
    $newName = trim($_POST['name']);
    $newEmail = trim($_POST['email']);

    // Optional password change
    $newPassword = $_POST['password'];
    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, password = ? WHERE email = ?");
        $stmt->bind_param("ssss", $newName, $newEmail, $hashedPassword, $email);
    } else {
        $stmt = $conn->prepare("UPDATE students SET name = ?, email = ? WHERE email = ?");
        $stmt->bind_param("sss", $newName, $newEmail, $email);
    }

    if ($stmt->execute()) {
        echo "✅ Profile updated!";
        $_SESSION['student_name'] = $newName;
        $_SESSION['student_email'] = $newEmail;
    } else {
        echo "❌ Error: " . $stmt->error;
    }
}
?>

<h2>Edit Profile</h2>
<form method="POST" enctype="multipart/form-data">
<form method="POST">
<input type="file" name="photo" accept="image/*"><br><br>
    <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br><br>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>
    <input type="password" name="password" placeholder="New Password (optional)"><br><br>
    <button type="submit">Update Profile</button>
</form>