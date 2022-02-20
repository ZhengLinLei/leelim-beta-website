<?php
    $mvc = new MVCcontroller();
    $mvc->account_middleware(true);

    $param_key = ['home' => ['Mi Cuenta', 'home'], 'direcciones' => ['Mis Direcciones de Entrega','address_location'], 'preferencias' => ['Mis Preferencias', 'setting'], 'monedero' => ['Mi Monedero', 'wallet'], 'historial-del-monedero' => ['Historial del Monedero', 'wallet_history'], 'datos-personales' => ['Mis Datos Personales', 'personal'], 'pedidos' => ['Historial de Pedidos', 'order_history']];
    if(isset($param_key[$_GET['page']])){
        $include = $param_key[$_GET['page']][1];
        $name_page = $param_key[$_GET['page']][0];
    }else{
        $mvc->return_status_not_found();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Basic meta tag -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $name_page ?> - LEE LIM</title>
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
    <link rel="stylesheet" href="/static/css/account.css">
    <link rel="stylesheet" href="/static/css/account_<?=$include?>.css">
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
    $mvc->include_modules(); // 默认HEADER
    ?>
    <main class="container" id="account-main">
        <div class="d-flex">
            <?php
            $mvc->include_modules('account/'.$include); //INCLUDE PGAE
            ?>
            <section id="help-user">
                <main>
                    <?php
                    if($_GET['page'] != 'home'){
                    ?>
                    <div class="index-link link-section">
                        <div>
                            <div>
                                <a href="/cuenta/" class="link">Mi cuenta</a>
                            </div>
                            <div>
                                <?php
                                if($_GET['page'] == 'datos-personales'){
                                ?>
                                <span>Datos personales</span>
                                <?php
                                }else{
                                ?>
                                <a href="/cuenta/datos-personales/" class="link">Datos personales</a>
                                <?php
                                }
                                ?>
                            </div>
                            <div>
                                <?php
                                if($_GET['page'] == 'direcciones'){
                                ?>
                                <span>Direcciones</span>
                                <?php
                                }else{
                                ?>
                                <a href="/cuenta/direcciones/" class="link">Direcciones</a>
                                <?php
                                }
                                ?>
                            </div>
                            <div>
                                <?php
                                if($_GET['page'] == 'preferencias'){
                                ?>
                                <span>Preferencias</span>
                                <?php
                                }else{
                                ?>
                                <a href="/cuenta/preferencias/" class="link">Preferencias</a>
                                <?php
                                }
                                ?>
                            </div>
                            <div>
                                <?php
                                if($_GET['page'] == 'monedero'){
                                ?>
                                <span>Monedero</span>
                                <?php
                                }else{
                                ?>
                                <a href="/cuenta/monedero/" class="link">Monedero</a>
                                <?php
                                }
                                ?>
                            </div>
                            <div>
                                <?php
                                if($_GET['page'] == 'pedidos'){
                                ?>
                                <span>Historial pedidos</span>
                                <?php
                                }else{
                                ?>
                                <a href="/cuenta/pedidos/" class="link">Historial pedido</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="help-link link-section">
                        <h4 class="title">¿NECESITAS AYUDA?</h4>
                        <div>
                            <div>
                                <a href="/info/devolucion/" class="link">Devoluciones</a>
                            </div>
                            <div>
                                <a href="/info/producto/" class="link">Productos</a>
                            </div>
                            <div>
                                <a href="/info/monedero/" class="link">Monedero</a>
                            </div>
                            <div>
                                <a href="/info/entrega/" class="link">Entregas</a>
                            </div>
                            <div>
                                <a href="/info/pedido/" class="link">Pedidos</a>
                            </div>
                            <div>
                                <a href="/info/metodo-de-pago/" class="link">Formas de Pago</a>
                            </div>
                        </div>
                    </div>
                    <div class="other-link link-section">
                        <h4 class="title">TEMPORADA</h4>
                        <div>
                            <div>
                                <a href="/busqueda/?s=2022AW" class="link">2022AW</a>
                            </div>
                        </div>
                    </div>
                </main>
            </section>
        </div>
    </main>
    <?php
    $mvc->include_modules('component/footer');
    ?>
    <section id="load-content-section" class="justify-center align-items-center">
        <div class="loader-spin"></div>
    </section>
    <!-- ICON IONICON 图标 -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <!-- HEADER SCRIPT -->
    <script src="/static/js/src/header.js"></script>
    <!-- --- -->
    <script>
        //LOADER SECTION
        let loader_spin = document.getElementById('load-content-section');
        const csrf_keycode = <?= $_SESSION['csrf_keycode'] ?>;
    </script>
</body>
</html>