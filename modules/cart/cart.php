<?php
if(isset($_SESSION['cart'])){
    if(isset($_POST['sbm'])){
        $_SESSION['cart'] = $_POST['quantity'];
        header("location:index.php?page_layout=cart");
    }
}
?>
<div id="my-cart">
    <div class="row">
        <div class="cart-nav-item col-lg-7 col-md-7 col-sm-12">Thông tin sản phẩm</div>
        <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Tùy chọn</div>
        <div class="cart-nav-item col-lg-3 col-md-3 col-sm-12">Giá</div>
    </div>
    <form  method="post">
        <?php
        $total_cash = 0;
        if(isset($_SESSION['cart'])){
        foreach ($_SESSION['cart'] as $key => $value) {
            $arr_id[] = $key;
            $query_prd = mysqli_query($con, "SELECT * FROM product WHERE prd_id = $key");
            $row_prd = mysqli_fetch_assoc($query_prd);
            $total_cash += $value * $row_prd['prd_price'];
    ?>
        <div class="cart-item row">
            <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                <img src="admin/img/products/<?php echo $row_prd['prd_image']?>">
                <h4><?php echo $row_prd['prd_name']?></h4>
            </div>

            <div class="cart-quantity col-lg-2 col-md-2 col-sm-12">
                <input type="number" id="quantity" name="quantity[<?php echo $row_prd['prd_id']?>]" class="form-control form-blue quantity"
                    value="<?php echo $value?>" min="1">
            </div>
            <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo number_format($row_prd['prd_price'],0,'','.');?>đ</b><a
                    href="modules/cart/cart_del.php?id=<?php echo $row_prd['prd_id'];?>">Xóa</a></div>
        </div>
        <?php }}else{ ?>
            <div class="alert alert-danger" role="alert"> Gio hang rong </div>    
        <?php
        }
        ?>
        <div class="row">
            <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                <button id="update-cart" class="btn btn-success" type="submit" name="sbm">Cập nhật giỏ hàng</button>
            </div>
            <div class="cart-total col-lg-2 col-md-2 col-sm-12"><b>Tổng cộng:</b></div>
            <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo number_format($total_cash,0,'','.'); ?>đ</b></div>
        </div>
    </form>
</div>
<?php
    include_once('modules/customer/customer.php');
?>