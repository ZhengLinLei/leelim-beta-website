<?php
$mvc = new MVCcontroller();
//NOT ALLOWED
if(!$_SESSION['employer_account']['role']['tools']){
    $mvc->include_modules('error/403');
}else{
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Busqueda por Pedidos</h1>
    <p class="mb-4">Busca aquí información de los pedidos de los clientes</p>
    <div class="my-5 py-5">
        <form method="get" action="/order/" class="row">
            <div class="input-group col-12 col-md-6">
                <input type="text" class="form-control" placeholder="Codigo de Pedido" name="s" aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <style>
        h6 {
            font-weight: 600;
        }
        .bar-status {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-gap: 5px
        }

        .bar-status>div>div {
            width: 100%;
            height: 10px;
            border-radius: 5px;
            background-color: #f5f5f5;
        }

        .cart {
            display: grid;
            grid-template-columns: 1fr;
        }
        .cart .image > img{
            width: 80px;
        }
    </style>
    <!-- DataTales Example -->
    <?php
    if (isset($_GET['s'])) :

        $order = $mvc->get_individual_order_history($_GET['s']);
        if (empty($order)) {
    ?>
            <div class="my-5 py-5 text-muted">
                <div class="text-center">No hay registros</div>
            </div>
        <?php
        } else {
            $order = $order[0];
            //json
            $to_json_key = ['order', 'address', 'billing_address', 'total_value', 'payment_data'];
            foreach ($to_json_key as $value) {
                $order[$value] = json_decode($order[$value]);
            }
        ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pedido: <?= $order['order_code'] ?></h6>
                    <?php
                    if ($order['shipping_code']) :
                    ?>
                        <a href="/shipping/?s=<?= $order['shipping_code'] ?>">ver estado envio</a>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="card-body py-5 row">
                    <section class="col-12 col-md-6">
                        <h6>Estado</h6>
                        <div class="pl-2 mt-4">
                            <span class="text-muted"><?= $order['status'] ?> - <?= $order['status_code'] ?></span>
                            <div class="mt-2 bar-status">
                                <div>
                                    <div class="bar bg-success"></div>
                                </div>
                                <div>
                                    <div class="bar <?= ($order['status_code'] > 1)?'bg-success':'' ?>"></div>
                                </div>
                                <div>
                                    <div class="bar <?= ($order['status_code'] > 2)?'bg-success':'' ?>"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="col-12 col-md-6 my-5 my-md-0">
                        <h6>Dirección de envio</h6>
                        <div class="pl-2 mt-4">
                            <div class="my-2">
                                <div><?= $order['address']->address->name ?> <?= $order['address']->address->surname ?></div>
                                <div><?= $order['address']->email ?></div>
                            </div>
                            <hr>
                            <div>España, <?= $order['address']->address->city ?></div>
                            <div><?= $order['address']->address->postal_code ?></div>
                            <div><?= $order['address']->address->street ?>, <?= $order['address']->address->number ?></div>
                            <div>+34 <?= chunk_split($order['address']->address->tel, 3, " ") ?></div>
                        </div>
                    </section>
                    <section class="col-12 col-md-6  my-5">
                        <h6>Pago</h6>
                        <div class="table-body order-details-total pl-2 w-100 w-md-75 mt-4">
                            <?php
                            $datetime = strtotime($order['date_create']);
                            ?>
                            <div class="mb-2">
                                <div>
                                    <table class="w-100">
                                        <tbody>
                                            <tr>
                                                <td>Fecha</td>
                                                <td class="text-right b"><?= date('d-m-Y', $datetime) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <table class="w-100">
                                        <tbody>
                                            <tr>
                                                <td>Hora</td>
                                                <td class="text-right b"><?= date('H:i', $datetime) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div>
                                <table class="w-100">
                                    <tbody>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="text-right b">€ <?= number_format($order['total_value']->subtotal, 2, '.', '') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <table class="w-100">
                                    <tbody>
                                        <tr>
                                            <td>Envio</td>
                                            <td class="text-right b">Gratis</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <table class="w-100">
                                    <tbody>
                                        <tr>
                                            <td>IVA (21%)</td>
                                            <td class="text-right b">€ <?= number_format($order['total_value']->extra, 2, '.', '') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div>
                                <table class="w-100">
                                    <tbody>
                                        <tr>
                                            <td>Total</td>
                                            <td class="text-right b">€ <?= number_format($order['total_value']->total, 2, '.', '') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    <section class="col-12 col-md-6 my-5">
                        <h6>Dirección de facturación</h6>
                        <div class="pl-2 mt-4">
                            <div class="my-2">
                                <div><?= $order['billing_address']->name ?> <?= $order['billing_address']->surname ?></div>
                            </div>
                            <hr>
                            <div>España, <?= $order['billing_address']->city ?></div>
                            <div><?= $order['billing_address']->postal_code ?></div>
                            <div><?= $order['billing_address']->street ?>, <?= $order['billing_address']->number ?></div>
                        </div>
                    </section>
                    <section class="col-12 col-md-6 my-5">
                        <h6>Datos Pago</h6>
                        <div class="pl-2 mt-4">
                            <div class="my-2">
                                <div>Pago con: <span class="b"><?= $order['payment_data']->payment_method ?></span></div>
                            </div>
                            <hr>
                            <div>ID: <a href="/payment/?type=<?= $order['payment_data']->payment_method ?>&s=<?= $order['payment_data']->data->id ?>" class="b" target="_blank"><?= $order['payment_data']->data->id ?></a></div>
                        </div>
                    </section>
                    <section class="col-12 col-md-6 my-5">
                        <h6>Codigo Envio</h6>
                        <div class="pl-2 mt-4">
                            <span class="text-muted"><?= ($order['shipping_code']) ? $order['shipping_code'] : 'No enviado aún' ?> - <?= $order['status_code'] ?></span>
                        </div>
                    </section>
                    <section class="col-12 my-5">
                        <h6>Productos</h6>
                        <div class="pl-2 mt-4">
                            <div class="cart w-100">
                                <?php
                                foreach ($order['order'] as $key => $value) :
                                ?>
                                    <div class="d-flex">
                                        <div class="image">
                                            <img src="http://leelim.test<?= $value->item->image ?>" alt="<?= $value->item->name ?>">
                                        </div>
                                        <div class="data d-flex justify-content-between p-3 w-100">
                                            <div class="info mx-5">
                                                <div class="name small"><a href="http://leelim.test/producto/<?= str_replace(' ', '-', $value->item->name)?>/<?=$value->item->id_code?>/"><?= $value->item->name?> - <?= $value->item->id_code?></a></div>
                                                <div class="option d-flex align-items-center">
                                                    <div class="size small"><?= $value->size ?></div>
                                                    <div class="color ml-1" style="background-color:<?= $value->color ?>;width:25px;height:10px;border-radius:5px;"></div>
                                                </div>
                                                <div class="amount small">Cantidad: <?= $value->amount ?></div>
                                            </div>
                                            <div class="price" style="white-space:nowrap;">
                                                <?php
                                                $item_total = $value->item->price * $value->amount;
                                                ?>
                                                <span>€ <?= number_format($item_total, 2, '.', '') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
    <?php
        }
    endif;
    ?>
</div>
<?php
}
?>