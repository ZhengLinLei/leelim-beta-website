<link rel="stylesheet" href="/static/css/info_stockist.css">
<main class="my-5 container">
    <div class="d-flex flex-column align-items-center">
        <header class="py-5 w-8 distro">
            <div>
                <h3>Tenemos distribuciones en:</h3>
                <div class="my-5 py-5">
                    <div class="grid-distro">
                        <span>España</span>
                    </div>
                </div>
            </div>
        </header>
        <main class="my-5 doc" id="tiendas-fisicas">
            <header class="text-center">
                <h1>Busca su tienda fisica en España</h1>
            </header>
            <main class="my-5 py-5">
                <div class="container">
                    <section id="input" class="my-5">
                        <form action="/" method="get" id="search-shop">
                            <div id="input-group">
                                <input type="search" name="search" id="input-s" placeholder="Busqueda de tiendas cercanas">
                                <a href="javascript:" class="close"><ion-icon name="close-outline" role="img" class="md hydrated" aria-label="close outline"></ion-icon></a>
                                <button type="submit">
                                    <ion-icon name="search-outline" role="img" class="md hydrated" aria-label="search outline"></ion-icon>
                                </button>
                            </div>
                        </form>
                    </section>
                    <section>
                        <div id="result-search">
                            <!-- 数据 -->
                            <div class="total text-center my-5 text-muted">
                                <span>Introduzca ciudad o codigo postal</span>
                            </div>
                        </div>
                    </section>
                </div>
            </main>
        </main>
    </div>
</main>
<section id="load-content-section" class="justify-center align-items-center">
    <div class="loader-spin"></div>
</section>
<script>
    const CSRFkeycode = '<?= $_SESSION['csrf_keycode']?>';
</script>
<script src="/static/js/src/info_stockist.js"></script>
