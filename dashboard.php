<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';

// ── Handle AJAX: delete inquiry ───────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_inquiry') {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0) {
        $conn->query("DELETE FROM inquiries WHERE id = $id");
        echo "ok";
    } else {
        http_response_code(400);
        echo "invalid";
    }
    $conn->close();
    exit();
}

// ── Handle AJAX: mark inquiry as seen ────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'mark_seen') {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0) $conn->query("UPDATE inquiries SET seen = 1 WHERE id = $id");
    echo "ok";
    $conn->close();
    exit();
}

// ── Stats ─────────────────────────────────────────────────
$total_weddings   = $conn->query("SELECT COUNT(*) as c FROM weddings")->fetch_assoc()['c'];
$month = date("m"); $year = date("Y"); $today = date("Y-m-d");
$this_month       = $conn->query("SELECT COUNT(*) as c FROM weddings WHERE MONTH(wedding_date)='$month' AND YEAR(wedding_date)='$year'")->fetch_assoc()['c'];
$upcoming         = $conn->query("SELECT COUNT(*) as c FROM weddings WHERE wedding_date > '$today'")->fetch_assoc()['c'];
$past             = $conn->query("SELECT COUNT(*) as c FROM weddings WHERE wedding_date < '$today'")->fetch_assoc()['c'];

$total_inquiries  = $conn->query("SELECT COUNT(*) as c FROM inquiries")->fetch_assoc()['c'];
$couple_inquiries = $conn->query("SELECT COUNT(*) as c FROM inquiries WHERE type='couple'")->fetch_assoc()['c'];
$planner_inquiries= $conn->query("SELECT COUNT(*) as c FROM inquiries WHERE type='planner'")->fetch_assoc()['c'];
$new_inquiries    = $conn->query("SELECT COUNT(*) as c FROM inquiries WHERE seen = 0")->fetch_assoc()['c'];

// ── Charts ────────────────────────────────────────────────
$monthly_data = array_fill(0, 12, 0);
$res = $conn->query("SELECT MONTH(wedding_date) as m, COUNT(*) as c FROM weddings WHERE YEAR(wedding_date)='$year' GROUP BY m");
while ($row = $res->fetch_assoc()) $monthly_data[$row['m'] - 1] = (int)$row['c'];

$locations = []; $loc_counts = [];
$res = $conn->query("SELECT location, COUNT(*) as c FROM weddings GROUP BY location ORDER BY c DESC LIMIT 6");
while ($row = $res->fetch_assoc()) { $locations[] = $row['location']; $loc_counts[] = (int)$row['c']; }

// ── Data ──────────────────────────────────────────────────
$weddings  = $conn->query("SELECT * FROM weddings ORDER BY created_at DESC");
$inquiries = $conn->query("SELECT * FROM inquiries ORDER BY submitted_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Dashboard — Veil & Varmala</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css"/>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    :root {
      --md-surface:#ffffff; --md-on-surface:#0b0b0b;
      --md-surface-2:#f3f3f3; --md-divider:#e6e6e6; --md-muted:#6b6b6b;
      --md-elevation-1:0 1px 3px rgba(11,11,11,.06),0 1px 2px rgba(11,11,11,.04);
      --md-elevation-2:0 4px 8px rgba(11,11,11,.08),0 2px 4px rgba(11,11,11,.06);
      --md-radius:12px;
    }
    .md-surface { background:var(--md-surface); color:var(--md-on-surface); border-radius:var(--md-radius); box-shadow:var(--md-elevation-1); }
    .md-elev-1  { box-shadow:var(--md-elevation-1); }
    .md-elev-2  { box-shadow:var(--md-elevation-2); }
    .sidebar a  { display:flex; align-items:center; gap:.75rem; padding:.6rem .9rem; border-radius:8px; color:var(--md-on-surface); }
    .sidebar a:hover { background:var(--md-surface-2); }
    table.dataTable { border-collapse:collapse !important; width:100% !important; }
    table.dataTable thead th { background:transparent; color:var(--md-muted); font-weight:600; padding:12px 16px; text-transform:uppercase; font-size:.75rem; letter-spacing:.08em; }
    table.dataTable td { padding:10px 16px; vertical-align:middle; border-bottom:1px solid var(--md-divider); }
    table.dataTable tbody tr:hover { background:var(--md-surface-2); }
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select { padding:8px 10px; border-radius:8px; border:1px solid var(--md-divider); background:#fff; }
    .img-feature { width:52px; height:72px; object-fit:cover; border-radius:8px; }
    .img-cover   { width:100px; height:58px; object-fit:cover; border-radius:8px; }
    .img-placeholder-feature { width:52px; height:72px; border-radius:8px; background:#f3f3f3; display:flex; align-items:center; justify-content:center; color:#ccc; font-size:1.2rem; }
    .img-placeholder-cover   { width:100px; height:58px; border-radius:8px; background:#f3f3f3; display:flex; align-items:center; justify-content:center; color:#ccc; font-size:1.2rem; }
    .btn-md { background:#0b0b0b; color:#fff; padding:8px 14px; border-radius:10px; display:inline-flex; gap:8px; align-items:center; font-weight:600; cursor:pointer; }
    .btn-md:hover { background:#333; }
    .modal-backdrop { background:rgba(0,0,0,.55); }
    .tab-btn { padding:.5rem 1.2rem; border-radius:8px; font-weight:600; font-size:.85rem; cursor:pointer; transition:all .2s; }
    .tab-btn.active { background:#0b0b0b; color:#fff; }
    .tab-btn:not(.active) { background:var(--md-surface-2); color:var(--md-muted); }
    .tab-btn:not(.active):hover { background:#e0e0e0; }
    .badge { display:inline-block; padding:2px 10px; border-radius:999px; font-size:.72rem; font-weight:600; }
    .badge-couple  { background:#ede9fe; color:#5b21b6; }
    .badge-planner { background:#dcfce7; color:#166534; }
    .row-unseen { background: #fefce8 !important; }
  </style>
</head>
<body class="bg-gray-50 antialiased text-sm">
<div class="flex h-screen">

<?php include 'sidebar.php'; ?>

<main class="flex-1 p-8 overflow-auto">

  <!-- Header -->
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold">Wedding Dashboard</h1>
      <p class="text-sm text-gray-500 mt-1">Insights, stats, and management — Veil & Varmala</p>
    </div>
    <button onclick="openAddModal()" class="btn-md">
      <i class="fas fa-plus"></i> Add Wedding
    </button>
  </div>

  <!-- Wedding Stats -->
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
    <div class="md-surface p-5 text-center md-elev-1">
      <div class="text-xs text-gray-500 uppercase mb-1">Total Weddings</div>
      <div class="text-2xl font-bold text-indigo-600"><?= $total_weddings ?></div>
    </div>
    <div class="md-surface p-5 text-center md-elev-1">
      <div class="text-xs text-gray-500 uppercase mb-1">This Month</div>
      <div class="text-2xl font-bold text-green-600"><?= $this_month ?></div>
    </div>
    <div class="md-surface p-5 text-center md-elev-1">
      <div class="text-xs text-gray-500 uppercase mb-1">Upcoming</div>
      <div class="text-2xl font-bold text-orange-500"><?= $upcoming ?></div>
    </div>
    <div class="md-surface p-5 text-center md-elev-1">
      <div class="text-xs text-gray-500 uppercase mb-1">Past</div>
      <div class="text-2xl font-bold text-red-500"><?= $past ?></div>
    </div>
  </div>

  <!-- Inquiry Stats -->
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="md-surface p-5 text-center md-elev-1">
      <div class="text-xs text-gray-500 uppercase mb-1">Total Inquiries</div>
      <div class="text-2xl font-bold text-purple-600" id="total-inquiries-count"><?= $total_inquiries ?></div>
    </div>
    <div class="md-surface p-5 text-center md-elev-1">
      <div class="text-xs text-gray-500 uppercase mb-1">Couple Inquiries</div>
      <div class="text-2xl font-bold text-blue-600"><?= $couple_inquiries ?></div>
    </div>
    <div class="md-surface p-5 text-center md-elev-1">
      <div class="text-xs text-gray-500 uppercase mb-1">Planner Inquiries</div>
      <div class="text-2xl font-bold text-emerald-600"><?= $planner_inquiries ?></div>
    </div>
    <div class="md-surface p-5 text-center md-elev-1">
      <div class="text-xs text-gray-500 uppercase mb-1">Unread</div>
      <div class="text-2xl font-bold text-pink-600" id="unread-count"><?= $new_inquiries ?></div>
    </div>
  </div>

  <!-- Charts -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="md-surface p-6 md-elev-2">
      <h3 class="text-base font-semibold mb-3">Weddings Per Month (<?= $year ?>)</h3>
      <canvas id="lineChart"></canvas>
    </div>
    <div class="md-surface p-6 md-elev-2">
      <h3 class="text-base font-semibold mb-3">Weddings by Location</h3>
      <canvas id="barChart"></canvas>
    </div>
  </div>

  <!-- Tabs -->
  <div class="md-surface p-6 md-elev-2">
    <div class="flex gap-3 mb-5">
      <button class="tab-btn active" id="tab-weddings" onclick="switchTab('weddings')">
        <i class="fas fa-camera mr-1"></i> Weddings
      </button>
      <button class="tab-btn" id="tab-inquiries" onclick="switchTab('inquiries')">
        <i class="fas fa-envelope mr-1"></i> Inquiries
        <?php if($new_inquiries > 0): ?>
          <span id="unread-badge" class="ml-1 bg-red-500 text-white text-xs rounded-full px-2"><?= $new_inquiries ?></span>
        <?php else: ?>
          <span id="unread-badge" class="ml-1 bg-red-500 text-white text-xs rounded-full px-2 hidden"><?= $new_inquiries ?></span>
        <?php endif; ?>
      </button>
    </div>

    <!-- WEDDINGS TABLE -->
    <div id="panel-weddings">
      <div class="overflow-x-auto">
        <table id="weddingsTable" class="min-w-full text-left">
          <thead>
            <tr>
              <th>Feature</th>
              <th>Cover</th>
              <th>Bride</th>
              <th>Groom</th>
              <th>Date</th>
              <th>Location</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while($w = $weddings->fetch_assoc()): ?>
            <tr>
              <td>
                <?php if(!empty($w['feature_photo'])): ?>
                  <img src="assets/uploads/<?= htmlspecialchars($w['feature_photo']) ?>" class="img-feature" alt="feature">
                <?php else: ?>
                  <div class="img-placeholder-feature"><i class="fas fa-image"></i></div>
                <?php endif; ?>
              </td>
              <td>
                <?php if(!empty($w['cover_photo'])): ?>
                  <img src="assets/uploads/<?= htmlspecialchars($w['cover_photo']) ?>" class="img-cover" alt="cover">
                <?php else: ?>
                  <div class="img-placeholder-cover"><i class="fas fa-image"></i></div>
                <?php endif; ?>
              </td>
              <td class="font-medium"><?= htmlspecialchars($w['bride_name']) ?></td>
              <td class="font-medium"><?= htmlspecialchars($w['groom_name']) ?></td>
              <td class="text-gray-500">
                <?= ($w['wedding_date'] && $w['wedding_date'] !== '0000-00-00') ? date('M d, Y', strtotime($w['wedding_date'])) : '—' ?>
              </td>
              <td class="text-gray-500"><?= htmlspecialchars($w['location']) ?></td>
              <td>
                <div class="flex gap-3">
                  <a href="edit_wedding.php?id=<?= $w['id'] ?>" class="text-indigo-600 hover:underline text-xs font-semibold">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <a href="delete_wedding.php?id=<?= $w['id'] ?>" onclick="return confirm('Delete this wedding?')" class="text-red-500 hover:underline text-xs font-semibold">
                    <i class="fas fa-trash"></i> Delete
                  </a>
                  <a href="manage_gallery.php?id=<?= $w['id'] ?>" class="text-green-600 hover:underline text-xs font-semibold">
                    <i class="fas fa-images"></i> Gallery
                  </a>
                </div>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- INQUIRIES TABLE -->
    <div id="panel-inquiries" style="display:none;">
      <div class="flex gap-2 mb-4">
        <button onclick="filterInquiries('all')"     class="inq-filter tab-btn active text-xs" data-filter="all">All</button>
        <button onclick="filterInquiries('couple')"  class="inq-filter tab-btn text-xs"        data-filter="couple">Couples</button>
        <button onclick="filterInquiries('planner')" class="inq-filter tab-btn text-xs"        data-filter="planner">Planners</button>
      </div>
      <div class="overflow-x-auto">
        <table id="inquiriesTable" class="min-w-full text-left">
          <thead>
            <tr>
              <th>Type</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Wedding Date</th>
              <th>Location</th>
              <th>Budget</th>
              <th>Submitted</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while($inq = $inquiries->fetch_assoc()): ?>
            <tr data-type="<?= $inq['type'] ?>" data-id="<?= $inq['id'] ?>"
              class="<?= $inq['seen'] == 0 ? 'row-unseen' : '' ?>">
              <td>
                <span class="badge badge-<?= $inq['type'] ?>">
                  <?= ucfirst($inq['type']) ?>
                </span>
              </td>
              <td class="font-medium"><?= htmlspecialchars($inq['full_name']) ?></td>
              <td>
                <a href="mailto:<?= htmlspecialchars($inq['email']) ?>" class="text-indigo-600 hover:underline">
                  <?= htmlspecialchars($inq['email']) ?>
                </a>
              </td>
              <td class="text-gray-500"><?= htmlspecialchars($inq['phone'] ?? '—') ?></td>
              <td class="text-gray-500"><?= htmlspecialchars($inq['wedding_date'] ?? '—') ?></td>
              <td class="text-gray-500"><?= htmlspecialchars($inq['location'] ?? '—') ?></td>
              <td class="text-gray-500"><?= htmlspecialchars($inq['budget'] ?? '—') ?></td>
              <td class="text-gray-400 text-xs"><?= date('M d, Y g:i A', strtotime($inq['submitted_at'])) ?></td>
              <td>
                <div class="flex gap-3">
                  <button onclick="viewInquiry(<?= htmlspecialchars(json_encode($inq)) ?>, this)"
                    class="text-indigo-600 hover:underline text-xs font-semibold">
                    <i class="fas fa-eye"></i> View
                  </button>
                  <button onclick="deleteInquiry(<?= $inq['id'] ?>, this)"
                    class="text-red-500 hover:underline text-xs font-semibold">
                    <i class="fas fa-trash"></i> Delete
                  </button>
                </div>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
</div>

<!-- ADD WEDDING MODAL -->
<div id="addModal" class="hidden fixed inset-0 z-50 flex items-center justify-center modal-backdrop">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl p-6 md-elev-2 overflow-y-auto max-h-[90vh]">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg font-semibold">Add Wedding</h2>
      <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-700"><i class="fas fa-times"></i></button>
    </div>
    <form method="POST" action="save_wedding.php" enctype="multipart/form-data" class="space-y-4">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="text-xs text-gray-500">Bride Name</label>
          <input type="text" name="bride_name" required class="w-full border border-gray-200 rounded-md p-2 mt-1">
        </div>
        <div>
          <label class="text-xs text-gray-500">Groom Name</label>
          <input type="text" name="groom_name" required class="w-full border border-gray-200 rounded-md p-2 mt-1">
        </div>
      </div>
      <div>
        <label class="text-xs text-gray-500">Wedding Date</label>
        <input type="date" name="wedding_date" required class="w-full border border-gray-200 rounded-md p-2 mt-1">
      </div>
      <div>
        <label class="text-xs text-gray-500">Location</label>
        <input type="text" name="location" required class="w-full border border-gray-200 rounded-md p-2 mt-1">
      </div>
      <div>
        <label class="text-xs text-gray-500">Message / Testimonial</label>
        <textarea name="message" rows="3" class="w-full border border-gray-200 rounded-md p-2 mt-1"></textarea>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="text-xs text-gray-500">Feature Photo (portrait)</label>
          <input type="file" name="feature_photo" accept="image/*" onchange="previewSingleImage(event,'featurePreview','portrait')" class="w-full border border-gray-200 rounded-md p-2 mt-1">
          <div id="featurePreview" class="mt-2"></div>
        </div>
        <div>
          <label class="text-xs text-gray-500">Cover Photo (landscape)</label>
          <input type="file" name="cover_photo" accept="image/*" onchange="previewSingleImage(event,'coverPreview','landscape')" class="w-full border border-gray-200 rounded-md p-2 mt-1">
          <div id="coverPreview" class="mt-2"></div>
        </div>
      </div>
      <div>
        <label class="text-xs text-gray-500">Gallery Photos (multiple)</label>
        <input type="file" name="photos[]" accept="image/*" multiple onchange="previewPhotos(event)" class="w-full border border-gray-200 rounded-md p-2 mt-1">
        <div id="photosPreview" class="mt-2 grid grid-cols-4 gap-2"></div>
      </div>
      <div class="flex justify-end gap-3 pt-2">
        <button type="button" onclick="closeAddModal()" class="px-4 py-2 border rounded-md text-sm">Cancel</button>
        <button type="submit" class="btn-md text-sm">Save Wedding</button>
      </div>
    </form>
  </div>
</div>

<!-- VIEW INQUIRY MODAL -->
<div id="inquiryModal" class="hidden fixed inset-0 z-50 flex items-center justify-center modal-backdrop">
  <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 md-elev-2 overflow-y-auto max-h-[90vh]">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg font-semibold">Inquiry Details</h2>
      <button onclick="closeInquiryModal()" class="text-gray-400 hover:text-gray-700"><i class="fas fa-times"></i></button>
    </div>
    <div id="inquiryContent" class="space-y-2 text-sm"></div>
    <div class="flex justify-between mt-5">
      <button onclick="deleteInquiryFromModal()"
        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md text-sm font-semibold">
        <i class="fas fa-trash mr-1"></i> Delete
      </button>
      <button onclick="closeInquiryModal()" class="px-4 py-2 border rounded-md text-sm">Close</button>
    </div>
  </div>
</div>

<script>
// ── Charts ────────────────────────────────────────────────
new Chart(document.getElementById('lineChart'), {
  type: 'line',
  data: {
    labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    datasets: [{
      label: 'Weddings',
      data: <?= json_encode($monthly_data) ?>,
      borderColor: '#4f46e5',
      backgroundColor: 'rgba(79,70,229,0.08)',
      fill: true, tension: 0.4,
      pointBackgroundColor: '#4f46e5'
    }]
  },
  options: { plugins:{ legend:{ display:false } }, scales:{ y:{ beginAtZero:true, ticks:{ stepSize:1 } } } }
});

new Chart(document.getElementById('barChart'), {
  type: 'bar',
  data: {
    labels: <?= json_encode($locations) ?>,
    datasets: [{
      label: 'Weddings',
      data: <?= json_encode($loc_counts) ?>,
      backgroundColor: ['#6366f1','#22c55e','#f97316','#ef4444','#ec4899','#14b8a6']
    }]
  },
  options: { plugins:{ legend:{ display:false } }, scales:{ y:{ beginAtZero:true, ticks:{ stepSize:1 } } } }
});

// ── DataTables ────────────────────────────────────────────
$(document).ready(function() {
  $('#weddingsTable').DataTable({ pageLength: 10, order: [] });
  $('#inquiriesTable').DataTable({ pageLength: 10, order: [] });
});

// ── Tab switching ─────────────────────────────────────────
function switchTab(tab) {
  document.getElementById('panel-weddings').style.display  = tab === 'weddings'  ? 'block' : 'none';
  document.getElementById('panel-inquiries').style.display = tab === 'inquiries' ? 'block' : 'none';
  document.getElementById('tab-weddings').classList.toggle('active',  tab === 'weddings');
  document.getElementById('tab-inquiries').classList.toggle('active', tab === 'inquiries');
}

// ── Inquiry filter ────────────────────────────────────────
function filterInquiries(type) {
  const table = $('#inquiriesTable').DataTable();
  document.querySelectorAll('.inq-filter').forEach(b => b.classList.toggle('active', b.dataset.filter === type));
  table.column(0).search(type === 'all' ? '' : type, false, false).draw();
}

// ── Modals ────────────────────────────────────────────────
function openAddModal()      { document.getElementById('addModal').classList.remove('hidden'); }
function closeAddModal()     { document.getElementById('addModal').classList.add('hidden'); }
function closeInquiryModal() { document.getElementById('inquiryModal').classList.add('hidden'); }

// ── Image previews ────────────────────────────────────────
function previewSingleImage(event, containerId, type) {
  const file = event.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = e => {
    const cls = type === 'portrait' ? 'img-feature' : 'img-cover';
    document.getElementById(containerId).innerHTML = `<img src="${e.target.result}" class="${cls}">`;
  };
  reader.readAsDataURL(file);
}

function previewPhotos(event) {
  const container = document.getElementById('photosPreview');
  container.innerHTML = '';
  Array.from(event.target.files).forEach(file => {
    const reader = new FileReader();
    reader.onload = e => {
      container.innerHTML += `<img src="${e.target.result}" class="w-full h-20 object-cover rounded-lg">`;
    };
    reader.readAsDataURL(file);
  });
}

// ── Shared state for inquiry modal ────────────────────────
let unreadCount       = <?= $new_inquiries ?>;
let currentInquiryId  = null;
let currentInquiryRow = null;

// ── Helper: update unread badge & counters ────────────────
function decrementUnread() {
  unreadCount = Math.max(0, unreadCount - 1);
  const badge   = document.getElementById('unread-badge');
  const countEl = document.getElementById('unread-count');
  if (unreadCount === 0) badge.classList.add('hidden');
  else badge.textContent = unreadCount;
  if (countEl) countEl.textContent = unreadCount;
}

function decrementTotal() {
  const el = document.getElementById('total-inquiries-count');
  if (el) el.textContent = Math.max(0, parseInt(el.textContent) - 1);
}

// ── View Inquiry + mark as seen ───────────────────────────
function viewInquiry(data, btn) {
  const row = btn.closest('tr');
  currentInquiryId  = row.dataset.id;
  currentInquiryRow = row;

  if (row.classList.contains('row-unseen')) {
    fetch('dashboard.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'action=mark_seen&id=' + currentInquiryId
    }).then(() => {
      row.classList.remove('row-unseen');
      decrementUnread();
    });
  }

  const isPlanner = data.type === 'planner';
  const fields = isPlanner ? [
    ['Type',             `<span class="badge badge-${data.type}">${data.type}</span>`],
    ['Planner Name',     data.full_name],
    ['Email',            `<a href="mailto:${data.email}" class="text-indigo-600 underline">${data.email}</a>`],
    ['Couple Names',     data.planner || '—'],
    ['Wedding Date',     data.wedding_date || '—'],
    ['Venue',            data.location || '—'],
    ['Budget (USD)',     data.budget || '—'],
    ['How they heard',   data.hear_about || '—'],
    ['About the Couple', data.details || '—'],
    ['Submitted',        data.submitted_at],
  ] : [
    ['Type',             `<span class="badge badge-${data.type}">${data.type}</span>`],
    ['Full Name',        data.full_name],
    ['Instagram',        data.instagram ? '@' + data.instagram : '—'],
    ['Email',            `<a href="mailto:${data.email}" class="text-indigo-600 underline">${data.email}</a>`],
    ['Phone',            data.phone || '—'],
    ['Wedding Date',     data.wedding_date || '—'],
    ['Location',         data.location || '—'],
    ['Reception',        data.reception || '—'],
    ['Wedding Type',     data.wedding_type || '—'],
    ['How they heard',   data.hear_about || '—'],
    ['Planner',          data.planner || '—'],
    ['Budget',           data.budget || '—'],
    ['Details',          data.details || '—'],
    ['Submitted',        data.submitted_at],
  ];

  let html = '<dl class="divide-y divide-gray-100">';
  fields.forEach(([label, value]) => {
    html += `
      <div class="py-2 grid grid-cols-3 gap-2">
        <dt class="text-gray-500 font-medium">${label}</dt>
        <dd class="col-span-2 text-gray-800 break-words">${value || '—'}</dd>
      </div>`;
  });
  html += '</dl>';

  document.getElementById('inquiryContent').innerHTML = html;
  document.getElementById('inquiryModal').classList.remove('hidden');
}

// ── Delete inquiry (from table row) ──────────────────────
function deleteInquiry(id, btn) {
  if (!confirm('Delete this inquiry? This cannot be undone.')) return;
  fetch('dashboard.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'action=delete_inquiry&id=' + id
  }).then(r => r.text()).then(res => {
    if (res.trim() === 'ok') {
      const row = btn.closest('tr');
      if (row.classList.contains('row-unseen')) decrementUnread();
      $('#inquiriesTable').DataTable().row(row).remove().draw();
      decrementTotal();
    }
  });
}

// ── Delete inquiry (from modal) ───────────────────────────
function deleteInquiryFromModal() {
  if (!currentInquiryId) return;
  if (!confirm('Delete this inquiry? This cannot be undone.')) return;
  fetch('dashboard.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'action=delete_inquiry&id=' + currentInquiryId
  }).then(r => r.text()).then(res => {
    if (res.trim() === 'ok') {
      if (currentInquiryRow) {
        if (currentInquiryRow.classList.contains('row-unseen')) decrementUnread();
        $('#inquiriesTable').DataTable().row(currentInquiryRow).remove().draw();
        decrementTotal();
      }
      closeInquiryModal();
      currentInquiryId  = null;
      currentInquiryRow = null;
    }
  });
}

// ── Close modals on backdrop click ────────────────────────
['addModal','inquiryModal'].forEach(id => {
  document.getElementById(id).addEventListener('click', function(e) {
    if (e.target === this) this.classList.add('hidden');
  });
});
</script>

<?php $conn->close(); ?>
</body>
</html>