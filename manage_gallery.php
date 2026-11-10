<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'db_connect.php';

$id = intval($_GET['id'] ?? 0);
if (!$id) { header("Location: dashboard.php"); exit(); }

$wedding = $conn->query("SELECT * FROM weddings WHERE id = $id")->fetch_assoc();
if (!$wedding) { header("Location: dashboard.php"); exit(); }

// Handle photo upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['photos']['name'][0])) {
    foreach ($_FILES['photos']['tmp_name'] as $i => $tmp) {
        if ($_FILES['photos']['error'][$i] !== UPLOAD_ERR_OK) continue;
        $ext  = pathinfo($_FILES['photos']['name'][$i], PATHINFO_EXTENSION);
        $name = 'gallery_' . uniqid() . '.' . $ext;
        move_uploaded_file($tmp, "assets/uploads/$name");
        $safe = $conn->real_escape_string($name);
        $conn->query("INSERT INTO gallery (wedding_id, filename) VALUES ($id, '$safe')");
    }
    header("Location: manage_gallery.php?id=$id");
    exit();
}

// Handle delete single photo
if (isset($_GET['delete_photo'])) {
    $pid = intval($_GET['delete_photo']);
    $photo = $conn->query("SELECT * FROM gallery WHERE id = $pid AND wedding_id = $id")->fetch_assoc();
    if ($photo) {
        $path = __DIR__ . '/assets/uploads/' . $photo['filename'];
        if (file_exists($path)) unlink($path);
        $conn->query("DELETE FROM gallery WHERE id = $pid");
    }
    header("Location: manage_gallery.php?id=$id");
    exit();
}

$photos = $conn->query("SELECT * FROM gallery WHERE wedding_id = $id ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Gallery — Veil & Varmala</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --md-surface:#ffffff; --md-on-surface:#0b0b0b;
      --md-surface-2:#f3f3f3; --md-divider:#e6e6e6;
      --md-elevation-2:0 4px 8px rgba(11,11,11,.08),0 2px 4px rgba(11,11,11,.06);
      --md-radius:12px;
    }
    .md-surface { background:var(--md-surface); border-radius:var(--md-radius); box-shadow:var(--md-elevation-2); }
    .sidebar a { display:flex; align-items:center; gap:.75rem; padding:.6rem .9rem; border-radius:8px; color:var(--md-on-surface); }
    .sidebar a:hover { background:var(--md-surface-2); }
    .btn-md { background:#0b0b0b; color:#fff; padding:8px 14px; border-radius:10px; display:inline-flex; gap:8px; align-items:center; font-weight:600; cursor:pointer; }
    .btn-md:hover { background:#333; }
    .photo-card { position:relative; aspect-ratio:1; overflow:hidden; border-radius:10px; background:#f3f3f3; }
    .photo-card img { width:100%; height:100%; object-fit:cover; display:block; }
    .photo-card .delete-btn {
      position:absolute; top:6px; right:6px;
      background:rgba(0,0,0,.6); color:#fff;
      border-radius:50%; width:28px; height:28px;
      display:flex; align-items:center; justify-content:center;
      font-size:.75rem; opacity:0; transition:opacity .2s; cursor:pointer;
      text-decoration:none;
    }
    .photo-card:hover .delete-btn { opacity:1; }
  </style>
</head>
<body class="bg-gray-50 antialiased text-sm">
<div class="flex h-screen">

<?php include 'sidebar.php'; ?>

<main class="flex-1 p-8 overflow-auto">
  <div class="flex items-center gap-3 mb-6">
    <a href="dashboard.php" class="text-gray-400 hover:text-gray-700"><i class="fas fa-arrow-left"></i></a>
    <div>
      <h1 class="text-2xl font-semibold">Manage Gallery</h1>
      <p class="text-sm text-gray-500 mt-1">
        <?= htmlspecialchars($wedding['bride_name']) ?> &amp; <?= htmlspecialchars($wedding['groom_name']) ?>
      </p>
    </div>
  </div>

  <!-- Upload Form -->
  <div class="md-surface p-6 mb-6 max-w-xl">
    <h2 class="font-semibold mb-3">Upload Photos</h2>
    <form method="POST" enctype="multipart/form-data" class="flex flex-col gap-3">
      <input type="file" name="photos[]" accept="image/*" multiple required
        onchange="previewNew(event)"
        class="w-full border border-gray-200 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
      <div id="newPreview" class="grid grid-cols-4 gap-2"></div>
      <div class="flex justify-end">
        <button type="submit" class="btn-md text-sm">
          <i class="fas fa-upload"></i> Upload
        </button>
      </div>
    </form>
  </div>

  <!-- Gallery Grid -->
  <div class="md-surface p-6">
    <h2 class="font-semibold mb-4">
      Gallery Photos
      <span class="text-gray-400 font-normal text-xs ml-2"><?= $photos->num_rows ?> photo<?= $photos->num_rows != 1 ? 's' : '' ?></span>
    </h2>
    <?php if ($photos->num_rows === 0): ?>
      <div class="text-center text-gray-400 py-12">
        <i class="fas fa-images text-4xl mb-3"></i>
        <p>No gallery photos yet. Upload some above!</p>
      </div>
    <?php else: ?>
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        <?php while ($photo = $photos->fetch_assoc()): ?>
          <div class="photo-card group">
            <img src="assets/uploads/<?= htmlspecialchars($photo['filename']) ?>" alt="gallery photo" loading="lazy">
            <a href="manage_gallery.php?id=<?= $id ?>&delete_photo=<?= $photo['id'] ?>"
               onclick="return confirm('Delete this photo?')"
               class="delete-btn">
              <i class="fas fa-trash"></i>
            </a>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>
</main>
</div>

<script>
function previewNew(event) {
  const container = document.getElementById('newPreview');
  container.innerHTML = '';
  Array.from(event.target.files).forEach(file => {
    const reader = new FileReader();
    reader.onload = e => {
      container.innerHTML += `<img src="${e.target.result}" class="w-full h-20 object-cover rounded-lg">`;
    };
    reader.readAsDataURL(file);
  });
}
</script>
</body>
</html>