<?php
require __DIR__ . '/../db/config.php';
require __DIR__ . '/../includes/PHPMailer/PHPMailer.php';
require __DIR__ . '/../includes/PHPMailer/SMTP.php';
require __DIR__ . '/../includes/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (session_status() === PHP_SESSION_NONE) session_start();

// ✅ Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  header('Location: ../admissions.php?error=Method+Not+Allowed');
  exit;
}

// ✅ CSRF Token validation
$token = $_POST['csrf_token'] ?? '';
if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
  header('Location: ../admissions.php?error=Invalid+session,+please+reload');
  exit;
}

// ✅ Sanitize input values
$full_name = trim($_POST['full_name'] ?? '');
$email     = trim($_POST['email'] ?? '');
$phone     = trim($_POST['phone'] ?? '');
$program   = trim($_POST['program'] ?? '');
$course    = trim($_POST['course'] ?? '');

// ✅ Validation
if (
  $full_name === '' ||
  !filter_var($email, FILTER_VALIDATE_EMAIL) ||
  $phone === '' ||
  $program === '' ||
  $course === ''
) {
  header('Location: ../admissions.php?error=Please+fill+all+fields+correctly');
  exit;
}

// ✅ Insert record into DB (corrected column name: full_name)
$stmt = $conn->prepare("INSERT INTO admissions (full_name, email, phone, program, course) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $full_name, $email, $phone, $program, $course);

if ($stmt->execute()) {
  // ✅ Send confirmation emails
  try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rupaliydv2526@gmail.com'; // Your Gmail
    $mail->Password = 'nccfezcrjmwpywfw'; // Your App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('your_email@gmail.com', 'SIWS Admissions');

    // === Send Email to Admin ===
    $mail->addAddress('admin@example.com', 'Admissions Admin');
    $mail->isHTML(true);
    $mail->Subject = 'New Application Submitted';
    $mail->Body = "
      <h3>New Admission Application</h3>
      <p><strong>Name:</strong> $full_name</p>
      <p><strong>Email:</strong> $email</p>
      <p><strong>Phone:</strong> $phone</p>
      <p><strong>Program:</strong> $program</p>
      <p><strong>Course:</strong> $course</p>
      <p><strong>Submitted:</strong> " . date('Y-m-d H:i:s') . "</p>
    ";
    $mail->send();

    // === Send Confirmation to Applicant ===
    $mail->clearAddresses();
    $mail->addAddress($email, $full_name);
    $mail->Subject = 'Your Application Has Been Received';
    $mail->Body = "
      <h3>Thank you for applying to SIWS</h3>
      <p>Dear $full_name,</p>
      <p>We’ve received your application for <strong>$course</strong> under the <strong>$program</strong> program.</p>
      <p>Here are the details you submitted:</p>
      <ul>
        <li><strong>Email:</strong> $email</li>
        <li><strong>Phone:</strong> $phone</li>
        <li><strong>Program:</strong> $program</li>
        <li><strong>Course:</strong> $course</li>
      </ul>
      <p>We’ll contact you soon with further updates.</p>
      <p>Regards,<br>SIWS Admissions Team</p>
    ";
    $mail->send();

    error_log("✅ Emails sent successfully to admin and applicant.");
  } catch (Exception $e) {
    error_log("Email failed: " . $mail->ErrorInfo);
  }

  // ✅ Redirect to success
  header('Location: ../admissions.php?submitted=1');
  exit;

} else {
  // ❌ Database insertion failed
  header('Location: ../admissions.php?error=Submission+failed,+try+again');
  exit;
}

$stmt->close();
$conn->close();
?>
