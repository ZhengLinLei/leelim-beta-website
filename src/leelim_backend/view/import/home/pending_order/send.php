<p class="mb-4">Pedidos pendientes de <b>Enviar</b></p>

<div class="my-5 py-5">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Pendientes de enviar</h6>
            <div>
                <button class="btn btn-success mr-1" id="packedBoxBtn">
                    <i class="fas fa-check" title="Complet"></i>
                    <span>Enviado</span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="overflow-x:hidden">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout: fixed;">
                    <thead>
                        <tr>
                            <th width="30px" class="min-tablet-l">ID</th>
                            <th class="all">Pedido</th>
                            <th class="min-tablet-l">Detalles</th>
                            <td class="min-tablet-l">Fecha</td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Pedido</th>
                            <th>Detalles</th>
                            <td>Fecha</td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $mvc = new MVCcontroller();
                        $list = $mvc->get_pending_send_order();
                        foreach ($list as $key => $value) :
                        ?>
                            <tr>
                                <td><?= $value['id'] ?></td>
                                <td><a href="/order/?s=<?= $value['order_code'] ?>" target="_blanck"><?= $value['order_code'] ?></a></td>
                                <td><?= $value['order_details'] ?></td>
                                <td><?= $value['date_create'] ?></td>
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
<div class="modal fade" id="packedBox" tabindex="-1" role="dialog" aria-labelledby="AddItem" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddItem">Completar Envio del Pedido</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Si terminastes de empaquetar el pedido puede Aceptar</p>
                <div>
                    Pedido:
                    <p id="order_code_form" class="b"></p>
                </div>
                <input type="text" id="shipping_code_form" class="form-control" placeholder="Codigo de Envio">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                <a class="btn btn-primary" href="javascript:" id="packedBoxFormBtn">Aceptar</a>
            </div>
        </div>
    </div>
</div>
<!-- ----NOT SELECTED---- -->
<div class="modal fade" id="notSelect" tabindex="-1" role="dialog" aria-labelledby="notSelectLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notSelectLabel">Ningun pedido seleccionada</h5>
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
<script>
const PATH = 'send';
</script>