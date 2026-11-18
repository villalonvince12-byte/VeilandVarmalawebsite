<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}
require 'db_connect.php';

$data = json_decode(file_get_contents('php://input'), true);
$ordered = isset($data['ordered']) && is_array($data['ordered']) ? $data['ordered'] : [];
if (!$ordered) {
    echo json_encode(['success' => false, 'error' => 'No photos supplied']);
    exit;
}

$stmt = $conn->prepare('UPDATE wedding_gallery SET display_order = ? WHERE id = ?');
foreach ($ordered as $item) {
    $id = isset($item['id']) ? (int) $item['id'] : 0;
    $order = isset($item['order']) ? (int) $item['order'] : 0;
    if ($id > 0 && $order >= 0) {
        $stmt->bind_param('ii', $order, $id);
        $stmt->execute();
    }
}
$stmt->close();
$conn->close();
echo json_encode(['success' => true]);
