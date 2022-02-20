<?php
if(!isset($_GET['c']) || (isset($_GET['c']) && $_GET['c'] != $_SESSION['order_code']) || empty($_SESSION['cart'])){
    header('Location: /carrito/');
    die();
}
$mvc = new MVCcontroller();
$_SESSION['order_info'] = $mvc->cart_total_count();
?>
<main id="address-order">
    <div>
        <div class="d-flex main py-5">
            <div class="container address">
                <header>
                    <div class="mb-5">
                        <a href="/" id="logo-svg-image-a">
                            <svg viewBox="0 0 304 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.759766 52.0009V0.880859H8.82377V44.8729H36.2558V52.0009H0.759766ZM85.0707 44.8729V52.0009H50.0067V0.880859H84.4227V8.00886H58.0707V22.5529H80.8947V29.2489H58.0707V44.8729H85.0707ZM135.654 44.8729V52.0009H100.59V0.880859H135.006V8.00886H108.654V22.5529H131.478V29.2489H108.654V44.8729H135.654ZM176.162 52.0009V0.880859H184.226V44.8729H211.658V52.0009H176.162ZM225.408 52.0009V0.880859H233.472V52.0009H225.408ZM295.21 52.0009V15.5689L280.162 43.2169H275.41L260.29 15.5689V52.0009H252.226V0.880859H260.866L277.786 32.1289L294.706 0.880859H303.346V52.0009H295.21Z" fill="black"/>
                            </svg>
                        </a>
                    </div>
                    <div>
                        <div class="order-steps">
                            <div class="d-flex justify-space-between align-items-center title-steps">
                                <h4>¿Como comprar?</h4>
                                <div class="icon">
                                    <ion-icon name="chevron-down-outline"></ion-icon>
                                </div>
                            </div>
                            <div class="steps">
                                <div>1. Escribe o eliges tu dirección</div>
                                <div>2. Pagas con tu metodo favorito</div>
                                <div>3. Pedido finalizado</div>
                            </div>   
                        </div>
                    </div>
                </header>
                <main class="py-5 my-5">
                    <div class="py-5 my-5">
                        <h2>Pedido</h2>
                        <?php
                        $mvc->include_modules('cart/address/'.(($mvc->isset_account_session())?'logged':'guest'));
                        ?>
                    </div>
                </main>
            </div>
            <div class="container" id="total">
                <div class="mobile-show d-none justify-space-between p-5 align-items-center">
                    <div class="d-flex">
                        <div>€ <?=number_format($_SESSION['order_info']['total'], 2, '.', '')?></div>
                    </div>
                    <div>
                        <ion-icon name="chevron-down-outline"></ion-icon>
                    </div>
                </div>
                <section>
                    <div class="cart">
                        <?php
                        foreach ($_SESSION['cart'] as $key => $value):
                        ?>
                        <div>
                            <div class="image">
                                <img src="<?=$value->item->image?>" alt="<?=$value->item->name?>">
                            </div>
                            <div class="data">
                                <div class="info">
                                    <div class="name"><?= $value->item->name?></div>
                                    <div class="option">
                                        <div class="size"><?=$value->size?></div>
                                        <div class="color" style="background-color:<?=$value->color?>"></div>
                                    </div>
                                    <div class="amount">Cantidad: <?=$value->amount?></div>
                                </div>
                                <div class="price">
                                    <?php
                                    $item_total = $value->item->price * $value->amount;
                                    ?>
                                    <span>€ <?=number_format($item_total, 2, '.', '')?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                    <div class="calc">
                        <div>
                            <div>Subtotal</div>
                            <div class="result">€ <?=number_format($_SESSION['order_info']['subtotal'], 2, '.', '')?></div>
                        </div>
                        <div>
                            <div>Envio</div>
                            <div class="result">Gratis</div>
                        </div>
                        <div>
                            <div>I.V.A (21%)</div>
                            <div class="result">€ <?=number_format($_SESSION['order_info']['extra'], 2, '.', '')?></div>
                        </div>
                    </div>
                    <div class="total">
                        <div class="d-flex justify-space-between">
                            <div class="total-title">Total</div>
                            <b>€ <?=number_format($_SESSION['order_info']['total'], 2, '.', '')?></b>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
<script>
    const status_account = <?=(($mvc->isset_account_session())?'true':'false')?>;
    const csrf_keycode = <?= $_SESSION['csrf_keycode'] ?>;
</script>