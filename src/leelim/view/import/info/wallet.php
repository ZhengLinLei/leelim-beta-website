<main class="my-5 container">
    <div class="d-flex flex-column align-items-center">
        <header class="py-5">
            <div class="text-center">
                <h1>Monedero de LEE LIM</h1>
            </div>
        </header>
        <main id="body" class="container my-5 py-5 doc">
            <section class="des">
                <div>
                    <div>
                        <p>Los reembolsos se le devolveran mediante monedero donde podra disfrutar en hacer pagos con dichos fondos en cualquier de nuestras tiendas y web, para acceder a este apartado necesita entrar a su cuenta > monedero y le aparecerá si es nuevo un € 0.00 y si ya le reembolsaron podra ver el dinero reembolsado incluso puede entrar en el historial para ver toda las transacciones que se hicieron.</p>
                    </div>
                </div>
            </section>
            <!-- INLINE STYLE -->
            <main class="my-5 py-5" id="wallet-main">
                <div class="d-flex align-items-center flex-column my-5 py-5">
                    <div id="number">€ <span id="money">0.00</span></div>
                </div>
            </main>
            <section>
                <div>
                    <h2>Moneda</h2>
                    <div>
                        <p>La moneda en que circulara este monedero serán en € euros. Por lo que todo los reembolsos se realizaran en euros.</p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</main>
<script>
    let money = document.querySelector('#number #money');
    document.addEventListener('scroll', e =>{
        let text = window.scrollY.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        money.innerHTML = text;
    });
</script>