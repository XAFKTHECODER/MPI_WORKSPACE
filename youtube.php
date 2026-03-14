<?php
session_start();
require_once 'config/db.php';
require_once 'config/auth.php'; 

function getYouTubeId($url) {
    $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
    if (preg_match($pattern, $url, $matches)) {
        return $matches[1];
    }
    return htmlspecialchars($url);
}

$current_page = basename(__FILE__);
$selected_subject = isset($_GET['subject']) ? $_GET['subject'] : 'all';

// Fetch subjects and videos (Keep your existing logic here)
try {
    $subjects_stmt = $pdo->query("SELECT DISTINCT s.id, s.name FROM subjects s JOIN youtube_videos y ON s.id = y.subject_id ORDER BY s.name ASC");
    $all_subjects = $subjects_stmt->fetchAll();
    
    $query = "SELECT y.*, s.name as subject_name FROM youtube_videos y JOIN subjects s ON y.subject_id = s.id";
    if ($selected_subject !== 'all') { $query .= " WHERE y.subject_id = :subject_id"; }
    $query .= " ORDER BY y.id DESC";
    $stmt = $pdo->prepare($query);
    if ($selected_subject !== 'all') { $stmt->execute(['subject_id' => $selected_subject]); } else { $stmt->execute(); }
    $videos = $stmt->fetchAll();
} catch (PDOException $e) { $all_subjects = []; $videos = []; }
?>

<?php include 'includes/header.php'; ?>

<nav class="navbar navbar-dark bg-dark d-lg-none px-3 py-2 sticky-top shadow-sm">
    <div class="container-fluid px-0">
        <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile">
            <span class="navbar-toggler-icon"></span>
        </button>
        <span class="navbar-brand mx-auto fw-bold text-primary mb-0" style="color: #4318FF !important;">Video Portal</span>
    </div>
</nav>

<div class="container-fluid p-0">
    <div class="d-flex">
        
        <aside class="d-none d-lg-block">
            <?php include 'includes/sidebar.php'; ?>
        </aside>

        <div class="offcanvas offcanvas-start bg-dark d-lg-none" tabindex="-1" id="sidebarMobile" style="width: 280px;">
            <div class="offcanvas-header justify-content-end pb-0">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body p-0">
                <?php include 'includes/sidebar.php'; ?>
            </div>
        </div>

        <main class="content-area flex-grow-1 p-3 p-md-4 p-lg-5">
            <style>
                /* Layout dynamique */
                @media (min-width: 992px) {
                    main.content-area { 
                        margin-left: 290px !important; 
                        max-width: calc(100% - 290px);
                    }
                }

                /* Ajustements titres et boutons sur mobile */
                @media (max-width: 576px) {
                    .header-section { text-align: center; }
                    .filter-scroll { 
                        display: flex; 
                        overflow-x: auto; 
                        white-space: nowrap; 
                        padding-bottom: 10px;
                        -webkit-overflow-scrolling: touch;
                    }
                    .filter-scroll::-webkit-scrollbar { display: none; }
                    .btn-filter { flex: 0 0 auto; }
                }
            </style>

            <div class="header-section mb-4 mb-lg-5">
                <h1 class="fw-800 mb-1">Video Portal</h1>
                <p class="text-secondary">Select a subject to filter educational content.</p>
            </div>

            <div class="mb-4 filter-scroll d-flex flex-wrap gap-2">
                <a href="<?= $current_page ?>?subject=all" 
                   class="btn-filter btn <?= $selected_subject == 'all' ? 'btn-primary' : 'btn-outline-primary' ?> rounded-pill px-4 shadow-sm">
                   All Videos
                </a>
                
                <?php foreach ($all_subjects as $sub): ?>
                    <a href="<?= $current_page ?>?subject=<?= $sub['id'] ?>" 
                       class="btn-filter btn <?= $selected_subject == $sub['id'] ? 'btn-primary' : 'btn-outline-primary' ?> rounded-pill px-4 shadow-sm">
                       <?= htmlspecialchars($sub['name']) ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="row g-3 g-md-4">
                <?php if (empty($videos)): ?>
                    <div class="col-12 text-center py-5">
                        <div class="p-5 border border-dashed rounded-4 bg-white shadow-sm">
                            <i class="fas fa-video-slash fa-3x text-light mb-3"></i>
                            <p class="text-muted mb-0">No videos found for this selection.</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach($videos as $video): ?>
                        <?php $cleanVideoId = getYouTubeId($video['video_id']); ?>
                        
                        <div class="col-12 col-md-6 col-xxl-4">
                            <div class="card h-100 border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
                                <div class="ratio ratio-16x9 bg-dark">
                                    <iframe 
                                        src="https://www.youtube.com/embed/<?= $cleanVideoId ?>" 
                                        title="<?= htmlspecialchars($video['video_title']) ?>" 
                                        loading="lazy"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                                
                                <div class="card-body p-3 p-md-4">
                                    <div class="mb-2">
                                        <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">
                                            <?= htmlspecialchars($video['subject_name']) ?>
                                        </span>
                                    </div>
                                    <h5 class="card-title fw-bold text-dark mb-0 fs-6 fs-md-5">
                                        <?= htmlspecialchars($video['video_title']) ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>

<?php include 'includes/footer.php'; ?>