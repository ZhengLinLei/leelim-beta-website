<?php
$mvc = new MVCcontroller();
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ajustes</h1>
    <p class="mb-4">Puede manejar los ajustes de su cuenta.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Ajustes</h6>
        </div>
        <div class="card-body">
            <section class="password">
                <h6>Cambio de Contraseña</h6>
                <div class="mt-3 pl-5 pointer">
                    <a class="mr-5" href="#" data-toggle="modal" data-target="#passwordModal">Cambiar</a>
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
<!-- Page level custom scripts -->
<script src="/static/js/src/setting.js" defer></script>