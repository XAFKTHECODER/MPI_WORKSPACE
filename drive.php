<?php 
session_start();
require_once 'config/db.php';
require_once 'config/auth.php'; // Middleware to protect the page

/**
 * 1. DATA FETCHING & FILTERING
 */

// Fetch all subjects for the dropdown filter
$subjects = $pdo->query("SELECT * FROM subjects ORDER BY name ASC")->fetchAll();

// Get Search, Filter, and Sort inputs
$subject_filter = isset($_GET['subject']) ? (int)$_GET['subject'] : null;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sort_order = isset($_GET['sort']) ? $_GET['sort'] : 'newest';

// Base Query
$query = "SELECT d.*, s.name as subject_name 
          FROM drive_links d 
          JOIN subjects s ON d.subject_id = s.id 
          WHERE 1=1";

$params = [];

// Apply Subject Filter
if ($subject_filter) {
    $query .= " AND d.subject_id = ?";
    $params[] = $subject_filter;
}

// Apply Search (checks Title and Description)
if ($search) {
    $query .= " AND (d.title LIKE ? OR d.description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

// APPLY SORTING (Newest First using the ID)
if ($sort_order === 'oldest') {
    $query .= " ORDER BY d.id ASC";
} else {
    $query .= " ORDER BY d.id DESC"; 
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$links = $stmt->fetchAll();
?>

<?php include 'includes/header.php'; ?>

<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>

    <main class="flex-grow-1 p-4 p-md-5" style="margin-left: 290px; min-height: 100vh;">
        
        <div class="d-md-flex justify-content-between align-items-end mb-5">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item small"><a href="dashboard.php" class="text-decoration-none text-secondary">Dashboard</a></li>
                        <li class="breadcrumb-item small active" aria-current="page">Drive</li>
                    </ol>
                </nav>
                <h2 class="fw-800 mb-0">Resource Explorer</h2>
                <p class="text-secondary small mb-0">Browse archived materials for the MPI track.</p>
            </div>
            
            <form class="d-flex flex-wrap gap-2 mt-4 mt-md-0" method="GET">
                <div class="input-group" style="width: 220px;">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0 shadow-none" placeholder="Search..." value="<?= htmlspecialchars($search) ?>">
                </div>
                
                <select name="subject" class="form-select shadow-none" onchange="this.form.submit()" style="width: 160px;">
                    <option value="">All Subjects</option>
                    <?php foreach($subjects as $s): ?>
                        <option value="<?= $s['id'] ?>" <?= $subject_filter == $s['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($s['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select name="sort" class="form-select shadow-none fw-600 text-primary" onchange="this.form.submit()" style="width: 150px;">
                    <option value="newest" <?= $sort_order == 'newest' ? 'selected' : '' ?>>Newest First</option>
                    <option value="oldest" <?= $sort_order == 'oldest' ? 'selected' : '' ?>>Oldest First</option>
                </select>
            </form>
        </div>

        <div class="row g-4">
            <?php if (empty($links)): ?>
                <div class="col-12 text-center py-5">
                    <div class="bg-light d-inline-block p-4 rounded-circle mb-3">
                        <i class="fas fa-folder-open fa-3x text-secondary opacity-50"></i>
                    </div>
                    <h5 class="text-secondary fw-600">No resources found</h5>
                    <p class="text-muted small">Try adjusting your filters or search keywords.</p>
                    <a href="drive.php" class="btn btn-outline-primary btn-sm rounded-pill mt-2">Clear Filters</a>
                </div>
            <?php else: ?>
                <?php foreach($links as $link): ?>
                    <?php 
                        // Provider Detection Logic
                        $is_mega = (strpos($link['url'], 'mega.nz') !== false);
                        $brand_icon = $is_mega ? 'fa-solid fa-m text-danger' : 'fab fa-google-drive text-primary';
                        $btn_theme = $is_mega ? 'btn-danger' : 'btn-primary';
                        $provider_label = $is_mega ? 'Mega Cloud' : 'Google Drive';
                    ?>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="stat-card h-100 d-flex flex-column border-0 shadow-sm transition-hover">
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill small fw-700">
                                    <?= htmlspecialchars($link['subject_name']) ?>
                                </span>
                                <?php if(!empty($link['year'])): ?>
                                    <span class="text-muted small fw-600">
                                        <i class="far fa-calendar-alt me-1 text-primary"></i> <?= htmlspecialchars($link['year']) ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    <i class="<?= $brand_icon ?> fs-6"></i>
                                </div>
                                <span class="text-uppercase fw-800 text-muted" style="font-size: 0.65rem; letter-spacing: 1px;">
                                    <?= $provider_label ?>
                                </span>
                            </div>

                            <h5 class="fw-bold text-dark mb-2"><?= htmlspecialchars($link['title']) ?></h5>
                            <p class="text-secondary small flex-grow-1 line-clamp-3">
                                <?= htmlspecialchars($link['description'] ?? 'Explore the contents of this MPI resource folder.') ?>
                            </p>

                            <div class="mt-4 pt-3 border-top border-light">
                                <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" class="btn <?= $btn_theme ?> w-100 py-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                    <span class="fw-bold">Open Folder</span>
                                    <i class="fas fa-external-link-alt small"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </main>
</div>

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
    .transition-hover:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }
    .bg-soft-primary {
        background-color: rgba(67, 24, 255, 0.1) !important;
    }
    .fw-800 { font-weight: 800; }
    .fw-700 { font-weight: 700; }
    .fw-600 { font-weight: 600; }
</style>

<?php include 'includes/footer.php'; ?>