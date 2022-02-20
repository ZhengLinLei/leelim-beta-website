<section id="setting" class="w-10 module-section">
    <header>
        <div>
            <h1>Mis preferencias</h1>
        </div>
    </header>
    <main class="my-5" id="setting-main">
        <div>
            <div class="py-5 container">
                <div>
                    <h3>Notificaciones</h3>
                    <div class="my-5 py-3 container main">
                        <div class="d-flex justify-space-between my-5">
                            <div class="mr-5">Recibir ofertas y promociones por email</div>
                            <div>
                                <a href="javascript:" value="<?= ($_SESSION['account']['data']['receive_information'] == 1)?'true':'false' ?>" class="check-box-ui" id="active-email-receive">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
<script src="/static/js/src/account_setting.js"></script>