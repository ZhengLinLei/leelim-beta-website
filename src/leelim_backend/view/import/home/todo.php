<!-- CSS STYLE DATATABLE -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
<?php
$mvc = new MVCcontroller();
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tareas</h1>
    <p class="mb-4">Aqui puedes guardar las tareas pendientes que necesitas realizar.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Listado de Tareas</h6>
            <div>
                <button class="btn btn-primary mr-1" data-toggle="modal" data-target="#addModal">
                    <i class="fas fa-plus" title="Añadir"></i>
                </button>
                <button class="btn btn-dark" id="updateTableItem">
                    <i class="fas fa-edit" title="Modificar"></i>
                </button>
                <button class="btn btn-danger ml-3" id="deleteTableItem">
                    <i class="fas fa-trash" title="Eliminar"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="overflow-x:hidden">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout: fixed;">
                    <thead>
                        <tr>
                            <th class="all">Nombre</th>
                            <th class="min-tablet-l">Descripcion</th>
                            <th class="min-tablet-l">Estado</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($_SESSION['employer_account']['data']['todo_list'] as $key => $value):
                        ?>
                        <tr>
                            <td><?=$value->name?></td>
                            <td><?=$value->description?></td>
                            <td>
                                <div class="dropdown">
                                    <span class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-3"><?=($value->status)?'<i class="fas fa-check text-success"></i>':'<span class="text-danger">Pendiente</span>'?></span>
                                    </span>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" type="button" onclick="updateStatus(<?=$key?>, 1)">Completado <i class="fas fa-check text-success"></i></button>
                                        <button class="dropdown-item" type="button" onclick="updateStatus(<?=$key?>, 0)">No completado <i class="fas fa-times text-danger"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ADD ITEM- -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="AddItem" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddItem">Añadir tarea</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addItemForm">
                        <div class="form-group">
                            <label for="addName">Nombre</label>
                            <input type="email" class="form-control" id="addName" name="name" aria-describedby="emailHelp" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="addDescription">Descripción</label>
                            <textarea id="addDescription" cols="30" rows="10" name="description" class="form-control" placeholder="Descripcción"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    <a class="btn btn-primary" href="javascript:" id="addItemBtn">Añadir</a>
                </div>
            </div>
        </div>
    </div>
    <!-- UPDATE ITEM- -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="UpdateItem" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UpdateItem">Modificar tarea</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateItemForm">
                        <div class="form-group">
                            <label for="updateName">Nombre</label>
                            <input type="email" class="form-control" id="updateName" aria-describedby="emailHelp" name="name" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="updateDescription">Descripción</label>
                            <textarea id="updateDescription" cols="30" rows="10" class="form-control" placeholder="Descripcción" name="description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    <a class="btn btn-primary" href="javascript:" id="updateItemBtn">Modificar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ----NOT SELECTED---- -->
    <div class="modal fade" id="notSelect" tabindex="-1" role="dialog" aria-labelledby="notSelectLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notSelectLabel">Ninguna tarea seleccionada</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page level plugins -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js" defer></script>
<!-- RESPONSIVE -->
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js" defer></script>
<!-- SELECT -->
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js" defer></script>
<!-- Page level custom scripts -->
<script src="/static/js/src/todo.js" defer></script>