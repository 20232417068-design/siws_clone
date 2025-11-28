<?php
// Start session for CSRF protection
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Block direct GET access
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../contact?error=Invalid+Request");
    exit;
}

// Validate CSRF token
if (!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
    header("Location: ../contact?error=Session+Expired,+please+try+again");
    exit;
}

// Sanitize inputs
$name         = trim($_POST['name'] ?? '');
$contact      = trim($_POST['contact'] ?? '');
$email        = trim($_POST['email'] ?? '');
$passed_from  = trim($_POST['passed_from'] ?? '');
$year         = trim($_POST['year'] ?? '');
$comments     = trim($_POST['comments'] ?? '');
$newsletter   = isset($_POST['newsletter']) ? "Yes" : "No";

// Basic validation
if ($name === '' || $contact === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../contact?error=Invalid+form+data");
    exit;
}

// PHPMailer Files
require __DIR__ . '/../includes/PHPMailer/PHPMailer.php';
require __DIR__ . '/../includes/PHPMailer/SMTP.php';
require __DIR__ . '/../includes/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "yourgmail@gmail.com";        // CHANGE THIS
    $mail->Password = "your_app_password_here";     // CHANGE THIS
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    // Email to SIWS Admin
    $mail->setFrom("yourgmail@gmail.com", "SIWS Website Contact Form");
    $mail->addAddress("siws@siwscollege.edu.in", "SIWS Office");

    $mail->isHTML(true);
    $mail->Subject = "New Contact Form Message Received";
    $mail->Body = "
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Contact:</strong> $contact</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Passed Out From:</strong> $passed_from</p>
        <p><strong>Year:</strong> $year</p>
        <p><strong>Newsletter Signup:</strong> $newsletter</p>
        <p><strong>Comments:</strong><br>$comments</p>
        <p><strong>Submitted On:</strong> " . date("Y-m-d H:i:s") . "</p>
    ";
    $mail->send();

    // Confirmation email to user
    $mail->clearAddresses();
    $mail->addAddress($email, $name);
    $mail->Subject = "Thank you for contacting SIWS College";
    $mail->Body = "
        <h2>We Received Your Message</h2>
        <p>Dear $name,</p>
        <p>Thank you for contacting SIWS College. Our team will reply within 24 hours.</p>
        <p>Regards,<br>SIWS Team</p>
    ";
    $mail->send();

} catch (Exception $e) {
    error_log("Contact form email error: " . $mail->ErrorInfo);
}

// Redirect back
header("Location: ../contact?submitted=1");
exit;
?>
