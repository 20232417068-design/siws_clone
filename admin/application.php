<?php
require __DIR__ . '/../db/config.php';
require __DIR__ . '/../includes/auth.php';

$search = trim($_GET['q'] ?? '');
$program = trim($_GET['program'] ?? '');

$sql = "SELECT id, name, email, phone, program, course, submitted_at FROM admissions WHERE 1";
$params = [];
$types  = '';

if ($search !== '') {

 if ($_SESSION['admin_role'] !== 'superadmin') {
}
  $sql .= " AND (name LIKE CONCAT('%', ?, '%') OR email LIKE CONCAT('%', ?, '%') OR phone LIKE CONCAT('%', ?, '%'))";
  $params[] = $search; $params[] = $search; $params[] = $search;
  $types .= 'sss';
}
if ($program !== '') {
  $sql .= " AND program = ?";
  $params[] = $program;
  $types .= 's';
}
$sql .= " ORDER BY submitted_at DESC";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
  $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$res = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Applications</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="container">
  <section class="section">
    <h2>Applications</h2>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name'] ?? ''); ?> | <a href="logout.php">Logout</a></p>

    <form method="get" style="display:flex; gap:8px; margin:12px 0;">
      <input name="q" placeholder="Search name/email/phone" value="<?php echo htmlspecialchars($search); ?>">
      <select name="program">
        <option value="">All Programs</option>
        <option <?php if($program==='Undergraduate') echo 'selected'; ?>>Undergraduate</option>
        <option <?php if($program==='Postgraduate') echo 'selected'; ?>>Postgraduate</option>
        <option <?php if($program==='Doctoral') echo 'selected'; ?>>Doctoral</option>
      </select>
      <button class="btn">Filter</button>
    </form>

    <div class="list" style="overflow:auto;">
      <table style="width:100%; border-collapse:collapse;">
        <thead>
          <tr>
            <th style="text-align:left; padding:8px; border-bottom:1px solid #e5e7eb;">ID</th>
            <th style="text-align:left; padding:8px; border-bottom:1px solid #e5e7eb;">Name</th>
            <th style="text-align:left; padding:8px; border-bottom:1px solid #e5e7eb;">Email</th>
            <th style="text-align:left; padding:8px; border-bottom:1px solid #e5e7eb;">Phone</th>
            <th style="text-align:left; padding:8px; border-bottom:1px solid #e5e7eb;">Program</th>
            <th style="text-align:left; padding:8px; border-bottom:1px solid #e5e7eb;">Course</th>
            <th style="text-align:left; padding:8px; border-bottom:1px solid #e5e7eb;">Submitted</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($row = $res->fetch_assoc()): ?>
          <tr>
            <td style="padding:8px; border-bottom:1px solid #f1f5f9;"><?php echo $row['id']; ?></td>
            <td style="padding:8px; border-bottom:1px solid #f1f5f9;"><?php echo htmlspecialchars($row['name']); ?></td>
            <td style="padding:8px; border-bottom:1px solid #f1f5f9;"><?php echo htmlspecialchars($row['email']); ?></td>
            <td style="padding:8px; border-bottom:1px solid #f1f5f9;"><?php echo htmlspecialchars($row['phone']); ?></td>
            <td style="padding:8px; border-bottom:1px solid #f1f5f9;"><?php echo htmlspecialchars($row['program']); ?></td>
            <td style="padding:8px; border-bottom:1px solid #f1f5f9;"><?php echo htmlspecialchars($row['course']); ?></td>
            <td style="padding:8px; border-bottom:1px solid #f1f5f9;"><?php echo $row['submitted_at']; ?></td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </section>
</body>
</html>