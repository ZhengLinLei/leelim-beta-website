<section id="wallet-history" class="w-10 module-section">
    <header>
        <div>
            <h1>Historial del monedero</h1>
        </div>
    </header>
    <main class="my-5" id="wallet-history-main">
        <?php
        if(empty($_SESSION['account']['data']['wallet_history'])){
        ?>
            <div>
                <div class="text-center text-muted limit">No hay registros</div>
            </div>
        <?php
        }else{
            foreach ($_SESSION['account']['data']['wallet_history'] as $key => $value):
        ?>
            <div>
                <div <?=($key == count($_SESSION['account']['data']['wallet_history'])-1)?'class="last"':''?>>
                    <div class="d-flex justify-space-between title">
                        <div class="datetime">
                            <span><?= date('d-m-Y', $value->datetime) ?></span>
                            <small><?= date('H:i', $value->datetime) ?></small>
                        </div>
                        <div>
                            <?php
                            if($value->type){ //type 1 = add money, 0 = minus money
                                $color = 'correct';
                                $sign = '+';
                            }else{
                                $color = 'wrong';
                                $sign = '-';
                            }
                            ?>
                            <div class="text-<?= $color?>"><?=$sign?> <?= number_format($value->value, 2, '.', '')?> €</div>
                        </div>
                    </div>
                    <div class="d-flex justify-space-between mt-5">
                        <div class="message small"><?=$value->message?></div>
                        <div class="text-right text-muted"><?= number_format($value->wallet, 2, '.', '')?> €</div>
                    </div>
                </div>
            </div>
        <?php
            endforeach;
        }
        ?>
    </main>
</section>