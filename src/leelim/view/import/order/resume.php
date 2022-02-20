<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap" rel="stylesheet">
<header class="py-5">
    <!-- SEO HELPER -->
    <nav class="d-none">
        <ul>
            <li><a href="/">LEELIM</a></li>
            <li><a href="/busquedas/">BUSQUEDAS</a></li>
            <li><a href="/galeria/">GALERIA</a></li>
            <li><a href="/mujer/">MUJER</a></li>
            <li><a href="/hombre/">HOMBRE</a></li>
            <li><a href="/unisex/">UNISEX</a></li>
        </ul>
    </nav>
    <section class="d-flex flex-column align-items-center my-5">
        <a href="/" id="logo-svg-image-a">
            <svg viewBox="0 0 304 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.759766 52.0009V0.880859H8.82377V44.8729H36.2558V52.0009H0.759766ZM85.0707 44.8729V52.0009H50.0067V0.880859H84.4227V8.00886H58.0707V22.5529H80.8947V29.2489H58.0707V44.8729H85.0707ZM135.654 44.8729V52.0009H100.59V0.880859H135.006V8.00886H108.654V22.5529H131.478V29.2489H108.654V44.8729H135.654ZM176.162 52.0009V0.880859H184.226V44.8729H211.658V52.0009H176.162ZM225.408 52.0009V0.880859H233.472V52.0009H225.408ZM295.21 52.0009V15.5689L280.162 43.2169H275.41L260.29 15.5689V52.0009H252.226V0.880859H260.866L277.786 32.1289L294.706 0.880859H303.346V52.0009H295.21Z" fill="black" />
            </svg>
        </a>
    </section>
</header>
<main id="display-order-main" class="my-5 py-5">
    <!-- 购买记录 -->
    <main class="py-5 my-5 d-flex body">
        <div class="flex-1 details-section">
            <div class="mb-5 pb-5">
                <?php
                if (empty($_SESSION['order_request_info']['shipping_code'])) {
                ?>
                    <div class="mt-5 d-flex justify-center">
                        <div class="p-5 warning d-flex align-items-center small">
                            <ion-icon name="hourglass-outline"></ion-icon>
                            <div class="ml-5">Este pedido aún esta en proceso.</div>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="mt-5 d-flex justify-center">
                        <div class="p-5 success d-flex align-items-center small">
                            <ion-icon name="footsteps-outline"></ion-icon>
                            <div class="ml-5">Este pedido esta en camino.</div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="d-flex justify-center my-5 py-5">
                <div class="card d-flex flex-column align-items-center">
                    <div class="my-5">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=<?= $_SESSION['order_request_info']['order_code'] ?>" alt="QR del Codigo del pedido - LEELIM">
                    </div>
                    <div class="my-5">
                        <div class="barcode"><?= $_SESSION['order_request_info']['order_code'] ?></div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column align-items-center">
                <div class="my-5">
                    <div class="table d-flex">
                        <div class="flex-1 px-5">
                            <div class="my-5 py-5">
                                <div class="text-center title-table my-5">Codigo pedido</div>
                                <div class="table-body">
                                    <div>
                                        <span><?= $_SESSION['order_request_info']['order_code'] ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (!empty($_SESSION['order_request_info']['shipping_code'])) :
                            ?>
                                <div class="my-5 py-5">
                                    <div class="text-center title-table my-5">Codigo envío</div>
                                    <div class="table-body">
                                        <div>
                                            <span><?= $_SESSION['order_request_info']['shipping_code'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endif;
                            ?>
                            <div class="my-5 py-3">
                                <div class="text-center title-table my-5">Enviar a</div>
                                <div class="table-body">
                                    <div>
                                        <span><?= $_SESSION['order_request_info']['address']->address->name ?> <?= $_SESSION['order_request_info']['address']->address->surname ?></span>
                                    </div>
                                    <div>
                                        <span><?= $_SESSION['order_request_info']['address']->address->street ?></span>
                                    </div>
                                    <div>
                                        <span><?= $_SESSION['order_request_info']['address']->address->number ?></span>
                                    </div>
                                    <div>
                                        <span><?= $_SESSION['order_request_info']['address']->address->postal_code ?>, <?= $_SESSION['order_request_info']['address']->address->city ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 px-5">
                            <div class="my-5 py-3">
                                <div class="text-center title-table my-5">Detalles</div>
                                <div class="table-body order-details-total">
                                    <?php
                                    $datetime = strtotime($_SESSION['order_request_info']['date_create']);
                                    ?>
                                    <div class="mb-5 pb-5">
                                        <div class="my-2">
                                            <table class="w-10">
                                                <tbody>
                                                    <tr>
                                                        <td>Fecha</td>
                                                        <td class="text-right b"><?= date('d-m-Y', $datetime) ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="my-2">
                                            <table class="w-10">
                                                <tbody>
                                                    <tr>
                                                        <td>Hora</td>
                                                        <td class="text-right b"><?= date('H:i', $datetime) ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div>
                                        <table class="w-10">
                                            <tbody>
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <td class="text-right">€ <?= number_format($_SESSION['order_request_info']['total_value']->subtotal, 2, '.', '') ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <table class="w-10">
                                            <tbody>
                                                <tr>
                                                    <td>Envio</td>
                                                    <td class="text-right">Gratis</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <table class="w-10">
                                            <tbody>
                                                <tr>
                                                    <td>IVA (21%)</td>
                                                    <td class="text-right">€ <?= number_format($_SESSION['order_request_info']['total_value']->extra, 2, '.', '') ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="line"></div>
                                    <div>
                                        <table class="w-10">
                                            <tbody>
                                                <tr>
                                                    <td>Total</td>
                                                    <td class="text-right b">€ <?= number_format($_SESSION['order_request_info']['total_value']->total, 2, '.', '') ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="my-5 py-3">
                                <div class="text-center title-table my-5">Facturación</div>
                                <div class="table-body">
                                    <div>
                                        <span><?= $_SESSION['order_request_info']['billing_address']->name ?> <?= $_SESSION['order_request_info']['billing_address']->surname ?></span>
                                    </div>
                                    <div>
                                        <span><?= $_SESSION['order_request_info']['billing_address']->street ?></span>
                                    </div>
                                    <div>
                                        <span><?= $_SESSION['order_request_info']['billing_address']->number ?></span>
                                    </div>
                                    <div>
                                        <span><?= $_SESSION['order_request_info']['billing_address']->postal_code ?>, <?= $_SESSION['order_request_info']['billing_address']->city ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="my-5 py-3">
                                <div class="text-center title-table my-5">Contacto</div>
                                <div class="table-body">
                                    <div>
                                        <span>+34 <?= chunk_split($_SESSION['order_request_info']['address']->address->tel, 3, " ") ?></span>
                                    </div>
                                    <div>
                                        <span><?= $_SESSION['order_request_info']['address']->email ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if(!empty($_SESSION['order_request_info']['order_details'])):
                    ?>
                    <div class="my-5 table">
                        <div class="px-5">
                            <div class="my-5 py-3">
                                <div class="text-center title-table my-5">Comentario</div>
                                <div class="table-body w-10">
                                    <div>
                                        <span><?= $_SESSION['order_request_info']['order_details'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <div class="cart-section container">
            <div class="text-center my-5 cart-title d-none py-5">Carrito de compras</div>
            <div class="cart">
                <?php
                foreach ($_SESSION['order_request_info']['order'] as $key => $value) :
                ?>
                    <div>
                        <div class="image">
                            <img src="<?= $value->item->image ?>" alt="<?= $value->item->name ?>">
                        </div>
                        <div class="data">
                            <div class="info">
                                <div class="name"><?= $value->item->name ?></div>
                                <div class="option">
                                    <div class="size"><?= $value->size ?></div>
                                    <div class="color" style="background-color:<?= $value->color ?>"></div>
                                </div>
                                <div class="amount">Cantidad: <?= $value->amount ?></div>
                            </div>
                            <div class="price">
                                <?php
                                $item_total = $value->item->price * $value->amount;
                                ?>
                                <span>€ <?= number_format($item_total, 2, '.', '') ?></span>
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
                    <div class="result">€ <?= number_format($_SESSION['order_request_info']['total_value']->subtotal, 2, '.', '') ?></div>
                </div>
                <div>
                    <div>Envio</div>
                    <div class="result">Gratis</div>
                </div>
                <div>
                    <div>I.V.A (21%)</div>
                    <div class="result">€ <?= number_format($_SESSION['order_request_info']['total_value']->extra, 2, '.', '') ?></div>
                </div>
            </div>
            <div class="total">
                <div class="d-flex justify-space-between">
                    <div class="total-title">Total</div>
                    <b>€ <?= number_format($_SESSION['order_request_info']['total_value']->total, 2, '.', '') ?></b>
                </div>
            </div>
        </div>
    </main>
</main>