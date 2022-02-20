<?php
$mvc = new MVCcontroller();
//NOT ALLOWED
if(!$_SESSION['employer_account']['role']['tools']){
    $mvc->include_modules('error/403');
}else{
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Estado de Envio</h1>
    <p class="mb-4">Puede ver el estado y la información del envio de un pedido</p>
    <div class="my-5 py-5">
        <form method="get" action="/shipping/" class="row">
            <div class="input-group col-12 col-md-6">
                <input type="text" class="form-control" placeholder="Codigo de Envio" name="s" aria-label="Search" aria-describedby="basic-addon2">
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
        /* ---TRACK */
        .list-style{
            padding: 50px 0;
        }
        .track-all-list{
            margin-left: 80px;
        }
        .track-all-list ul{
            list-style: none;
        }
        .track-all-list ul li{
            padding-left: 20px;
            border-left: 1px solid #CCC;
            padding-bottom: 25px;
        }
        .track-all-list ul li i::before{
            position: absolute;
            height: 8px;
            width: 8px;
            background: #FFF;
            margin: 3px 0 0 -25px;
            border-radius: 100%;
            border: 1px solid #CCC;
            content: '';
            display: block;
        }
    </style>
    <!-- DataTales Example -->
    <?php
    if (isset($_GET['s'])) :

        $order = $mvc->get_individual_order_history_by_shipping($_GET['s']);
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
                    <h6>Envio: <?= $order['shipping_code'] ?></h6>
                </div>
                <div class="card-body py-5">
                    <section>
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
                    <section class="my-5">
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
                    <section class="my-5">
                    <main class="status-shipping">
                        <div class="d-flex justify-content-between">
                            <h6>Informacíon del estado</h6>
                            <a href="https://parcelsapp.com/es/tracking/<?=$order['shipping_code']?>">más datos</a>
                        </div>
                        <div class="my-5 py-5">
                            <div>
                                <div class="mx-5"></div>
                            </div>
                            <!-- 邮件轨道 -->
                            <div class="list-style">
                                <div class="track-all-list">
                                    <ul>
                                        <li>
                                            <i></i>
                                            <div>
                                                <p class="text">Tu pedido esta en proceso.</p>
                                                <?php
                                                $datetime = strtotime($order['date_create']);
                                                ?>
                                                <p class="time"><?=date('Y-m-d H:i', $datetime)?></p>
                                            </div>
                                        </li>
                                        <li>
                                            <i></i>
                                            <div>
                                                <p class="text">Pedido pagado.</p>
                                                <?php
                                                $datetime = strtotime($order['date_create']);
                                                ?>
                                                <p class="time"><?=date('Y-m-d H:i', $datetime)?></p>
                                            </div>
                                        </li>
                                        <li>
                                            <i></i>
                                            <div>
                                                <p class="text">Pedido iniciado.</p>
                                                <?php
                                                $datetime = strtotime($order['date_create']);
                                                ?>
                                                <p class="time"><?=date('Y-m-d H:i', $datetime)?></p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <a href="javascript:" class="btn btn-primary" id="YQElem1">17 Track</a>
                            <a href="https://parcelsapp.com/es/tracking/<?=$order['shipping_code']?>" class="btn btn-dark">ParcelsApp</a>
                            <a href="https://www.ship24.com/es/tracking?p=<?=$order['shipping_code']?>" class="btn btn-secondary">Ship 24</a>
                            <a href="https://www.correos.es/es/es/herramientas/localizador/envios/detalle?tracking-number=<?=$order['shipping_code']?>" class="btn btn-warning">Correos</a>
                        </div>
                    </main>
                    </section>
                </div>
            </div>
            <script type="text/javascript" src="//www.17track.net/externalcall.js"></script>
            <script type="text/javascript">
            YQV5.trackSingleF1({
                YQ_ElementId:"YQElem1",
                YQ_Width:470,
                YQ_Height:560,
                YQ_Fc:"0",
                YQ_Lang:"es",
                YQ_Num:"<?=$order['shipping_code']?>"
            });
            </script>
    <?php
        }
    endif;
    ?>
</div>
<?php
}
?>