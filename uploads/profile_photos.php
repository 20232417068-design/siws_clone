$targetDir = "../uploads/rupali.jpg/";
$targetFile = $targetDir . basename($_FILES["photo"]["name"]);

if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
    echo "✅ File uploaded!";
} else {
    echo "❌ Upload failed.";
}
<?php
$filename = "../uploads/rupali.jpg";
if (file_exists($filename)) {
    echo "✅ File exists: " . $filename;
} else {
    echo "❌ File not found.";
}
?>