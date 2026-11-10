<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'db_connect.php';

$id = intval($_GET['id'] ?? 0);
if (!$id) { header("Location: dashboard.php"); exit(); }

$wedding = $conn->query("SELECT * FROM weddings WHERE id = $id")->fetch_assoc();
if (!$wedding) { header("Location: dashboard.php"); exit(); }

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bride_name  = $conn->real_escape_string($_POST['bride_name']);
    $groom_name  = $conn->real_escape_string($_POST['groom_name']);
    $wedding_date= $conn->real_escape_string($_POST['wedding_date']);
    $location    = $conn->real_escape_string($_POST['location']);
    $message     = $conn->real_escape_string($_POST['message']);

    $feature_photo = $wedding['feature_photo'];
    $cover_photo   = $wedding['cover_photo'];

    // Handle feature photo upload
    if (!empty($_FILES['feature_photo']['name'])) {
        $ext  = pathinfo($_FILES['feature_photo']['name'], PATHINFO_EXTENSION);
        $name = 'feature_' . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['feature_photo']['tmp_name'], "assets/uploads/$name");
        $feature_photo = $name;
    }

    // Handle cover photo upload
    if (!empty($_FILES['cover_photo']['name'])) {
        $ext  = pathinfo($_FILES['cover_photo']['name'], PATHINFO_EXTENSION);
        $name = 'cover_' . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['cover_photo']['tmp_name'], "assets/uploads/$name");
        $cover_photo = $name;
    }

    $conn->query("UPDATE weddings SET 
        bride_name='$bride_name', groom_name='$groom_name',
        wedding_date='$wedding_date', location='$location',
        message='$message', feature_photo='$feature_photo',
        cover_photo='$cover_photo'
        WHERE id=$id");

    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Edit Wedding — Veil & Varmala</title>
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
    .img-feature { width:80px; height:110px; object-fit:cover; border-radius:8px; }
    .img-cover   { width:140px; height:80px; object-fit:cover; border-radius:8px; }
  </style>
</head>
<body class="bg-gray-50 antialiased text-sm">
<div class="flex h-screen">

<?php include 'sidebar.php'; ?>

<main class="flex-1 p-8 overflow-auto">
  <div class="flex items-center gap-3 mb-6">
    <a href="dashboard.php" class="text-gray-400 hover:text-gray-700"><i class="fas fa-arrow-left"></i></a>
    <div>
      <h1 class="text-2xl font-semibold">Edit Wedding</h1>
      <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($wedding['bride_name']) ?> & <?= htmlspecialchars($wedding['groom_name']) ?></p>
    </div>
  </div>

  <div class="md-surface p-8 max-w-2xl mx-auto">
    <form method="POST" enctype="multipart/form-data" class="space-y-5">

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="text-xs text-gray-500 font-medium">Bride Name</label>
          <input type="text" name="bride_name" value="<?= htmlspecialchars($wedding['bride_name']) ?>"
            required class="w-full border border-gray-200 rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-gray-300">
        </div>
        <div>
          <label class="text-xs text-gray-500 font-medium">Groom Name</label>
          <input type="text" name="groom_name" value="<?= htmlspecialchars($wedding['groom_name']) ?>"
            required class="w-full border border-gray-200 rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-gray-300">
        </div>
      </div>

      <div>
        <label class="text-xs text-gray-500 font-medium">Wedding Date</label>
        <input type="date" name="wedding_date"
          value="<?= $wedding['wedding_date'] !== '0000-00-00' ? $wedding['wedding_date'] : '' ?>"
          class="w-full border border-gray-200 rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-gray-300">
      </div>

      <div>
        <label class="text-xs text-gray-500 font-medium">Location</label>
        <input type="text" name="location" value="<?= htmlspecialchars($wedding['location']) ?>"
          required class="w-full border border-gray-200 rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-gray-300">
      </div>

      <div>
        <label class="text-xs text-gray-500 font-medium">Message / Testimonial</label>
        <textarea name="message" rows="4"
          class="w-full border border-gray-200 rounded-md p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-gray-300"><?= htmlspecialchars($wedding['message'] ?? '') ?></textarea>
      </div>

      <!-- Feature Photo -->
      <div>
        <label class="text-xs text-gray-500 font-medium">Feature Photo (portrait)</label>
        <div class="mt-2 mb-2">
          <?php if($wedding['feature_photo']): ?>
            <img src="assets/uploads/<?= htmlspecialchars($wedding['feature_photo']) ?>"
              class="img-feature" id="featurePreviewImg" alt="Current feature">
            <p class="text-xs text-gray-400 mt-1">Current photo — upload a new one to replace</p>
          <?php else: ?>
            <div class="img-feature bg-gray-100 flex items-center justify-center text-gray-300 text-2xl" id="featurePreviewImg">
              <i class="fas fa-image"></i>
            </div>
          <?php endif; ?>
        </div>
        <input type="file" name="feature_photo" accept="image/*"
          onchange="previewImg(event,'featurePreviewImg','feature')"
          class="w-full border border-gray-200 rounded-md p-2 focus:outline-none">
      </div>

      <!-- Cover Photo -->
      <div>
        <label class="text-xs text-gray-500 font-medium">Cover Photo (landscape)</label>
        <div class="mt-2 mb-2">
          <?php if($wedding['cover_photo']): ?>
            <img src="assets/uploads/<?= htmlspecialchars($wedding['cover_photo']) ?>"
              class="img-cover" id="coverPreviewImg" alt="Current cover">
            <p class="text-xs text-gray-400 mt-1">Current photo — upload a new one to replace</p>
          <?php else: ?>
            <div class="img-cover bg-gray-100 flex items-center justify-center text-gray-300 text-2xl" id="coverPreviewImg">
              <i class="fas fa-image"></i>
            </div>
          <?php endif; ?>
        </div>
        <input type="file" name="cover_photo" accept="image/*"
          onchange="previewImg(event,'coverPreviewImg','cover')"
          class="w-full border border-gray-200 rounded-md p-2 focus:outline-none">
      </div>

      <div class="flex justify-between pt-2">
        <a href="dashboard.php" class="px-4 py-2 border rounded-md text-sm hover:bg-gray-50">Cancel</a>
        <button type="submit" class="btn-md text-sm">
          <i class="fas fa-save"></i> Save Changes
        </button>
      </div>
    </form>
  </div>
</main>
</div>

<script>
function previewImg(event, imgId, type) {
  const file = event.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = e => {
    const el = document.getElementById(imgId);
    if (el.tagName === 'IMG') {
      el.src = e.target.result;
    } else {
      const img = document.createElement('img');
      img.src = e.target.result;
      img.className = type === 'feature' ? 'img-feature' : 'img-cover';
      img.id = imgId;
      el.replaceWith(img);
    }
  };
  reader.readAsDataURL(file);
}
</script>
</body>
</html>