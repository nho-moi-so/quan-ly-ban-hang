<?php
session_start();
include 'connect.php';
checkLogin();
checkAdmin((['Admin']));
if (isset($_POST['ids'])) {
    $ids = $_POST['ids'];
    $id_list = implode(',', array_map('intval', $ids));

    $sql = "SELECT anh_3x4 FROM nhanvien WHERE id IN ($id_list)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $file_path = '../img-anhthe/' . $row['anh_3x4'];
            
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    $sql = "DELETE FROM nhanvien WHERE id IN ($id_list)";
    if ($conn->query($sql) === TRUE) {
        echo "Các nhân viên đã chọn đã được xóa thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    echo "Không có nhân viên nào được chọn để xóa.";
}

$conn->close();
?>