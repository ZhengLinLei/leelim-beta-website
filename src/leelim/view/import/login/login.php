<main class="container py-5">
    <header class="d-flex align-items-center flex-column my-5">
        <h1>Iniciar Sesion</h1>
        <div class="my-5">
            <a href="/cuenta/register/" class="btn btn-big">¿Registrase?</a>
        </div>
    </header>
    <main class="my-5">
        <div class="py-5 d-flex justify-center">
            <form action="/" method="post" id="login-form">
                <div class="server-response my-5 d-none small wrong"></div>
                <input type="text" name="keycode" class="d-none" value="<?= $_SESSION['csrf_keycode']?>" style="display:none">
                <div>
                    <input type="email" name="email" id="email-form" placeholder="Email de su cuenta">
                </div>
                <div class="input-group">
                    <input type="password" name="password" class="password-input" id="password-form" placeholder="Contraseña"> 
                    <div id="hide-password">
                        <ion-icon name="eye-outline" id="show"></ion-icon>
                        <ion-icon name="eye-off-outline" id="hide"></ion-icon>
                    </div>
                </div>
                <div class="my-5 py-5 d-flex justify-flex-end">
                    <button type="submit" class="btn btn-big d-flex align-items-center">
                        <div class="mr-3">Iniciar Sesion</div>
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </button>
                </div>
            </form>
        </div>
    </main>
    <footer id="recovery-password" class="po-fixed py-5">
        <div class="d-flex justify-center my-5">
            <a href="/cuenta/recovery/" class="link-hover">¿Contraseña Olvidada?</a>
        </div>
    </footer>
</main>
<script>
    const REDIRECT_URL = "<?=(isset($_GET['r']))?$_GET['r']:'undefined'?>";
</script>