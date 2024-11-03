<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "connect.php";

  if (!empty($_POST['TaoSPMoi'])) {
    $UrlSP;

    // Xử lý lưu hình ảnh
    if (isset($_FILES["imageUploadfile"])) {
      $target_dir = "../img-sanpham/uploads/"; // Thư mục nơi lưu hình ảnh

      // Tạo thư mục nếu chưa tồn tại
      if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
      }

      $newFileName = time() . '_' . basename($_FILES["imageUploadfile"]["name"]);
      $target_file = $target_dir . $newFileName;
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Kiểm tra xem file có phải là hình ảnh thật không
      $check = getimagesize($_FILES["imageUploadfile"]["tmp_name"]);
      if ($check !== false) {
        $uploadOk = 1;
      } else {
        echo "File không phải là hình ảnh.";
        $uploadOk = 0;
      }

      // Kiểm tra kích thước file (Max 2MB)
      if ($_FILES["imageUploadfile"]["size"] > 2097152) {
        echo "Xin lỗi, file của bạn quá lớn.";
        $uploadOk = 0;
      }

      // Cho phép một số định dạng file nhất định
      if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Xin lỗi, chỉ cho phép các định dạng JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
      }

      // Kiểm tra nếu $uploadOk được set thành 0 do lỗi
      if ($uploadOk == 0) {
        echo "Xin lỗi, file của bạn không được upload.";
      } else {
        if (move_uploaded_file($_FILES["imageUploadfile"]["tmp_name"], $target_file)) {
          echo "Hình ảnh " . htmlspecialchars(basename($_FILES["imageUploadfile"]["name"])) . " đã được upload.";

          // Lấy URL của sản phẩm
          $UrlSP = $target_file;
          echo "URL sản phẩm: " . $UrlSP;
        } else {
          echo "Xin lỗi, đã xảy ra lỗi khi upload hình ảnh.";
        }
      }
    }
    // End

    $TenSP = $_POST['TenSP'];
    $soluong = $_POST['SoLuong'];
    $dongia = $_POST['DonGia'];
    $mota = $_POST['MoTa'];
    $MaDanhMuc = $_POST['MaDanhMuc'];
    $MaXuatXu = $_POST['MaXuatXu'];
    $Today = date("Y-m-d");

    // $sql = ("INSERT INTO sanpham (TenSP, SoLuong, DonGia, MoTa, MaDanhMuc, MaXuatXu) 
    //           VALUES ('$TenSP', '$soluong', '$dongia', '$mota', '$MaDanhMuc', '$MaXuatXu')");

    $stmt = $conn->prepare("INSERT INTO sanpham (TenSP, SoLuong, DonGia, MoTa, MaDanhMuc, MaXuatXu) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siissi", $TenSP, $soluong, $dongia, $mota, $MaDanhMuc, $MaXuatXu);

    if ($stmt->execute()) {
      echo "Sản phẩm mới đã được thêm thành công.";

      // Lấy giá trị MaSP mới được tạo ra
      $MaSP = $conn->insert_id;

      // Tiến hành thêm hình ảnh vào bảng hinhanh
      $stmtImage = $conn->prepare("INSERT INTO hinhanh (MaSP, URL, NgayTao) VALUES (?, ?, ?)");
      $stmtImage->bind_param("iss", $MaSP, $UrlSP, $Today);

      if ($stmtImage->execute()) {
        echo "URL hình ảnh đã được thêm thành công cho sản phẩm có mã: " . $MaSP;
      } else {
        echo "Lỗi: " . $stmtImage->error;
      }

      $stmtImage->close(); // Đóng statement cho hình ảnh
    } else {
      echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header('location:form-add-san-pham.php');
  }
}
