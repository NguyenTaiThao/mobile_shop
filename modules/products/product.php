<?php
    ob_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include_once("modules/paginate/paginate.php");
    if(isset($_GET['id'])){
        $cur_id = $_GET['id'];
        $query_prd = mysqli_query($con, "SELECT * FROM product WHERE prd_id = '$cur_id'");
        $cur_row = mysqli_fetch_assoc($query_prd);
    }else{
        header("location:index.php");
    }
    if(isset($_POST['sbm'])){
        $comm_name = $_POST['comm_name'];
        $comm_mail= $_POST['comm_mail'];
        $comm_details= $_POST['comm_details'];
        $date = date("Y/m/d H:i:s");
        $sql = "INSERT INTO comment(prd_id, comm_name,comm_mail, comm_date, comm_details) VALUES('$cur_id', '$comm_name', '$comm_mail', '$date','$comm_details')";
        $query = mysqli_query($con, $sql);
        if($query){
            header("location:index.php?page_layout=products&id=".$cur_id);
        }
    }
?>
<div id="product">
    <div id="product-head" class="row">
        <div id="product-img" class="col-lg-6 col-md-6 col-sm-12">
            <img src="admin/img/products/<?php echo $cur_row['prd_image']?>">
        </div>
        <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
            <h1><?php echo $cur_row['prd_name'];?></h1>
            <ul>
                <li><span>Bảo hành:</span> <?php echo $cur_row['prd_warranty'];?></li>
                <li><span>Đi kèm:</span><?php echo $cur_row['prd_accessories'];?></li>
                <li><span>Tình trạng:</span> <?php echo $cur_row['prd_new'];?></li>
                <li><span>Khuyến Mại:</span> <?php echo $cur_row['prd_promotion'];?></li>
                <li id="price">Giá Bán (chưa bao gồm VAT)</li>
                <li id="price-number"><?php echo number_format($cur_row['prd_price'], 0, '','.');?>đ</li>
                <li id="<?php if($cur_row['prd_status'] == 1) echo 'status'; else echo 'status-fail';?>"><?php if($cur_row['prd_status'] == 1) echo 'Còn hàng'; else echo 'Hết hàng';?></li>
            </ul>
            <!-- <div id="add-cart"><a href="index.php?page_layout=order&id=<?php echo $cur_row['prd_id'];?>">Mua ngay</a> -->
            <div id="add-cart"><a href="modules/cart/add_cart.php?id=<?php echo $cur_row['prd_id'];?>">Mua ngay</a>
            </div>
        </div>
    </div>
    <div id="product-body" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Đánh giá về <?php echo $cur_row['prd_name']?></h3>
            <p>
                <?php echo $cur_row['prd_details']?>
            </p>
        </div>
    </div>
    <div id="comment" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Bình luận sản phẩm</h3>
            <form method="post">
                <div class="form-group">
                    <label>Tên:</label>
                    <input name="comm_name" required type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input name="comm_mail" required type="email" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <label>Nội dung:</label>
                    <textarea name="comm_details" required rows="8" class="form-control"></textarea>
                </div>
                <button type="submit" name="sbm" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>
    <?php
        $soBanGhi = 5;
        $sql = "SELECT * FROM comment WHERE prd_id = $cur_id ORDER BY comm_id DESC";
        $query_prd = queryGetItem($sql, $soBanGhi);
    ?>
    <div id="comments-list" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php
                while($row = mysqli_fetch_assoc($query_prd)){
            ?>
            <div class="comment-item">
                <ul>
                    <li><b><?php echo $row['comm_name'];?></b></li>
                    <li><?php echo $row['comm_date'];?></li>
                    <li><p><?php echo $row['comm_details'];?></p></li>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
    <!--	End Comments List	-->
</div>
<!--	End Product	-->
<div id="pagination">
    <ul class="pagination">
        <?php echo Links($sql, $soBanGhi);?>
    </ul>
</div>
<?php ob_flush();?>