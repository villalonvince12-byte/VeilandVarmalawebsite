<?php
include 'db_connect.php';
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM weddings WHERE id=$id");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['success' => true, 'wedding' => $row]);
        exit;
    }
}
echo json_encode(['success' => false]);
?>
