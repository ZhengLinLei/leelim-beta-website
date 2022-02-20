<!-- CSS STYLE DATATABLE -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
<?php
$mvc = new MVCcontroller();
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Galeria</h1>
    <p class="mb-4">Añade y visualiza los tag de las galerias</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tag</h6>
            <div>
                <button class="btn btn-primary mr-1" data-toggle="modal" data-target="#addModal">
                    <i class="fas fa-plus" title="Añadir"></i>
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
                            <th class="min-tablet-l" style="width:100px;">ID</th>
                            <th class="all">Nombre</th>
                            <th class="min-tablet-l">Imagen portada</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Imagen portada</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($_SESSION['season']['tag'] as $key => $value) :
                        ?>
                            <tr>
                                <td><?= $value['id'] ?></td>
                                <td><?= $value['name'] ?></td>
                                <td><a href="https://leelim.test<?= $value['cover_img'] ?>"><?= $value['cover_img'] ?></a></td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- ADD ITEM- -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="AddItem" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddItem">Añadir Nueva sesion Galeria</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addItemForm">
                    <div class="form-group">
                        <label for="addName">Nombre</label>
                        <input type="text" class="form-control" id="addName" name="name" aria-describedby="emailHelp" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="addDescription">Imagen de Portada</label><br>
                        <input type="file" id="file-form" name="file" accept="image/*,.gif,.webp">
                        <div class="my-2">
                            <img id="blah" src="" class="w-75" alt="La imagen se mostrara aquí" />
                        </div>
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
<!-- ----NOT SELECTED---- -->
<div class="modal fade" id="notSelect" tabindex="-1" role="dialog" aria-labelledby="notSelectLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notSelectLabel">Ningun tag seleccionada</h5>
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
<!-- Page level plugins -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js" defer></script>
<!-- RESPONSIVE -->
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js" defer></script>
<!-- SELECT -->
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js" defer></script>
<script src="/static/js/src/season_tag.js" defer></script>