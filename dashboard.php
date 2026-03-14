<?php
session_start();
require_once 'config/db.php';
require_once 'config/auth.php'; 

$drive_count = $pdo->query("SELECT COUNT(*) FROM drive_links")->fetchColumn();
$video_count = $pdo->query("SELECT COUNT(*) FROM youtube_videos")->fetchColumn();
$subject_count = $pdo->query("SELECT COUNT(*) FROM subjects")->fetchColumn();
?>

<?php include 'includes/header.php'; ?>

<nav class="navbar navbar-dark bg-dark d-lg-none px-3 py-2 sticky-top shadow-sm">
    <div class="container-fluid px-0">
        <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile">
            <span class="navbar-toggler-icon"></span>
        </button>
        <span class="navbar-brand mx-auto h1 fw-bold text-primary mb-0" style="color: #4318FF !important; transform: translateX(-15px);">
            <i class="fas fa-graduation-cap"></i> Workspace
        </span>
    </div>
</nav>

<div class="container-fluid p-0">
    <div class="d-flex">
        
        <aside class="d-none d-lg-block">
            <?php include 'includes/sidebar.php'; ?>
        </aside>

        <div class="offcanvas offcanvas-start bg-dark d-lg-none" tabindex="-1" id="sidebarMobile" style="width: 280px; border-right: 1px solid rgba(255,255,255,0.1);">
            <div class="offcanvas-header justify-content-end pb-0">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body p-0">
                <?php include 'includes/sidebar.php'; ?>
            </div>
        </div>

        <main class="content-area flex-grow-1 min-vh-100 p-3 p-sm-4 p-md-5">
            <style>
                /* Layout Engine */
                @media (min-width: 992px) {
                    main.content-area { 
                        margin-left: 290px !important; 
                        max-width: calc(100% - 290px);
                    }
                }

                /* Mobile-First Adjustments */
                @media (max-width: 767.98px) {
                    .header-content { text-align: center; }
                    .date-badge { margin: 1rem auto 0; display: inline-block; }
                    .stat-card { text-align: center; }
                    .stat-card .d-flex { flex-direction: column; }
                    .icon-circle { margin: 0 0 1rem 0 !important; }
                    .hero-card { text-align: center; padding: 2rem 1.5rem !important; }
                }

                /* Fluid Typography */
                h1 { font-size: clamp(1.5rem, 5vw, 2.5rem); }
                .stat-card h3 { font-size: clamp(1.2rem, 3vw, 1.8rem); }
            </style>
            
            <header class="header-content d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
                <div class="mb-3 mb-md-0">
                    <h1 class="fw-800 mb-1">Mar7be, <?= explode(' ', $_SESSION['user_name'])[0] ?>! 👋</h1>
                    <p class="text-secondary mb-0 fw-medium">Chnowa Newi ta9ra lyoum?</p>
                </div>
                <div class="date-badge bg-white px-4 py-2 rounded-pill shadow-sm fw-bold border border-light">
                    <i class="far fa-calendar-alt text-primary me-2"></i> 
                    <span class="small"><?= date('F d, Y') ?></span>
                </div>
            </header>

            <div class="row g-3 g-md-4 mb-5 justify-content-center">
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="stat-card p-4 h-100 shadow-sm border-0 transition-hover">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <div class="icon-circle bg-soft-primary text-primary me-md-3">
                                <i class="fab fa-google-drive"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0 text-dark"><?= $drive_count ?></h3>
                                <small class="text-muted text-uppercase fw-bold ls-1" style="font-size: 0.7rem;">Drive Files</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="stat-card p-4 h-100 shadow-sm border-0 transition-hover">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <div class="icon-circle bg-soft-danger text-danger me-md-3">
                                <i class="fab fa-youtube"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0 text-dark"><?= $video_count ?></h3>
                                <small class="text-muted text-uppercase fw-bold ls-1" style="font-size: 0.7rem;">Video Lessons</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="stat-card p-4 h-100 shadow-sm border-0 transition-hover">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <div class="icon-circle bg-soft-success text-success me-md-3">
                                <i class="fas fa-tags"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0 text-dark"><?= $subject_count ?></h3>
                                <small class="text-muted text-uppercase fw-bold ls-1" style="font-size: 0.7rem;">Active Subjects</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-card bg-primary p-4 p-md-5 rounded-4 text-white mb-5 shadow-lg position-relative overflow-hidden">
                <div class="position-relative" style="z-index: 2;">
                    <div class="col-lg-8 px-0">
                        <h2 class="fw-bold mb-3">New Resources Available!</h2>
                        <p class="opacity-75 mb-4 fs-6">Your admins have just updated the Physics and IT Drive folders with last week's exam solutions. Check them out before the next DS!</p>
                        <a href="drive.php" class="btn btn-light rounded-pill px-4 py-2 fw-bold shadow-sm">
                            Explore Library <i class="fas fa-arrow-right ms-2 small"></i>
                        </a>
                    </div>
                </div>
                <div class="position-absolute d-none d-md-block" style="width:300px; height:300px; background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 100%); border-radius:50%; top:-100px; right:-100px;"></div>
            </div>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>