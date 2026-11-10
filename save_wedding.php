<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php'; // your mysqli connection to veilandvarmala

// Collect inputs
$bride_name   = $_POST['bride_name'] ?? '';
$groom_name   = $_POST['groom_name'] ?? '';
$wedding_date = $_POST['wedding_date'] ?? '';
$location     = $_POST['location'] ?? '';
$message      = $_POST['message'] ?? '';

// 📂 Save to assets/image (make sure folder exists)
$uploadDir = __DIR__ . "/assets/image/"; // absolute path
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Helper function to rename and move file
function uploadFile($file, $prefix, $uploadDir) {
    if (!empty($file['name'])) {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = uniqid($prefix . "_", true) . "." . $extension;
        $targetPath = $uploadDir . $newName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $newName; // store only filename in DB
        }
    }
    return null;
}

// Handle file uploads
$featurePhoto = uploadFile($_FILES['feature_photo'], "feature", $uploadDir);
$coverPhoto   = uploadFile($_FILES['cover_photo'], "cover", $uploadDir);

// Insert into weddings table
$stmt = $conn->prepare("
    INSERT INTO weddings (bride_name, groom_name, wedding_date, location, message, feature_photo, cover_photo)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("sssssss", $bride_name, $groom_name, $wedding_date, $location, $message, $featurePhoto, $coverPhoto);

if ($stmt->execute()) {
    echo "<script>alert('Wedding added successfully!'); window.location.href='portfolio_management.php';</script>";
} else {
    echo "<script>alert('Error saving wedding: " . $stmt->error . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
