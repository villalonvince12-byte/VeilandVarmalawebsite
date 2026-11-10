<?php
session_start();
if (!isset($_SESSION['user_id'])) { http_response_code(403); exit(); }
include 'db_connect.php';
$id = intval($_POST['id'] ?? 0);
if ($id > 0) {
    $conn->query("UPDATE inquiries SET seen = 1 WHERE id = $id");
}
echo "ok";