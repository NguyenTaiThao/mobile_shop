<?php
	if(!defined('SECURITY')){
		header("location:index.php");
	}
?>
<?php
    $con = mysqli_connect('localhost', 'root','', 'dtb_vietpro');
    if($con){
        mysqli_query($con, 'SET NAMES "utf8"');
    }else{
        die('Ket noi that bai.');
    }

?>