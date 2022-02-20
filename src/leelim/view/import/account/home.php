<section id="account-info" class="w-10 module-section">
    <header class="d-flex justify-space-between align-items-center">
        <div class="d-flex align-items-flex-end welcome">
            <h1>Hola <?= $_SESSION['account']['data']['name'] ?></h1>
            <!-- <div class="mx-3">
                <span class="text-correct"><ion-icon name="shield-checkmark-outline"></ion-icon></span>
            </div> -->
        </div>
        <a href="javascript:" class="btn" id="close-account-session"><b>Cerrar Sesión</b></a>
    </header>
    <?php
    if ($_SESSION['account']['data']['verify_account'] != 0) :
    ?>
        <section class="mt-5 p-5 warning">
            <div class="d-flex">
                <span>"</span>
                <span class="text-center"><i>Su cuenta no ha sido verificada, por favor revise su correo. Por cuestiones de privacidad, su cuenta estará en restricciones hasta su total verificación.</i></span>
                <span>"</span>
            </div>
        </section>
    <?php
    endif;
    ?>
    <main class="my-5">
        <a href="/cuenta/datos-personales/" class="btn btn-big">Datos Personales</a>
        <a href="/cuenta/direcciones/" class="btn btn-big">Direcciones</a>
        <a href="/cuenta/preferencias/" class="btn btn-big">Preferencias</a>
        <a href="/cuenta/monedero/" class="btn btn-big">Monedero</a>
        <a href="/cuenta/pedidos/" class="btn btn-big">Historial Pedidos</a>
    </main>
</section>
<script src="/static/js/src/account_home.js"></script>