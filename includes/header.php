<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$current = basename($_SERVER['PHP_SELF']);

// Detect if running on localhost (XAMPP)
$isLocalhost =
    strpos($_SERVER['HTTP_HOST'], 'localhost') !== false ||
    strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false;

// Force HTTPS on Render
if ($isLocalhost) {
    // Localhost → use HTTP and folder name
    $protocol = "http://";
    $baseURL = $protocol . $_SERVER['HTTP_HOST'] . "/siws_clone/";
} else {
    // Render → always HTTPS
    $protocol = "https://";
    $baseURL = $protocol . $_SERVER['HTTP_HOST'] . "/";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SIWS College (Autonomous)</title>

  <!-- CSS -->
  <link rel="stylesheet" href="<?php echo $baseURL; ?>assets/css/style.css">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?php echo $baseURL; ?>assets/images/siws-logo.png">
</head>

<body>
<header class="site-header">
  <div class="topbar">
    <img src="<?php echo $baseURL; ?>assets/images/siws-logo.png" alt="SIWS Logo" class="logo">
    <div class="topbar-text">
      <h1>SIWS College (Autonomous)</h1>
      <p>N.R. Swamy College of Commerce & Economics and Smt. Thirumalai College of Science</p>
      <p class="naac">NAAC Re-Accredited A Grade with 3.15 CGPA</p>
      <p class="meta">College Code 311 | AISHE CODE C-34030 | Wadala, Mumbai 400031</p>
      <a class="site-link" href="https://www.siwscollege.edu.in" target="_blank" rel="noopener">
        www.siwscollege.edu.in
      </a>
    </div>
  </div>

  <nav class="main-nav" id="mainNav">
    <button class="nav-toggle" aria-label="Toggle navigation" onclick="toggleNav()">☰</button>
    <ul>
      <li><a href="<?php echo $baseURL; ?>index.php" class="<?php echo $current==='index.php'?'active':'';?>">Home</a></li>
      <li><a href="<?php echo $baseURL; ?>about.php" class="<?php echo $current==='about.php'?'active':'';?>">About Us</a></li>
      <li><a href="<?php echo $baseURL; ?>academics.php" class="<?php echo $current==='academics.php'?'active':'';?>">Academics</a></li>
      <li><a href="<?php echo $baseURL; ?>admissions.php" class="<?php echo $current==='admissions.php'?'active':'';?>">Admissions</a></li>
      <li><a href="<?php echo $baseURL; ?>amenities.php" class="<?php echo $current==='amenities.php'?'active':'';?>">Amenities</a></li>
      <li><a href="<?php echo $baseURL; ?>student-corner.php" class="<?php echo $current==='student-corner.php'?'active':'';?>">Student Corner</a></li>
      <li><a href="<?php echo $baseURL; ?>contact.php" class="<?php echo $current==='contact.php'?'active':'';?>">Contact Us</a></li>
    </ul>
  </nav>
</header>

<main class="container">
