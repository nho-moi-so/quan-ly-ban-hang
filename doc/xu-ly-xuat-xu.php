<?php
include "connect.php";
require_once 'auth.php';
checkLogin();
checkAdmin(['Admin']);
$currentRole = $_SESSION['user_role'];
$current_page = basename($_SERVER['PHP_SELF']);

// Thêm xuất xứ mới
function themXuatXu($conn, $maXuatXu, $tenXuatXu, $moTa)
{
    // Kiểm tra xem mã xuất xứ đã tồn tại chưa
    $checkExist = "SELECT * FROM xuatxu WHERE MaXuatXu = ?";
    $stmt = $conn->prepare($checkExist);
    $stmt->bind_param("s", $maXuatXu);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return ["error" => "Mã xuất xứ đã tồn tại. Vui lòng chọn mã khác."];
    }

    // Chuẩn bị câu truy vấn INSERT
    $sql = "INSERT INTO xuatxu (MaXuatXu, TenXuatXu, MoTa) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $maXuatXu, $tenXuatXu, $moTa);

    if ($stmt->execute()) {
        return ["success" => "Thêm xuất xứ mới thành công."];
    } else {
        return ["error" => "Lỗi: " . $stmt->error];
    }
}

// Cập nhật xuất xứ
function suaXuatXu($conn, $maXuatXu, $tenXuatXu, $moTa)
{
    $sql = "UPDATE xuatxu SET TenXuatXu = ?, MoTa = ? WHERE MaXuatXu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $tenXuatXu, $moTa, $maXuatXu);

    if ($stmt->execute()) {
        return ["success" => "Cập nhật xuất xứ thành công."];
    } else {
        return ["error" => "Lỗi: " . $stmt->error];
    }
}

// Xóa xuất xứ
function xoaXuatXu($conn, $maXuatXu)
{
    $sql = "DELETE FROM xuatxu WHERE MaXuatXu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $maXuatXu);

    if ($stmt->execute()) {
        return ["success" => "Xóa xuất xứ thành công."];
    } else {
        return ["error" => "Lỗi: " . $stmt->error];
    }
}

// Lấy thông tin xuất xứ để chỉnh sửa
function layThongTinXuatXu($conn, $maXuatXu)
{
    $sql = "SELECT * FROM xuatxu WHERE MaXuatXu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $maXuatXu);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Lấy danh sách xuất xứ
function layDanhSachXuatXu($conn)
{
    $sql = "SELECT * FROM xuatxu";
    return $conn->query($sql);
}

// Xử lý yêu cầu từ form
$editOrigin = null;
$success = null;
$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ThemXuatXu'])) {
        $result = themXuatXu($conn, $_POST['MaXuatXu'], $_POST['TenXuatXu'], $_POST['MoTa'] ?? '');
        $success = $result['success'] ?? null;
        $error = $result['error'] ?? null;
    }

    if (isset($_POST['SuaXuatXu'])) {
        $result = suaXuatXu($conn, $_POST['MaXuatXu'], $_POST['TenXuatXu'], $_POST['MoTa'] ?? '');
        $success = $result['success'] ?? null;
        $error = $result['error'] ?? null;
    }
}

// Xử lý xóa xuất xứ
if (isset($_GET['xoa']) && isset($_GET['id'])) {
    $result = xoaXuatXu($conn, $_GET['id']);
    $success = $result['success'] ?? null;
    $error = $result['error'] ?? null;
}

// Xử lý chỉnh sửa - lấy thông tin xuất xứ để điền vào form
if (isset($_GET['sua']) && isset($_GET['id'])) {
    $editOrigin = layThongTinXuatXu($conn, $_GET['id']);
}
