<?php
    $mvc = new MVCcontroller();
    $mvc->include_modules(); // 默认header
?>
<main id="display-cart-main">
    <!-- 显示购物车 -->
    <?php
    if(!isset($_SESSION['cart']) || (isset($_SESSION['cart']) && empty($_SESSION['cart']))){
        $mvc->include_modules(('cart/display/empty'));
    }else{
        $mvc->include_modules(('cart/display/content'));
    }
    $mvc->include_modules('component/footer');
    ?>
</main>
<!-- HEADER SCRIPT -->
<script src="/static/js/src/header.js"></script>