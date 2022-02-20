<section id="personal" class="w-10 module-section">
    <header>
        <div>
            <h1>Mis datos personales</h1>
        </div>
    </header>
    <main class="my-5" id="personal-main">
        <div id="block">
            <div>
                <h2>Datos personales</h2>
                <div>
                    <div>
                        <div>Nombre y Apellidos</div>
                        <div><b id="name-surname-title"><?= $_SESSION['account']['data']['name']?> <?= $_SESSION['account']['data']['surname']?></b></div>
                    </div>
                    <div class="last">
                        <div>Fecha Nacimiento</div>
                        <div><b><?= $_SESSION['account']['data']['birthday']?></b></div>
                    </div>
                </div>
                <div class="text-right my-5">
                    <a href="javascript:" class="btn" id="modify-personal-data-button">Modificar</a>
                </div>
            </div>
            <div>
                <h2>Datos de la cuenta</h2>
                <div>
                    <div>
                        <div>Correo Electronico</div>
                        <div><b><?= $_SESSION['account']['data']['email']?></b></div>
                    </div>
                    <div class="last">
                        <div>Contraseña</div>
                        <div class="d-flex align-items-center">
                            <b class="password">*********</b>
                            <div class="d-none small" id="recently-changed-password">Recién cambiada</div>
                        </div>
                        <div class="text-right my-5">
                            <a href="javascript:" class="btn" id="modify-account-password-button">Modificar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h2>Direcciones</h2>
                <div>
                    <a href="/cuenta/direcciones/" class="link">Revise sus direcciones</a>
                </div>
            </div>
        </div>
    </main>
</section>
<section id="modify-personal-data" class="modify-section">
    <div class="p-5">
        <header class="close p-5 po-absolute fixed-top">
            <a href="javascript:"><ion-icon name="close-outline"></ion-icon></a>
        </header>
        <main class="my-5">
            <div class="py-5 d-flex justify-center">
                <form action="/" method="post" id="modify-personal-data-form">
                    <input type="text" name="keycode" class="d-none" value="<?= $_SESSION['csrf_keycode']?>" style="display:none">
                    <div class="user my-5">
                        <h3 class="mb-5">Sobre ti</h3>
                        <div class="my-5">
                            <input type="text" name="name" id="name-form" placeholder="Nombre" <?= 'value="'.$_SESSION['account']['data']['name'].'" class="correct"'?>>
                        </div>
                        <div class="my-5">
                            <input type="text" name="surname" id="surname-form" placeholder="Apellido" <?= 'value="'.$_SESSION['account']['data']['surname'].'" class="correct"'?>>
                        </div>
                    </div>
                    <div class="birthday my-5 pt-5">
                        <h3 class="mb-5">Fecha Nacimiento</h3>
                        <div class="inputs">
                            <span><b><?= $_SESSION['account']['data']['birthday']?></b></span>
                        </div>
                        <div class="w-10 mt-4 mb-5 d-none" id="child-warning">
                            <span class="small d-flex">
                                <span class="wrong">Eres demasiado pequeño.</span>
                                <div class="ml-2 tooltips">
                                    <a href="javascript:" class="link">Leer Más</a>
                                    <div class="content">
                                        <span>Necesitas los permisos de tus padres o tutores legales.</span>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="server-response my-5 py-5 d-none small text-wrong"></div>
                    <footer class="py-5 mx-5 po-absolute">
                        <div class="py-3">
                            <button type="submit" class="btn btn-big">Guardar</a>
                        </div>
                    </footer>
                </form>
            </div>
        </main>
    </div>
</section>
<!-- 密码 -->
<section id="modify-account-password" class="modify-section">
    <div class="p-5">
        <header class="close p-5 po-absolute fixed-top">
            <a href="javascript:"><ion-icon name="close-outline"></ion-icon></a>
        </header>
        <main class="my-5">
            <div class="py-5 d-flex justify-center">
                <form action="/" method="post" id="modify-password-form">
                    <input type="text" name="keycode" class="d-none" value="<?= $_SESSION['csrf_keycode']?>" style="display:none">
                    <div class="user my-5">
                        <h3 class="mb-5">Contraseña</h3>
                        <div class="server-response my-5 py-5 d-none small text-wrong"></div>
                        <div class="my-5">
                            <input type="text" name="old-password" class="password-input" autocomplete="off" id="old-password-form" placeholder="Antigua contraseña">
                            <div class="w-10 mt-2 mb-5">
                                <span class="small">Necesitamos para verificar si es usted el propietario de la cuenta</span>
                            </div>
                        </div>
                        <div class="my-5 py-5">
                            <div class="input-group">
                                <input type="password" name="new-password" class="password-input" id="new-password-form" placeholder="Contraseña"> 
                                <div id="hide-password">
                                    <ion-icon name="eye-outline" id="show" role="img" class="md hydrated" aria-label="eye outline"></ion-icon>
                                    <ion-icon name="eye-off-outline" id="hide" role="img" class="md hydrated" aria-label="eye off outline"></ion-icon>
                                </div>
                            </div>
                            <div class="w-10 mt-3 mb-5">
                                <span class="small password-warning">Una buena contraseña deberia tener al menos un signo y 8 caracteres con numeros</span>
                            </div>
                        </div>
                    </div>
                    <footer class="py-5 mx-5 po-absolute">
                        <div class="py-3">
                            <button type="submit" class="btn btn-big">Guardar</a>
                        </div>
                    </footer>
                </form>
            </div>
        </main>
    </div>
</section>
<script>
    let PERSONAL_DATA = {
        name: "<?= $_SESSION['account']['data']['name']?>",
        surname: "<?=$_SESSION['account']['data']['surname']?>"
    }
</script>
<script src="/static/js/src/account_personal.js"></script>