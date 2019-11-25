<?php
    $query_featured = mysqli_query($con, "SELECT * FROM product WHERE prd_featured = 1 ORDER BY prd_id DESC LIMIT 6");
?>
<div class="products">
    <h3>Sản phẩm nổi bật</h3>
    <div class="product-list card-deck">
        <?php
            while($row_featured = mysqli_fetch_assoc($query_featured)){
        ?>
        <div class="product-item card text-center">
            <a href="index.php?page_layout=products&id=<?php echo $row_featured['prd_id']?>"><img src="admin/img/products/<?php echo $row_featured['prd_image']?>"></a>
            <h4><a href="index.php?page_layout=products&id=<?php echo $row_featured['prd_id']?>"><?php echo $row_featured['prd_name']?></a></h4>
            <p>Giá Bán: <span><?php echo number_format($row_featured['prd_price'], 0, '','.');?>đ</span></p>
        </div>
        <?php
            }
        ?>
    </div>
</div>