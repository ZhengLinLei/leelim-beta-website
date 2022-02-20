<link rel="stylesheet" href="/static/css/login_recovery.css">
<main class="container py-5">
    <header class="d-flex align-items-center flex-column my-5">
        <h2 class="text-center">Contraseña Olvidada</h2>
        <div class="my-5 p-3 text-center">
            <p>No te preocupes, nosotros te ayudamos</p>
        </div>
    </header>
    <main class="my-5 body">
        <div class="py-5 d-flex justify-center input">
            <form action="/" method="post" id="recovery-form">
                <input type="text" name="keycode" class="d-none" value="<?= $_SESSION['csrf_keycode']?>" style="display:none">
                <div>
                    <input type="email" name="email" id="email-form" placeholder="Email de su cuenta">
                </div>
                <div class="server-response my-5 d-none small wrong"></div>
                <div class="my-5 py-5 d-flex justify-flex-end">
                    <button type="submit" class="btn btn-big d-flex align-items-center">
                        <span class="mr-3">Recuperar</span>
                        <ion-icon name="arrow-forward-outline" role="img" class="md hydrated" aria-label="arrow forward outline"></ion-icon>
                    </button>
                </div>
            </form>
        </div>
        <!-- -------- -->
        <div class="py-5 d-flex justify-center text">
            <div class="text-center">
                <h3>¡ Enviado !</h3>
                <div class="mt-5 message">
                    <span>Revise su correo y siga los pasos siguientes para cambiar su contraseña.</span>
                </div>
            </div>
        </div>
    </main>
    <footer id="help-recovery-password" class="po-fixed py-5">
        <div class="d-flex justify-center my-5">
            <a href="/ayuda/" class="link-hover">Ayuda y Soporte</a>
        </div>
    </footer>
</main>
<script>
    const VERIFY_ACTIVE = 2;
</script>