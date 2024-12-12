<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "connect.php";
  
  if (!empty($_POST['Taokhmoi'])) {
    $TenKH = $_POST['TenKH'];
    $SDT = $_POST['SDT'];
    $NgayTao = $_POST['NgayLap'];
    $DiemTichLuy = $_POST['diemtichluy'];

    $stmt = $conn->prepare("INSERT INTO khachhang (TenKH, DienThoai, NgayLap, DiemTichLuy) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $TenKH, $SDT, $NgayTao, $DiemTichLuy);

    if ($stmt->execute()) {
      echo "Khách Hàng mới đã được thêm thành công.";
    } else {
      echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header('location:phan-mem-ban-hang.php');
    exit();
  }
} else {
  echo "Lỗi: Dữ liệu không hợp lệ.";
}
?>
