<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "connect.php";
  if (!empty($_POST['Taokhmoi'])) {
    $TenKH = $_POST['TenKH'];
    $SDT = $_POST['SDT'];
    $NgayTao = $_POST['NgayLap'];
    $DiemTichLuy = $_POST['diemtichluy'];
    $stmt = $conn->prepare("INSERT INTO khachhang (TenKH, DienThoai, NgayLap, DiemTichLuy) VALUES ( ?, ?, ?, ?)");
            $stmt->bind_param("sssi", $TenKH, $SDT, $NgayTao, $DiemTichLuy);
    if ($stmt->execute()) {
      echo "Khách Hàng mới đã được thêm thành công.";

      // Lấy giá trị MaKH mới được tạo ra
      $MaKH = $conn->insert_id;
    } else {
      echo "Lỗi: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
    header('location:form-add-khach-hang.php');
  }
}else{
    echo"loi";
}
?>
