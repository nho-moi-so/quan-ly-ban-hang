<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_chuc_vu = $_POST['ten_chuc_vu'];

    $sql = "DELETE FROM chucvu WHERE TenChucVu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ten_chuc_vu);

    if ($stmt->execute()) {
        echo "success"; 
    } else {
        echo "Lỗi: Không thể xóa chức vụ này.";
    }

    $stmt->close();
    $conn->close();
}
?>
