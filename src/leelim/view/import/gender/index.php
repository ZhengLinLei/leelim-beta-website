<?php
    $mvc = new MVCcontroller();
    $mvc->include_modules(); // 默认 HEADER

    $gender_key = ['mujer' => 'woman', 'hombre' => 'man', 'unisex' => 'unisex'];
    
    $gender_active = $gender_key[$_GET['gender']];
?>
<main id="gender-index-main">
    <header>
        <div id="video">
            <video autoplay muted loop>
                <source src="/static/video/web/gender/gender_index_<?= $gender_active ?>.mp4" type="video/mp4">
            </video>
        </div>
        <div class="po-absolute" id="header-title">
            <h1><?= ucfirst($_GET['gender']) ?></h1>
        </div>
    </header>
    <main class="py-5 container">
        <div class="d-flex justify-center mb-5 pb-5">
            <div id="index-gender">
                <a href="ropa/" class="clothing item btn">
                    <h2>Ropa</h2>
                </a>
                <a href="accesorio/" class="accessory item btn">
                    <h2>Accesorios</h2>
                </a>
                <a href="bolso/" class="bag item btn">
                    <h2>Bolsos</h2>
                </a>
                <a href="zapato/" class="shoe item btn">
                    <h2>Zapatos</h2>
                </a>
            </div>
        </div>
        <?php
        //GET RESULTS
        $top_item = $mvc->get_top_recent_gender_item($gender_active, 'top');
        $recent_item = $mvc->get_top_recent_gender_item($gender_active, 'recent');
        ?>
        <div id="top-product" class="py-5 d-flex flex-column align-items-center">
            <h2 class="my-5">#TOP <?= strtoupper($_GET['gender']) ?></h2>
            <div class="item-product-grid my-5 w-10 gender-grid">
                <main>
                <?php
                foreach ($top_item as $key => $value):
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
                                <dv class="price">€ <?=$value['price']?></dv>
                            </main>
                        </div>
                    </a>
                <?php
                endforeach;
                ?>
                </main>
            </div>
        </div>
        <div id="recently-product" class="py-5 d-flex flex-column align-items-center">
            <h2 class="my-5">RECIENTES</h2>
            <div class="item-product-grid my-5 w-10 gender-grid">
                <main>
                <?php
                foreach ($recent_item as $key => $value):
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
                                <dv class="price">€ <?=$value['price']?></dv>
                            </main>
                        </div>
                    </a>
                <?php
                endforeach;
                ?>
                </main>
            </div>
        </div>
    </main>
</main>
