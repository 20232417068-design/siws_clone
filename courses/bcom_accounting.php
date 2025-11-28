<?php
$course = [
  "title" => "Bachelor of Science (Physics)",
  "duration" => "3 Years (6 Semesters)",
  "intake" => "60",
  "eligibility" => "Std. XII Science (HSC) from any statutory board",
  "semesters" => [
    "Semester I" => [
      ["Major", "Introduction to Mechanics and Optics", 2, 2],
      ["Major Practical", "Physics Major Practical – I", 2, 2],
      ["Minor", "General Chemistry – I", 2, 2],
      ["Minor Practical", "Chemistry Minor Practical – I", 2, 2],
      ["SEC", "Basic Instrumentation Skills", 2, 2],
      ["AEC", "Communication Skills in English – I", 2, 2],
      ["VEC", "Energy Physics – I", 2, 2],
      ["OE I", "Entrepreneurship Management – I", 2, 2],
      ["OE II", "Introduction to Advertising", 2, 2],
      ["IKS", "Indian Knowledge System", 2, 2],
      ["CC", "NSS / DLLE / Yoga / Fine Arts", 2, 2]
    ]
    // Add Semester II to VI similarly
  ],
  "faculty" => [
    "Mrs. Anagha Bapat – Head, Department of Physics",
    "Mrs. Mariamma Danny – Associate Professor",
    "Dr. Sandeep Sudhakar Vansutre – Assistant Professor",
    "Ms. Ramya Rao – Assistant Professor"
  ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $course['title'] ?> – SIWS College</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    body { font-family: Arial; padding: 20px; }
    h2, h3 { color: #003366; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f0f0f0; }
    .section { margin-bottom: 30px; }
  </style>
</head>
<body>
  <h2><?= $course['title'] ?></h2>
  <div class="section">
    <p><strong>Duration:</strong> <?= $course['duration'] ?></p>
    <p><strong>Intake:</strong> <?= $course['intake'] ?></p>
    <p><strong>Eligibility:</strong> <?= $course['eligibility'] ?></p>
  </div>

  <?php foreach ($course['semesters'] as $sem => $subjects): ?>
    <div class="section">
      <h3><?= $sem ?> – Course Structure</h3>
      <table>
        <thead>
          <tr>
            <th>Course Type</th>
            <th>Title</th>
            <th>Credits</th>
            <th>Lectures/Week</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($subjects as $sub): ?>
            <tr>
              <td><?= $sub[0] ?></td>
              <td><?= $sub[1] ?></td>
              <td><?= $sub[2] ?></td>
              <td><?= $sub[3] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endforeach; ?>

  <div class="section">
    <h3>Faculty</h3>
    <ul>
      <?php foreach ($course['faculty'] as $f): ?>
        <li><?= $f ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</body>
</html>