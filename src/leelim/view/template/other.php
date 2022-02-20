<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Basic meta tag -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Más cosas - LEE LIM</title>
    <!-- SEO meta tag -->
    <meta name="description" content="">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="Lee, Lim">
    <meta name="author" content="ZLL Studio">
    <meta name="distribution" content="Global">
    <!-- OG SEO social media meta tag -->
    <meta property="og:site_name" content="LEE LIM">
    <meta property="og:url" content="https://leelim.es/">
    <meta property="og:title" content="LEE LIM - Página Oficial España">
    <meta property="og:type" content="website">
    <meta property="og:description" content="">
    <!-- SEO Helpers -->
    <link rel="canonical" href="https://leelim.es/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- RESOURCE, CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <!-- INTERNAL RESOURCE -->
    <link rel="stylesheet" href="/static/css/global.css">
    <link rel="stylesheet" href="/static/css/other.css">
    <!-- ICON 图标 -->
    <link rel="apple-touch-icon" sizes="57x57" href="/static/img/logo/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/static/img/logo/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/static/img/logo/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/static/img/logo/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/static/img/logo/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/static/img/logo/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/static/img/logo/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/static/img/logo/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/static/img/logo/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/static/img/logo/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/static/img/logo/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/static/img/logo/icon/favicon-16x16.png">
    <!-- <link rel="manifest" href="/manifest.json"> -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/static/img/logo/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
    <?php
    $mvc = new MVCcontroller();
    $mvc->include_modules(); // 默认HEADER
    ?>
    <main id="other-index" class="container py-5">
        <header class="po-relative">
             <!--   -->
             <div class="scrollslider img-slider">
                <ul>
                    <!-- 照片 /static/video/web/other/ -->
                    <li>
                        <img src="/static/img/web/other/other_section_one.jpg" alt="">
                    </li>
                    <li>
                        <img src="/static/img/web/other/other_section_two.jpg" alt="">
                    </li>
                    <li>
                        <img src="/static/img/web/other/other_section_three.jpg" alt="">
                    </li>
                </ul>
            </div>
            <div class="index-title fixed-top">
                <h1>INDICE</h1>
            </div>
        </header>
        <main>
            <header class="d-flex">
               <div>
                   <a href="/info/distribucion/" class="btn btn-big">DISTRIBUCIONES</a>
               </div>
               <div>
                   <a href="#" class="btn btn-big">LEE LIM</a>
               </div>
               <div>
                   <a href="/ayuda/" class="btn btn-big">AYUDA & SOPORTE</a>
               </div>
            </header>
            <section id="design-logo">
                <div>
                    <span id="big-logo" class="stroke-text">LEE LIM · LEE LIM · LEE LIM</span>
                </div>
            </section>
            <main class="my-5" id="other-index-grid">
                <div>
                    <div class="stroke-text">01</div>
                    <div class="title">PRIVACIDAD</div>
                    <div class="view">
                        <a href="/info/politica-de-privacidad/" class="btn btn-big"><ion-icon name="arrow-forward-outline"></ion-icon></a>
                    </div>
                </div>
                <div>
                    <div class="stroke-text">02</div>
                    <div class="title">UNETE</div>
                    <div class="view">
                        <a href="/info/unete/" class="btn btn-big"><ion-icon name="arrow-forward-outline"></ion-icon></a>
                    </div>
                </div>
                <div>
                    <div class="stroke-text">03</div>
                    <div class="title">INFO</div>
                    <div class="view">
                        <a href="/info/" class="btn btn-big"><ion-icon name="arrow-forward-outline"></ion-icon></a>
                    </div>
                </div>
                <div>
                    <div class="stroke-text">04</div>
                    <div class="title">TIENDAS</div>
                    <div class="view">
                        <a href="/info/distribucion/#tiendas-fisicas" class="btn btn-big"><ion-icon name="arrow-forward-outline"></ion-icon></a>
                    </div>
                </div>
                <div>
                    <div class="stroke-text">05</div>
                    <div class="title">CONTACTO</div>
                    <div class="view">
                        <a href="/ayuda/#contacto" class="btn btn-big"><ion-icon name="arrow-forward-outline"></ion-icon></a>
                    </div>
                </div>
                <div>
                    <div class="stroke-text">06</div>
                    <div class="title">ESTUDIO</div>
                    <div class="view">
                        <a href="#" class="btn btn-big"><ion-icon name="arrow-forward-outline"></ion-icon></a>
                    </div>
                </div>
            </main>
        </main>
    </main>
    <?php
    $mvc->include_modules('component/footer');
    ?>
    <!-- ICON IONICON 图标 -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <!-- HEADER SCRIPT -->
    <script src="/static/js/src/header.js"></script>
    <!-- --- -->
    <script src="/static/js/src/other.js"></script>
</body>
</html>