<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Basic meta tag -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LEE LIM - Página Oficial España</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/3.1.0/fullpage.min.css" integrity="sha512-RVmrWua3k1yTDEOg4Yzs2bK5+Thh7nM6jrhDq/6/5/Mwa0JbYe4pP4YMK5sqghKz01T3DgrwYc57Jaf1PSurCg==" crossorigin="anonymous" />
    <!-- COROUSOL SCROLLSLIDER DEFAULT CSS -->
    <link rel="stylesheet" href="./static/css/ScrollSlider.css">
    <!-- INTERNAL RESOURCE -->
    <link rel="stylesheet" href="./static/css/global.css">
    <link rel="stylesheet" href="./static/css/home.css">
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
    $mvc->include_modules(); // 默认 HEADER
    ?>
    <main id="home-main">
        <section id="fullpage" class="container py-5">
            <div class="section d-flex flex-column align-items-center justify-center" id="presentation">
                <div class="call d-flex flex-column">
                    <div class="d-flex">
                        <div class="mx-1" id="quote">"</div>
                        <div class="text-center">Sientete libre de llevar lo que quieras</div>
                        <div class="mx-1" id="quote">"</div>
                    </div>
                    <div class="text-center pt-5">
                        <span class="text-muted small">LEE LIM</span>
                    </div>
                </div>
                <div id="home-section-one-bg-img">
                    <!-- PEXEL 图片， 随时换 -->
                    <img class="image-one" src="./static/img/web/home/home_section_one_one.jpg" alt="Imagen de cuadros y retratos · Lee Lim · ZLL">
                    <img class="image-two" src="./static/img/web/home/home_section_one_two.jpg" alt="Imagen de una mujer sentada en una silla · Lee Lim · ZLL">
                </div>
                <!-- 往下滑指示 -->
            </div>
            <div class="section d-flex align-items-center justify-center" id="content">
                <div id="text" class="d-flex flex-column align-items-center">
                    <h3 class="title">BIENVENIDA</h3>
                    <div class="des my-5 text-center py-5">
                    <p class="my-5 py-5">Recien llegamos a España, y te damos la bienvenida. Tu forma de vestir si que importa y es necesario ser admiradas por otros.</p>
                        <p class="my-5 py-5">Por eso sientete libre en llevar lo que te gusta.</p>
                    </div>
                </div>
            </div>
            <div class="section d-flex align-items-center justify-center" id="gender">
                <a href="./mujer/" class="m-5 p-3 dark">MUJER</a>
                <a href="./unisex/" class="m-5 p-3 light">UNISEX</a>
                <a href="./hombre/" class="m-5 p-3 dark">HOMBRE</a>
                <!-- 背景图 -->
                <div id="image-liquid-fade-hover">
                    <img class="image-one" src="./static/img/web/home/home_section_two_one.jpg" alt="Dos hombres con periodicos · Lee Lim · ZLL">
                    <img class="image-two" src="./static/img/web/home/home_section_two_two.jpg" alt="Dos hombres con periodicos riendose · Lee Lim · ZLL">
                </div>
            </div>
            <div class="section d-flex align-items-flex-end justify-center" id="gallery">
                <!-- SCROLLSLIDER模块 SINTAX  -->
                <div class="scrollslider video-slider">
                    <div class="slider__track">
                        <ul class="slider__list">
                            <!-- 视频 /static/video/web/home/ -->
                            <li class="slider__slide">
                                <video autoplay muted loop>
                                    <source src="./static/video/web/home/home_section_three_one.mp4" type="video/mp4">
                                </video>
                            </li>
                            <li class="slider__slide">
                                <video autoplay muted loop>
                                    <source src="./static/video/web/home/home_section_three_two.mp4" type="video/mp4">
                                </video>
                            </li>
                            <li class="slider__slide">
                                <video autoplay muted loop>
                                    <source src="./static/video/web/home/home_section_three_three.mp4" type="video/mp4">
                                </video>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="gallery-collection">
                    <a href="./galeria/" before-content="GALERIA">GALERIA</a>
                </div>
            </div>
            <div class="section d-flex align-items-center justify-center flex-column" id="social-media">
                <div id="get-connect">
                    <span class="title my-5">CONECTATE</span>
                    <div class="py-4">
                        <ul class="d-flex">
                            <li class="m-5">
                                <a href="#" before-content="@leelim_es"><ion-icon name="logo-instagram"></ion-icon></a>
                            </li>
                            <li class="m-5">
                                <a href="#" before-content="@leelim_es"><ion-icon name="logo-twitter"></ion-icon></a>
                            </li>
                            <li class="m-5">
                                <a href="#" before-content="@leelim_es"><ion-icon name="logo-youtube"></ion-icon></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <footer class="d-flex flex-column align-items-center">
                    <div class="my-3">© LEE LIM 2022</div>
                </footer>
            </div>
        </section>
        <footer id="home-footer">
            <section class="p-5 d-flex h-10">
                <div class="b d-flex" id="home-footer-step">
                    <div>0</div>
                    <div id="home-footer-step-num">1</div>
                </div>
                <div> / 05</div>
            </section>
        </footer>
    </main>
    <!-- FULLPAGE.JS 文件 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/3.1.0/fullpage.min.js" integrity="sha512-HqbDsHIJoZ36Csd7NMupWFxC7e7aX2qm213sX+hirN+yEx/eUNlZrTWPs1dUQDEW4fMVkerv1PfMohR1WdFFJQ==" crossorigin="anonymous"></script>
    <!-- ICON IONICON 图标 -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <!-- COROUSOL SCROLLSLIDER -->
    <script src="./static/js/src/ScrollSlider.js"></script>
    <!-- INNER SCRIPT -->
    <script src="./static/js/src/home.js"></script>
    <!-- HEADER SCRIPT -->
    <script src="./static/js/src/header.js"></script>
</body>

</html>