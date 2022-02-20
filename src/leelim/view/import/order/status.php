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
    <!-- 记录 -->
    <main class="py-5 my-5 d-flex body">
        <div class="container">
            <section class="code mb-5 pb-5 text-center">
                <div class="pb-5 mb-5">
                    <h4>Nº Pedido</h4>
                    <div class="mt-5 small"><?= $_SESSION['order_request_info']['order_code'] ?></div>
                </div>
                <?php
                if (!empty($_SESSION['order_request_info']['shipping_code'])) :
                ?>
                    <div class="pb-5 mb-5">
                        <h4>Nº Envío</h4>
                        <div class="mt-5 small"><?= $_SESSION['order_request_info']['shipping_code'] ?></div>
                    </div>
                <?php
                endif;
                ?>
            </section>
            <header class="my-5">
                <div>
                    <div class="bar success"></div>
                    <div class="mt-5 text-muted d-flex justify-center">
                        <div>Pagado</div>
                    </div>
                </div>
                <div>
                    <div class="bar <?=($_SESSION['order_request_info']['status_code'] > 1)?'success':''?>"></div>
                    <div class="mt-5 text-muted d-flex justify-center">
                        <div>Empaquetado</div>
                    </div>
                </div>
                <div>
                    <div class="bar <?=($_SESSION['order_request_info']['status_code'] > 2)?'success':''?>"></div>
                    <div class="mt-5 text-muted d-flex justify-center">
                        <div>Enviado</div>
                    </div>
                </div>
            </header>
            <main class="status-shipping container">
                <div class="my-5 py-5">
                    <div>
                        <h4>Informacíon del estado</h4>
                        <div class="mx-5"></div>
                    </div>
                    <!-- 邮件轨道 -->
                    <div class="list-style">
                        <div class="track-all-list">
                            <ul>
                                <li>
                                    <i></i>
                                    <div>
                                        <p class="text">Tu pedido esta en proceso.</p>
                                        <?php
                                        $datetime = strtotime($_SESSION['order_request_info']['date_create']);
                                        ?>
                                        <p class="time"><?=date('Y-m-d H:i', $datetime)?></p>
                                    </div>
                                </li>
                                <li>
                                    <i></i>
                                    <div>
                                        <p class="text">Pedido pagado.</p>
                                        <?php
                                        $datetime = strtotime($_SESSION['order_request_info']['date_create']);
                                        ?>
                                        <p class="time"><?=date('Y-m-d H:i', $datetime)?></p>
                                    </div>
                                </li>
                                <li>
                                    <i></i>
                                    <div>
                                        <p class="text">Pedido iniciado.</p>
                                        <?php
                                        $datetime = strtotime($_SESSION['order_request_info']['date_create']);
                                        ?>
                                        <p class="time"><?=date('Y-m-d H:i', $datetime)?></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </main>
</main>