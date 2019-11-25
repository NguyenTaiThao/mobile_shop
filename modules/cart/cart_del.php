<?php
    session_start();
    $prd_id = $_GET['id'];
    $_SESSION['cart_size'] -= $_SESSION['cart'][$prd_id];
    unset($_SESSION['cart'][$prd_id]);
    header("location:../../index.php?page_layout=cart");
?>