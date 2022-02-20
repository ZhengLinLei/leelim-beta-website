<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Basic meta tag -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ayuda y Soporte - LEE LIM</title>
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
    <link rel="stylesheet" href="/static/css/help.css">
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
    $mvc->include_modules(); //HEADER
    ?>
    <main class="container py-5 my-5">
        <div class="d-flex" id="body">
            <div class="flex-1">
                <header>
                    <div class="my-5">
                        <h1>Ayuda y Soporte</h1>
                    </div>
                    <p>Si tienes alguna duda, puede contactarnos lo mas antes posible.</p>
                    <?php
                    $date = getdate();
                    $hours = $date['hours'];
                    $week = $date['wday'];
                    $status = 'correct';
                    $text = 'Abierto';
                    if($date['wday'] == 0 || ($hours < 11 || $hours > 16)){
                        $status = 'wrong';
                        $text = 'Cerrado';
                    }
                    ?>
                    <div class="my-5">
                        <p><span class="mr-5">Atención de 11:00 a 16:00</span><span class="text-<?= $status ?>"><b><?= $text ?></b></span></p>
                    </div>
                </header>
                <main>
                    <div class="grid-help">
                        <div>
                            <h2>Ayuda</h2>
                            <ul class="my-5">
                                <li>
                                    <a href="mailto:info@leelim.es">
                                        <ion-icon name="mail-outline"></ion-icon>
                                        <span>info@leelim.es</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2>Privacidad</h2>
                            <ul class="my-5">
                                <li>
                                    <a href="mailto:privacy@leelim.es">
                                        <ion-icon name="mail-outline"></ion-icon>
                                        <span>privacy@leelim.es</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2>Devoluciones</h2>
                            <ul class="my-5">
                                <li>
                                    <a href="mailto:refund@leelim.es">
                                        <ion-icon name="mail-outline"></ion-icon>
                                        <span>refund@leelim.es</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2>Unirse</h2>
                            <ul class="my-5">
                                <li>
                                    <a href="mailto:joinus@leelim.es">
                                        <ion-icon name="mail-outline"></ion-icon>
                                        <span>joinus@leelim.es</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </main>
            </div>
            <div class="flex-1 contact" id="contacto">
                <header>
                    <div class="my-5">
                        <h2 class="title-contact">Contacto</h2>
                    </div>
                    <p>O si lo prefiere le contactamos nosotros</p>
                </header>
                <main class="my-5">
                    <form action="/" method="post" id="contact-form">
                        <input type="text" name="keycode" class="d-none" value="<?= $_SESSION['csrf_keycode']?>" style="display:none">
                        <input type="text" id="name-form" name="name" placeholder="Nombre para contacto" <?= ($mvc->isset_account_session())?'class="correct" value="'.$_SESSION['account']['data']['name'].'"':'' ?>>
                        <input type="tel" id="tel-form" name="phone-number" placeholder="Numero telefono de contacto" pattern="[0-9]{9}">
                        <input type="email" id="email-form" name="email" placeholder="Email de contacto" <?= ($mvc->isset_account_session())?'class="correct" value="'.$_SESSION['account']['data']['email'].'"':'' ?>>
                        <input type="text" id="title-form" name="title" placeholder="Asunto">
                        <textarea name="content" id="content-form" placeholder="Mensaje o duda" cols="30" rows="10"></textarea>
                        <div class="server-response my-5 d-none small text-wrong text-left"></div>
                        <div class="my-5 py-5 d-flex justify-flex-end">
                            <button type="submit" class="btn btn-big d-flex align-items-center">
                                <span class="mr-3">Enviar mensaje</span>
                                <ion-icon name="arrow-forward-outline" role="img" class="md hydrated" aria-label="arrow forward outline"></ion-icon>
                            </button>
                        </div>
                    </form>
                </main>
            </div>
        </div>
    </main>
    <section id="load-content-section" class="justify-center align-items-center">
        <div class="loader-spin"></div>
    </section>
    <section id="submitted" class="d-none">
        <div>
            <ion-icon name="checkmark-outline" class="icon"></ion-icon>
            <span>Enviado</span>
        </div>
    </section>
    <?php
    $mvc = new MVCcontroller();
    $mvc->include_modules('component/footer');
    ?>
    <!-- ICON IONICON 图标 -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <!-- HEADER SCRIPT -->
    <script src="/static/js/src/header.js"></script>
    <!-- ---- -->
    <script src="/static/js/src/help.js"></script>
</body>
</html>