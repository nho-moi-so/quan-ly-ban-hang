<div class="cart-section">
    <h4>Giỏ hàng</h4>
    <?php if (count($_SESSION['cart']) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã SP</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng giá</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $totalPrice = $item['quantity'] * $item['DonGia'];
                    $total += $totalPrice;
                    echo '<tr>';
                    echo '<td>' . $item['MaSP'] . '</td>';
                    echo '<td>' . $item['TenSP'] . '</td>';
                    echo '<td>' . $item['quantity'] . '</td>';
                    echo '<td>' . number_format($item['DonGia'], 0, ',', '.') . ' VNĐ</td>';
                    echo '<td>' . number_format($totalPrice, 0, ',', '.') . ' VNĐ</td>';
                    echo '<td>
                        <form class="remove-from-cart-form" method="POST">
                            <input type="hidden" name="MaSPToRemove" value="' . $item['MaSP'] . '">
                            <button type="submit" name="remove_from_cart" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <p><strong>Tổng cộng: <?php echo number_format($total, 0, ',', '.') . ' VNĐ'; ?></strong></p>
    <?php else: ?>
        <p>Giỏ hàng hiện tại không có sản phẩm nào.</p>
    <?php endif; ?>
</div>
