<?php
require __DIR__ . '/../db/config.php';

$id = $_POST['id'] ?? '';
$status = $_POST['status'] ?? '';

if ($id && $status) {
  $stmt = $conn->prepare("UPDATE admissions SET status = ? WHERE id = ?");
  $stmt->bind_param("si", $status, $id);
  if ($stmt->execute()) {
    echo 'success';
  } else {
    echo 'error';
  }
} else {
  echo 'invalid';
}