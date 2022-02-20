<link rel="stylesheet" href="/static/css/login_recovery.css">
<main class="container py-5">
    <header class="d-flex align-items-center flex-column my-5">
        <h2 class="text-center">Nueva Contraseña</h2>
        <div class="my-5 p-3 text-center">
            <p>Rellene una nueva contraseña</p>
            <p>Pero que no se te olvide de nuevo</p>
        </div>
    </header>
    <main class="body">
        <div class="d-flex justify-center input">
            <form action="/" method="post" id="recovery-form">
                <input type="text" name="keycode" class="d-none" value="<?= $_SESSION['csrf_keycode']?>" style="display:none">
                <div class="input-group">
                    <input type="password" name="password" class="password-input" id="password-form" placeholder="Nueva contraseña"> 
                    <div id="hide-password">
                        <ion-icon name="eye-outline" id="show"></ion-icon>
                        <ion-icon name="eye-off-outline" id="hide"></ion-icon>
                    </div>
                </div>
                <div class="w-10 mt-3 mb-5">
                    <span class="small password-warning">Una buena contraseña deberia tener al menos un signo y 8 caracteres con numeros</span>
                </div>
                <div class="server-response my-5 d-none small wrong"></div>
                <div class="my-5 py-5 d-flex justify-flex-end">
                    <button type="submit" class="btn btn-big d-flex align-items-center">
                        <span class="mr-3">Cambiar</span>
                        <ion-icon name="arrow-forward-outline" role="img" class="md hydrated" aria-label="arrow forward outline"></ion-icon>
                    </button>
                </div>
            </form>
        </div>
        <!-- -------- -->
        <div class="py-5 d-flex justify-center text">
            <div class="text-center">
                <h3>¡ Cambiado !</h3>
                <div class="mt-5 message">
                    <span>Ya se configuró la contraseña, ya puede iniciar sesión con la nueva contraseña.</span> 
                    <div class="mt-2">
                        <a href="/cuenta/login/" class="btn">Iniciar Sesión</a>
                    </div>
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
    const VERIFY_ACTIVE = 1;
    const PARAM_GET = {
        d: "<?=$_GET['d']?>",
        c: "<?=$_GET['c']?>"
    }
</script>