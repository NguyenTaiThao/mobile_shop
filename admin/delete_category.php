<?php
	if(!defined('SECURITY')){
		header("location:index.php");
    }
    $cur_id = $_GET['id'];
    if(isset($cur_id)){
        $sql_del = "DELETE FROM category WHERE cat_id = '$cur_id'";
        $query_del = mysqli_query($con, $sql_del);
        if($query_del){
            header("location:index.php?page_layout=category");
        }
    }
?>
