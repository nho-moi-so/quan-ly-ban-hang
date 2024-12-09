<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tongcong = isset($_POST['tongcong']) ? floatval(str_replace(',', '', $_POST['tongcong'])) : 0;
    $khachhang_dua_tien = isset($_POST['khachhang_dua_tien']) ? floatval(str_replace(',', '', $_POST['khachhang_dua_tien'])) : 0;

    $khachhang_thoi = $khachhang_dua_tien - $tongcong;

    if ($khachhang_thoi < 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Tiền khách đưa không đủ để thanh toán!',
            'change' => 0
        ]);
    } else {
        echo json_encode([
            'status' => 'success',
            'message' => 'Tiền thừa: ' . number_format($khachhang_thoi, 0, ',', '.') . ' VNĐ',
            'change' => number_format($khachhang_thoi, 0, ',', '.')
        ]);
    }
    exit;
}
