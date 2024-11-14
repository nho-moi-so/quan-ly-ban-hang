<?php

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "quanlidoan";
$port = 3306;


// Tạo kết nối
try {
    $conn = new mysqli($servername, $username, $password, $db_name, $port);
    
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        throw new Exception("Kết nối thất bại: " . $conn->connect_error);
    }
    
    // Đặt charset cho kết nối
    $conn->set_charset("utf8");
    echo "";
} catch (Exception $e) {
    die("Lỗi: " . $e->getMessage());
}
?>
