<?php
include 'connect.php';
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM donhang WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Xóa đơn hàng thành công!";
        } else {
            echo "Lỗi khi xóa đơn hàng!";
        }
        $stmt->close();
    }
}
$conn->close();
?>
