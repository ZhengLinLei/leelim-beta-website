<?php
    $mvc = new MVCcontroller();
    $not_apply_redirect = ['verify-account', 'recovery'];
    if(!in_array($_GET['type'], $not_apply_redirect)){
        $mvc->account_middleware(false);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    $key = ['login' => 'Iniciar Sesion', 'register' => 'Registrarse', 'verify-account' => 'Verificar Cuenta', 'recovery' => 'Recuperar Contraseña'];
    $active_key = $key[$_GET['type']];
    ?>
    <!-- Basic meta tag -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $active_key ?> - LEE LIM</title>
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
    <?php
    if($_GET['type'] != 'verify-account'){
    ?>
    <link rel="stylesheet" href="/static/css/login.css">
    <?php
    }
    ?>
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
                    <path d="M0.759766 52.0009V0.880859H8.82377V44.8729H36.2558V52.0009H0.759766ZM85.0707 44.8729V52.0009H50.0067V0.880859H84.4227V8.00886H58.0707V22.5529H80.8947V29.2489H58.0707V44.8729H85.0707ZM135.654 44.8729V52.0009H100.59V0.880859H135.006V8.00886H108.654V22.5529H131.478V29.2489H108.654V44.8729H135.654ZM176.162 52.0009V0.880859H184.226V44.8729H211.658V52.0009H176.162ZM225.408 52.0009V0.880859H233.472V52.0009H225.408ZM295.21 52.0009V15.5689L280.162 43.2169H275.41L260.29 15.5689V52.0009H252.226V0.880859H260.866L277.786 32.1289L294.706 0.880859H303.346V52.0009H295.21Z" fill="black"/>
                </svg>
            </a>
        </section>
    </header>
    <section id="load-content-section" class="justify-center align-items-center">
        <div class="loader-spin"></div>
    </section>
    <?php
    $mvc->include_modules('login/'.str_replace("-", '_', $_GET['type']));
    ?>
    <!-- ICON IONICON 图标 -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <!-- INNER SCRIPT -->
    <?php
    if($_GET['type'] != 'verify-account'){
    ?>
    <script src="/static/js/src/login_<?= $_GET['type'] ?>.js"></script>
    <?php
    }
    ?>
</body>
</html>