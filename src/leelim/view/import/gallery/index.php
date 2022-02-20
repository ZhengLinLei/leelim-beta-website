<main id="gallery-index">
    <?php
    $mvc = new MVCcontroller();
    $pag = (isset($_GET['pag']) && !empty($_GET['pag'] && is_numeric($_GET['pag'])))?$_GET['pag']:1;
    //------------------
    $response = $mvc->get_gallery($pag, (isset($_SESSION['count_gallery_result']))?false:true);
    ?> 
    <!-- 结果 -->
    <main class="my-5 p-5">
        <div class="photo-gallery-grid container">
            <main>
                <?php
                foreach ($response as $value):
                ?>
                <a href="/galeria/<?=$value['name']?>/">
                    <div class="img">
                        <img src="<?=$value['cover_img']?>" alt="Temporada <?=$value['name']?> - LEELIM">
                    </div>
                    <div class="info">
                        <header class="text-center"><?=$value['name']?></header>
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
                    <a href="?pag=<?=($pag-1)?>">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                        <span class="tt">ANTERIOR</span>
                    </a>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="active-pag d-flex">
                    <div class="num-actual"><?=$pag?></div>
                    <div class="num-total"> / <?= $_SESSION['count_gallery_result']['data']['page']?></div>
                </div>
                <div class="prev-pag indi">
                    <?php
                    if($pag < $_SESSION['count_gallery_result']['data']['page']):
                    ?>
                    <a href="?pag=<?=($pag+1)?>">
                        <span class="tt">SIGUIENTE</span>
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </a>
                    <?php
                    endif;
                    ?>
                </div>
            </footer>
        </div>
    </main>
</main>