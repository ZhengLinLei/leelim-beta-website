<?php
$mvc = new MVCcontroller();
//NOT ALLOWED
if(!$_SESSION['employer_account']['role']['product']){
    $mvc->include_modules('error/403');
}else{
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Entradas de email</h1>
    <p class="mt-4">Actual version no incorpora funciones IMAP para recibir mensajes, pero si se puede enviar correos.</p>
    <p class="mb-4">Para ver las entradas de los correos, acceda con algun cliente <span class="text-success b">seguros</span> ( <a href="https://www.thunderbird.net/">ThunderBird</a>, <a href="https://www.seamonkey-project.org/">SeaMonkey</a>, ... ) o use <a href="">WebMail</a>.</p>
    <div class="my-5">
        <a href="javascript;" class="btn btn-primary px-5 py-3 h1 rounded-pill" data-toggle="modal" data-target="#addModal">Redactar correo</a>
    </div>
    <div class="my-5 py-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Correos Globales</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="overflow-x:hidden">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th class="all">Email</th>
                                <th class="min-tablet-l">Nombre</th>
                                <th class="min-tablet-l">Descripción</th>
                                <td class="min-tablet-l">Contraseña</td>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Email</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <td>Contraseña</td>
                            </tr>
                        </tfoot>
                        <style>
                            .password:not(.hide) .show-password{
                                display: none;
                            }
                            .password.hide .hide-password{
                                display: none;
                            }
                            .icon-hide{
                                cursor: pointer;
                            }
                        </style>
                        <tbody>
                            <?php
                            $mvc = new MVCcontroller();
                            $list = $mvc->get_email_list();
                            foreach ($list as $key => $value):
                            ?>
                            <tr>
                                <td><?=$value['email']?></td>
                                <td><?=$value['name']?></td>
                                <td><?=$value['description']?></td>
                                <td>
                                    <div class="password">
                                        <span class="bg-light p-1 rounded">
                                            <span class="hide-password">* * * * * * * *</span>
                                            <span class="show-password"><?=$value['password']?></span>
                                        </span>
                                        <span class="ml-2 icon-hide" onclick="this.parentElement.classList.toggle('hide')">
                                            <span class="hide-password"><i class="fas fa-eye"></i></span>
                                            <span class="show-password"><i class="fas fa-eye-slash"></i></span>
                                        </span>
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
    </div>
    <!-- ADD ITEM- -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="AddItem" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddItem">Enviar correo</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addItemForm" method="POST" action="/">
                        <div class="form-group">
                            <label for="from">De</label>
                            <select name="from" id="from" class="form-control">
                                <?php
                                foreach ($list as $key => $value) {
                                ?>
                                <option value="<?=$value['email']?>"><?=$value['email']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fromName">Nombre</label>
                            <input type="text" class="form-control" id="fromName" name="fromName" aria-describedby="emailName" placeholder="Nombre del emisor" required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="to">Destinatario</label>
                            <input type="email" class="form-control" id="to" name="to" aria-describedby="emailName" placeholder="Para [email]" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Asunto</label>
                            <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailName" placeholder="Asunto" required>
                        </div>
                        <div class="form-group">
                            <label for="content_email">Contenido</label>
                            <textarea id="content_email" cols="30" rows="10" name="content" class="form-control" placeholder="Contenido del email (acepta HTML)" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                            <button class="btn btn-primary" id="addItemBtn" type="submit">Enviar</button>
                        </div>
                    </form>
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
<script src="/static/js/src/email.js" defer></script>
<?php
}
?>