<div class="login group">
    <!-- 没账号 -->
    <div>
        <div class="d-flex justify-space-between">
            <div>¿Tienes tu dirección guardado en tu cuenta?</div>
            <div class="login-re">
                <a href="/cuenta/login/?r=<?=urlencode($_SERVER['REQUEST_URI'])?>" class="btn">Iniciar Sesion</a>
            </div>
        </div>
    </div>
</div>
<div class="address-form group">
    <h3>Dirección de envio</h3>
    <div class="my-5">
        <form action="/" method="post" id="address-form">
            <div class="d-flex my-5 py-5 form-input">
                <input type="text" name="keycode" class="d-none" value="<?= $_SESSION['csrf_keycode']?>" style="display:none">
                <div class="flex-1 name-surname-form">
                    <div class="user">
                        <div class="flex">
                            <input type="text" name="name" id="name-form" placeholder="Nombre" <?=(isset($_SESSION['order_address']))?'value="'.$_SESSION['order_address']['address']->name.'" class="correct"':''?>>
                            <input type="text" name="surname" id="surname-form" placeholder="Apellido" <?=(isset($_SESSION['order_address']))?'value="'.$_SESSION['order_address']['address']->surname.'" class="correct"':''?>>
                        </div>
                        <div>
                            <input type="email" name="email" id="email-form" placeholder="Email de contacto" <?=(isset($_SESSION['order_address']))?'value="'.$_SESSION['order_address']['email'].'" class="correct"':''?>>
                        </div>
                        <div class="my-5">
                            <input type="tel" name="phone-number" id="tel-form" placeholder="Numero de contacto" <?=(isset($_SESSION['order_address']))?'value="'.$_SESSION['order_address']['address']->tel.'" class="correct"':''?>>
                            <small>Solo te llamaremos en caso de que haya algun problema con el pedido</small>
                        </div>
                    </div>
                </div>
                <div class="data flex-1">
                    <div class="address-input">
                        <div class="my-3">
                            <input type="text" name="street" id="street-form" placeholder="Calle/Avenida/Plaza, Numero" <?=(isset($_SESSION['order_address']))?'value="'.$_SESSION['order_address']['address']->street.'" class="correct"':''?>>
                            <small>ej. Plaza de rios, 20</small>
                        </div>
                        <div class="my-3">
                            <input type="text" name="number" id="number-form" placeholder="Escalera/Piso/Local/Letra" <?=(isset($_SESSION['order_address']))?'value="'.$_SESSION['order_address']['address']->number.'" class="correct"':''?>>
                            <small>ej. Piso 2, 4D</small>
                        </div>
                        <div class="flex">
                            <div>
                                <input type="text" name="postal-code" id="postal_code-form" placeholder="Codigo Postal" <?=(isset($_SESSION['order_address']))?'value="'.$_SESSION['order_address']['address']->postal_code.'" class="correct"':''?>>
                                <small>ej. 46020</small>
                            </div>
                            <div>
                                <input type="text" name="city" id="city-form" placeholder="Ciudad" <?=(isset($_SESSION['order_address']))?'value="'.$_SESSION['order_address']['address']->city.'" class="correct"':''?>>
                                <small>ej. Valencia</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="server-response my-5 d-none small text-wrong"></div>
            <div class="continue-payment my-5 py-5 d-flex justify-space-between">
                <a href="/carrito/" class="btn btn-big"><ion-icon name="arrow-back-outline"></ion-icon><span class="ml-3">Volver</span></a>
                <button type="submit" class="btn btn-big"><span class="mr-3">Continuar Pago</span><ion-icon name="arrow-forward-outline"></ion-icon></button>
            </div>
        </form>
    </div>
</div>