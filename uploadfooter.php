<?php
// uploadfooter.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';

// ----------------- HANDLE ADD IMAGE -----------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['footer_image'])) {
    $uploadDir = "uploads/"; // Ensure this directory exists and is writable
    $fileName = basename($_FILES['footer_image']['name']);
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['footer_image']['tmp_name'], $targetPath)) {
        $stmt = $conn->prepare("INSERT INTO footer (image_name, date_created) VALUES (?, NOW())");
        $stmt->bind_param("s", $fileName);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: uploadfooter.php");
    exit();
}

// ----------------- HANDLE DELETE IMAGE -----------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = (int)$_POST['delete_id'];

    // get filename
    $stmt = $conn->prepare("SELECT image_name FROM footer WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($fileName);
    $stmt->fetch();
    $stmt->close();

    if (!empty($fileName) && file_exists("uploads/$fileName")) {
        unlink("uploads/$fileName"); // remove from folder
    }

    $stmt = $conn->prepare("DELETE FROM footer WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: uploadfooter.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Dashboard — Veil & Varmala</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css"/>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

  <style>
    :root{
      --md-surface: #ffffff;
      --md-on-surface: #0b0b0b;
      --md-surface-2: #f3f3f3;
      --md-divider: #e6e6e6;
      --md-muted: #6b6b6b;
      --md-elevation-1: 0 1px 3px rgba(11,11,11,0.06), 0 1px 2px rgba(11,11,11,0.04);
      --md-elevation-2: 0 4px 8px rgba(11,11,11,0.08), 0 2px 4px rgba(11,11,11,0.06);
      --md-radius: 12px;
    }
    .md-surface { background: var(--md-surface); color: var(--md-on-surface); border-radius: var(--md-radius); box-shadow: var(--md-elevation-1);}
    table.dataTable thead th { color:var(--md-muted); font-weight:600; text-transform:uppercase; font-size:0.75rem; text-align:center; }
    table.dataTable td { padding:12px 16px; vertical-align:middle; border-bottom:1px solid var(--md-divider); text-align:center; }
    table.dataTable td img { display:block; margin:auto; max-height:80px; object-fit:contain; border-radius:8px; }
    .btn-md { background:#0b0b0b; color:#fff; padding:8px 12px; border-radius:10px; font-weight:600; }
    .btn-md:hover { background:#111; }
    .modal-backdrop { background: rgba(0,0,0,0.55); }

    /* ✅ Sidebar styles kept */
    .sidebar-logo { font-weight:700; letter-spacing:0.02em; font-size:1.05rem; }
    .sidebar a { display:flex; align-items:center; gap:0.75rem; padding:0.6rem 0.9rem; border-radius:8px; color:var(--md-on-surface); }
    .sidebar a .fa-fw { width:18px; text-align:center; }
    .sidebar a:hover { background: var(--md-surface-2); color:var(--md-on-surface); }
  </style>
</head>
<body class="bg-gray-50 antialiased text-sm">

<div class="flex h-screen">
  <?php include 'sidebar.php'; ?>

  <main class="flex-1 p-8 overflow-auto">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold">Footer Images Management</h1>
      <button onclick="openAddModal()" class="btn-md">
        <i class="fas fa-plus"></i> Add Image
      </button>
    </div>

    <div class="md-surface p-6 md-elev-2">
      <h3 class="text-base font-semibold mb-4">Image List</h3>
      <div class="overflow-x-auto">
        <table id="footerTable" class="min-w-full">
          <thead>
            <tr>
              <th>ID</th>
              <th>Filename</th>
              <th>Image</th>
              <th>Date Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $result = $conn->query("SELECT * FROM footer ORDER BY id DESC");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . (int)$row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['image_name']) . "</td>";
                echo "<td>";
                if (!empty($row['image_name'])) {
                    echo "<img src='uploads/" . htmlspecialchars($row['image_name']) . "'>";
                }
                echo "</td>";
                echo "<td>" . htmlspecialchars($row['date_created']) . "</td>";
                echo "<td>
                        <form method='POST' onsubmit='return confirm(\"Delete this image?\")' class='inline'>
                          <input type='hidden' name='delete_id' value='" . (int)$row['id'] . "'>
                          <button type='submit' 
                            class='px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-full shadow hover:bg-red-700'>
                            <i class='fas fa-trash mr-1'></i> Delete
                          </button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>

<!-- ADD MODAL -->
<div id="addModal" class="hidden fixed inset-0 z-50 flex items-center justify-center modal-backdrop">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 md-elev-2">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg font-semibold">Add Footer Image</h2>
      <button onclick="closeAddModal()" class="text-gray-600"><i class="fas fa-times"></i></button>
    </div>
    <form method="POST" enctype="multipart/form-data" class="space-y-4">
      <div>
        <label class="text-xs text-gray-600">Upload Image</label>
        <input type="file" name="footer_image" accept="image/*" required class="w-full border border-gray-200 rounded-md p-2">
      </div>
      <div class="flex justify-end gap-3">
        <button type="button" onclick="closeAddModal()" class="px-4 py-2 border rounded-md">Cancel</button>
        <button type="submit" class="px-4 py-2 btn-md">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
$(document).ready(function () {
  $('#footerTable').DataTable({
    pageLength: 10,
    ordering: true,
    columnDefs: [
      { orderable: false, targets: [2,4] }
    ]
  });
});

function openAddModal(){ document.getElementById('addModal').classList.remove('hidden'); }
function closeAddModal(){ document.getElementById('addModal').classList.add('hidden'); }
</script>

</body>
</html>
