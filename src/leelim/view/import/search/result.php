<?php
    $mvc = new MVCcontroller();
    $mvc->include_modules(); // 默认 HEADER
    //PREPARE
    $gender = (array) [];
    $group = (array) [];
    $sort = 'best'; //DEFAULT IN 'BEST' OPTION
    $page = 0;
    //GET PARAM
    $sort_accept = ['newest', 'priceDesc', 'priceAsc'];
    if(isset($_GET['sort']) && in_array($_GET['sort'], $sort_accept)){
        $sort = $_GET['sort'];
    }
    //GET PARAM
    $gender_accept = ['woman', 'man', 'unisex'];
    $group_accept = ['accessory', 'clothing', 'bag', 'shoe'];
    function array_array($array, $array_master){
        foreach ($array as $value) {
            if(!in_array($value, $array_master)){
                return false;
            }
        }
        return true;
    }
    if(isset($_GET['gender'])){
        $ex = explode(',', $_GET['gender']);
        if(array_array($ex, $gender_accept)){
            $gender = $ex;
        }
    }
    if(isset($_GET['group'])){
        $ex = explode(',', $_GET['group']);
        if(array_array($ex, $group_accept)){
            $group = $ex;
        }
    }
    $pag = (isset($_GET['pag']) && !empty($_GET['pag'] && is_numeric($_GET['pag'])))?$_GET['pag']:1;
    //KEY
    $gender_key = ['woman' => 'Mujer', 'man' => 'Hombre', 'unisex' => 'Unisex'];
    $group_key = ['accessory' => 'Accesorios', 'clothing' => 'Ropa', 'bag' => 'Bolsos', 'shoe' => 'Zapatos'];
    $sort_key = ['newest' => 'Recientes', 'priceDesc' => 'Precio: alto-bajo', 'priceAsc' => 'Precio: bajo-alto'];
    //------------------
    function check_session_saved_count($param, $sort){
        if(!isset($_SESSION['count_search_result']) || 
        (isset($_SESSION['count_search_result']) && ($_SESSION['count_search_result']['query'] != $_GET['s'] || $_SESSION['count_search_result']['gender'] != $param['gender'] || $_SESSION['count_search_result']['group'] != $param['group'] || $_SESSION['count_search_result']['sort'] != $sort))){
            return true;
        }
        return false;
    }
    $param = ["gender" => $gender, "group" => $group];
    $response = $mvc->get_search_product_item($_GET['s'], $pag, $param, $sort, check_session_saved_count($param, $sort));
?>
<!-- 结果页面 -->
<main id="result-main" class="container my-5 py-5">
    <!-- 结果 -->
    <header class="p-5 mb-5 ">
        <div class="d-flex justify-space-between align-items-flex-end header">
            <div>
                <div class="my-3">RESULTADOS DE </div>
                <div class=" d-flex align-items-flex-end">
                    <h1 class="mx-2">"<?= $_GET['s']?>"</h1>
                    <span class="text-muted">[ <?= $_SESSION['count_search_result']['data']['total']?> ]</span>
                </div>
            </div>
            <?php
            if($_SESSION['count_search_result']['data']['total'] > 0):
            ?>
            <div class="d-flex order-group">
                <div class="option order">
                    <a href="javascript:"><span>Abrir Filtros</span><ion-icon name="options-outline"></ion-icon></a>
                </div>
                <div class="sort order">
                    <a href="javascript:"><span>Ordenar por</span><ion-icon name="chevron-down-outline"></ion-icon></a>
                </div>
            </div>
            <?php
            endif;
            ?>
        </div>
        <div class="tag mt-5 pt-5 d-flex">
            <a class="tag-tic" href="javascript:">
                <span><?= $_GET['s']?></span>
            </a>
            <?php
            if(isset($_GET['sort'])){
            ?>
            <a class="tag-tic" href="?s=<?= $_GET['s']?><?= ((isset($_GET['gender']))?('&gender='.$_GET["gender"]):'')?>">
                <span><?= $sort_key[$sort] ?></span>
                <ion-icon name="close-outline"></ion-icon>
            </a>
            <?php
            }
            if(isset($_GET['gender'])){ 
                foreach ($gender as $value) {
                    $tmp_arr = $gender;
                    unset($tmp_arr[array_search($value, $tmp_arr)]);
            ?>
            <a class="tag-tic" href="?s=<?= $_GET['s']?><?= ((isset($_GET['sort']))?('&sort='.$_GET["sort"]):'').((!empty($tmp_arr))?'&gender='.implode(',', $tmp_arr):'').((isset($_GET['group']))?('&group='.$_GET["group"]):'')?>">
                <span><?= $gender_key[$value] ?></span>
                <ion-icon name="close-outline"></ion-icon>
            </a>
            <?php
                }
            }
            if(isset($_GET['group'])){ 
                foreach ($group as $value) {
                    $tmp_arr = $group;
                    unset($tmp_arr[array_search($value, $tmp_arr)]);
            ?>
            <a class="tag-tic" href="?s=<?= $_GET['s']?><?= ((isset($_GET['sort']))?('&sort='.$_GET["sort"]):'').((isset($_GET['gender']))?('&gender='.$_GET["gender"]):'').((!empty($tmp_arr))?'&group='.implode(',', $tmp_arr):'')?>">
                <span><?= $group_key[$value] ?></span>
                <ion-icon name="close-outline"></ion-icon>
            </a>
            <?php
                }
            }
            ?>
        </div>
    </header>
    <main class="my-5 p-5">
        <?php
        if($_SESSION['count_search_result']['data']['total'] > 0){
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
                                <dv class="price">€ <?=number_format($value['price'], 2, '.', ' ')?></dv>
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
                    <a href="?s=<?= $_GET['s'].((isset($_GET['gender']))?('&gender='.$_GET['gender']):'').((isset($_GET['group']))?('&group='.$_GET['group']):'').('&pag='.($pag-1))?>">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                        <span class="tt">ANTERIOR</span>
                    </a>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="active-pag d-flex">
                    <div class="num-actual"><?=$pag?></div>
                    <div class="num-total"> / <?= $_SESSION['count_search_result']['data']['page']?></div>
                </div>
                <div class="prev-pag indi">
                    <?php
                    if($pag < $_SESSION['count_search_result']['data']['page']):
                    ?>
                    <a href="?s=<?= $_GET['s'].((isset($_GET['gender']))?('&gender='.$_GET['gender']):'').((isset($_GET['group']))?('&group='.$_GET['group']):'').('&pag='.($pag+1))?>">
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
        }else{
            $mvc->include_modules('search/result/empty');
        }
        ?>
    </main>
</main>
<?php
    $mvc->include_modules('component/footer');
?> 
<!-- OPTIONS -->
<?php
if($_SESSION['count_search_result']['data']['total'] > 0):
?>
<section id="option" class="po-fixed p-5">
    <header class="close mb-5 po-sticky fixed-top">
        <a href="javascript:" onclick="document.body.classList.remove('option-active')"><ion-icon name="close-outline"></ion-icon></a>
    </header>
    <main class="my-5">
        <h3>Genero</h3>
        <div class="my-5 py-5">
            <ul>
                <?php
                foreach ($gender_key as $key => $value):
                ?>
                    <li>
                        <input type="checkbox" id="gender-<?= $key ?>" <?= ((isset($gender) && isset($_GET['gender']) && in_array($key, $gender))?'checked': '') ?>><ion-icon name="checkmark-outline" class="icon"></ion-icon><label for="gender-<?= $key ?>"><?= $value ?></label>
                    </li>
                <?php
                endforeach;
                ?>
            </ul>
        </div>
        <h3>Producto</h3>
        <div class="my-5 py-5">
            <ul>
                <?php
                foreach ($group_key as $key => $value):
                ?>
                    <li>
                        <input type="checkbox" id="group-<?= $key ?>" <?= ((isset($group) && isset($_GET['group']) && in_array($key, $group))?'checked': '') ?>><ion-icon name="checkmark-outline" class="icon"></ion-icon><label for="group-<?= $key ?>"><?= $value ?></label>
                    </li>
                <?php
                endforeach;
                ?>
            </ul>
        </div>
    </main>
    <footer class="py-3 po-sticky">
        <div class="pt-5">
            <a href="javascript:" id="apply-filter">Aplicar Filtros</a>
        </div>
    </footer>
</section>
<!-- SORT -->
<section id="sort" class="po-fixed p-5">
    <header class="close mb-5">
        <a href="javascript:" onclick="document.body.classList.remove('sort-active')"><ion-icon name="close-outline"></ion-icon></a>
    </header>
    <main class="my-5">
        <h3>Ordenar por</h3>
        <div class="my-5 py-5">
            <ul>
                <li><a href="?s=<?= $_GET['s'].((isset($_GET['gender']))?('&gender='.$_GET['gender']):'').((isset($_GET['group']))?('&group='.$_GET['group']):'')?>">Destacados</a></li>
                <?php
                foreach ($sort_key as $key => $value):
                ?>
                <li><a <?= (isset($_GET['sort']) && $_GET['sort'] == $key)?'class="text-muted"':('href="?s='.$_GET['s'].'&sort='.$key.((isset($_GET['gender']))?('&gender='.$_GET['gender']):'').((isset($_GET['group']))?('&group='.$_GET['group']):''))?>"><?= $value ?></a></li>
                <?php
                endforeach;
                ?>
            </ul>
        </div>
    </main>
</section>
<!-- 黑布 -->
<section id="dark-bg" class="po-fixed"></section>
<script>
    const base_url = '<?= parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH).'?s='.$_GET['s']?><?= (isset($_GET['sort']))?('&sort='.$_GET['sort']):''?>';
    let request_param = <?= (isset($_GET['gender']) || isset($_GET['group']))?'true':'false' ?>;
</script>
<?php
endif;
?>
<!-- HEADER SCRIPT -->
<script src="/static/js/src/header.js"></script>