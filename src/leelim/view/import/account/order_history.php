<?php
$mvc = new MVCcontroller();

$order_history = $mvc->get_order_history(10);
?>
<section id="order-history" class="w-10 module-section">
    <header>
        <div>
            <h1>Historial de pedidos</h1>
        </div>
    </header>
    <main class="my-5 py-5" id="order-history-main">
        <?php
        if(empty($order_history)){
        ?>
            <div class="my-5 py-5 limit">
                <div class="text-center text-muted">No hay registros</div>
            </div>
        <?php
        }else{
            foreach ($order_history as $key => $value):
                $value['total_value'] = json_decode($value['total_value']);
        ?>
            <div>
                <div <?=($key == count($order_history)-1)?'class="last"':''?>>
                    <div class="d-flex justify-space-between title">
                        <?php
                        $datetime = strtotime($value['date_create']);
                        ?> 
                        <div class="datetime">
                            <span><?= date('d-m-Y', $datetime) ?></span>
                            <small><?= date('H:i', $datetime) ?></small>
                        </div>
                        <div class="total">
                            <span>Total: € <?= $value['total_value']->total?></span>
                        </div>
                    </div>
                    <div class="d-flex justify-space-between mt-5 py-5 align-items-flex-end body-card">
                        <div>
                            <div class="mt-5">Pedido: <span class="small keycode"><?=$value['order_code']?></span></div>
                            <div class="mt-5">Envío: <span class="small <?=(!empty($value['shipping_code']))?'keycode':''?>"><?=(empty($value['shipping_code']))?'No procesado':$value['shipping_code']?></span></div>
                        </div>
                        <div class="action">
                            <a href="/pedido/<?=$value['order_code']?>/resumen/" class="btn mx-3">Ver todo</a>
                            <a href="/pedido/<?=$value['order_code']?>/estado/" class="btn mx-3">Ver estado</a>
                        </div>
                    </div>
                    <?php
                    if(empty($value['shipping_code'])){
                    ?>
                    <div class="mt-5">
                        <div class="p-5 warning d-flex align-items-center small">
                            <ion-icon name="hourglass-outline"></ion-icon>
                            <div class="ml-5">Este pedido aún esta en proceso.</div>
                        </div>
                    </div>
                    <?php
                    }else{
                    ?>
                    <div class="mt-5">
                        <div class="p-5 success d-flex align-items-center small">
                            <ion-icon name="footsteps-outline"></ion-icon>
                            <div class="ml-5">Este pedido esta en camino.</div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        endforeach;
        ?>
            <!-- 限制 -->
            <div class="my-5 py-5 limit">
                <div class="my-5 text-center">
                    <div class="text-muted">Solo se mostrará los 10 últimos registros.</div>
                </div>
            </div>
        <?php
        }
        ?>
    </main>
</section>