<?php
session_start();
include "connect.php";
// Kiểm tra kết nối CSDL
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $taikhoan = $_POST['taikhoan'];
    $password = $_POST['password'];

    // Kiểm tra giá trị đã được gửi
    echo "Tài khoản: " . $taikhoan . "<br>";
    echo "Mật khẩu: " . $password . "<br>";

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare("SELECT id, taikhoan, role FROM nhanvien WHERE taikhoan = ? AND password = ?");
    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error); // In lỗi nếu câu lệnh chuẩn bị không thành công
    }

    // Liên kết tham số
    $stmt->bind_param("ss", $taikhoan, $password);

    // Thực thi câu lệnh SQL
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra kết quả
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id']; // Lưu user_id vào session
        $_SESSION['user_role'] = $row['role'];
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>'; 
        header("Location: index.php"); // Chuyển hướng đến trang chủ
        exit();
    } else {
        echo "Tên đăng nhập hoặc mật khẩu không đúng!";
    }

    // Đảm bảo đóng statement
    if (isset($stmt) && $stmt !== false) {
        $stmt->close();
    }
}

// Đóng kết nối CSDL
$conn->close();
