<header class="d-none">
    <!-- SEO HELPER -->
    <nav class="d-none">
        <ul>
            <li><a href="/">LEELIM</a></li>
            <li><a href="/busquedas/">BUSQUEDAS</a></li>
            <li><a href="/galeria/">GALERIA</a></li>
            <li><a href="/mujer/">MUJER</a></li>
            <li><a href="/hombre/">HOMBRE</a></li>
            <li><a href="/unisex/">UNISEX</a></li>
        </ul>
    </nav>
</header>
<!-- 搜索页面 -->
<?php
$mvc = new MVCcontroller();

$last_keywords = $mvc->get_last_search_keywords();
?>
<main id="search-main">
    <!-- 搜索 -->
    <header id="search_form" class="d-flex flex-column align-items-center pt-5 pb-3">
        <section class="d-flex flex-column align-items-center">
            <a href="/" id="logo-svg-image-a">
                <svg viewBox="0 0 304 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.759766 52.0009V0.880859H8.82377V44.8729H36.2558V52.0009H0.759766ZM85.0707 44.8729V52.0009H50.0067V0.880859H84.4227V8.00886H58.0707V22.5529H80.8947V29.2489H58.0707V44.8729H85.0707ZM135.654 44.8729V52.0009H100.59V0.880859H135.006V8.00886H108.654V22.5529H131.478V29.2489H108.654V44.8729H135.654ZM176.162 52.0009V0.880859H184.226V44.8729H211.658V52.0009H176.162ZM225.408 52.0009V0.880859H233.472V52.0009H225.408ZM295.21 52.0009V15.5689L280.162 43.2169H275.41L260.29 15.5689V52.0009H252.226V0.880859H260.866L277.786 32.1289L294.706 0.880859H303.346V52.0009H295.21Z" fill="black"/>
                </svg>
            </a>
        </section>
        <section id="input" class="my-5">
            <form action="/busqueda/" method="get" id="search-form">
                <div id="input-group">
                    <input type="search" name="s" id="input-s" placeholder="Busqueda por palabras">
                    <a href="javascript:" class="close"><ion-icon name="close-outline"></ion-icon></a>
                    <button type="submit">
                        <ion-icon name="search-outline"></ion-icon>
                    </button>
                </div>
            </form>
        </section>
    </header>
    <!-- 快键 -->
    <main id="hot" class="py-5 d-flex justify-center">
        <section id="recommended">
            <div id="history" class="my-5 pb-5 d-none">
                <header class="d-flex justify-space-between">
                    <h3>Historial</h3>
                    <div class="delete">
                        <a href="javascript:">
                            <ion-icon name="trash-outline"></ion-icon>
                            <span>Borrar Todo</span>
                        </a>
                    </div>
                </header>
                <main class="py-5">
                    <ul>
                    </ul>
                </main>
            </div>
            <div class="top my-5">
                <ul class="save-update">
                    <?php
                    foreach ($last_keywords as $key => $value):
                    ?>
                    <li>
                        <a href="/busqueda/?s=<?=str_replace(" ", '-', $value['keyword'])?>" query-update="<?=$value['keyword']?>">
                            <span><?=$value['keyword']?></span>
                            <?php
                            if($key == 0 || strtotime($value['date_update']) > strtotime($last_keywords[$key-1]['date_update'])){
                            ?>
                            <ion-icon name="caret-up-outline" class="up"></ion-icon>
                            <?php
                            }else{
                            ?>
                            <ion-icon name="caret-down-outline" class="down"></ion-icon>
                            <?php
                            }
                            ?>
                        </a>
                    </li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            </div>
            <div class="quick-link my-5">
                <ul class="save-update">
                    <li><a href="/busqueda/?s=pantalones" query-update="pantalones">PANTALONES</a></li>
                    <li><a href="/busqueda/?s=invierno" query-update="invierno">INVIERNO</a></li>
                    <li><a href="/busqueda/?s=pulseras" query-update="pulseras">PULSERAS</a></li>
                    <li><a href="/busqueda/?s=bufandas" query-update="bufandas">BUFANDAS</a></li>
                    <li><a href="/busqueda/?s=especial" query-update="especial">ESPECIAL</a></li>
                    <li><a href="/busqueda/?s=verano" query-update="verano">VERANO</a></li>
                </ul>
            </div>
        </section>
        <section class="d-none" id="search-suggestion">
            <h4>Relacionados</h4>
            <div class="mt-5 py-5">
                <ul>
                    <!-- REAL TIME 搜索 -->
                </ul>
            </div>
        </section>
    </main>
</main>
<section id="load-content-section" class="justify-center align-items-center">
    <div class="loader-spin"></div>
</section>
<!-- --- -->
<script>
    const csrf_keycode = <?= $_SESSION['csrf_keycode'] ?>;
</script>