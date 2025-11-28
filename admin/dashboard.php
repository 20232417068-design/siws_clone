<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/../db/config.php';
require __DIR__ . '/includes/auth.php'; // Protect with session

$stmt = $conn->prepare("SELECT id, name, email, phone, program, course, status FROM admissions ORDER BY id DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <h2>Applications Dashboard</h2>
  <input type="text" id="search" placeholder="Search by name or email">
  <table border="1" width="100%" id="appTable">
    <thead>
      <tr>
        <th>Name</th><th>Email</th><th>Phone</th><th>Program</th><th>Course</th><th>Status</th><th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr data-id="<?= $row['id'] ?>">
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['program']) ?></td>
        <td><?= htmlspecialchars($row['course']) ?></td>
        <td class="status"><?= htmlspecialchars($row['status']) ?></td>
        <td>
          <select class="status-select">
            <option value="Pending">Pending</option>
            <option value="Approved">Approved</option>
            <option value="Rejected">Rejected</option>
          </select>
          <button class="update-btn">Update</button>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <script>
    $('#search').on('keyup', function() {
      var value = $(this).val().toLowerCase();
      $('#appTable tbody tr').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });

    $('.update-btn').on('click', function() {
      var row = $(this).closest('tr');
      var id = row.data('id');
      var newStatus = row.find('.status-select').val();

      $.post('update_status.php', { id: id, status: newStatus }, function(response) {
        if (response === 'success') {
          row.find('.status').text(newStatus);
          alert('Status updated!');
        } else {
          alert('Failed to update status.');
        }
      });
    });
  </script>
</body>
</html>