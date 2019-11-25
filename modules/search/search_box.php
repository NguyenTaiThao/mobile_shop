<?php
    $keyword = '';
    if(isset($_GET['keyword'])){
        $keyword = $_GET['keyword'];
    }
?>
<div id="search" class="col-lg-6 col-md-6 col-sm-12">
    <form class="form-inline">
        <input class="form-control mt-3" type="search" placeholder="Tìm kiếm" aria-label="Search"
            value="<?php echo $keyword;?>" name="keyword">
        <input type="hidden" name="page_layout" value="search">
        <button class="btn btn-danger mt-3" type="submit">Tìm kiếm</button>
    </form>
</div>