<?php
    $query_latest = mysqli_query($con, "SELECT * FROM product ORDER BY prd_id DESC LIMIT 6");
?>
<div class="products">
    <h3>Sản phẩm mới</h3>
    <div class="product-list card-deck">
    <?php
    while($row_latest = mysqli_fetch_assoc($query_latest)){
    ?>
        <div class="product-item card text-center">
            <a href="index.php?page_layout=products&id=<?php echo $row_latest['prd_id']?>"><img src="admin/img/products/<?php echo $row_latest['prd_image']?>"></a>
            <h4><a href="index.php?page_layout=products&id=<?php echo $row_latest['prd_id']?>"><?php echo $row_latest['prd_name']?></a></h4>
            <p>Giá Bán: <span><?php echo number_format($row_latest['prd_price'], 0, '','.');?>đ</span></p>
        </div>
        <?php
        }
    ?>
    </div>
</div>