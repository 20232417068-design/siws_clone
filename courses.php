<?php include 'includes/header.php'; ?>
<main>
    <h2>Courses Offered</h2>
    <ul>
        <li>B.Sc. IT</li>
        <li>B.Com</li>
        <li>BMS</li>
        <li>M.Sc. IT</li>
    </ul>
</main>
<?php include 'includes/footer.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Undergraduate Programs – SIWS College</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .course-box {
      border: 1px solid #ccc;
      padding: 15px;
      margin: 15px 0;
      border-radius: 6px;
      background: #f9f9f9;
    }
    .course-box h3 {
      margin: 0;
      font-size: 18px;
    }
    .course-box p {
      margin: 5px 0;
    }
    .learn-more {
      color: #0077cc;
      cursor: pointer;
      text-decoration: underline;
    }
    .details {
      display: none;
      margin-top: 10px;
      font-size: 14px;
      color: #444;
    }
  </style>
</head>
<body class="container">
  <h2>Undergraduate Programs</h2>

  <?php
  $courses = [
    ["Bachelor of Science (Physics)", "3 years"],
    ["Bachelor of Science (Chemistry)", "3 years"],
    ["Bachelor of Science (Microbiology)", "3 years"],
    ["Bachelor of Commerce (Accountancy)", "3 years"],
    ["Bachelor of Commerce (Commerce)", "3 years"],
    ["Bachelor of Management Studies (B.M.S.) – A.I.C.T.E.", "3 years"],
    ["B.Com. (Management Studies)", "3 years"],
    ["B.Com. (Banking and Insurance)", "3 years"],
    ["B.Com. (Accounting and Finance)", "3 years"],
    ["B.Com. (Financial Markets)", "3 years"],
    ["B.Com. (Financial Management)", "3 years"],
    ["B.Sc. (Information Technology)", "3 years"]
  ];

  foreach ($courses as $course) {
    echo "<div class='course-box'>
            <h3>{$course[0]}</h3>
            <p><strong>Duration:</strong> {$course[1]}</p>
            <span class='learn-more'>Find Out What You’ll Learn</span>
            <div class='details'>This section can include syllabus overview, career prospects, and eligibility criteria.</div>
          </div>";
  }
  ?>

  <script>
    document.querySelectorAll('.learn-more').forEach(function(el) {
      el.addEventListener('click', function() {
        const details = this.nextElementSibling;
        details.style.display = details.style.display === 'block' ? 'none' : 'block';
      });
    });
  </script>
</body>
</html>