<?php
$mvc = new MVCcontroller();
//NOT ALLOWED
if(!$_SESSION['employer_account']['role']['contact']){
    $mvc->include_modules('error/403');
}else{
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Entradas de mensajes de contacto</h1>
    <p class="mb-4">Responde los mensajes enviados desde la web</p>
    <div class="my-5 py-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Mensajes sin responder</h6>
                <div>
                    <a href="javascript:" id="answer" class="btn btn-success rounded-pill">Responder</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="overflow-x:hidden">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th class="all" style="max-width:80px;">ID</th>
                                <th class="all">Nombre</th>
                                <th class="desktop">Contacto</th>
                                <th class="desktop">Contenido</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Contacto</th>
                                <th>Contenido</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $mvc = new MVCcontroller();
                            $list = $mvc->get_all_contact_data();
                            foreach ($list as $key => $value):
                            ?>
                            <tr>
                                <td><?=$value['id']?></td>
                                <td><?=$value['name']?></td>
                                <td>
                                    <p class="small"><i class="fas fa-envelope"></i> : <a href="mailto:<?=$value['email']?>" class="small"><?=$value['email']?></a></p>
                                    <p class="small"><i class="fas fa-phone"></i> : <a href="tel:+34 <?=$value['phone_number']?>" class="small">+34 <?=$value['phone_number']?></a></p>
                                </td>
                                <td>
                                    <h5><?=$value['title']?></h5>
                                    <p class="small"><?=$value['content']?></p>
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
    </div>
    <!-- ADD ITEM- -->
    <div class="modal fade" id="answerModal" tabindex="-1" role="dialog" aria-labelledby="AddItem" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddItem">Responder mensaje</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-5 bg-light mb-5 ">
                        <div id="name-user" class="mb-5"></div>
                        <div id="contact-user"></div>
                    </div>
                    <form id="answerItemForm" method="POST" action="/">
                        <div class="form-group">
                            <label for="to">Respondido via</label>
                            <select name="answer" id="answerd-form" class="form-control">
                                <option value="email">E-mail</option>
                                <option value="tel">Phone number</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                            <button class="btn btn-primary" id="answerItemBtn" type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ----NOT SELECTED---- -->
    <div class="modal fade" id="notSelect" tabindex="-1" role="dialog" aria-labelledby="notSelectLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notSelectLabel">Ningun mensaje seleccionada</h5>
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
<script src="/static/js/src/contact.js" defer></script>
<?php
}
?>