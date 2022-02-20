<?php
$mvc = new MVCcontroller();
//NOT ALLOWED
if(!$_SESSION['employer_account']['role']['tools']){
    $mvc->include_modules('error/403');
}else{
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Compresión</h1>
    <p class="mb-4">Comprime las imagenes antes subirla para que la carga de la pagina no se relantice.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Herramienta</h6>
        </div>
        <div class="card-body">
            <section class="compress my-5">
                <h6>La actual version no incorpora compresion nativa, pero sin embargo puede acudir a herramientas externas, link abajo.</h6>
                <div class="mt-3 pointer">
                    <a href="https://tinypng.com/">TinyPNG</a> - <a href="https://tinyjpg.com/">TinyJPG</a> - <a href="https://www.iloveimg.com/es">iLoveIMG</a>
                </div>
            </section>
            <section class="tool my-5">
                <h6>Crear GIF</h6>
                <div class="mt-3">
                    <a href="https://picasion.com/es/">Picasion</a>
                </div>
            </section>
            <section class="editor my-5">
                <h5>Editor</h5>
                <div class="mt-3">
                    <a href="https://www.befunky.com/es/">Befunky</a>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- ADD ITEM- -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="AddItem" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddItem">Cambiar contraseña</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addItemForm">
                    <div class="form-group">
                        <label for="addName">Contraseña antigua</label>
                        <input type="text" class="form-control" id="old-password" name="old_password" aria-describedby="emailHelp" placeholder="Contraseña">
                    </div>
                    <div class="form-group">
                        <label for="addDescription">Contraseña nueva</label>
                        <input type="password" class="form-control" id="new-password" name="new_password" aria-describedby="emailHelp" placeholder="Nueva contraseña">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                <a class="btn btn-primary" href="javascript:" id="passwordChangeBtn">Cambiar</a>
            </div>
        </div>
    </div>
</div>
<?php
}
?>