<?php
    if(!defined('SECURITY')){
		header("location:index.php");
    }
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $rows_per_page = 5;
    $total_row = mysqli_num_rows( mysqli_query($con, "SELECT * FROM user"));
    $row_page = $page * $rows_per_page - $rows_per_page;
    $total_page = ceil($total_row / $rows_per_page);
    
    $list_page = '';

    //nut page previous
    $page_pre = $page - 1;
    if($page_pre <= 0){
        $page_pre = 1;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page=' . $page_pre . '">&laquo;</a></li>';

    //nut page 1,2,3...
    for($i = 1; $i <= $total_page; $i++){
        if($i == $page){
            $active = 'active';
        }else{
            $active = '';
        }
        $list_page .= '<li class="page-item ' . $active . '"><a class="page-link" href="index.php?page_layout=user&page=' . $i . '">' . $i . '</a></li>';
    }

    // nut page next
    $page_next = $page + 1;
    if($page_next > $total_page){
        $page_next = $total_page;
    }
    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page=' . $page_next . '">&raquo;</a></li>';
?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Danh sách thành viên</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh sách thành viên</h1>
			</div>
		</div><!--/.row-->
		<div id="toolbar" class="btn-group">
            <a href="index.php?page_layout=add_user" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i> Thêm thành viên
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
						        <th data-field="name"  data-sortable="true">Họ & Tên</th>
                                <th data-field="price" data-sortable="true">Email</th>
                                <th>Quyền</th>
                                <th>Hành động</th>
						    </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql_user = "SELECT * FROM user ORDER BY user_level ASC LIMIT $row_page, $rows_per_page";
                                    $query_user = mysqli_query($con, $sql_user);
                                    while($row = mysqli_fetch_assoc($query_user)){
                                        $acc_type = "member";
                                        $acc_label = "label-warning";
                                        if($row['user_level'] == 1){
                                            $acc_type = "Admin";
                                            $acc_label = "label-danger";
                                        }
                                    ?>
                                    <td style=""><?php echo $row['user_id'] ?></td>
                                    <td style=""><?php echo $row['user_full'] ?></td>
                                    <td style=""><?php echo $row['user_mail'] ?></td>
                                    <td><span class="label <?php echo $acc_label ?>"><?php echo $acc_type ?></span></td>
                                    <td class="form-group">
                                        <a href="index.php?page_layout=edit_user&id=<?php echo $row['user_id']?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="index.php?page_layout=delete_user&id=<?php echo $row['user_id']?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                                
                            </tbody>
						</table>
                    </div>
                    <div class="panel-footer">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php echo $list_page ?>
                            </ul>
                        </nav>
                    </div>
				</div>
			</div>
		</div><!--/.row-->	
	</div>	<!--/.main-->
