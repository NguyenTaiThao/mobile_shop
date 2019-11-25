<?php
    if(isset($_GET['category'])){
        $cur_category = $_GET['category'];
        $cur_id = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM category WHERE cat_name  = '$cur_category'"))['cat_id'];
        $cur_category = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM category WHERE cat_name  = '$cur_category'"))['cat_name'];
        $query_prd = mysqli_query($con, "SELECT * FROM product WHERE cat_id = '$cur_id' ORDER BY prd_id DESC");
        $num_prd = mysqli_num_rows($query_prd);
    }else{
        header("location:index.php");
    }
?>
<div class="products">
    <h3><?php echo $cur_category?> (hiện có <?php echo $num_prd?> sản phẩm)</h3>
    <div class="product-list card-deck">
        <?php
            while($row_prd = mysqli_fetch_assoc($query_prd)){
        ?>
        <div class="product-item card text-center">
            <a href="index.php?page_layout=products&id=<?php echo $row_prd['prd_id']?>"><img src="admin/img/products/<?php echo $row_prd['prd_image']?>"></a>
            <h4><a href="index.php?page_layout=products&id=<?php echo $row_prd['prd_id']?>"><?php echo $row_prd['prd_name']?></a></h4>
            <p>Giá Bán: <span><?php echo number_format($row_prd['prd_price'],'0','','.');?>đ</span></p>
        </div>
        <?php } ?>
    </div>
</div>
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Trang trước</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Trang sau</a></li>
    </ul> 
</div>

