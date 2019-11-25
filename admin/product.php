<script>
    function delItem(name){
        return confirm('Bạn muốn xóa sản phẩm ' +name+ ' ?');
    }
</script>
<?php
	if(!defined('SECURITY')){
		header("location:index.php");
	}
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Danh sách sản phẩm</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh sách sản phẩm</h1>
			</div>
		</div><!--/.row-->
		<div id="toolbar" class="btn-group">
            <a href="index.php?page_layout=add_product" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm
            </a>
        </div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
                        <table 
                            data-toolbar="#toolbar"
                            data-toggle="table">

						    <thead>
						    <tr>
						        <th data-field="id" data-sortable="true">ID</th>
						        <th data-field="name"  data-sortable="true">Tên sản phẩm</th>
                                <th data-field="price" data-sortable="true">Giá</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Danh mục</th>
                                <th>Hành động</th>
						    </tr>
                            </thead>
                            <tbody>
                            <?php
                            //list ra danh sách sản phẩm
                                $sobangi = 2;
                                $sql = "SELECT * FROM product
                                INNER JOIN category
                                ON product.cat_id=category.cat_id
                                ORDER BY prd_id DESC";
                                $query = queryGetItem($sql, $sobangi);
                            while($row = mysqli_fetch_assoc($query)){
                                $label = 'label-success';
                                $status = 'Còn hàng';
                                if($row['prd_status'] == 0){
                                    $label = 'label-danger';
                                    $status = 'Hết hàng';
                                }
                            ?>
                                    <tr>
                                        <td style=""><?php echo $row['prd_id']; ?></td>
                                        <td style=""><?php echo $row['prd_name']; ?></td>
                                        <td style=""><?php echo $row['prd_price'] ?></td>
                                        <td style="text-align: center">
                                        <img width="130" height="180" src="img/products/<?php echo $row['prd_image']; ?>" /></td>
                                        <td><span class="label <?php echo $label ?>">
                                        <?php echo $status ?></span></td>
                                        <td><?php echo $row['cat_name']; ?></td>
                                        <td class="form-group">
                                            <a href="index.php?page_layout=edit_product&id=<?php echo $row['prd_id']?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <a onclick="return delItem('<?php echo $row['prd_name'];?>')" href="delete_product.php?id=<?php echo $row['prd_id']?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                 </tbody>
						</table>
                    </div>
                    <div class="panel-footer">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                               <?php echo Links($sql, $sobangi);?>
                            </ul>
                        </nav>
                    </div>
				</div>
			</div>
		</div><!--/.row-->	
	</div>	<!--/.main-->
