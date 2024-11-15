<?php
include 'connect.php';
if (isset($_GET['sdt'])) {
    $sdt = $_GET['sdt'];
    $sql_khachhang = "SELECT ho_ten FROM khachhang WHERE sdt = '$sdt'";
    $result_khachhang = $conn->query($sql_khachhang);
    if ($result_khachhang && $result_khachhang->num_rows > 0) {
        $row = $result_khachhang->fetch_assoc();
        echo $row['ho_ten'];
    } else {
        echo '';
    }
}
$conn->close();
?>
