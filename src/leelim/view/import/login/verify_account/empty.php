<main class="container py-5">
    <header class="d-flex align-items-center flex-column my-5">
        <h2 class="text-center">Hemos enviado un correo a:</h2>
        <div class="my-5 p-3 email">
            <code><i><?= $_GET['to'] ?></i></code>
        </div>
        <div class="my-5 w-7 text-center">
            <p>Por favor revise su bandeja del correo y verifique su cuenta</p>
        </div>
    </header>
    <main class="my-5 py-5">
        <div class="d-flex justify-center py-5 my-5">
            <a href="/cuenta/login/" class="btn btn-big">
                <ion-icon name="arrow-back-outline"></ion-icon>
                <span class="ml-2">Volver</span>
            </a>
        </div>
    </main>
</main>