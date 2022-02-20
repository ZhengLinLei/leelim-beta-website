<div class="login-section group">
    <div class="address-list py-5">
        <div class="d-flex justify-space-between">
            <div>Elige tu dirección</div>
            <div>
                <a href="/cuenta/direcciones/" class="btn d-flex align-items-center" id="add-new-address">Nueva dirección</a>
            </div>
        </div>
        <div class="my-5">
            <div class="py-5 address-book-grid">
                <?php
                if (!empty($_SESSION['account']['data']['address_location'])) {
                    foreach ($_SESSION['account']['data']['address_location'] as $key => $value) :
                ?>
                        <div class="address-card">
                            <div class="d-none json-data">
                                <?= json_encode($_SESSION['account']['data']['address_location'][$key]) ?>
                            </div>
                            <div>
                                <div class="d-flex justify-space-between">
                                    <div class="name-surname"><?= $value->name ?> <?= $value->surname ?></div>
                                    <div class="number text-muted"><?= $value->tel ?></div>
                                </div>
                                <div class="my-3">
                                    <div><?= $value->street ?></div>
                                    <div><?= $value->number ?></div>
                                    <div><?= $value->city ?>, <?= $value->postal_code ?></div>
                                </div>
                            </div>
                            <div class="check">
                                <ion-icon name="checkmark-outline"></ion-icon>
                            </div>
                        </div>
                <?php
                    endforeach;
                } else {
                ?>
                    <div class="none">
                        <div class="py-5 d-flex align-items-center flex-column">
                            <div class="text-center">No tienes ninguna dirección guardada</div>
                            <div class="my-5 py-5">
                                <a href="/cuenta/direcciones/" class="btn btn-big">Añadir una</a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="server-response my-5 d-none small text-wrong"></div>
            <div class="continue-payment my-5 py-5 d-flex justify-space-between">
                <a href="/carrito/" class="btn btn-big"><ion-icon name="arrow-back-outline"></ion-icon><span class="ml-3">Volver</span></a>
                <a href="javascript:" class="btn btn-big" id="account-continue-payment"><span class="mr-3">Continuar Pago</span><ion-icon name="arrow-forward-outline"></ion-icon></a>
            </div>
        </div>
    </div>
</div>
<script>
    const EMAIL_ACCOUNT = '<?= base64_encode($_SESSION['account']['data']['email'])?>'; 
</script>