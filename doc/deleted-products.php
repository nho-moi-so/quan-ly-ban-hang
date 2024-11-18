<?php
  session_start();
  include "connect.php";
  checkLogin();
  checkAdmin((['Admin']));
  $id= $_GET['id'];
  echo $id;
  $sql = "DELETE from sanpham Where MaSP='$id'";
  mysqli_query($conn, $sql);
  header('location:table-data-product.php');

?>