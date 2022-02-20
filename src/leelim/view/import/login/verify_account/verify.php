<main class="container py-5">
    <header class="d-flex align-items-center flex-column my-5">
        <h2 class="text-center" id="server-response">Espere un momento...</h2>
    </header>
    <main class="my-5 py-5">
        <div class="d-flex justify-center py-5 my-5">
            <a href="/cuenta/" class="btn btn-big">
                <ion-icon name="arrow-back-outline"></ion-icon>
                <span class="ml-2">Volver</span>
            </a>
        </div>
    </main>
</main>
<script>
    const bodyReq = `d=<?= $_GET['d']?>&c=<?= $_GET['c'] ?>&keycode=<?= $_SESSION['csrf_keycode']?>`;
</script>
<script src="/static/js/src/login_verify_account.js"></script>