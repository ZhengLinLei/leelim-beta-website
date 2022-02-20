<?php
if (isset($_GET['s'])) :
    //INCLUDE STRIPE API SDK
    require './model/stripe-php/init.php';
    //PRIVATE KEY
    $key = 'sk_test_51Ihgw6J9HHZbmVICIuwN4usvDGSSNbxx9GPkaygf0ubDdGFrWPJOAy69awPaNz5en3bdBZnyjQa3MEHfqOhBHVp600bp1LkKEc';
    //DEFINE
    $stripe = new \Stripe\StripeClient($key);
    $order = $stripe->paymentIntents->retrieve(
        $_GET['s'],
        []
    );
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
                <pre class="prettyprint" style="font-family:monospace !important;">
                    <code class="language-js">
                        <?=json_encode($order, JSON_PRETTY_PRINT);?>
                    </code>
                </pre>
            </div>
        </div>
<?php
    }
endif;
?>