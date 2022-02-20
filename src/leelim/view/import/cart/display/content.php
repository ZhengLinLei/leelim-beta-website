<?php
$_SESSION['order_code'] = rand();
?>
<header class="py-5">
    <div class="d-flex flex-column align-items-center my-5 py-5">
        <h1 class="title mb-3">TU CARRO</h1>
        <a href="/" class="btn btn-big">Seguir Comprando</a>
    </div>
</header>
<main class="mb-5 pb-5 container">
    <div class="my-5 py-5 container">
        <div id="cart" class="d-flex flex-column">
            <table class="border-bottom">
                <thead class="cart-header">
                    <tr>
                        <th colspan="2" scope="col" class="text-left">Producto</th>
                        <th class="text-right" scope="col">Precio</th>
                        <th class="text-center __hide-content" scope="col">Cantidad</th>
                        <th class="text-right __hide-content" scope="col">Total</th>
                    </tr>
                </thead>
                <tbody class="cart-body">
                    <?php
                    $subtotal = 0;
                    foreach ($_SESSION['cart'] as $key => $value):
                        $url_name = str_replace(" ", '-', $value->item->name);
                    ?>
                    <tr class="border-top item-cart-<?=$key?>">
                        <td class="cart-image">
                            <a href="/producto/<?=$url_name?>/<?=$value->item->id_code?>">
                                <img src="<?=$value->item->image?>" alt="<?=$value->item->name?> - Carrito de Compras - LEELIM" class="active">
                            </a>
                        </td>
                        <td class="cart-info text-left">
                            <div class="cart-title">
                                <a href="/producto/<?=$url_name?>/<?=$value->item->id_code?>/"><?=$value->item->name?> <span class="__hide-content-big">(<span class="item-amount"><?=$value->amount?></span>)</span></a>
                            </div>
                            <div class="d-flex align-items-flex-start" id="cart-option">
                                <div class="cart-size"><?=$value->size?></div>
                                <div class="cart-color" style="background-color:<?=$value->color?>"></div>
                            </div>
                            <div class="cart-remove-item __hide-content">
                                <a href="javascript:" class="btn delete-item-btn" item-delete="<?=$key?>">Eliminar</a>
                            </div>
                        </td>
                        <td class="text-right cart-price">
                            <div class="price">€ <?=number_format($value->item->price, 2, '.', '')?></div>
                            <div class="edit-btn">
                                <a href="javascript:" class="btn edit btn-mobile-edit" item-update="<?=$key?>">Editar</a>
                                <a href="javascript:" class="btn cancel btn-mobile-cancel" item-update="<?=$key?>">Cancelar</a>
                            </div>
                        </td>
                        <td class="__hide-content text-center cart-amount">
                            <div class="amount-input">
                                <input class="amount-input-item amount-input-item-focus text-center" item-update="<?=$key?>" value="<?=$value->amount?>" type="number" min="1" pattern="[0-9]*">
                            </div>
                        </td>
                        <?php
                        $item_total = $value->item->price*$value->amount;
                        $subtotal += $item_total;
                        ?>
                        <td class="__hide-content text-right item-total-price">€ <?=number_format($item_total, 2, '.', '')?></td>
                    </tr>
                    <!-- 更新 -->
                    <tr class="update-item-tool update-item-tool-0 __hide-content-big" data-update="<?=$key?>">
                        <td colspan="3">
                            <div class="d-flex justify-space-between align-items-center">
                                <div class="cart-remove-item">
                                    <a href="javascript:" class="btn delete-item-btn" item-delete="<?=$key?>">Eliminar</a>
                                </div>
                                <div class="amount-input">
                                    <input class="amount-input-item amount-input-item-click-<?=$key?> text-center" value="<?=$value->amount?>" type="number" min="1" pattern="[0-9]*">
                                </div>
                                <div class="cart-remove-item">
                                    <a href="javascript:" class="btn save-item-btn" item-update="<?=$key?>">Guardar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- ------- -->
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <div class="subtotal-cart w-10 py-5">
                <div class="d-flex align-items-flex-end flex-column text-right my-5 py-5">
                    <div class="subtotal-log">
                        <div class="d-flex justify-between">
                            <h3 class="mx-5">Subtotal</h3>
                            <div class="price-subtotal ml-5">€ <?= number_format($subtotal, 2, '.', '') ?></div>
                        </div>
                        <div class="taxes mt-5 text-muted">Tasas e IVA seran calculadas en el cobro</div>
                    </div>
                    <div id="continue-payment">
                        <div class="my-5 py-5">
                            <div class="py-5">
                                <a href="/carrito/informacion-del-pedido/?c=<?= $_SESSION['order_code']?>" class="btn d-flex align-items-center">
                                    <span class="mr-3">Continuar Pago</span>
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    const csrf_keycode = <?= $_SESSION['csrf_keycode'] ?>;
</script>