<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success'=>false, 'error'=>'Not authenticated']); exit;
}
include 'db_connect.php';

$wedding_id = isset($_POST['wedding_id']) ? (int)$_POST['wedding_id'] : 0;
$caption = isset($_POST['caption']) ? trim($_POST['caption']) : '';

if (!$wedding_id) { echo json_encode(['success'=>false,'error'=>'Missing wedding id']); exit; }

if (!isset($_FILES['photos'])) {
    echo json_encode(['success'=>false,'error'=>'No files']); exit;
}

$allowed = ['image/jpeg','image/png','image/webp','image/gif'];
$uploadDir = __DIR__ . '/assets/gallery/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

// determine current max order
$stmt = $conn->prepare("SELECT COALESCE(MAX(display_order),0) AS mx FROM wedding_gallery WHERE wedding_id = ?");
$stmt->bind_param('i', $wedding_id);
$stmt->execute();
$r = $stmt->get_result()->fetch_assoc();
$nextOrder = (int)$r['mx'] + 1;
$stmt->close();

$files = $_FILES['photos'];
$results = [];
$maxSize = 200 * 1024 * 1024; // 200MB

for ($i=0; $i < count($files['name']); $i++) {
    if ($files['error'][$i] !== UPLOAD_ERR_OK) {
        $results[] = ['file'=>$files['name'][$i],'status'=>'error','msg'=>'upload error'];
        continue;
    }

    // Check size
    if ($files['size'][$i] > $maxSize) {
        $results[] = ['file'=>$files['name'][$i],'status'=>'error','msg'=>'file too large'];
        continue;
    }

    $tmp = $files['tmp_name'][$i];
    $type = mime_content_type($tmp);
    if (!in_array($type, $allowed)) {
        $results[] = ['file'=>$files['name'][$i],'status'=>'error','msg'=>'invalid file type'];
        continue;
    }

    // unique filename
    $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
    $newName = uniqid('g_', true) . '.' . $ext;
    $dest = $uploadDir . $newName;
    if (!move_uploaded_file($tmp, $dest)) {
        $results[] = ['file'=>$files['name'][$i],'status'=>'error','msg'=>'move failed'];
        continue;
    }

    // insert DB
    $stmt = $conn->prepare("INSERT INTO wedding_gallery (wedding_id, filename, caption, display_order) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('issi', $wedding_id, $newName, $caption, $nextOrder);
    if ($stmt->execute()) {
        $results[] = ['file'=>$files['name'][$i],'status'=>'ok','id'=>$stmt->insert_id];
        $nextOrder++;
    } else {
        @unlink($dest);
        $results[] = ['file'=>$files['name'][$i],'status'=>'error','msg'=>'db error'];
    }
    $stmt->close();
}


echo json_encode(['success'=>true, 'results'=>$results]);
