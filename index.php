<?php
session_start();
// Redirect to dashboard if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentWorkspace | Centralize Your Learning</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <style>
        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .hero-section {
            padding: 160px 0 100px 0;
            background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.1), transparent),
                        radial-gradient(circle at bottom left, rgba(168, 85, 247, 0.1), transparent);
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            margin-bottom: 20px;
            background: var(--primary);
            color: white;
            font-size: 24px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="fas fa-graduation-cap me-2"></i>Workspace
            </a>
            <div class="d-flex gap-3">
                <a href="auth/login.php" class="btn btn-link text-dark text-decoration-none fw-semibold">Login</a>
                <a href="auth/signup.php" class="btn btn-primary px-4 rounded-pill shadow-sm">Sign Up Free</a>
            </div>
        </div>
    </nav>

    <section class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill mb-3">v2.0 is now live!</span>
                    <h1 class="display-3 fw-800 mb-4" style="letter-spacing: -2px;">Study Smarter, <br><span class="text-primary">Not Harder.</span></h1>
                    <p class="lead text-secondary mb-5 px-lg-5">
                        Access your Google Drive folders, YouTube lectures, and course documents in one unified, modern workspace designed for high-performing students.
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="auth/signup.php" class="btn btn-primary btn-lg px-5 py-3 rounded-4 shadow">Get Started Now</a>
                        <a href="#features" class="btn btn-outline-dark btn-lg px-5 py-3 rounded-4">View Features</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card p-4 h-100">
                        <div class="feature-icon bg-primary shadow-sm">
                            <i class="fab fa-google-drive"></i>
                        </div>
                        <h4 class="fw-bold">Drive Integration</h4>
                        <p class="text-secondary">Direct access to your subject folders without digging through Google Drive's messy UI.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-4 h-100">
                        <div class="feature-icon bg-danger shadow-sm">
                            <i class="fab fa-youtube"></i>
                        </div>
                        <h4 class="fw-bold">Video Portal</h4>
                        <p class="text-secondary">Watch curated YouTube playlists for your specific subjects without distractions.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card p-4 h-100">
                        <div class="feature-icon bg-success shadow-sm">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h4 class="fw-bold">Admin Managed</h4>
                        <p class="text-secondary">Only the best, verified resources are added by your admins to ensure quality learning.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 bg-white border-top mt-5">
        <div class="container text-center">
            <p class="text-muted mb-0">&copy; 2026 StudentWorkspace. Built for production.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>