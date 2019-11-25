<?php
    $cart_size = 0;
    if(isset($_SESSION['cart'])){
        $cart_size = array_sum($_SESSION['cart']);   
    }
?>
<div id="cart" class="col-lg-3 col-md-3 col-sm-12">
    <a class="mt-4 mr-2" href="index.php?page_layout=cart">giỏ hàng</a><span class="mt-3"><?php echo $cart_size;?></span>
</div>