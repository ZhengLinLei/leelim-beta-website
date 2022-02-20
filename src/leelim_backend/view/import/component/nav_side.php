<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a href="/" id="logo-svg-image-a" class="sidebar-brand d-flex align-items-center justify-content-center">
        <svg viewBox="0 0 304 52" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.759766 52.0009V0.880859H8.82377V44.8729H36.2558V52.0009H0.759766ZM85.0707 44.8729V52.0009H50.0067V0.880859H84.4227V8.00886H58.0707V22.5529H80.8947V29.2489H58.0707V44.8729H85.0707ZM135.654 44.8729V52.0009H100.59V0.880859H135.006V8.00886H108.654V22.5529H131.478V29.2489H108.654V44.8729H135.654ZM176.162 52.0009V0.880859H184.226V44.8729H211.658V52.0009H176.162ZM225.408 52.0009V0.880859H233.472V52.0009H225.408ZM295.21 52.0009V15.5689L280.162 43.2169H275.41L260.29 15.5689V52.0009H252.226V0.880859H260.866L277.786 32.1289L294.706 0.880859H303.346V52.0009H295.21Z" fill="white" />
        </svg>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?=(!isset($_GET['heading']))?'active':''?>">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>General</span>
        </a>
    </li>
    <?php
    if($_SESSION['employer_account']['role']['order'] || $_SESSION['employer_account']['role']['email'] || $_SESSION['employer_account']['role']['analytic']):
    ?>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">Sección</div>
    <!-- Nav Item - Pages Collapse Menu -->
    <?php
    endif;

    if ($_SESSION['employer_account']['role']['order']) :
    ?>
    <li class="nav-item <?=(isset($_GET['heading']) && $_GET['heading'] == 'pending_order')?'active':''?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-boxes"></i>
            <span>Pedidos</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pedidos pedientes de :</h6>
                <a class="collapse-item" href="/pending_order/?type=pack">Empaquetar</a>
                <a class="collapse-item" href="/pending_order/?type=send">Enviar</a>
            </div>
        </div>
    </li>
    <?php
    endif;
    if ($_SESSION['employer_account']['role']['contact']) :
    ?>
    <li class="nav-item <?=(isset($_GET['heading']) && $_GET['heading'] == 'contact')?'active':''?>">
        <a class="nav-link" href="/contact/">
            <i class="fas fa-comments"></i>
            <span class="ml-1">Contacto</span>
        </a>
    </li>
    <?php
    endif;

    if ($_SESSION['employer_account']['role']['email']) :
    ?>
    <li class="nav-item <?=(isset($_GET['heading']) && $_GET['heading'] == 'email')?'active':''?>">
        <a class="nav-link" href="/email/">
            <i class="fas fa-envelope"></i>
            <span class="ml-1">Correo</span>
        </a>
    </li>
    <?php
    endif;

    if ($_SESSION['employer_account']['role']['analytic']) :
    ?>
    <li class="nav-item <?=(isset($_GET['heading']) && $_GET['heading'] == 'analytic')?'active':''?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-chart-area"></i>
            <span>Analitica</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/analytic/?type=order">Pedidos</a>
                <a class="collapse-item" href="/analytic/?type=earning">Ganancias</a>
                <a class="collapse-item" href="/analytic/?type=user">Usuarios</a>
                <a class="collapse-item" href="/analytic/?type=view">Visitas</a>
            </div>
        </div>
    </li>
    <?php
    endif;
    if($_SESSION['employer_account']['role']['product']):
    ?>
    <li class="nav-item <?=(isset($_GET['heading']) && $_GET['heading'] == 'product')?'active':''?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-sitemap"></i>
            <span>Productos</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/product/?type=add">Añadir</a>
                <a class="collapse-item" href="/product/?type=remove">Borrar</a>
            </div>
        </div>
    </li>
    <?php
    endif;
    if($_SESSION['employer_account']['role']['season']):
    ?>
    <li class="nav-item <?=(isset($_GET['heading']) && $_GET['heading'] == 'season')?'active':''?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
            <i class="far fa-images"></i>
            <span>Sesiones</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/season?type=gallery">Galeria</a>
                <div class="dropdown-divider"></div>
                <a class="collapse-item" href="/season/?type=tag">Tags</a>
            </div>
        </div>
    </li>
    <?php
    endif;
    ?>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">Otro</div>
    <!-- Nav Item - Tools Collapse Menu -->
    <?php
    if($_SESSION['employer_account']['role']['tools']):
    ?>
    <li class="nav-item <?=(isset($_GET['heading']) && $_GET['heading'] == 'tools')?'active':''?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTools" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Herramientas</span>
        </a>
        <div id="collapseTools" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pedidos:</h6>
                <a class="collapse-item" href="/order/">Pedidos</a>
                <a class="collapse-item" href="/shipping/">Envios</a>
                <?php
                if($_SESSION['employer_account']['role']['payment']):
                ?>
                <h6 class="collapse-header">Transacciones:</h6>
                <a class="collapse-item" href="/payment/?type=paypal">PayPal</a>
                <a class="collapse-item" href="/payment/?type=credit-card">Stripe</a>
                <a class="collapse-item" href="/payment/?type=wallet">Monedero</a>
                <?php
                endif;
                ?>
                <h6 class="collapse-header">Imagenes:</h6>
                <a class="collapse-item" href="/compress_img/">Comprimir</a>
            </div>
        </div>
    </li>
    <?php
    endif;
    ?>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="javascript:" onclick="toggle_calculator('post')">
            <i class="fas fa-calculator"></i>
            <span class="ml-1">Calculadora</span>
        </a>
    </li>
    <!-- Nav Item - Tables -->
    <li class="nav-item <?=(isset($_GET['heading']) && $_GET['heading'] == 'todo')?'active':''?>">
        <a class="nav-link" href="/todo/">
            <i class="fas fa-fw fa-table"></i>
            <span>Tareas</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline" id="toggle-nav-side">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex small text-justify">
        <small>Cualquier error comunique al departamento</small>
        <div class="my-3 text-center h1">
            <i class="fas fa-bug"></i>
        </div>
        <small>Versión 1.0 Beta</small>
    </div>

</ul>