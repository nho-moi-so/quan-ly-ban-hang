<?php
session_start();
var_dump($_SESSION);  


$_SESSION['test'] = "Testing session";
echo "<br>Đã set session test";


var_dump($_SESSION);
?>