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
        mysqli_query($con, $sql_del);
        header("location:index.php?page_layout=product");
    }else{
        header('location:index.php');
    }
   
?>
