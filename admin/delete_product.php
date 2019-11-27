<?php
	if(!defined('SECURITY')){
		header("location:index.php");
    }
    session_start();
    if($_SESSION['mail'] && $_SESSION['pass']){
        define('SECURITY', TRUE);
        include_once('../config/connect.php');
        $id = $_GET['id'];
        $sql_del = "DELETE FROM product WHERE prd_id = '$id'";
        $query_del_img = mysqli_query($con, "SELECT * FROM product WHERE prd_id = $id");
        $row = mysqli_fetch_assoc($query_del_img);
        mysqli_query($con, $sql_del);
        
        $myFile = "img/products/" . $row['prd_image'];
        unlink($myFile);
        header("location:index.php?page_layout=product");
    }else{
        header('location:index.php');
    }
   
?>
