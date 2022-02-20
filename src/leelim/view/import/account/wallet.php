<section id="wallet" class="w-10 module-section">
    <header class="d-flex justify-space-between align-items-center">
        <div class="d-flex align-items-flex-end">
            <h1>Monedero</h1>
        </div>
        <a href="/cuenta/historial-del-monedero/" class="btn d-flex align-items-center" id="history"><b class="mr-1">Historial del monedero</b></a>
    </header>
    <main class="my-5" id="wallet-main">
        <div class="d-flex align-items-center flex-column">
            <div id="number">€ <span id="money"></span></div>
            <?php
            if(!empty($_SESSION['account']['data']['wallet_history'])):
                if($_SESSION['account']['data']['wallet_history'][0]->type){ //type 1 = add money, 0 = minus money
                    $color = 'correct';
                    $icon = 'up';
                    $sign = '+';
                }else{
                    $color = 'wrong';
                    $icon = 'down';
                    $sign = '-';
                }
            ?>
            <div class="text-<?= $color?> mt-3"><ion-icon name="caret-<?=$icon?>-outline"></ion-icon> <?=$sign?> <?= number_format($_SESSION['account']['data']['wallet_history'][0]->value, 2, '.', '')?> €</div>
            <?php
            endif;
            ?>
        </div>
    </main>
</section>
<script>
    const wallet_money = <?= $_SESSION['account']['data']['wallet'] ?>;
    document.getElementById('money').innerHTML = ((wallet_money < 10)?0:wallet_money - 10).toFixed(2);
</script>
<script src="/static/js/src/account_wallet.js"></script>