<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    $mvc = new MVCcontroller();
    $param_key = ['index' => ['Indice de Información', 'index'], 'politica-de-privacidad' => ['Política de Privacidad','privacy_policy'], 'copyright' => ['Copyright','copyright'], 'terminos-y-condiciones' => ['Terminos y Condiciones', 'term_condition'],
                    'distribucion' => ['Distribución y Tiendas fisicas', 'stockist'], 'unete' => ['Unete al equipo', 'joinus'], 'devolucion' => ['Devoluciones de pedidos', 'refund'], 'producto' => ['Productos diseñados', 'product'],
                    'monedero' => ['Monedero', 'wallet'], 'entrega' => ['Entregas de Pedidos', 'delivery'], 'pedido' => ['Pedidos', 'order'], 'metodo-de-pago' => ['Métodos de Pago', 'pay']];
    if(isset($param_key[$_GET['page']])){
        $include = $param_key[$_GET['page']][1];
        $name_page = $param_key[$_GET['page']][0];
    }else{
        $mvc->return_status_not_found();
    }
    ?>
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
    <link rel="stylesheet" href="/static/css/info_<?= ($include == 'index')?'index':'document' ?>.css">
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
    $mvc->include_modules(); //HEADER
    $mvc->include_modules('info/'.$include);
    $mvc->include_modules('component/footer');
    ?>
    <!-- ICON IONICON 图标 -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <!-- HEADER SCRIPT -->
    <script src="/static/js/src/header.js"></script>
</body>
</html>