<?php
$mvc = new MVCcontroller();
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Perfil</h1>
    <p class="mb-4">Datos de su cuenta.</p>

    <div class="row">
        <div class="card shadow mb-4 col-12 col-md-5 mx-3 px-0" style="height:fit-content;">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Datos Empleado</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <div>
                        <p>
                            <b>Nombre: </b><span><?=$_SESSION['employer_account']['data']['name']?></span>
                        </p>
                        <p>
                            <b>Apellido: </b><span><?=$_SESSION['employer_account']['data']['surname']?></span>
                        </p>
                        <p>
                            <b>ID Empleado: </b><span class="p-1 bg-light"><?=$_SESSION['employer_account']['data']['id_employer']?></span>
                        </p>
                        <p>
                            <b>Contraseña: </b><span class="p-1 bg-light">* * * * * * * *</span> <a href="/setting/">Cambiar</a>
                        </p>
                        <hr>
                        <p>
                            <b>Correo: </b><span><?=$_SESSION['employer_account']['data']['email']?></span>
                        </p>
                        <p>
                            <b>Role: </b><span><?=$_SESSION['employer_account']['data']['role']?></span>
                        </p>
                        <p>
                            <b>Puesto: </b><span><?=$_SESSION['employer_account']['data']['range']?></span>
                        </p>
                        <hr>
                        <p>
                            <b>Fecha de unión: </b><span><?=$_SESSION['employer_account']['data']['date_join_us']?></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4 col-12 col-md-5 mx-3 px-0" style="height:fit-content;">
            <!-- Card Header - Accordion -->
            <a href="#collapseCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCard">
                <h6 class="m-0 font-weight-bold text-primary">Datos Empresa</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCard">
                <div class="card-body">
                    <div>
                        <p>
                            <b>Nombre: </b><span>LEE LIM</span>
                        </p>
                        <hr>
                        <p>
                            <b>Telefono: </b><span>+34 </span>
                        </p>
                        <p>
                            <b>Email: </b><span>info@gmail.com</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>