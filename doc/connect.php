<?php
header("Content-type: text/html; charset=utf-8");
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "quanlidoan";
$port = 3307;

// Tạo kết nối
try {
    $conn = new mysqli($servername, $username, $password, $db_name, $port);

    // Kiểm tra kết nối
    mysqli_set_charset($conn, 'UTF8');
    if ($conn->connect_error) {
        throw new Exception("Kết nối thất bại: " . $conn->connect_error);
    } else {
        echo "";
    }
} catch (Exception $e) {
    die("Lỗi: " . $e->getMessage());
}
