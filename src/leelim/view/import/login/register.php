<main class="container py-5">
    <header class="d-flex align-items-center flex-column my-5">
        <h1>Registrase</h1>
        <div class="my-5">
            <a href="/cuenta/login/" class="btn btn-big">¿Iniciar Sesion?</a>
        </div>
    </header>
    <main class="my-5">
        <div class="py-5 d-flex justify-center">
            <form action="/" method="post" id="register-form">
                <input type="text" name="keycode" class="d-none" value="<?= $_SESSION['csrf_keycode']?>" style="display:none">
                <div class="user my-5 py-2">
                    <h3 class="mb-5">Sobre ti</h3>
                    <div class="my-5">
                        <input type="text" name="name" id="name-form" placeholder="Nombre">
                    </div>
                    <div class="my-5">
                        <input type="text" name="surname" id="surname-form" placeholder="Apellido">
                    </div>
                </div>
                <div class="birthday my-5 py-2">
                    <h3 class="mb-5">Fecha Nacimiento</h3>
                    <div class="mt-5 inputs">
                        <input type="number" step="1" name="day" id="day-form" placeholder="dd" pattern="[0-9]{2}">
                        <input type="number" name="month" id="month-form" placeholder="mm" pattern="[0-9]{2}">
                        <input type="number" name="year" id="year-form" placeholder="yyyy" pattern="[0-9]{4}">
                    </div>
                    <div class="w-10 mt-4 mb-5 d-none" id="child-warning">
                        <span class="small d-flex">
                            <span class="wrong">Eres demasiado pequeño.</span>
                            <div class="ml-2 tooltips">
                                <a href="javascript:" class="link">Leer Más</a>
                                <div class="content">
                                    <span>Registre su cuenta con consentimiento de tus padres o tutores legales.</span>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="w-10 mt-2 mb-5">
                        <span class="small">Pedimos tu edad acorde con la <a href="#" class="link">Politica de privacidad</a></span>
                    </div>
                </div>
                <div class="account my-5 pt-2">
                    <h3 class="mb-5">Cuenta</h3>
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
                </div>
                <div class="account mb-5 pb-5">
                    <div class="consent-form">
                        <ul>
                            <li class="small">
                                <input type="checkbox" id="checkbox-email" name="receive-info-accept" checked>
                                <div class="icon-box">
                                    <ion-icon name="checkmark-outline" class="icon"></ion-icon>
                                </div>
                                <label for="checkbox-email">Acepto recibir información<label>
                            </li>
                            <li class="small">
                                <input type="checkbox" id="checkbox-term" name="term-accept">
                                <div class="icon-box">
                                    <ion-icon name="checkmark-outline" class="icon"></ion-icon>
                                </div>
                                <label for="checkbox-term">Acepto la <a href="/info/politica-de-privacidad/" class="link">Politica de privacidad</a> y los <a href="/info/terminos-y-condiciones/" class="link">Términos y Condiciones</a><label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="server-response my-5 d-none small wrong"></div>
                <div class="my-5 py-5 d-flex justify-flex-end">
                    <button type="submit" class="btn btn-big d-flex align-items-center">
                        <span class="mr-3">Registrarse</span>
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </button>
                </div>
            </form>
        </div>
    </main>
</main>