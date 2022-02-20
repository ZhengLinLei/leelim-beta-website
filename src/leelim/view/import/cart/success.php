<?php
    if(!$_SESSION['order_success']){
        header('Location: /carrito/');
        die();
    }
    $mvc = new MVCcontroller();
    $mvc->include_modules(); // 默认header
?>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap" rel="stylesheet">
<main id="display-cart-main">
    <!-- 购买成功 -->
    <main class="py-5">
        <div class="d-flex flex-column align-items-center my-5 py-5">
            <h2 class="title-empty mb-3 text-center">TU PEDIDO HA SIDO COMPLETADO</h2>
            <div class="order-card">
                <div class="front">
                    <div class="water-mark-box">
                        <div class="water-mark">
                            <span>LEE LIM</span>
                        </div>
                    </div>
                    <div class="content">
                        <div class="qr">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=<?= $_SESSION['order_success']['order_code']?>" alt="Codigo QR del Pedido - LEELIM">
                        </div>
                        <div class="info">
                            <div class="text d-flex">
                                <div class="data-group">
                                    <div>
                                        <div class="label">Pedido</div>
                                        <div class="data order-code" data-copy="<?= $_SESSION['order_success']['order_code']?>"><?= $_SESSION['order_success']['order_code']?></div>
                                    </div>
                                    <div>
                                        <div class="label">Total</div>
                                        <div class="data">€ <?= number_format($_SESSION['order_success']['total']['total'], 2, '.', '')?></div>
                                    </div>
                                </div>
                                <div class="data-group">
                                    <div>
                                        <div class="label">Dirección de Envio</div>
                                        <div class="data">
                                            <div><?= $_SESSION['order_success']['address']['address']->street ?></div>
                                            <div><?= $_SESSION['order_success']['address']['address']->number ?></div>
                                            <div><?= $_SESSION['order_success']['address']['address']->city ?>, <?= $_SESSION['order_success']['address']['address']->postal_code ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center barcode-section">
                                <div class="barcode"><?= $_SESSION['order_success']['order_code']?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="back">
                    <div class="content">
                        <div class="text-center">
                            <h3>LEE LIM</h3>
                            <div class="barcode"><?= $_SESSION['order_success']['order_code']?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-5 py-5 w-7">
                <div class="d-flex align-items-center flex-column">
                    <div class="text-center">Y le hemos enviado los datos de la compra por e-mail</div>
                    <div class="my-5 p-3 email">
                        <code><i><?= $_SESSION['order_success']['email'] ?></i></code>
                    </div>
                </div>
                <div class="my-5 py-5">
                    <div class="text-center">
                        <h3><b>¡ Gracias por su compra. !</b></h3>
                    </div>
                </div>
            </div>
            <a href="/" class="btn btn-big">
                <span class="mr-3">Seguir Comprando</span>
                <ion-icon name="arrow-forward-outline"></ion-icon>
            </a>
        </div>
    </main>
</main>
<?php 
$mvc->include_modules('component/footer');
//UNSET SESSION ONCE PRINTED
unset($_SESSION['order_success']);
?>
<!-- HEADER SCRIPT -->
<script src="/static/js/src/header.js"></script>