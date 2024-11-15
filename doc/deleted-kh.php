<?php
  include"connect.php";
  $id= $_GET['id'];
  echo $id;
  $sql = "DELETE from khachhang Where MaKH='$id'";
  mysqli_query($conn, $sql);
  header('location:table-data-khachhang.php');

?>