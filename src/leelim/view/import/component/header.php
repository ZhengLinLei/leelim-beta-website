<header id="global-header">
    <section class="d-flex justify-space-between py-5 px-5">
        <a href="javascript:" class="d-none mx-3" id="header-menu-close">
            <ion-icon name="menu-outline" id="menu"></ion-icon>
            <ion-icon name="close-outline" id="close"></ion-icon>
        </a>
        <!-- 其他链接 -->
        <nav id="external-link">
            <ul class="d-flex">
                <li>
                    <a href="/mujer/">MUJER</a>
                    <div class="sub-menu"></div>
                </li>
                <li>
                    <a href="/hombre/">HOMBRE</a>
                    <div class="sub-menu"></div>
                </li>
                <li>
                    <a href="/unisex/">UNISEX</a>
                    <div class="sub-menu"></div>
                </li>
                <li>
                    <a href="/galeria/">GALERIA</a>
                    <div class="sub-menu"></div>
                </li>
                <li>
                    <a href="/otro/">MÁS</a>
                    <div class="sub-menu"></div>
                </li>
            </ul>
        </nav>
        <div class="d-flex">
            <ul class="d-flex mr-3">
                <li id="header-search" class="mx-3">
                    <a href="/busqueda/">
                        <ion-icon name="search-outline"></ion-icon>
                    </a>
                </li>
                <li id="cart" class="mx-3">
                    <a href="/carrito/">
                        <ion-icon name="cart-outline"></ion-icon>
                        <span class="text-muted" id="cart-index"><?= (isset($_SESSION['cart']) && !empty($_SESSION['cart']))?count($_SESSION['cart']):''?></span>
                    </a>
                </li>
            </ul>
            <ul>
                <li id="user" class="mx-3">
                    <a href="/cuenta/">
                        <ion-icon name="person-outline"></ion-icon>
                    </a>
                </li>
            </ul>
        </div>
    </section>
    <section class="d-flex justify-center py-5">
        <a href="/" id="logo-svg-image-a">
            <svg viewBox="0 0 304 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.759766 52.0009V0.880859H8.82377V44.8729H36.2558V52.0009H0.759766ZM85.0707 44.8729V52.0009H50.0067V0.880859H84.4227V8.00886H58.0707V22.5529H80.8947V29.2489H58.0707V44.8729H85.0707ZM135.654 44.8729V52.0009H100.59V0.880859H135.006V8.00886H108.654V22.5529H131.478V29.2489H108.654V44.8729H135.654ZM176.162 52.0009V0.880859H184.226V44.8729H211.658V52.0009H176.162ZM225.408 52.0009V0.880859H233.472V52.0009H225.408ZM295.21 52.0009V15.5689L280.162 43.2169H275.41L260.29 15.5689V52.0009H252.226V0.880859H260.866L277.786 32.1289L294.706 0.880859H303.346V52.0009H295.21Z" fill="black"/>
            </svg>
        </a>
    </section>
</header>
<?php
if(!isset($_COOKIE['accept_use_cookies']) || (isset($_COOKIE['accept_use_cookies']) && $_COOKIE['accept_use_cookies'] == 'false')):
?>
<section id="cookies-section" class="po-fixed d-flex justify-space-between">
    <div>
        <div class="title mb-5">Esta web utiliza cookies.</div>
        <div>Necesitamos usar las cookies para el correcto funcionamiento de la web. <a href="/info/politica-de-privacidad/#cookies" class="link">Saber más</a> </div>
    </div>
    <div class="accept-condition">
        <a onclick="accept_cookies(this)" class="btn btn-big">Aceptar</a>
    </div>
</section>
<?php
endif;
?>