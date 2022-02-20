<?php
$mvc = new MVCcontroller();
$mvc->account_middleware();

$module = (!isset($_GET['page']) ? 'index' : $_GET['page']);

$calculator_open = (isset($_SESSION['calculator']) && $_SESSION['calculator'])?true:false;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>(<?=strtoupper($_GET['page'])?>) Panel Admin - LEE LIM Backend</title>
    <!-- SEO meta tag -->
    <meta name="description" content="">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
    <meta name="author" content="ZLL">
    <link rel="shortcut icon" href="/static/img/logo/leelim.png" type="image/png">
    <!-- SEO Helpers -->
    <link rel="canonical" href="https://leelim.es/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- RESOURCE, CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="/static/css/global.css" rel="stylesheet">
    <link href="/static/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/static/css/calc-1.1.css">
</head>

<body id="page-top">
    <section id="load-content-section" class="justify-content-center align-items-center">
        <div class="loader-spin"></div>
    </section>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php
        $mvc->include_modules();
        ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="get" action="http://leelim.test/busqueda/">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Busqueda en LEE LIM" aria-label="Search" name="s" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <?php
                                $pending_todo = $mvc->get_peding_todo();
                                ?>
                                <span class="badge badge-danger badge-counter"><?=count($pending_todo)?></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">Tareas Pendientes</h6>
                                <?php
                                foreach ($pending_todo as $key => $value):
                                ?>
                                <a class="dropdown-item d-flex align-items-center" href="/todo/#:~:text=<?=$value->name?>">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500"><?=$value->name?></div>
                                        <div class="small"><small><?=$value->description?></small></div>
                                    </div>
                                </a>
                                <?php
                                endforeach;
                                ?>
                                <a class="dropdown-item text-center small text-gray-500" href="/todo/">Ver más</a>
                            </div>
                        </li>
                        <?php
                        if($_SESSION['employer_account']['role']['contact']):
                        ?>
                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-comments fa-fw"></i>
                                <!-- Counter - Messages -->
                                <?php
                                if(!isset($_SESSION['contact_message_unseen']) || (isset($_SESSION['contact_message_unseen']) && (time() - $_SESSION['contact_message_unseen']['date']) > 600)){
                                    $_SESSION['contact_message_unseen'] = ['count' => $mvc->get_contact_count(), 'date' => time(), 'data' => $mvc->get_contact_data()];
                                }
                                ?>
                                <span class="badge badge-danger badge-counter"><?=$_SESSION['contact_message_unseen']['count']?></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Contacto
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="/contact/">
                                    <div class="dropdown-list-image mr-3">
                                        <i class="fas fa-comments"></i>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Tienes <span class="text-danger"><?=$_SESSION['contact_message_unseen']['count']?></span> mensajes sin responder</div>
                                    </div>
                                </a>
                                <?php
                                if(!empty($_SESSION['contact_message_unseen']['data'])):
                                    foreach ($_SESSION['contact_message_unseen']['data'] as $key => $value) {
                                ?>
                                <a class="dropdown-item d-flex align-items-center" href="/contact/">
                                    <div class="dropdown-list-image mr-3">
                                        <div class="rounded-circle">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 464 464" style="enable-background:new 0 0 464 464;" xml:space="preserve">
                                                <g>
                                                    <path style="fill:#F9EDE0;" d="M305.872,451.92c-2.416,0.816-4.848,1.608-7.296,2.336   C301.032,453.52,303.456,452.728,305.872,451.92z"/>
                                                    <path style="fill:#F9EDE0;" d="M317.992,447.472c-2.608,1.04-5.216,2.064-7.872,3.008   C312.776,449.528,315.392,448.512,317.992,447.472z"/>
                                                </g>
                                                <circle style="fill:#EFECE8;" cx="232" cy="232" r="232"/>
                                                <g>
                                                    <path style="fill:#F9EDE0;" d="M293.896,455.584c-2.368,0.656-4.752,1.28-7.16,1.864   C289.144,456.864,291.528,456.24,293.896,455.584z"/>
                                                    <path style="fill:#F9EDE0;" d="M215.192,463.328c-2.832-0.2-5.656-0.416-8.448-0.72   C209.544,462.912,212.368,463.128,215.192,463.328z"/>
                                                    <path style="fill:#F9EDE0;" d="M177.256,457.44c-2.4-0.584-4.784-1.208-7.16-1.864C172.472,456.24,174.856,456.864,177.256,457.44z   "/>
                                                    <path style="fill:#F9EDE0;" d="M201.944,462c-2.536-0.328-5.064-0.672-7.576-1.08C196.872,461.328,199.408,461.664,201.944,462z"/>
                                                    <path style="fill:#F9EDE0;" d="M232,464c-4.272,0-8.504-0.136-12.72-0.36C223.496,463.864,227.728,464,232,464z"/>
                                                    <path style="fill:#F9EDE0;" d="M189.416,460.032c-2.432-0.448-4.856-0.928-7.256-1.456   C184.56,459.104,186.984,459.584,189.416,460.032z"/>
                                                    <path style="fill:#F9EDE0;" d="M142.608,446.128c-3.608-1.512-7.176-3.096-10.688-4.776   C135.44,443.032,139.008,444.624,142.608,446.128z"/>
                                                    <path style="fill:#F9EDE0;" d="M153.872,450.48c-2.648-0.952-5.264-1.968-7.872-3.008   C148.608,448.512,151.224,449.528,153.872,450.48z"/>
                                                    <path style="fill:#F9EDE0;" d="M244.72,463.64c-4.216,0.224-8.448,0.36-12.72,0.36C236.272,464,240.504,463.864,244.72,463.64z"/>
                                                    <path style="fill:#F9EDE0;" d="M257.256,462.608c-2.8,0.304-5.624,0.52-8.448,0.72   C251.632,463.128,254.456,462.912,257.256,462.608z"/>
                                                    <path style="fill:#F9EDE0;" d="M281.848,458.576c-2.408,0.528-4.824,1.008-7.256,1.456   C277.016,459.584,279.44,459.104,281.848,458.576z"/>
                                                    <path style="fill:#F9EDE0;" d="M269.64,460.912c-2.512,0.408-5.04,0.752-7.576,1.08   C264.592,461.664,267.128,461.328,269.64,460.912z"/>
                                                    <path style="fill:#F9EDE0;" d="M332.032,441.368c-3.496,1.672-7.048,3.256-10.64,4.76   C324.984,444.624,328.536,443.048,332.032,441.368z"/>
                                                    <path style="fill:#F9EDE0;" d="M165.424,454.256c-2.456-0.736-4.88-1.528-7.296-2.336   C160.544,452.728,162.968,453.52,165.424,454.256z"/>
                                                    <path style="fill:#F9EDE0;" d="M321.392,446.128c-1.12,0.472-2.264,0.888-3.392,1.336   C319.12,447.016,320.264,446.6,321.392,446.128z"/>
                                                    <path style="fill:#F9EDE0;" d="M332.352,441.224c-0.104,0.048-0.216,0.096-0.32,0.144   C332.136,441.32,332.248,441.28,332.352,441.224z"/>
                                                    <path style="fill:#F9EDE0;" d="M182.152,458.576c-1.64-0.36-3.272-0.736-4.896-1.128   C178.88,457.84,180.512,458.216,182.152,458.576z"/>
                                                    <path style="fill:#F9EDE0;" d="M194.36,460.912c-1.656-0.272-3.304-0.576-4.952-0.88   C191.064,460.336,192.704,460.648,194.36,460.912z"/>
                                                    <path style="fill:#F9EDE0;" d="M219.28,463.64c-1.368-0.072-2.728-0.216-4.088-0.312C216.56,463.424,217.912,463.568,219.28,463.64   z"/>
                                                    <path style="fill:#F9EDE0;" d="M206.744,462.608c-1.608-0.176-3.2-0.4-4.8-0.608C203.544,462.208,205.136,462.432,206.744,462.608z   "/>
                                                    <path style="fill:#F9EDE0;" d="M131.928,441.352c-0.088-0.04-0.184-0.08-0.272-0.12   C131.744,441.272,131.84,441.312,131.928,441.352z"/>
                                                    <path style="fill:#F9EDE0;" d="M248.808,463.328c-1.368,0.096-2.72,0.24-4.088,0.312   C246.088,463.568,247.44,463.424,248.808,463.328z"/>
                                                    <path style="fill:#F9EDE0;" d="M298.576,454.256c-1.552,0.464-3.112,0.896-4.68,1.328   C295.464,455.152,297.024,454.72,298.576,454.256z"/>
                                                    <path style="fill:#F9EDE0;" d="M310.128,450.48c-1.408,0.504-2.832,0.96-4.248,1.44C307.296,451.44,308.72,450.984,310.128,450.48z   "/>
                                                    <path style="fill:#F9EDE0;" d="M146.008,447.472c-1.128-0.448-2.272-0.872-3.392-1.336   C143.736,446.6,144.88,447.016,146.008,447.472z"/>
                                                    <path style="fill:#F9EDE0;" d="M158.128,451.92c-1.416-0.48-2.848-0.936-4.248-1.44C155.28,450.984,156.704,451.44,158.128,451.92z   "/>
                                                    <path style="fill:#F9EDE0;" d="M262.056,462c-1.6,0.208-3.192,0.44-4.8,0.608C258.864,462.432,260.456,462.208,262.056,462z"/>
                                                    <path style="fill:#F9EDE0;" d="M286.744,457.44c-1.624,0.392-3.256,0.768-4.896,1.128   C283.488,458.216,285.12,457.84,286.744,457.44z"/>
                                                    <path style="fill:#F9EDE0;" d="M274.584,460.032c-1.648,0.304-3.288,0.616-4.952,0.88   C271.296,460.648,272.936,460.336,274.584,460.032z"/>
                                                    <path style="fill:#F9EDE0;" d="M170.104,455.584c-1.56-0.432-3.128-0.864-4.68-1.328   C166.976,454.72,168.536,455.152,170.104,455.584z"/>
                                                </g>
                                                <path style="fill:#C6C3BD;" d="M285.104,247.952C310.952,230.744,328,201.376,328,168c0-53.016-42.984-96-96-96s-96,42.984-96,96  c0,33.376,17.048,62.744,42.896,79.952c0,0,0.008,0.008,0.016,0.008c-0.008,0-0.008-0.008-0.008-0.008  c-61.872,18.648-110.048,68.864-125.56,132.04L53.352,380c2.528,3.048,5.152,6.024,7.832,8.944c0.648,0.712,1.328,1.392,1.992,2.088  c2.064,2.192,4.152,4.352,6.296,6.464c0.888,0.872,1.792,1.712,2.696,2.568c1.984,1.888,3.992,3.752,6.04,5.568  c1.016,0.896,2.048,1.784,3.072,2.664c2.008,1.72,4.04,3.408,6.112,5.056c1.088,0.872,2.184,1.728,3.28,2.584  c2.096,1.616,4.224,3.184,6.376,4.72c1.112,0.792,2.208,1.6,3.336,2.376c2.272,1.568,4.584,3.072,6.912,4.56  c1.048,0.664,2.072,1.352,3.128,2.008c2.688,1.656,5.424,3.24,8.184,4.792c0.728,0.408,1.44,0.848,2.176,1.248  c3.568,1.952,7.192,3.824,10.872,5.592c0.088,0.04,0.184,0.08,0.272,0.12c3.512,1.68,7.08,3.272,10.688,4.776  c1.12,0.472,2.264,0.888,3.392,1.336c2.608,1.04,5.216,2.064,7.872,3.008c1.408,0.504,2.832,0.96,4.248,1.44  c2.416,0.816,4.848,1.608,7.296,2.336c1.552,0.464,3.112,0.896,4.68,1.328c2.368,0.656,4.752,1.28,7.16,1.864  c1.624,0.392,3.256,0.768,4.896,1.128c2.408,0.528,4.824,1.008,7.256,1.456c1.648,0.304,3.288,0.616,4.952,0.88  c2.512,0.408,5.04,0.752,7.576,1.08c1.6,0.208,3.192,0.44,4.8,0.608c2.8,0.304,5.624,0.52,8.448,0.72  c1.368,0.096,2.72,0.24,4.088,0.312c4.216,0.24,8.448,0.376,12.72,0.376s8.504-0.136,12.72-0.36  c1.368-0.072,2.728-0.216,4.088-0.312c2.832-0.2,5.656-0.416,8.448-0.72c1.608-0.176,3.2-0.4,4.8-0.608  c2.536-0.328,5.064-0.672,7.576-1.08c1.656-0.272,3.304-0.576,4.952-0.88c2.432-0.448,4.856-0.928,7.256-1.456  c1.64-0.36,3.272-0.736,4.896-1.128c2.4-0.584,4.784-1.208,7.16-1.864c1.56-0.432,3.128-0.864,4.68-1.328  c2.456-0.736,4.88-1.528,7.296-2.336c1.416-0.48,2.848-0.936,4.248-1.44c2.648-0.952,5.264-1.968,7.872-3.008  c1.128-0.448,2.272-0.872,3.392-1.336c3.592-1.504,7.144-3.08,10.64-4.76c0.104-0.048,0.216-0.096,0.32-0.144  c3.68-1.768,7.304-3.64,10.872-5.592c0.736-0.4,1.448-0.84,2.176-1.248c2.76-1.552,5.496-3.136,8.184-4.792  c1.056-0.648,2.088-1.336,3.128-2.008c2.328-1.488,4.64-3,6.912-4.56c1.12-0.776,2.224-1.576,3.336-2.376  c2.152-1.544,4.28-3.112,6.376-4.72c1.104-0.848,2.192-1.712,3.28-2.584c2.064-1.648,4.104-3.336,6.112-5.056  c1.032-0.88,2.064-1.768,3.072-2.664c2.048-1.816,4.056-3.68,6.04-5.568c0.896-0.856,1.808-1.704,2.696-2.568  c2.144-2.112,4.24-4.272,6.296-6.464c0.656-0.704,1.336-1.384,1.992-2.088c2.68-2.92,5.304-5.896,7.832-8.944l0.008-0.008  C395.152,316.816,346.976,266.6,285.104,247.952z"/>
                                            </svg>
                                        </div>
                                        <div class="status-indicator bg-danger"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate"><?=substr($value['content'], 0, 20)?>...</div>
                                        <div class="small text-gray-500"><?=$value['name']?></div>
                                        <div class="small text-gray-500"><?=$value['email']?></div>
                                    </div>
                                </a>
                                <?php
                                    }
                                ?>
                                <a href="/contact/" class="dropdown-item d-flex align-items-center justify-center"> ... </a>
                                <?php
                                endif;
                                ?>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Ver mensajes</a>
                            </div>
                        </li>
                        <?php
                        endif;

                        if($_SESSION['employer_account']['role']['email']):
                        ?>
                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <?php
                                if(!isset($_SESSION['email_message_unseen']) || (isset($_SESSION['email_message_unseen']) && (time() - $_SESSION['email_message_unseen']['date']) > 600)){
                                    $_SESSION['email_message_unseen'] = ['count' => $mvc->get_email_count('UNSEEN UNANSWERED'), 'date' => time()];
                                }
                                ?>
                                <span class="badge badge-danger badge-counter"><?=$_SESSION['email_message_unseen']['count']?></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Mensajes
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="/email/#info@gmail.es">
                                    <div class="dropdown-list-image mr-3">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Tienes <span class="text-danger"><?=$_SESSION['email_message_unseen']['count']?></span> correos sin leer</div>
                                        <div class="small text-gray-500">info@gmail.es</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="/email/#privacy@gmail.es">
                                    <div class="font-weight-bold">
                                        <div class="small text-gray-500">privacy@gmail.es</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="/email/#help@gmail.es">
                                    <div class="font-weight-bold">
                                        <div class="small text-gray-500">help@gmail.es</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="/email/#joinus@gmail.es">
                                    <div class="font-weight-bold">
                                        <div class="small text-gray-500">joinus@gmail.es</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="/email/">Ver correo</a>
                            </div>
                        </li>
                        <?php
                        endif;
                        ?>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$_SESSION['employer_account']['data']['name']?> <?=$_SESSION['employer_account']['data']['surname']?></span>
                                <div class="img-profile rounded-circle border">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-44 0 512 512.00116">
                                        <path d="m355.117188 512h-285.53125c-16.832032 0-30.476563-13.644531-30.476563-30.476562v-14.660157c0-50.710937 41.109375-91.820312 91.820313-91.820312h162.839843c50.710938 0 91.820313 41.109375 91.820313 91.820312v14.660157c0 16.832031-13.644532 30.476562-30.472656 30.476562zm0 0" fill="#61a5ce" />
                                        <path d="m254.980469 375.042969h-124.050781c-50.710938 0-91.820313 41.109375-91.820313 91.820312v14.664063c0 16.832031 13.644531 30.472656 30.476563 30.472656h99.433593c58.050781-35.289062 78.652344-97.632812 85.960938-136.957031zm0 0" fill="#4f8baa" />
                                        <path d="m284.863281 402.113281c0-32.496093-32.464843-58.839843-72.511719-58.839843-40.050781 0-72.515624 26.34375-72.515624 58.839843 0 32.496094 32.464843 58.839844 72.515624 58.839844 40.046876 0 72.511719-26.34375 72.511719-58.839844zm0 0" fill="#ffcfc2" />
                                        <path d="m212.351562 343.273438c-40.050781 0-72.515624 26.34375-72.515624 58.839843 0 32.496094 32.464843 58.839844 72.515624 58.839844 3.230469 0 6.398438-.167969 9.519532-.503906 25.238281-38.339844 33.328125-81.160157 35.914062-104.199219-12.433594-8.121094-28.230468-12.976562-45.433594-12.976562zm0 0" fill="#ffaea1" />
                                        <path d="m88.097656 276.925781c0-24.324219-19.71875-44.042969-44.046875-44.042969s-44.050781 19.71875-44.050781 44.042969 19.722656 44.042969 44.050781 44.042969 44.046875-19.71875 44.046875-44.042969zm0 0" fill="#ffaea1" />
                                        <path d="m424.699219 276.925781c0-24.324219-19.71875-44.042969-44.046875-44.042969s-44.050782 19.71875-44.050782 44.042969 19.722657 44.042969 44.050782 44.042969 44.046875-19.71875 44.046875-44.042969zm0 0" fill="#ffcfc2" />
                                        <path d="m228.347656 415.714844h-31.996094c-83.765624 0-152.300781-68.535156-152.300781-152.300782v-69.941406c0-92.558594 75.730469-168.289062 168.285157-168.289062h.027343c92.558594 0 168.289063 75.730468 168.289063 168.289062v69.941406c0 83.765626-68.539063 152.300782-152.304688 152.300782zm0 0" fill="#ffe2d9" />
                                        <path d="m124.632812 300.730469c-7.851562-41.558594 4.984376-84.089844 33.089844-115.699219 41.796875-47.007812 54.628906-159.847656 54.628906-159.847656-92.566406 0-168.300781 75.722656-168.300781 168.273437v69.96875c0 83.191407 67.632813 151.359375 150.628907 152.28125-44.289063-36.675781-63.171876-78.574219-70.046876-114.976562zm0 0" fill="#ffcfc2" />
                                        <path d="m212.351562 339.367188c-15.988281 0-28.949218-12.960938-28.949218-28.945313v-21.042969c0-4.363281 3.539062-7.902344 7.902344-7.902344h42.09375c4.363281 0 7.902343 3.535157 7.902343 7.902344v21.042969c-.003906 15.984375-12.960937 28.945313-28.949219 28.945313zm0 0" fill="#57565c" />
                                        <path d="m146.394531 310.421875c0-13.578125-13.824219-24.585937-30.875-24.585937-17.054687 0-30.878906 11.007812-30.878906 24.585937s13.824219 24.585937 30.878906 24.585937c17.050781 0 30.875-11.007812 30.875-24.585937zm0 0" fill="#ffa6bb" />
                                        <path d="m340.0625 310.421875c0-13.578125-13.824219-24.585937-30.878906-24.585937-17.054688 0-30.878906 11.007812-30.878906 24.585937s13.824218 24.585937 30.878906 24.585937c17.054687 0 30.878906-11.007812 30.878906-24.585937zm0 0" fill="#ffa6bb" />
                                        <path d="m295.441406 296.925781c-4.265625 0-7.726562-3.457031-7.726562-7.726562v-12.824219c0-4.265625 3.460937-7.722656 7.726562-7.722656 4.269532 0 7.726563 3.457031 7.726563 7.722656v12.824219c0 4.265625-3.457031 7.726562-7.726563 7.726562zm0 0" fill="#57565c" />
                                        <path d="m129.257812 296.925781c-4.265624 0-7.726562-3.457031-7.726562-7.726562v-12.824219c0-4.265625 3.460938-7.722656 7.726562-7.722656 4.269532 0 7.726563 3.457031 7.726563 7.722656v12.824219c0 4.265625-3.457031 7.726562-7.726563 7.726562zm0 0" fill="#57565c" />
                                        <path d="m332.757812 97.203125s17.945313-8.972656 30.914063-22.984375c7.441406-8.042969 20.765625-5.03125 24.207031 5.371094 7.980469 24.121094 12.417969 61.476562-16.390625 98.648437-1.402343-2.453125-47.570312-27.992187-47.570312-27.992187zm0 0" fill="#c1aa84" />
                                        <path d="m247.304688 72.648438s10.992187-35.496094 64.957031-48.097657c15.433593-3.605469 30.738281 6.4375 33.617187 22.023438 5.394532 29.195312 10.382813 78.839843-5.816406 127.246093-6.320312-1.964843-81.199219-6.875-81.199219-6.875zm0 0" fill="#d3bd94" />
                                        <path d="m129.257812 63.898438-20.8125-26.753907c-9.066406-11.652343-27.035156-10.582031-34.59375 2.101563-15.746093 26.414062-34.195312 73.398437-19.058593 134.574218-.265625-.058593 74.464843-4.917968 74.464843-4.917968zm0 0" fill="#c1aa84" />
                                        <path d="m207.980469 66.25c-.09375-1.042969-6.433594-25.320312-11.910157-46.144531-4.171874-15.871094-23.132812-22.519531-36.21875-12.617188-31.859374 24.101563-78.757812 76.410157-75.488281 174.152344l132.261719-16.5zm0 0" fill="#d3bd94" />
                                        <path d="m109.945312 187.171875s4.902344-153.683594 147.679688-186.664063c13.453125-3.109374 25.65625 8.539063 23.46875 22.171876-5.625 35.027343-6.238281 100.242187 42.828125 172.84375-.003906.488281-213.976563-8.351563-213.976563-8.351563zm0 0" fill="#e5cfa1" />
                                        <path d="m86.925781 195.542969s-10.113281 41.488281-31.308593 73.113281c-5.304688 7.917969-17.589844 5.070312-19.019532-4.351562-3.484375-23-4.984375-60.234376 10.277344-90.484376 5.632812 0 40.050781 21.722657 40.050781 21.722657zm0 0" fill="#d3bd94" />
                                        <path d="m337.777344 195.542969s10.113281 41.488281 31.304687 73.113281c5.304688 7.917969 17.59375 5.070312 19.019531-4.351562 3.488282-23 4.984376-60.234376-10.277343-90.484376-5.632813 0-40.046875 21.722657-40.046875 21.722657zm0 0" fill="#e5cfa1" />
                                        <path d="m364.488281 216.054688h-304.273437c-13.605469 0-24.632813-11.027344-24.632813-24.628907v-26.371093c0-13.601563 11.027344-24.632813 24.632813-24.632813h304.273437c13.601563 0 24.632813 11.03125 24.632813 24.632813v26.371093c0 13.601563-11.03125 24.628907-24.632813 24.628907zm0 0" fill="#7ac1dd" />
                                        <path d="m262.652344 226.585938h-100.601563c-13.378906 0-24.222656-10.84375-24.222656-24.21875v-48.253907c0-13.378906 10.84375-24.222656 24.222656-24.222656h100.601563c13.378906 0 24.222656 10.84375 24.222656 24.222656v48.253907c0 13.375-10.84375 24.21875-24.222656 24.21875zm0 0" fill="#c6c5ca" />
                                    </svg>
                                </div>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/profile/">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="/setting/">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ajustes
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <?php
                $mvc->include_modules('home/' . $module);
                ?>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php
            $mvc->include_modules('component/copyright');
            ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Seguro que quieres cerrar sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Presione "Salir" si es realmente que quiere cerrar sesión.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="javascript:" onclick="close_session()" id="logout-account-btn">Salir</a>
                </div>
            </div>
        </div>
    </div>
    <!-- INLINE CALCULATOR -->
    <div id="calculator-section" style="right:10px;bottom:10px;position:fixed;z-index:9999;">
        <div class="close text-light" style="position:absolute;right:40px;top:5px;cursor:pointer;" onclick="this.parentElement.classList.toggle('hide')">
            <i class="fas fa-minus"></i>
        </div>
        <div class="close text-light" style="position:absolute;right:10px;top:5px;cursor:pointer;" onclick="toggle_calculator('delete')">
            <i class="fas fa-times"></i>
        </div>
        <div class="calc shadow rounded"></div>
    </div>
    <!-- END CALCULATOR -->
    <script>
        //CLOSE MENU IN TOUCH MOBILE
        if(window.innerWidth < 600){
            document.body.classList.add('sidebar-toggled');
            document.getElementById('accordionSidebar').classList.add('toggled');
        }
        //LOADER SECTION
        let loader_spin = document.getElementById('load-content-section');
        //REQUEST CODE
        const csrf_keycode = <?= $_SESSION['csrf_keycode_backend'] ?>;
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ==" crossorigin="anonymous"></script>
    <!-- Custom scripts for all pages-->
    <script src="/static/js/min/sb-admin-2.min.js"></script>
    <script src="/static/js/src/home.js"></script>
    <!-- CALCULATOR -->
    <script src="/static/js/src/calc-1.1.js"></script>
    <?php
    if($calculator_open):
    ?>
    <script>JSCALC.init();</script>
    <?php
    endif;
    ?>
</body>

</html>