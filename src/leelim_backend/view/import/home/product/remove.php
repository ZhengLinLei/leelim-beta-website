<!-- CSS STYLE DATATABLE -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
<?php
$mvc = new MVCcontroller();
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Mostrar productos</h1>
    <p class="mb-4">Visualiza y borra los productos</p>
    <div class="my-5 py-5">
        <form method="get" action="/product/" class="row">
            <div class="input-group col-12 col-md-6">
                <input type="text" name="type" class="d-none" value="<?=$_GET['type']?>">
                <input type="text" class="form-control" placeholder="Codigo del producto" name="s" aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="my-5">
            <p class="b">¿Como detectar el codigo?</p>
            <p>En la <code>URL</code> https://leelim.es/producto/xxxxxx-xxxx-xxxxxx/<span class="bg-warning">xxxxx</span>/. Lo de subrayado en amarillo es el codigo</p>
        </div>
    </div>
    <!-- DataTales Example -->
    <?php
    if(isset($_GET['s'])):
    ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tag</h6>
            <div>
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
                            <th class="all">Codigo</th>
                            <th class="min-tablet-l">Nombre</th>
                            <th class="min-tablet-l">Descripción</th>
                            <th class="min-tablet-l">Precio</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $list = $mvc->get_product_by_code($_GET['s']);
                        foreach ($list as $key => $value):
                        ?>
                        <tr>
                            <td><?=$value['id']?></td>
                            <td><?=$value['product_code']?></td>
                            <td><?=$value['name']?></td>
                            <td><?=$value['description']?></td>
                            <td>€ <?=number_format($value['price'], 2, '.', '')?></td>
                        </tr>
                        <?php
                        endforeach
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    endif;
    ?>
</div>
<!-- ----NOT SELECTED---- -->
<div class="modal fade" id="notSelect" tabindex="-1" role="dialog" aria-labelledby="notSelectLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notSelectLabel">Ningun producto seleccionada</h5>
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
<?php
if(isset($_GET['s'])):
?>
<script src="/static/js/src/product_remove.js" defer></script>
<?php
endif;
?>