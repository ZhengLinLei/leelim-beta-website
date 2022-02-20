<section id="address-location" class="w-10 module-section">
    <header class="d-flex justify-space-between align-items-center">
        <div class="d-flex align-items-flex-end">
            <h1>Mis direcciones</h1>
        </div>
        <a href="javascript:" class="btn d-flex align-items-center" id="add-new-address"><b class="mr-1">Nueva dirección</b> <ion-icon class="icon" name="add-outline"></ion-icon></a>
    </header>
    <main class="my-5" id="address-book">
        <?php
        foreach ($_SESSION['account']['data']['address_location'] as $key => $value):
        ?>
        <div class="address-card-<?= $key ?>">
            <div class="d-none json-data" >
                <?= json_encode($_SESSION['account']['data']['address_location'][$key]) ?>
            </div>
            <div>
                <div class="name-surname"><?= $value->name ?> <?= $value->surname?></div>
                <div class="my-5">
                    <div><?= $value->street ?></div>
                    <div><?= $value->number ?></div>
                    <div><?= $value->city ?>, <?= $value->postal_code ?></div>
                </div>
                <div class="d-flex pt-5 justify-flex-end">
                    <a href="javascript:" class="btn mx-2 modify-address" list-index="<?= $key ?>">Modificar</a>
                    <a href="javascript:" class="btn mx-2 delete-address" list-index="<?= $key ?>">Borrar</a>
                </div>
            </div>
        </div>
        <?php
        endforeach;
        ?>
        <!-- -FROTEND自动生成- -->
    </main>
</section>
<section id="add-edit-address-section">
    <div id="edit">
        <div class="container po-relative">
            <header class="close mb-5 py-5 po-sticky fixed-top">
                <a href="javascript:" id="close-form"><ion-icon name="close-outline" role="img" class="md hydrated" aria-label="close outline"></ion-icon></a>
            </header>
            <main>
                <div><h2 id="form-title">Añadir nueva direccion</h2></div>
                <div class="my-5 pb-5">
                    <form action="/" method="post" id="address-form">
                        <div class="d-flex my-5 py-5 form-input">
                            <input type="text" name="keycode" class="d-none" value="<?= $_SESSION['csrf_keycode']?>" style="display:none">
                            <div class="flex-1 name-surname-form">
                                <div class="user">
                                    <div class="flex">
                                        <input type="text" name="name" id="name-form" placeholder="Nombre">
                                        <input type="text" name="surname" id="surname-form" placeholder="Apellido">
                                    </div>
                                    <div class="my-5 py-5">
                                        <input type="tel" name="phone-number" id="tel-form" placeholder="Numero de contacto">
                                        <small>Solo te llamaremos en caso de que haya algun problema con el pedido</small>
                                    </div>
                                </div>
                            </div>
                            <div class="data flex-1">
                                <div class="address">
                                    <div class="my-3">
                                        <input type="text" name="street" id="street-form" placeholder="Calle/Avenida/Plaza, Numero">
                                        <small>ej. Plaza de rios, 20</small>
                                    </div>
                                    <div class="my-3">
                                        <input type="text" name="number" id="number-form" placeholder="Escalera/Piso/Local/Letra">
                                        <small>ej. Piso 2, 4D</small>
                                    </div>
                                    <div class="py-5 flex">
                                        <div class="my-3">
                                            <input type="text" name="postal-code" id="postal_code-form" placeholder="Codigo Postal">
                                            <small>ej. 46020</small>
                                        </div>
                                        <div class="my-3">
                                            <input type="text" name="city" id="city-form" placeholder="Ciudad">
                                            <small>ej. Valencia</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="server-response my-5 d-none small text-wrong text-center"></div>
                        <div class="my-5 py-5 d-flex justify-flex-end">
                            <button type="submit" class="btn btn-big d-flex align-items-center" id="save">
                                <span class="mr-3">Guardar</span>
                                <ion-icon name="arrow-forward-outline"></ion-icon>
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</section>
<script src="/static/js/src/account_address_location.js"></script>