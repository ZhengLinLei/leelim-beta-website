<?php
    $mvc = new MVCcontroller();
    $pag = (isset($_GET['pag']) && !empty($_GET['pag'] && is_numeric($_GET['pag'])))?$_GET['pag']:1;
    //------------------
    function check_session_saved_count(){
        if(!isset($_SESSION['count_album_result']) || 
        (isset($_SESSION['count_album_result']) && ($_SESSION['count_album_result']['album'] != $_GET['album']))){
            return true;
        }
        return false;
    }
    $response = $mvc->get_album($_GET['album'], $pag, check_session_saved_count());
?> 
<main id="gallery-index">
    <?php
    //RESPONSE 404 WHEN THERE IS  NOTHING
    if(empty($response)){
    ?>
    <main class="my-5 py-5">
        <div class="text-center my-5 py-5 text-muted">
            <h1>Temporada no encontrada</h1>
            <div class="my-5 py-5">
                <h2>" <?=$_GET['album']?> "</h2>
            </div>
            <div>
                <a href="/galeria/" class="btn btn-big"><ion-icon name="arrow-back-outline"></ion-icon><span class="ml-3">Volver</span></a>
            </div>
        </div>
    </main>
    <?php
    }else{
    ?>
    <header class="my-5 py-5">
        <div class="text-center">
            <h1>ALBUM DEL <?=$_GET['album']?></h1>
        </div>
    </header>
    <!-- 结果 -->
    <main class="my-5 p-5">
        <div class="photo-gallery-grid container">
            <main>
                <?php
                foreach ($response as $value):
                    $value['image'] = json_decode($value['image']);
                ?>
                <a href="/galeria/<?=$_GET['album']?>/<?=$value['name']?>/">
                    <div class="img">
                        <img src="<?=$value['image']->cover_img?>" alt="Album de la temporada <?=$_GET['album']?> - Colección <?=$value['name']?> - LEELIM">
                        <div class="inner-title"><?=$value['name']?></div>
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
                    <div class="num-total"> / <?= $_SESSION['count_album_result']['data']['page']?></div>
                </div>
                <div class="prev-pag indi">
                    <?php
                    if($pag < $_SESSION['count_album_result']['data']['page']):
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
    <?php
    }
    ?>
</main>