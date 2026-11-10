<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';

$wedding_id = isset($_GET['wedding_id']) ? (int)$_GET['wedding_id'] : 0;
if (!$wedding_id) {
    echo "Missing wedding id";
    exit;
}

// fetch wedding info
$stmt = $conn->prepare("SELECT id, bride_name, groom_name FROM weddings WHERE id = ?");
$stmt->bind_param('i', $wedding_id);
$stmt->execute();
$res = $stmt->get_result();
$wedding = $res->fetch_assoc();
$stmt->close();

if (!$wedding) {
    echo "Wedding not found";
    exit;
}

// fetch existing gallery images
$stmt = $conn->prepare("SELECT id, filename, caption, display_order FROM wedding_gallery WHERE wedding_id = ? ORDER BY display_order ASC, id ASC");
$stmt->bind_param('i', $wedding_id);
$stmt->execute();
$gallery_res = $stmt->get_result();
$gallery = $gallery_res->fetch_all(MYSQLI_ASSOC);
$stmt->close();
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
    /* ---------- Material (tech-preview) monochrome tokens ---------- */
    :root{
      --md-surface: #ffffff;
      --md-on-surface: #0b0b0b;
      --md-surface-2: #f3f3f3;  /* dirty white for hover/background */
      --md-divider: #e6e6e6;
      --md-muted: #6b6b6b;
      --md-elevation-1: 0 1px 3px rgba(11,11,11,0.06), 0 1px 2px rgba(11,11,11,0.04);
      --md-elevation-2: 0 4px 8px rgba(11,11,11,0.08), 0 2px 4px rgba(11,11,11,0.06);
      --md-radius: 12px;
      --md-radius-sm: 8px;
    }

    /* Material-like surface */
    .md-surface {
      background: var(--md-surface);
      color: var(--md-on-surface);
      border-radius: var(--md-radius);
      box-shadow: var(--md-elevation-1);
    }
    .md-surface-2 {
      background: var(--md-surface-2);
    }

    .md-elev-1 { box-shadow: var(--md-elevation-1); }
    .md-elev-2 { box-shadow: var(--md-elevation-2); }

    /* Sidebar specific */
    .sidebar-logo { font-weight:700; letter-spacing:0.02em; font-size:1.05rem; }
    .sidebar a { display:flex; align-items:center; gap:0.75rem; padding:0.6rem 0.9rem; border-radius:8px; color:var(--md-on-surface); }
    .sidebar a .fa-fw { width:18px; text-align:center; }
    .sidebar a:hover { background: var(--md-surface-2); color:var(--md-on-surface); }

    /* DataTables overrides for a clean material look */
    table.dataTable { border-collapse: collapse !important; width:100% !important; }
    table.dataTable thead th { background: transparent; color:var(--md-muted); font-weight:600; text-transform:uppercase; font-size:0.75rem; letter-spacing:0.08em; text-align: center;}
    table.dataTable td { padding:12px 16px; vertical-align:middle; border-bottom:1px solid var(--md-divider); }
    /* horizontal center for any image in the table */
table.dataTable td img,
table.dataTable td .img-feature,
table.dataTable td .img-cover {
  display: block;
  margin-left: auto;
  margin-right: auto;
  /* keep their fixed size & object-fit */
  max-width: 100%;
  height: auto;
}
/* add this for cells that only hold an image */
table.dataTable td.centered-cell {
  display: flex;
  align-items: center;    /* vertical center */
  justify-content: center;/* horizontal center */
  gap: 8px;
}

    table.dataTable tbody tr:hover { background: var(--md-surface-2); }
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
      padding:8px 10px; border-radius:8px; border:1px solid var(--md-divider); background: #fff;
    }

    /* Small helpers */
    .img-feature { width:64px; height:88px; object-fit:cover; border-radius:8px; }
    .img-cover { width:120px; height:68px; object-fit:cover; border-radius:8px; }
    .btn-md {
      background:#0b0b0b; color:#fff; padding:8px 12px; border-radius:10px; display:inline-flex; gap:8px; align-items:center; font-weight:600;
    }
    .btn-md:hover { background:#111; }

    /* Modal backdrop */
    .modal-backdrop { background: rgba(0,0,0,0.55); }

    /* Divide-y for tbody styled with tailwind */
    tbody.divide-y > tr > * { border-bottom: 1px solid var(--md-divider); }

    /* subtle ripple effect */
    .ripple { position:relative; overflow:hidden; }
    .ripple:after {
      content: ""; position: absolute; width: 0; height: 0; background: rgba(0,0,0,0.08);
      display:block; border-radius:50%; transform: scale(0); transition: width 0.45s ease, height 0.45s ease, transform 0.45s ease, opacity 0.8s;
      opacity:0;
    }
    .ripple:active:after { width:300px; height:300px; transform: translate(-50%,-50%) scale(1); left:50%; top:50%; opacity:1; transition:0s; }
  </style>
</head>
<body class="bg-gray-50 antialiased text-sm">

  <div class="flex h-screen">

<?php include 'sidebar.php'; ?>

    <!-- MAIN -->
    <main class="flex-1 p-8 overflow-auto">
      <style>
    :root{
      --md-surface:#fff; --md-divider:#e6e6e6; --md-muted:#6b6b6b;
    }
    .img-thumb { width:120px; height:80px; object-fit:cover; border-radius:8px; }
    .preview-thumb { width:120px; height:80px; object-fit:cover; border-radius:8px; }
    .drop-hint { border:2px dashed var(--md-divider); padding:18px; border-radius:12px; }
    .ghost { opacity:0.5; }
  </style>
</head>
<body class="bg-gray-50 p-6 text-sm">


<main class="max-w-6xl mx-auto">
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold"><?=htmlspecialchars($wedding['bride_name'])?> & <?=htmlspecialchars($wedding['groom_name'])?></h1>
      <p class="text-gray-600">Manage gallery for this couple — drag to reorder, upload multiple photos with preview.</p>
    </div>
    <div>
      <a href="portfolio_management.php" class="px-3 py-2 border rounded">Back to weddings</a>
    </div>
  </div>
  <!-- UPLOAD area -->
  <div class="md-surface p-6 md-elev-1 mb-6">
    <h3 class="font-semibold mb-3">Add Photos</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="col-span-2">
        <label class="block text-xs text-gray-600 mb-1">Select photos (multiple):</label>
        <input id="photosInput" type="file" accept="image/*" multiple class="block w-full border border-gray-200 rounded p-2" />
        <p class="text-xs text-gray-500 mt-2">Remove any preview using the ✖.</p>

        <div id="previewArea" class="mt-4 grid grid-cols-3 gap-3"></div>
      </div>

      <div>
        <label class="block text-xs text-gray-600 mb-1">Upload options</label>
        <input id="captionInput" type="text" placeholder="Optional caption for all uploaded images" class="w-full border border-gray-200 rounded p-2 mb-3"/>
        <button id="uploadBtn" class="px-4 py-2 bg-green-600 text-white rounded">Upload Selected</button>
        <div id="uploadStatus" class="mt-3 text-sm text-gray-600"></div>
      </div>
    </div>
  </div>
<div class="md-surface p-6 md-elev-1">
  <h3 class="font-semibold mb-3">Existing Photos</h3>

  <!-- existing gallery list (sortable) -->
  <div id="existingList" class="grid grid-cols-3 gap-4">
    <?php if (!empty($gallery)): ?>
      <?php foreach ($gallery as $g): ?>
        <div class="rounded-md p-2 bg-white shadow-sm flex items-center gap-3" data-id="<?= (int)$g['id'] ?>">
          <img src="<?= 'assets/gallery/'.htmlspecialchars($g['filename']) ?>" class="img-thumb">
          <div class="flex-1">
            <div class="text-xs text-gray-500">
              <?= $g['filename'] ?> • Order: 
              <span class="order-label"><?= (int)$g['display_order'] ?></span>
            </div>
            <div class="text-sm truncate"><?= htmlspecialchars($g['caption'] ?: '') ?></div>
       <div class="mt-2 flex gap-2">
    <button 
        data-id="<?= (int)$g['id'] ?>" 
        class="delete-btn px-2 py-1 text-xs bg-red-600 text-white rounded"
    >
        Delete
    </button>
</div>

          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-span-3 text-center py-10 text-gray-500 border-2 border-dashed rounded">
        <i class="fa fa-image text-3xl mb-2 text-gray-400"></i>
      <p class="text-gray-600 italic">No photos have been uploaded yet. Please use the upload section above to add images.</p>

      </div>
    <?php endif; ?>
  </div>
</div>



</main>

<script>
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.dataset.id;
        if (!confirm('Are you sure you want to permanently delete this photo? This cannot be undone.')) return;

        fetch('delete_photo.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({id})
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Photo permanently deleted ✅');
                // Refresh the page
                location.reload();
            } else {
                alert('Error: ' + data.error);
            }
        });
    });
});

/* ----- helper to create preview card ----- */
function createPreviewCard(file, idx) {
  const wrapper = document.createElement('div');
  wrapper.className = 'rounded-md p-2 bg-white shadow-sm flex flex-col items-center gap-2 preview-card';
  wrapper.dataset.index = idx;

  const img = document.createElement('img');
  img.className = 'preview-thumb';
  img.alt = file.name;

  const name = document.createElement('div');
  name.className = 'text-xs truncate w-full text-center';
  name.textContent = file.name;

  const btnRow = document.createElement('div');
  btnRow.className = 'flex gap-2';

  const removeBtn = document.createElement('button');
  removeBtn.type = 'button';
  removeBtn.className = 'px-2 py-1 text-xs border rounded';
  removeBtn.textContent = '✖';
  removeBtn.onclick = () => wrapper.remove();

  btnRow.appendChild(removeBtn);
  wrapper.appendChild(img);
  wrapper.appendChild(name);
  wrapper.appendChild(btnRow);

  const reader = new FileReader();
  reader.onload = e => img.src = e.target.result;
  reader.readAsDataURL(file);

  return wrapper;
}

/* ----- preview selected files and make sortable ----- */
const photosInput = document.getElementById('photosInput');
const previewArea = document.getElementById('previewArea');
let selectedFiles = []; // will store File objects

photosInput.addEventListener('change', (e) => {
  const files = Array.from(e.target.files);
  // append to selectedFiles
  files.forEach(f => selectedFiles.push(f));
  renderPreviews();
});

function renderPreviews() {
  previewArea.innerHTML = '';
  selectedFiles.forEach((file, i) => {
    const card = createPreviewCard(file, i);
    // remove button handler already on card; but also remove from selectedFiles when removed
    card.querySelector('button').onclick = () => {
      selectedFiles.splice(i,1);
      renderPreviews();
    };
    previewArea.appendChild(card);
  });

  // make preview area sortable
  if (window.Sortable) {
    Sortable.create(previewArea, {
      animation: 150,
      onEnd: function (evt) {
        // reorder selectedFiles according to DOM order
        const newOrder = [];
        previewArea.querySelectorAll('.preview-card').forEach(card => {
          const idx = parseInt(card.dataset.index, 10);
          // fallback: match by name if index mismatched
          newOrder.push(selectedFiles[idx]);
        });
        // replace selectedFiles only if lengths match
        if (newOrder.length === selectedFiles.length) selectedFiles = newOrder;
        // re-render to update indices
        renderPreviews();
      }
    });
  }
}

/* ----- upload via AJAX ----- */
document.getElementById('uploadBtn').addEventListener('click', () => {
  if (!selectedFiles.length) {
    alert('Pick files first');
    return;
  }
  const caption = document.getElementById('captionInput').value || '';
  const fd = new FormData();
  fd.append('wedding_id', <?= (int)$wedding_id ?>);
  fd.append('caption', caption);
  selectedFiles.forEach((f, i) => fd.append('photos[]', f)); // preserves order

  const uploadStatus = document.getElementById('uploadStatus');
  uploadStatus.textContent = 'Uploading...';

  fetch('upload_gallery.php', {
    method: 'POST',
    body: fd
  }).then(r => r.json()).then(data => {
    if (data.success) {
      uploadStatus.textContent = 'Upload successful';
      // append new items to existing list (simple reload recommended)
      location.reload();
    } else {
      uploadStatus.textContent = 'Error: ' + (data.error || 'Upload failed');
    }
  }).catch(err => {
    uploadStatus.textContent = 'Upload error';
    console.error(err);
  });
});

/* ----- existing list sortable + save order ----- */
const existingList = document.getElementById('existingList');
if (window.Sortable && existingList) {
  Sortable.create(existingList, {
    animation: 150,
    ghostClass: 'ghost'
  });
}

document.getElementById('saveOrderBtn').addEventListener('click', () => {
  const items = Array.from(existingList.querySelectorAll('[data-id]'));
  const orderedIds = items.map((el, idx) => ({ id: el.dataset.id, order: idx + 1 }));
  document.getElementById('orderStatus').textContent = 'Saving...';

  fetch('reorder_gallery.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({ ordered: orderedIds })
  }).then(r=>r.json()).then(resp=>{
    if (resp.success) {
      document.getElementById('orderStatus').textContent = 'Order saved';
      // update UI order labels
      items.forEach((el, idx) => el.querySelector('.order-label').textContent = idx+1);
    } else {
      document.getElementById('orderStatus').textContent = 'Error saving';
    }
  }).catch(e=>{
    document.getElementById('orderStatus').textContent = 'Error';
    console.error(e);
  });
});

/* ----- delete existing image ----- */
document.querySelectorAll('.delete-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    if (!confirm('Delete this photo?')) return;
    const id = btn.dataset.id;
    fetch('delete_gallery.php', {
      method: 'POST',
      headers: {'Content-Type':'application/json'},
      body: JSON.stringify({ id: id })
    }).then(r=>r.json()).then(resp=>{
      if (resp.success) {
        // remove element
        btn.closest('[data-id]').remove();
      } else {
        alert('Delete failed');
      }
    }).catch(e=>{
      console.error(e);
      alert('Delete failed');
    });
  });
});
</script>
</body>
</html>
