<?php
$mvc = new MVCcontroller();
$response = $mvc->get_individual_product_item($_GET['item']);
if(empty($response)){
    $mvc->return_status_not_found();
}
$item = $response[0];
$item['image'] = json_decode($item['image']);
$item['option'] = json_decode($item['option']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Basic meta tag -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$item['name']?> - LEE LIM</title>
    <!-- SEO meta tag -->
    <meta name="description" content="">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="Lee, Lim">
    <meta name="author" content="ZLL Studio">
    <meta name="distribution" content="Global">
    <!-- OG SEO social media meta tag -->
    <meta property="og:site_name" content="LEE LIM">
    <meta property="og:url" content="https://leelim.es/">
    <meta property="og:title" content="LEE LIM - Página Oficial España">
    <meta property="og:type" content="website">
    <meta property="og:description" content="">
    <!-- SEO Helpers -->
    <link rel="canonical" href="https://leelim.es/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- RESOURCE, CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <!-- COROUSOL SCROLLSLIDER DEFAULT CSS -->
    <link rel="stylesheet" href="/static/css/ScrollSlider.css">
    <!-- INTERNAL RESOURCE -->
    <link rel="stylesheet" href="/static/css/global.css">
    <link rel="stylesheet" href="/static/css/item.css">
    <!-- ICON 图标 -->
    <link rel="apple-touch-icon" sizes="57x57" href="/static/img/logo/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/static/img/logo/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/static/img/logo/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/static/img/logo/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/static/img/logo/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/static/img/logo/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/static/img/logo/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/static/img/logo/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/static/img/logo/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/static/img/logo/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/static/img/logo/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/static/img/logo/icon/favicon-16x16.png">
    <!-- <link rel="manifest" href="/manifest.json"> -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/static/img/logo/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
    <?php
    $mvc->include_modules(); // 默认HEADER
    ?>
    <!--  -->
    <main>
        <div>
            <section id="head" class="d-flex">
                <div class="flex-1" id="image-viewer">
                    <!-- 模块 SINTAX  -->
                    <div class="img-show">
                        <figure class="zoom" id="zoom-img" style="background-image: url(<?=$item['image']->extra_img[0]?>)">
                            <img id="product-big-image" src="<?=$item['image']->extra_img[0]?>" alt="">
                        </figure>
                    </div>
                </div>
                <div class="flex-1" id="product-info">
                    <div class="image-scroll">
                        <?php
                        foreach ($item['image']->extra_img as $index => $value):
                        ?>
                        <div>
                            <a href="javascript:" <?=($index == 0)?'class="active"':''?>>
                                <img src="<?=$value?>" alt="">
                            </a>
                        </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                    <div id="product-section" class="py-5">
                        <div class="my-5">
                            <h1 class="product-title"><?=$item['name']?></h1>
                            <div class="tag">
                                <div class="tic-c"><?=$item['season']?></div>
                            </div>
                            <div class="price my-5">€ <?=number_format($item['price'], 2, '.', '')?></div>
                        </div>
                        <div class="my-5 py-5" id="product-action">
                            <div class="my-5 py-5">
                                <!-- COLOR SECTION -->
                                <?php
                                if(!empty($item['option']->color)):
                                ?>
                                <div id="color" class="my-5 py-5">
                                    <h3>Color</h3>
                                    <div id="color-grid">
                                    <?php
                                    foreach($item['option']->color as $key => $value):
                                    ?>
                                        <a href="javascript:" class="product-color-option <?=($key == 0)?'active':''?>" data-color="<?=$value?>">
                                            <div class="color" style="background-color:<?=$value?>">
                                                <div id="active-color-option">
                                                    <ion-icon name="checkmark-outline"></ion-icon>
                                                </div>
                                            </div>
                                        </a>
                                    <?php
                                    endforeach;
                                    ?>
                                    </div>
                                </div>
                                <?php
                                endif;
                                ?>
                                <div class="size-amount d-flex">
                                    <!-- SIZE SECTION -->
                                    <?php
                                    if(!empty($item['option']->size)):
                                    ?>
                                    <div id="size">
                                        <h3>Talla</h3>
                                        <div class="my-5 px-2">
                                            <select id="select-size-item">
                                            <?php
                                            foreach($item['option']->size as $value):
                                            ?>
                                                <option value="<?=$value?>"><?=$value?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    endif;
                                    ?>
                                    <!-- AMOUNT SECTION -->
                                    <div id="amount">
                                        <h3>Cantidad</h3>
                                        <div class="my-5 px-2">
                                            <input class="amount-input-item" value="1" type="number" min="1" pattern="[0-9]*" id="input-amount-item">
                                        </div>
                                    </div>
                                </div>
                                <div class="my-5 pt-5">
                                    <div class="text-right mt-5 p-5">
                                        <a href="javascript:" class="btn btn-big" id="add-cart">Añadir al Carrito</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="body">
                <div id="item-info" class="d-flex container">
                    <div class="flex-1 shipping">
                        <h2 class="text-center">INFORMACIÓN</h2>
                        <div class="text">
                            <div>
                                <p><b>Envios de 3-6 dias laborales</b>, pero debido a la COVID-19, los plazos de entrega se han ampliado y puede tardar más de lo habitual.</p>
                            </div>
                            <div>
                                <p><b>Devoluciones en 14 dias habiles</b> desde la recepcion del producto.</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 ">
                        <h2 class="text-center">DESCRIPCIÓN</h2>
                        <div class="text">
                            <div>
                                <p><?=$item['description']?></p>
                            </div>
                            <div>
                                <h3>Material</h3>
                                <p><?=$item['material']?></p>
                                <div class="d-flex">
                                    <div class="d-flex">
                                        <div class="mx-5">
                                            <svg width="25px" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M510.21 125.885C507.085 121.403 500.922 120.295 496.413 123.446L369.085 212.417L275.241 40.4624C270.324 31.466 262.834 26.293 254.693 26.293C246.522 26.293 239.03 31.4844 234.135 40.5638L141.884 211.516L15.5832 123.437C11.0629 120.316 4.91465 121.414 1.77878 125.894C-1.34234 130.385 -0.249118 136.559 4.23622 139.689L132.41 229.066L13.6143 449.241C8.81374 458.145 8.48928 467.346 12.7626 474.479C17.0194 481.619 25.2563 485.706 35.3645 485.706H476.707C486.463 485.706 494.377 481.825 498.743 475.155C499.322 474.643 500.02 474.302 500.485 473.647C502.155 471.247 502.533 468.399 501.906 465.738C502.437 460.505 501.385 454.852 498.343 449.277L378.64 229.927L507.769 139.689C512.252 136.55 513.346 130.376 510.21 125.885ZM251.564 49.9751C253.092 47.1434 254.466 46.2014 254.56 46.0945C254.91 46.2014 256.291 47.125 257.84 49.9659L352.738 223.847L256.263 291.266L158.244 222.933L251.564 49.9751ZM238.949 303.359L39.7134 442.582L148.77 240.472L238.949 303.359ZM256.274 315.438L472.034 465.886H40.9615L256.274 315.438ZM471.401 441.284L273.574 303.343L362.287 241.344L471.401 441.284Z" fill="black"/>
                                            </svg>
                                        </div>
                                        <div class="mx-5">
                                            <svg width="25px" viewBox="0 0 513 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M490.667 475.583V36.4173L508.875 18.2093C513.042 14.0423 513.042 7.29225 508.875 3.12625C504.708 -1.04075 497.958 -1.04075 493.792 3.12625L475.585 21.3343H36.4173L18.2083 3.12525C14.0413 -1.04175 7.29125 -1.04175 3.12525 3.12525C-1.04075 7.29225 -1.04175 14.0423 3.12525 18.2083L21.3333 36.4163V475.583L3.12525 493.792C-1.04175 497.959 -1.04175 504.709 3.12525 508.875C5.20825 510.958 7.93825 512 10.6673 512C13.3963 512 16.1253 510.958 18.2093 508.875L36.4173 490.667H475.585L493.792 508.875C495.875 510.958 498.606 512 501.335 512C504.064 512 506.792 510.958 508.876 508.875C513.043 504.708 513.043 497.958 508.876 493.792L490.667 475.583ZM256 42.6673H454.25L398.879 98.0383C361.012 63.7543 310.986 42.6673 256 42.6673C201.014 42.6673 150.988 63.7543 113.121 98.0383L57.7503 42.6673H256ZM240.917 256L113.118 383.798C82.6863 349.811 64.0003 305.1 64.0003 256C64.0003 206.9 82.6863 162.189 113.118 128.202L240.917 256ZM128.202 113.118C162.189 82.6863 206.9 64.0003 256 64.0003C305.1 64.0003 349.811 82.6863 383.798 113.118L256 240.917L128.202 113.118ZM256 271.083L383.798 398.882C349.811 429.315 305.1 448 256 448C206.9 448 162.189 429.314 128.202 398.882L256 271.083ZM271.083 256L398.882 128.202C429.315 162.189 448 206.9 448 256C448 305.1 429.314 349.811 398.882 383.798L271.083 256ZM42.6673 256V57.7503L98.0383 113.121C63.7543 150.988 42.6673 201.014 42.6673 256C42.6673 310.986 63.7543 361.012 98.0383 398.879L42.6673 454.25V256ZM256 469.333H57.7503L113.121 413.962C150.988 448.246 201.014 469.333 256 469.333C310.986 469.333 361.012 448.246 398.879 413.962L454.25 469.333H256ZM469.333 256V454.25L413.962 398.879C448.246 361.012 469.333 310.986 469.333 256C469.333 201.014 448.246 150.988 413.962 113.121L469.333 57.7503V256Z" fill="black"/>
                                            </svg>
                                        </div>
                                        <div class="mx-5">
                                            <svg width="25px" viewBox="0 0 513 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M444.119 82.9653L508.875 18.2083C513.042 14.0413 513.042 7.29125 508.875 3.12525C504.708 -1.04175 497.958 -1.04175 493.792 3.12525L429.035 67.8823C383.417 25.8873 322.75 0.000251531 256 0.000251531C189.25 0.000251531 128.583 25.8873 82.9653 67.8823L18.2083 3.12525C14.0413 -1.04175 7.29125 -1.04175 3.12525 3.12525C-1.04075 7.29225 -1.04175 14.0423 3.12525 18.2083L67.8823 82.9653C25.8873 128.585 0.000251531 189.253 0.000251531 256C0.000251531 322.747 25.8873 383.415 67.8823 429.035L3.12525 493.792C-1.04175 497.959 -1.04175 504.709 3.12525 508.875C5.20825 510.958 7.93825 512 10.6673 512C13.3963 512 16.1253 510.958 18.2093 508.875L82.9663 444.119C128.583 486.113 189.25 512 256 512C322.75 512 383.417 486.113 429.035 444.119L493.792 508.875C495.875 510.958 498.606 512 501.335 512C504.064 512 506.792 510.958 508.876 508.875C513.043 504.708 513.043 497.958 508.876 493.792L444.12 429.035C486.113 383.415 512 322.747 512 256C512 189.253 486.113 128.585 444.119 82.9653ZM256 21.3333C316.866 21.3333 372.212 44.8213 413.956 82.9613L256 240.917L98.0443 82.9613C139.788 44.8223 195.134 21.3333 256 21.3333ZM82.9613 413.956C44.8223 372.212 21.3333 316.866 21.3333 256C21.3333 195.134 44.8223 139.788 82.9613 98.0443L240.917 256L82.9613 413.956ZM256 490.667C195.134 490.667 139.788 467.179 98.0443 429.039L256 271.083L413.956 429.039C372.212 467.178 316.866 490.667 256 490.667ZM429.039 413.956L271.083 256L429.039 98.0443C467.178 139.788 490.667 195.134 490.667 256C490.667 316.866 467.178 372.212 429.039 413.956Z" fill="black"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="d-flex ml-5">
                                        <div class="mx-5 d-flex justify-flex-end">
                                            <svg width="25px" viewBox="0 0 513 340" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M490.88 8.59261C492.047 2.79061 497.943 -0.979393 503.422 0.228608C509.214 1.38461 512.964 6.99961 511.795 12.7796L452.941 307.033C448.962 326.907 431.358 341.333 411.108 341.333H100.9C80.6498 341.333 63.0458 326.907 59.0668 307.033L0.212805 12.7796C-0.954195 6.99861 2.79581 1.38461 8.58781 0.228608C14.0668 -0.990394 19.9628 2.79061 21.1298 8.59261L35.8008 81.9476C42.0578 78.7566 46.9918 73.6336 52.6498 67.4746C62.7748 56.4236 75.3788 42.6846 99.6498 42.6846C123.921 42.6846 136.546 56.4336 146.671 67.4746C155.838 77.4636 163.088 85.3486 177.963 85.3486C192.81 85.3486 200.039 77.4712 209.2 67.489L209.213 67.4746C219.318 56.4336 231.922 42.6846 256.151 42.6846C280.401 42.6846 293.005 56.4346 303.13 67.4856L303.161 67.5197C312.291 77.4826 319.501 85.3496 334.338 85.3496C349.172 85.3496 356.401 77.4646 365.526 67.4856L365.542 67.4681C375.664 56.4191 388.247 42.6846 412.484 42.6846C436.734 42.6846 449.338 56.4346 459.463 67.4856C465.091 73.6266 470.002 78.7296 476.213 81.9206L490.88 8.59261ZM411.109 320.002C421.234 320.002 430.026 312.784 432.026 302.847L471.943 103.273C459.399 98.6256 451.084 89.9266 443.735 81.8896L443.722 81.8752C434.561 71.893 427.332 64.0156 412.485 64.0156C397.643 64.0156 390.434 71.8884 381.298 81.8664L381.277 81.8896L381.247 81.9229C371.127 92.9582 358.544 106.68 334.339 106.68C310.109 106.68 297.505 92.9306 287.401 81.8896L287.388 81.8752C278.227 71.893 270.998 64.0156 256.151 64.0156C241.316 64.0156 234.107 71.8807 224.978 81.8418L224.943 81.8796C214.818 92.9316 202.214 106.681 177.964 106.681C153.714 106.681 141.089 92.9416 130.964 81.9006C121.797 71.9116 114.547 64.0166 99.6508 64.0166C84.7758 64.0166 77.5258 71.9016 68.3588 81.8906C60.9868 89.9276 52.6548 98.6326 40.0688 103.28L79.9838 302.847C81.9838 312.784 90.7758 320.002 100.901 320.002H411.109ZM277.338 170.667C277.338 182.449 267.787 192 256.005 192C244.223 192 234.672 182.449 234.672 170.667C234.672 158.885 244.223 149.334 256.005 149.334C267.787 149.334 277.338 158.885 277.338 170.667Z" fill="black"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 颜色 -->
                <?php
                if(!empty($item['option']->color)):
                ?>
                <div id="color-product" class="py-5 my-5">
                    <h2 class="text-center">DISEÑOS DE COLORES</h2>
                    <div class="my-5 py-5 d-flex flex-column justify-center container">
                        <div class="color-index">
                            <?php
                            foreach($item['option']->color as $value):
                            ?>
                            <div>
                                <div class="color" style="background-color:<?=$value?>"></div>
                                <div class="my-5"><?=$value?></div>
                            </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                        <div class="my-5 py-5 container">
                            <img src="<?=$item['image']->color_img?>" alt="<?=$item['name']?> - Diseños de Colores - LEE LIM" class="w-10">
                        </div>
                    </div>
                </div>
                <?php
                endif;
                ?>
                <!-- size大小尺寸 -->
                <div id="size-product" class="py-5 my-5">
                    <h2 class="text-center">TALLA</h2>
                    <div class="container py-5 my-5">
                        <div class="my-5 py-5 container">
                            <img src="<?=$item['image']->size_img?>" alt="<?=$item['name']?> - Guia de Talla - LEE LIM" class="w-10">
                        </div>
                    </div>
                </div>
                <!-- 相似 -->
                <div id="related-product" class="py-5 d-flex flex-column align-items-center container">
                    <h2 class="my-5">RELACIONADOS</h2>
                    <div class="item-product-grid my-5 w-10">
                        <main>
                        <?php
                        //GET RESULTS
                        $related_item = $mvc->get_related_item($item['id']);
                        foreach ($related_item as $key => $value):
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
            </section>
        </div>
    </main>
    <?php
    $mvc->include_modules('component/footer');
    ?>
    <section id="load-content-section" class="justify-center align-items-center">
        <div class="loader-spin"></div>
    </section>
    <section id="added-item-to-cart" class="po-fixed">
        <!-- INLINE CART -->
        <div class="p-5">
            <header class="close mb-5 d-flex justify-space-between align-items-flex-end">
                <a href="javascript:"><ion-icon name="close-outline" role="img" class="md hydrated" aria-label="close outline"></ion-icon></a>
                <span>Carrito</span>
            </header>
            <main id="cart">
                <!-- 购物车 -->
                
            </main>
            <footer class="p-5">
                <a href="/carrito/" class="btn btn-big">Ir Carrito</a>
            </footer>
        </div>
    </section>
    <script>
        const ITEM_JSON = {
            id: <?=$item['id']?>,
            id_code: "<?=$item['product_code']?>",
            name: "<?=$item['name']?>",
            image: "<?=$item['image']->cover_img?>",
            price: <?=$item['price']?>
        }
        const csrf_keycode = <?= $_SESSION['csrf_keycode'] ?>;
    </script>
    <!-- ICON IONICON 图标 -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <!-- COROUSOL SCROLLSLIDER -->
    <script src="/static/js/src/ScrollSlider.js"></script>
    <!-- HEADER SCRIPT -->
    <script src="/static/js/src/header.js"></script>
    <!-- ITEM SCRIPT -->
    <script src="/static/js/src/item.js"></script>
</body>
</html>