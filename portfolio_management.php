<?php
//portfolio_management.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';

// Handle Update Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_wedding'])) {
       if (!isset($_POST['id']) || empty($_POST['id'])) {
        error_log("ID is missing from POST data");
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Wedding ID is missing!'
            });
        </script>";
        exit();
    }

    $id = intval($_POST['id']);
    $bride = $conn->real_escape_string($_POST['bride_name'] ?? '');
    $groom = $conn->real_escape_string($_POST['groom_name'] ?? '');
    $date = $conn->real_escape_string($_POST['wedding_date'] ?? '');
    $location = $conn->real_escape_string($_POST['location'] ?? '');
    $message = $conn->real_escape_string($_POST['message'] ?? '');

    // Fetch old images
    $query = $conn->query("SELECT feature_photo, cover_photo FROM weddings WHERE id = $id");
    if ($query && $query->num_rows > 0) {
        $row = $query->fetch_assoc();
        $feature_photo = $row['feature_photo'];
        $cover_photo = $row['cover_photo'];

        $uploadDir = "assets/image/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        // Upload new feature photo
        if (!empty($_FILES['feature_photo']['name'])) {
            $feature_photo = uniqid('feature_') . '_' . basename($_FILES['feature_photo']['name']);
            move_uploaded_file($_FILES['feature_photo']['tmp_name'], $uploadDir . $feature_photo);
        }

        // Upload new cover photo
        if (!empty($_FILES['cover_photo']['name'])) {
            $cover_photo = uniqid('cover_') . '_' . basename($_FILES['cover_photo']['name']);
            move_uploaded_file($_FILES['cover_photo']['tmp_name'], $uploadDir . $cover_photo);
        }

        // Perform update
        $sql = "
            UPDATE weddings 
            SET 
                bride_name = '$bride',
                groom_name = '$groom',
                wedding_date = '$date',
                location = '$location',
                message = '$message',
                feature_photo = '$feature_photo',
                cover_photo = '$cover_photo'
            WHERE id = $id
        ";

        if ($conn->query($sql)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'Wedding details updated successfully.',
                }).then(() => window.location='portfolio_management.php');
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'SQL Error: " . addslashes($conn->error) . "'
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Wedding not found!'
            });
        </script>";
    }
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
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-2xl font-semibold" style="color:var(--md-on-surface)">Wedding Management</h1>
          <p class="text-sm text-gray-600 mt-1">Manage weddings, photos and details — monochrome material preview.</p>
        </div>
        <div class="flex items-center gap-3">
          <button onclick="openAddModal()" class="btn-md ripple">
            <i class="fas fa-plus"></i> Add Wedding
          </button>
        </div>
      </div>

      <!-- Top cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="md-surface p-5 md-elev-1">
          <div class="text-xs text-gray-500 uppercase mb-2">Profile</div>
          <div class="text-lg font-semibold">Manage your details</div>
        </div>
        <div class="md-surface p-5 md-elev-1">
          <div class="text-xs text-gray-500 uppercase mb-2">Activity</div>
          <div class="text-lg font-semibold">Recent activity</div>
        </div>
        <div class="md-surface p-5 md-elev-1">
          <div class="text-xs text-gray-500 uppercase mb-2">Settings</div>
          <div class="text-lg font-semibold">Preferences</div>
        </div>
      </div>

      <!-- DataTable card -->
      <div class="md-surface p-6 md-elev-2">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-base font-semibold">Wedding List</h3>
          <div class="flex items-center gap-3">
            <!-- DataTables will generate its own controls but we keep wrapper clean -->
          </div>
        </div>

        <div class="overflow-x-auto">
<table id="weddingsTable" class="min-w-full">
  <thead>
    <tr>
      <th style="transform: translateX(-25%)">ID</th>
      <th>Bride</th>
      <th>Groom</th>
      <th style="text-align: center;">Date</th>
      <th>Location</th>
      <th>Message</th>
      <th style="text-align: center;">Feature</th>
      <th style="text-align: center;">Cover</th>
      <th style="text-align: center;">Gallery</th> <!-- ✅ new column -->
      <th class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody class="divide-y divide-gray-200">
    <?php
    $result = $conn->query("SELECT * FROM weddings ORDER BY id DESC");
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='hover:bg-gray-50'>";
        echo "<td class='px-4 py-3'>" . (int)$row['id'] . "</td>";
        echo "<td class='px-4 py-3'>" . htmlspecialchars($row['bride_name']) . "</td>";
        echo "<td class='px-4 py-3'>" . htmlspecialchars($row['groom_name']) . "</td>";
        echo "<td style='text-align: center;' class='px-4 py-3'>" . htmlspecialchars($row['wedding_date']) . "</td>";
        echo "<td class='px-4 py-3'>" . htmlspecialchars($row['location']) . "</td>";
       echo "<td class='px-4 py-3 max-w-xs truncate'>
        <button class='show-message-btn bg-blue-500 text-white px-2 py-1 rounded' data-message='" . htmlspecialchars($row['message'], ENT_QUOTES) . "'>
            View
        </button>
      </td>";


        // Feature
        echo "<td class='px-4 py-3 text-center'>";
        if (!empty($row['feature_photo'])) {
            echo "<img src='assets/image/" . htmlspecialchars($row['feature_photo']) . "' class='img-feature'>";
        }
        echo "</td>";

        // Cover
        echo "<td class='px-4 py-3 text-center'>";
        if (!empty($row['cover_photo'])) {
            echo "<img src='assets/image/" . htmlspecialchars($row['cover_photo']) . "' class='img-cover'>";
        }
        echo "</td>";

        // Gallery
        echo "<td class='px-4 py-3 text-center'>";
        echo "<a href='gallery_management.php?wedding_id=" . (int)$row['id'] . "' 
                class='px-3 py-1.5 bg-green-600 text-white text-xs font-medium rounded-full shadow hover:bg-green-700 transition'>
                <i class='fas fa-images mr-1'></i> Gallery
              </a>";
        echo "</td>";

        // Actions
        echo "<td class='px-4 py-3 text-center'>
                <div class='flex items-center justify-center gap-2'>
                  <button onclick='editWedding(" . (int)$row['id'] . ")' 
                          class='px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded-full shadow hover:bg-indigo-700 transition'>
                    <i class='fas fa-edit mr-1'></i> Edit
                  </button>
                  <button onclick='deleteWedding(" . (int)$row['id'] . ")' 
                          class='px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-full shadow hover:bg-red-700 transition'>
                    <i class='fas fa-trash mr-1'></i> Delete
                  </button>
                </div>
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

  <!-- ADD MODAL (keeps layout similar to prior modal) -->
  <div id="addModal" class="hidden fixed inset-0 z-50 flex items-center justify-center modal-backdrop">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 md-elev-2">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold">Add Wedding</h2>
        <button onclick="closeAddModal()" class="text-gray-600"><i class="fas fa-times"></i></button>
      </div>

      <form method="POST" action="save_wedding.php" enctype="multipart/form-data" class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="text-xs text-gray-600">Bride Name</label>
            <input type="text" name="bride_name" required class="w-full border border-gray-200 rounded-md p-2">
          </div>
          <div>
            <label class="text-xs text-gray-600">Groom Name</label>
            <input type="text" name="groom_name" required class="w-full border border-gray-200 rounded-md p-2">
          </div>
        </div>

        <div>
          <label class="text-xs text-gray-600">Wedding Date</label>
          <input type="date" name="wedding_date" class="w-full border border-gray-200 rounded-md p-2">
        </div>

        <div>
          <label class="text-xs text-gray-600">Location</label>
          <input type="text" name="location" required class="w-full border border-gray-200 rounded-md p-2">
        </div>

        <div>
          <label class="text-xs text-gray-600">Message</label>
          <textarea name="message" rows="3" class="w-full border border-gray-200 rounded-md p-2"></textarea>
        </div>

        <!-- photos simplified -->
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="text-xs text-gray-600">Feature Photo (portrait)</label>
            <input type="file" name="feature_photo" accept="image/*" onchange="previewSingleImage(event,'featurePreview','portrait')" class="w-full border border-gray-200 rounded-md p-2">
            <div id="featurePreview" class="mt-3"><img src='' class='hidden img-feature' alt='feature'></div>
          </div>
          <div>
            <label class="text-xs text-gray-600">Cover Photo (landscape)</label>
            <input type="file" name="cover_photo" accept="image/*" onchange="previewSingleImage(event,'coverPreview','landscape')" class="w-full border border-gray-200 rounded-md p-2">
            <div id="coverPreview" class="mt-3"><img src='' class='hidden img-cover' alt='cover'></div>
          </div>
        </div>



        <div class="flex justify-end gap-3">
          <button type="button" onclick="closeAddModal()" class="px-4 py-2 border rounded-md">Cancel</button>
          <button type="submit" class="px-4 py-2 btn-md">Save</button>
        </div>
      </form>
    </div>
  </div>

  <script>

  // DataTable init
$(document).ready(function () {
$('#weddingsTable').DataTable({
  pageLength: 10,
  ordering: true,
  columnDefs: [
    { orderable: false, targets: [6,7,8] }, // disable ordering
  { className: "text-center", targets: "_all" }

  ]
});

});


    // Modal controls
    function openAddModal(){ document.getElementById('addModal').classList.remove('hidden'); }
    function closeAddModal(){ document.getElementById('addModal').classList.add('hidden'); }

    // Preview functions (same as before)
    function previewSingleImage(event, previewId, type) {
      const previewContainer = document.getElementById(previewId);
      let img = previewContainer.querySelector("img");
      if(!img){ img = document.createElement('img'); previewContainer.appendChild(img); }
      const file = event.target.files[0];
      if (file && file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = function(e) {
          img.src = e.target.result;
          img.classList.remove('hidden');
          if (type === "portrait") img.className = "img-feature";
          else img.className = "img-cover";
        };
        reader.readAsDataURL(file);
      } else {
        img.src=''; img.classList.add('hidden');
      }
    }

    function previewPhotos(event) {
      const preview = document.getElementById("photosPreview");
      preview.innerHTML = "";
      const files = event.target.files;
      if (!files.length) return;
      Array.from(files).forEach(file => {
        if (!file.type.startsWith("image/")) return;
        const reader = new FileReader();
        reader.onload = function(e) {
          const wrapper = document.createElement("div");
          wrapper.className = "relative group";
          const img = document.createElement("img");
          img.src = e.target.result;
          img.className = "w-full h-24 object-cover rounded shadow";
          const removeBtn = document.createElement("button");
          removeBtn.type = "button";
          removeBtn.innerHTML = "✖";
          removeBtn.className = "absolute top-1 right-1 bg-black text-white text-xs px-1 rounded opacity-70 hover:opacity-100";
          removeBtn.onclick = () => wrapper.remove();
          wrapper.appendChild(img);
          wrapper.appendChild(removeBtn);
          preview.appendChild(wrapper);
        };
        reader.readAsDataURL(file);
      });
    }

    // Placeholder functions for editing & deleting
    function editWedding(id){ alert('Edit not implemented yet: ' + id); }
    function deleteWedding(id){
      if(!confirm('Delete wedding #' + id + '?')) return;
      // Simple POST delete — replace with AJAX or form as needed
      const form = document.createElement('form');
      form.method = 'POST'; form.action = 'delete_wedding.php';
      const input = document.createElement('input'); input.type='hidden'; input.name='id'; input.value=id;
      form.appendChild(input); document.body.appendChild(form); form.submit();
    }
  </script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.show-message-btn').forEach(button => {
        button.addEventListener('click', function() {
            const message = this.getAttribute('data-message');
            Swal.fire({
                title: 'Message',
                text: message,
                icon: 'info',
                confirmButtonText: 'Close'
            });
        });
    });
});
function openEditModal() { 
  document.getElementById('editModal').classList.remove('hidden'); 
}
function closeEditModal() { 
  document.getElementById('editModal').classList.add('hidden'); 
}

// Fetch wedding data via AJAX and open modal
function editWedding(id) {
  $.ajax({
    url: 'get_wedding.php',
    type: 'GET',
    data: { id },
    dataType: 'json',
    success: function(data) {
      if (data.success) {
        $('#edit_id').val(data.wedding.id);
        $('#edit_bride_name').val(data.wedding.bride_name);
        $('#edit_groom_name').val(data.wedding.groom_name);
        $('#edit_wedding_date').val(data.wedding.wedding_date);
        $('#edit_location').val(data.wedding.location);
        $('#edit_message').val(data.wedding.message);

        // Update previews
        $('#editFeaturePreview').html(data.wedding.feature_photo 
          ? `<img src='assets/image/${data.wedding.feature_photo}' class='img-feature'>` : '');
        $('#editCoverPreview').html(data.wedding.cover_photo 
          ? `<img src='assets/image/${data.wedding.cover_photo}' class='img-cover'>` : '');

        openEditModal();
      } else {
        Swal.fire('Error', 'Wedding not found.', 'error');
      }
    },
    error: function() {
      Swal.fire('Error', 'Failed to fetch wedding data.', 'error');
    }
  });
}

// Handle Update Submission
$('#editWeddingForm').on('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    $.ajax({
        url: 'portfolio_management.php', // Submit to same page
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Close modal first
            closeEditModal();
            
            // Then show the SweetAlert from PHP response
            // We need to extract and execute the script
            const scriptMatch = response.match(/<script>(.*?)<\/script>/s);
            if (scriptMatch && scriptMatch[1]) {
                eval(scriptMatch[1]);
            } else {
                // Fallback if script not found
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'Wedding details updated successfully.',
                }).then(() => window.location.reload());
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'Something went wrong: ' + error, 'error');
        }
    });
});
</script>
<!-- EDIT MODAL -->
<div id="editModal" class="hidden fixed inset-0 z-50 flex items-center justify-center modal-backdrop">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 md-elev-2">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg font-semibold">Edit Wedding</h2>
      <button onclick="closeEditModal()" class="text-gray-600"><i class="fas fa-times"></i></button>
    </div>

    <form id="editWeddingForm" method="POST" enctype="multipart/form-data" class="space-y-4">
      <input type="hidden" name="update_wedding" value="1">
      <input type="hidden" name="id" id="edit_id"> <!-- ADD THIS LINE -->

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="text-xs text-gray-600">Bride Name</label>
          <input type="text" name="bride_name" id="edit_bride_name" required class="w-full border border-gray-200 rounded-md p-2">
        </div>
        <div>
          <label class="text-xs text-gray-600">Groom Name</label>
          <input type="text" name="groom_name" id="edit_groom_name" required class="w-full border border-gray-200 rounded-md p-2">
        </div>
      </div>

      <div>
        <label class="text-xs text-gray-600">Wedding Date</label>
        <input type="date" name="wedding_date" id="edit_wedding_date" class="w-full border border-gray-200 rounded-md p-2">
      </div>

      <div>
        <label class="text-xs text-gray-600">Location</label>
        <input type="text" name="location" id="edit_location" required class="w-full border border-gray-200 rounded-md p-2">
      </div>

      <div>
        <label class="text-xs text-gray-600">Message</label>
        <textarea name="message" id="edit_message" rows="3" class="w-full border border-gray-200 rounded-md p-2"></textarea>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="text-xs text-gray-600">Feature Photo</label>
          <input type="file" name="feature_photo" accept="image/*" class="w-full border border-gray-200 rounded-md p-2">
          <div class="mt-3" id="editFeaturePreview"></div>
        </div>
        <div>
          <label class="text-xs text-gray-600">Cover Photo</label>
          <input type="file" name="cover_photo" accept="image/*" class="w-full border border-gray-200 rounded-md p-2">
          <div class="mt-3" id="editCoverPreview"></div>
        </div>
      </div>

      <div class="flex justify-end gap-3">
        <button type="button" onclick="closeEditModal()" class="px-4 py-2 border rounded-md">Cancel</button>
        <button type="submit" class="px-4 py-2 btn-md">Update</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>