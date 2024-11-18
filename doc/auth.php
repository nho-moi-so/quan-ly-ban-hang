<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
function checkLogin() {
    // Kiểm tra session
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
    
    // Kiểm tra timeout (ví dụ: 30 phút)
    // if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    //     session_unset();
    //     session_destroy();
    //     header("Location: login.php?msg=timeout");
    //     exit();
    // }
    
    // // Cập nhật thời gian hoạt động
    // $_SESSION['last_activity'] = time();
}

// Hàm kiểm tra quyền admin nếu cần
function checkAdmin($allowedRoles = []) {
    if (!isset($_SESSION['user_role'])) {
        header("Location: index.php");
        exit();
    }
    if (!in_array($_SESSION['user_role'], $allowedRoles)) {
        // Chuyển hướng nếu vai trò không hợp lệ
        header("Location: index.php");
        exit();
    }
    
}

$currentRole = $_SESSION['user_role'];

// Hàm logout
function logout() {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>