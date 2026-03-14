<?php
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['user_id'])) { header("Location: auth/login.php"); exit(); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Chat | Workspace</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css"> 
    <link rel="stylesheet" href="assets/css/chat_ui.css"> 
</head>
<body class="bg-light">

    <div class="d-flex min-vh-100">
        <?php include 'includes/sidebar.php'; ?>

        <main id="chat-app-scope" class="chat-main-wrapper">
            
            <div class="chat-top-bar p-3 bg-white border-bottom d-flex justify-content-between align-items-center shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="mobile-toggle d-lg-none me-3">
                        </div>
                    <div>
                        <h5 class="mb-0 fw-800 text-dark"># global-discussion</h5>
                        <small class="text-success fw-600"><i class="fas fa-circle me-1" style="font-size: 8px;"></i> Live Community</small>
                    </div>
                </div>
                <button class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-bold" onclick="toggleQuestionMode()" id="qModeBtn">
                    <i class="fas fa-question-circle me-1"></i> Ask Question
                </button>
            </div>

            <div id="chatBox" class="chat-box-area p-4 d-flex flex-column gap-3">
                </div>

            <div id="typingIndicator" class="px-4 py-1 small text-muted italic" style="display:none; background: rgba(255,255,255,0.8);">
                <span class="dot-flashing"></span> Student is typing...
            </div>

            <div class="chat-footer p-3 bg-white border-top">
                <form id="chatForm" class="container-fluid m-0 p-0">
                    <div class="input-group chat-custom-input-group rounded-4 overflow-hidden border">
                        <input type="hidden" id="msgType" value="normal">
                        <button class="btn btn-light border-0 text-secondary px-3" type="button">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                        <input type="text" id="msgContent" class="form-control border-0 bg-transparent shadow-none py-3" 
                               placeholder="Type a message..." required autocomplete="off">
                        <button class="btn btn-primary border-0 px-4" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>const currentUserId = <?= $_SESSION['user_id'] ?>;</script>
    <script src="assets/js/chat_engine.js"></script>
</body>
</html>