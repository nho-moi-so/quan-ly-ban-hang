<?php
  session_start();
  include "connect.php";
  checkLogin();
  checkAdmin((['Admin']));
  $id= $_GET['id'];
  echo $id;
  $sql = "DELETE from khachhang Where MaKH='$id'";
  mysqli_query($conn, $sql);
  header('location:table-data-khachhang.php');

?>