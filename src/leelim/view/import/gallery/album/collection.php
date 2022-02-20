<?php
$mvc = new MVCcontroller();
$response = $mvc->get_individual_collection_item($_GET['album'], $_GET['collection']);

if (empty($response)) {
?>
    <main class="my-5 py-5">
        <div class="text-center my-5 py-5 text-muted">
            <h1>Colección no encontrada</h1>
            <div class="my-5 py-5">
                <a href="javascript:history.back();" class="btn btn-big">
                    <ion-icon name="arrow-back-outline"></ion-icon><span class="ml-3">Volver</span>
                </a>
            </div>
        </div>
    </main>
<?php
} else {
    $item = $response[0];
    $item['image'] = json_decode($item['image']);
    $item['color_list'] = json_decode($item['color_list']);
    //
    $product_list = json_decode($item['product_list']);
    $product_ids = implode('","', $product_list);
    echo $product_ids;
    $product_list = $mvc->get_group_product_item($product_ids, count($product_list));
?>
    <main>
        <div>
            <section id="head" class="d-flex">
                <div class="flex-1" id="image-viewer">
                    <!-- 模块 SINTAX  -->
                    <div class="img-show">
                        <figure class="zoom" id="zoom-img" style="background-image: url(<?= $item['image']->extra_img[0] ?>)">
                            <img id="item-big-image" src="<?= $item['image']->extra_img[0] ?>" alt="">
                        </figure>
                    </div>
                </div>
                <div class="flex-1" id="item-info">
                    <div class="image-scroll">
                        <?php
                        foreach ($item['image']->extra_img as $index => $value) :
                        ?>
                            <div>
                                <a href="javascript:" <?= ($index == 0) ? 'class="active"' : '' ?>>
                                    <img src="<?= $value ?>" alt="">
                                </a>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                    <div id="item-section" class="py-5">
                        <div class="my-5">
                            <h1 class="item-title"><?= $item['name'] ?></h1>
                            <div class="tag">
                                <div class="tic-c"><?= $item['season'] ?></div>
                            </div>
                        </div>
                    </div>
                    <div id="product-related" class="my-5">
                        <h3>Productos</h3>
                        <div class="my-5 body">
                            <?php
                            foreach ($product_list as $key => $value):
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
                        </div>
                    </div>
                </div>
            </section>
            <section id="body">
                <!-- 颜色 -->
                <div id="color-item" class="py-5 my-5">
                    <h2 class="text-center">DISEÑOS DE COLORES</h2>
                    <div class="my-5 py-5 d-flex flex-column justify-center container">
                        <div class="color-index">
                            <?php
                            foreach ($item['color_list'] as $value) :
                            ?>
                                <div>
                                    <div class="color" style="background-color:<?= $value ?>"></div>
                                    <div class="my-5"><?= $value ?></div>
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                        <div class="my-5 py-5 container">
                            <img src="<?= $item['image']->color_img ?>" alt="<?= $item['name'] ?> - Diseños de Colores - LEE LIM" class="w-10">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- ITEM SCRIPT -->
    <script src="/static/js/src/gallery_collection.js"></script>
<?php
}
?>