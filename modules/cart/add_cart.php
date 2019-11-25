<?php
    $prd_id = $_GET['id'];
    session_start();
    if(isset($_SESSION['cart'][$prd_id])){
        $_SESSION['cart'][$prd_id]++;
    }else{
        $_SESSION['cart'][$prd_id]=1;
    }
    header("location:../../index.php?page_layout=cart");

?>