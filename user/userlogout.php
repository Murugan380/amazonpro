<?php
session_start();
setcookie('cart_date',json_encode($_SESSION['cart']),time()+86400*7);
unset($_SESSION['cart']);
unset($_SESSION['name']);
header("location:userlog.php");
?>