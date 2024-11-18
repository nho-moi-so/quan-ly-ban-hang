<?php
session_start();
include 'connect.php';
checkLogin();
checkAdmin((['Admin']));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "SELECT anh_3x4 FROM nhanvien WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($file_name);
    $stmt->fetch();
    $stmt->close();

    $directory = '../img-anhthe/';
    $file_path = $directory . $file_name;

    if (file_exists($file_path)) {
        unlink($file_path);
    }

    $sql = "DELETE FROM nhanvien WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: table-data-table.php"); 
        exit();
    } else {
        echo "Lỗi khi xóa nhân viên.";
    }

    $stmt->close();
    $conn->close();
}
?>