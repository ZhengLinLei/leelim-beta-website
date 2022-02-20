<?php
    $mvc = new MVCcontroller();
    $mvc->include_modules(); // 默认 HEADER

    $gender_key = ['mujer' => 'woman', 'hombre' => 'man', 'unisex' => 'unisex'];
    $group_key = ['accesorio' => 'accessory', 'ropa' => 'clothing', 'bolso' => 'bag', 'zapato' => 'shoe'];
    
    $gender_active = $gender_key[$_GET['gender']];
    $group_active = $group_key[$_GET['group']];
    $pag = (isset($_GET['pag']) && !empty($_GET['pag'] && is_numeric($_GET['pag'])))?$_GET['pag']:1;
    //------------------
    function check_session_saved_count($gender, $group){
        if(!isset($_SESSION['count_gender_result']) || 
        (isset($_SESSION['count_gender_result']) && ($_SESSION['count_gender_result']['gender'] != $gender || $_SESSION['count_gender_result']['group'] != $group))){
            return true;
        }
        return false;
    }
    $response = $mvc->get_gender_product_item($gender_active, $group_active, $pag, check_session_saved_count($gender_active, $group_active));
?>
<main id="gender-result-main">
    <header class="py-5 my-5">
        <div class="my-5 py-5 text-center" id="header-title">
            <h1><?= ucfirst($_GET['group']). ' de ' .ucfirst($_GET['gender']) ?></h1>
        </div>
    </header>
    <main class="container">
        <?php
        if($_SESSION['count_gender_result']['data']['total'] > 0){
        ?>
        <div class="item-product-grid search-grid">
            <main>
                <?php
                foreach ($response as $key => $value):
                    $value['image'] = json_decode($value['image']);
                    $url_name = str_replace(" ", '-', $value['name']);
                ?>
                    <a href="/producto/<?=$url_name?>/<?=$value['product_code']?>/">
                        <div class="img">
                            <img src="<?=$value['image']->cover_img?>" alt="<?=$value['name']?> - LEELIM" class="active">
                            <img src="<?=$value['image']->hover_img?>" alt="<?=$value['name']?> (imagen de hover) - LEELIM" class="hover">
                        </div>
                        <div class="info">
                            <header>
                                <div class="tag">
                                    <div class="tic-c"><?=$value['season']?></div>
                                </div>
                                <div class="title"><?=$value['name']?></div>
                            </header>
                            <main>
                                <dv class="price">€ <?= number_format($value['price'], 2, '.', ' ')?></dv>
                            </main>
                        </div>
                    </a>
                <?php
                endforeach;
                ?>
            </main>
            <footer>
                <div class="prev-pag indi">
                    <?php
                    if($pag > 1):
                    ?>
                    <a href="?pag=<?=$pag-1?>">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                        <span class="tt">ANTERIOR</span>
                    </a>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="active-pag d-flex">
                    <div class="num-actual"><?=$pag?></div>
                    <div class="num-total"> / <?= $_SESSION['count_gender_result']['data']['page']?></div>
                </div>
                <div class="prev-pag indi">
                    <?php
                    if($pag < $_SESSION['count_gender_result']['data']['page']):
                    ?>
                    <a href="?pag=<?=$pag+1?>">
                        <span class="tt">SIGUIENTE</span>
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </a>
                    <?php
                    endif;
                    ?>
                </div>
            </footer>
        </div>
        <?php
        }
        ?>
    </main>
</main>
<?php
    $mvc = new MVCcontroller();
    $mvc->include_modules('component/footer');
?>