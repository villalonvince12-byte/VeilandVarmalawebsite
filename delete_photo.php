<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success'=>false,'error'=>'Not authenticated']);
    exit;
}

include 'db_connect.php';
$data = json_decode(file_get_contents('php://input'), true);
$id = isset($data['id']) ? (int)$data['id'] : 0;

if (!$id) {
    echo json_encode(['success'=>false,'error'=>'Missing ID']);
    exit;
}

// get filename first
$stmt = $conn->prepare("SELECT filename FROM wedding_gallery WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$result) {
    echo json_encode(['success'=>false,'error'=>'Record not found']);
    exit;
}

// delete file from server
$filePath = __DIR__ . '/assets/gallery/' . $result['filename'];
if (file_exists($filePath)) unlink($filePath);

// delete record from DB permanently
$stmt = $conn->prepare("DELETE FROM wedding_gallery WHERE id = ?");
$stmt->bind_param('i', $id);
if ($stmt->execute()) {
    echo json_encode(['success'=>true]);
} else {
    echo json_encode(['success'=>false,'error'=>'DB error']);
}
$stmt->close();
?>
