<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $ho_ten = $_POST['ho_ten'];
    $anh_3x4 = $_POST['anh_3x4']; 
    $dia_chi = $_POST['dia_chi'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $sdt = $_POST['sdt'];
    $chuc_vu = $_POST['chuc_vu'];

    $sql = "UPDATE nhanvien SET ho_ten = ?, anh_3x4 = ?, dia_chi = ?, ngay_sinh = ?, gioi_tinh = ?, sdt = ?, chuc_vu = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $ho_ten, $anh_3x4, $dia_chi, $ngay_sinh, $gioi_tinh, $sdt, $chuc_vu, $id);

    if ($stmt->execute()) {
        header("Location: table-data-table.php"); 
        exit();
    } else {
        echo "Lỗi khi cập nhật thông tin.";
    }

    $stmt->close();
    $conn->close();
}
?>
