<?php
if (isset($_GET['s'])) :
    $mvc = new MVCcontroller();
    $order = $mvc->get_wallet_payment($_GET['s']);
    if (empty($order)) {
?>
        <div class="my-5 py-5 text-muted">
            <div class="text-center">No hay registros</div>
        </div>
    <?php
    } else {
    ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Codigo: <?= $_GET['s'] ?></h6>
            </div>
            <div class="card-body py-5 row">
                <pre class="prettyprint">
                    <code class="language-js">
                        <?=json_encode($order[0], JSON_PRETTY_PRINT);?>
                    </code>
                </pre>
            </div>
        </div>
<?php
    }
endif;
?>