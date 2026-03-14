<?php
session_start();
require_once 'config/db.php';
require_once 'config/auth.php'; // Ensures only logged-in users search

$query = isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '';
$drive_results = [];
$video_results = [];

if (!empty($query)) {
    // Search Drive Links
    $stmt1 = $pdo->prepare("SELECT d.*, s.name as subject_name 
                            FROM drive_links d 
                            JOIN subjects s ON d.subject_id = s.id 
                            WHERE d.title LIKE ? OR d.description LIKE ?");
    $stmt1->execute(["%$query%", "%$query%"]);
    $drive_results = $stmt1->fetchAll();

    // Search YouTube Videos
    $stmt2 = $pdo->prepare("SELECT y.*, s.name as subject_name 
                            FROM youtube_videos y 
                            JOIN subjects s ON y.subject_id = s.id 
                            WHERE y.video_title LIKE ?");
    $stmt2->execute(["%$query%"]);
    $video_results = $stmt2->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/header.php'; ?>
    <title>Search Results | Workspace</title>
</head>
<body class="bg-body">
    <div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>

        <main class="flex-grow-1 p-5" style="margin-left: 290px;">
            <div class="mb-5">
                <h2 class="fw-bold">Search Results for "<?= $query ?>"</h2>
                <p class="text-secondary"><?= count($drive_results) + count($video_results) ?> resources found.</p>
            </div>

            <?php if (empty($drive_results) && empty($video_results)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-search fa-4x text-light-secondary mb-3"></i>
                    <h4 class="text-secondary">No results found. Try different keywords.</h4>
                </div>
            <?php else: ?>

                <?php if (!empty($drive_results)): ?>
                    <h4 class="mb-4 fw-bold"><i class="fab fa-google-drive me-2 text-primary"></i> Drive Documents</h4>
                    <div class="row g-4 mb-5">
                        <?php foreach($drive_results as $res): ?>
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <span class="badge bg-soft-primary text-primary mb-2"><?= $res['subject_name'] ?></span>
                                    <h6><?= $res['title'] ?></h6>
                                    <a href="<?= $res['url'] ?>" class="btn btn-sm btn-outline-primary mt-2">View File</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($video_results)): ?>
                    <h4 class="mb-4 fw-bold"><i class="fab fa-youtube me-2 text-danger"></i> Video Lessons</h4>
                    <div class="row g-4">
                        <?php foreach($video_results as $vid): ?>
                            <div class="col-md-6">
                                <div class="stat-card d-flex align-items-center gap-3">
                                    <img src="https://img.youtube.com/vi/<?= $vid['video_id'] ?>/mqdefault.jpg" class="rounded" width="120">
                                    <div>
                                        <span class="badge bg-soft-danger text-danger mb-1"><?= $vid['subject_name'] ?></span>
                                        <h6 class="mb-0"><?= $vid['video_title'] ?></h6>
                                        <a href="youtube.php" class="small text-primary text-decoration-none">Watch Video</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            <?php endif; ?>
        </main>
    </div>
</body>
</html>