<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'db_connect.php';

$id = intval($_GET['id'] ?? 0);
if (!$id) { header("Location: dashboard.php"); exit(); }

// Get the wedding so we can delete its photos
$result = $conn->query("SELECT * FROM weddings WHERE id = $id");
if (!$result) { header("Location: dashboard.php"); exit(); }
$wedding = $result->fetch_assoc();
if (!$wedding) { header("Location: dashboard.php"); exit(); }

// Delete feature photo file
if (!empty($wedding['feature_photo'])) {
    $path = __DIR__ . '/assets/uploads/' . $wedding['feature_photo'];
    if (file_exists($path)) unlink($path);
}

// Delete cover photo file
if (!empty($wedding['cover_photo'])) {
    $path = __DIR__ . '/assets/uploads/' . $wedding['cover_photo'];
    if (file_exists($path)) unlink($path);
}

// Delete gallery photos from wedding_gallery table
$stmt = $conn->prepare("SELECT filename FROM wedding_gallery WHERE wedding_id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$gallery = $stmt->get_result();
while ($photo = $gallery->fetch_assoc()) {
    $path = __DIR__ . '/assets/gallery/' . $photo['filename'];
    if (file_exists($path)) unlink($path);
}
$stmt->close();

$deleteGallery = $conn->prepare("DELETE FROM wedding_gallery WHERE wedding_id = ?");
$deleteGallery->bind_param('i', $id);
$deleteGallery->execute();
$deleteGallery->close();

// Delete the wedding record
$conn->query("DELETE FROM weddings WHERE id = $id");

$conn->close();
header("Location: dashboard.php");
exit();