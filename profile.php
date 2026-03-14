<?php
session_start();
require_once 'config/db.php';
require_once 'config/auth.php'; 

$user_id = $_SESSION['user_id'];
$message = "";
$error = "";

// Fetch current user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Handle Profile Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $new_name = htmlspecialchars($_POST['fullname']);
    $new_bio = htmlspecialchars($_POST['bio']);
    $profile_pic = $user['profile_pic']; // Valeur par défaut (l'ancienne photo)

    // --- LOGIQUE D'UPLOAD DE PHOTO ---
    if (!empty($_FILES['profile_image']['name'])) {
        $target_dir = "assets/img/";
        $file_extension = strtolower(pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION));
        $new_file_name = "user_" . $user_id . "_" . time() . "." . $file_extension;
        $target_file = $target_dir . $new_file_name;
        
        // Vérification du type de fichier
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($file_extension, $allowed_types)) {
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                $profile_pic = $new_file_name;
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
        } else {
            $error = "Only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }

    if (empty($error)) {
        $update = $pdo->prepare("UPDATE users SET fullname = ?, bio = ?, profile_pic = ? WHERE id = ?");
        if ($update->execute([$new_name, $new_bio, $profile_pic, $user_id])) {
            $_SESSION['user_name'] = $new_name;
            $message = "Profile updated successfully!";
            header("Refresh:1");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/header.php'; ?>
    <title>My Profile | Workspace</title>
</head>
<body class="bg-body">
    <div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>

        <main class="flex-grow-1 p-5" style="margin-left: 290px;">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="stat-card p-5 shadow-sm bg-white rounded-4">
                        
                        <form action="" method="POST" enctype="multipart/form-data">
                            
                            <div class="text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    <img src="assets/img/<?= $user['profile_pic'] ?>" 
                                         id="profileDisplay"
                                         class="rounded-circle shadow-sm border" 
                                         width="130" height="130" 
                                         style="object-fit: cover;">
                                    
                                    <label for="profile_image" class="position-absolute bottom-0 end-0 badge rounded-pill bg-primary border border-white p-2" style="cursor: pointer;">
                                        <i class="fas fa-camera"></i>
                                        <input type="file" name="profile_image" id="profile_image" class="d-none" onchange="previewImage(this)">
                                    </label>
                                </div>
                                <h3 class="fw-bold mt-3 mb-0"><?= $user['fullname'] ?></h3>
                                <p class="text-secondary text-uppercase small fw-bold mt-1"><?= $user['role'] ?></p>
                            </div>

                            <?php if($message): ?>
                                <div class="alert alert-success border-0 shadow-sm"><?= $message ?></div>
                            <?php endif; ?>
                            <?php if($error): ?>
                                <div class="alert alert-danger border-0 shadow-sm"><?= $error ?></div>
                            <?php endif; ?>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Full Name</label>
                                    <input type="text" name="fullname" class="form-control" value="<?= $user['fullname'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Email (Read Only)</label>
                                    <input type="email" class="form-control bg-light" value="<?= $user['email'] ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Bio</label>
                                    <textarea name="bio" class="form-control" rows="3"><?= $user['bio'] ?></textarea>
                                </div>
                            </div>
                            <button type="submit" name="update_profile" class="btn btn-primary mt-4 px-5 fw-bold">Save Changes</button>
                        </form>

                        <hr class="my-5">
                        <h5 class="fw-bold text-danger mb-3">Security</h5>
                        <a href="change-password.php" class="btn btn-outline-danger btn-sm">Change Password</a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileDisplay').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
</body>
</html>