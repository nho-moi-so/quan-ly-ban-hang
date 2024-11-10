<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM nhanvien WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
        echo json_encode($employee); 
    } else {
        echo json_encode(['error' => 'Không tìm thấy nhân viên']);
    }

    $stmt->close();
    $conn->close();
}
?>
