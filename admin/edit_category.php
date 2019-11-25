<?php
	if(!defined('SECURITY')){
		header("location:index.php");
    }
    $cur_id = $_GET['id'];
    if(isset($cur_id)){
        $query_cur_name = mysqli_query($con, "SELECT * FROM category WHERE cat_id = $cur_id");
        $cur_cat_name = mysqli_fetch_assoc($query_cur_name)['cat_name'];
        if(isset($_POST['sbm'])){
            $cat_name = $_POST['cat_name'];
            $sql_check = "SELECT * FROM category WHERE cat_name = '$cat_name'";
            $query_check = mysqli_query($con, $sql_check);
            $row_num = mysqli_num_rows($query_check);

            if($row_num > 0){
                $error = '<div class="alert alert-danger">Danh mục đã tồn tại !</div>';
            }else{
                $sql_update = "UPDATE category SET cat_name = '$cat_name' WHERE cat_id = '$cur_id'";
                $query_update = mysqli_query($con, $sql_update);
                if($query_check){
                    header("location:index.php?page_layout=category");
                }
            }
        }
    }
?>
    <script src="//cdn.ckeditor.com/4.13.0/basic/ckeditor.js"></script>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="">Quản lý danh mục</a></li>
				<li class="active">Danh mục 1</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh mục:Danh mục 1</h1>
			</div>
		</div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-8">
                            <?php if(isset($error)) echo $error ?>
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input type="text" name="cat_name" required value="<?php echo $cur_cat_name?>" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div><!-- /.col-->
	</div>	<!--/.main-->	
