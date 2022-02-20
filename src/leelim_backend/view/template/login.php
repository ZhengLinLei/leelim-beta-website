<?php
$mvc = new MVCcontroller();
if($mvc->isset_account_session()){
    header("Location: /");

    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Empleado Inicio de Sesión - LEE LIM Backend</title>
    <!-- SEO meta tag -->
    <meta name="description" content="">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
    <meta name="author" content="ZLL">
    <link rel="shortcut icon" href="/static/img/logo/leelim.png" type="image/png">
    <!-- SEO Helpers -->
    <link rel="canonical" href="https://leelim.es/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- RESOURCE, CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="/static/css/global.css" rel="stylesheet">
    <link href="/static/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-light screen d-flex align-items-center container">
    <section id="load-content-section" class="justify-content-center align-items-center">
        <div class="loader-spin"></div>
    </section>
    <!-- ---- -->
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="w-100" style="max-width:400px;">
                <div class="card o-hidden border-0 shadow-xs my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <header class="py-5">
                                            <section class="d-flex flex-column align-items-center">
                                                <a href="/" id="logo-svg-image-a">
                                                    <svg viewBox="0 0 304 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0.759766 52.0009V0.880859H8.82377V44.8729H36.2558V52.0009H0.759766ZM85.0707 44.8729V52.0009H50.0067V0.880859H84.4227V8.00886H58.0707V22.5529H80.8947V29.2489H58.0707V44.8729H85.0707ZM135.654 44.8729V52.0009H100.59V0.880859H135.006V8.00886H108.654V22.5529H131.478V29.2489H108.654V44.8729H135.654ZM176.162 52.0009V0.880859H184.226V44.8729H211.658V52.0009H176.162ZM225.408 52.0009V0.880859H233.472V52.0009H225.408ZM295.21 52.0009V15.5689L280.162 43.2169H275.41L260.29 15.5689V52.0009H252.226V0.880859H260.866L277.786 32.1289L294.706 0.880859H303.346V52.0009H295.21Z" fill="black"/>
                                                    </svg>
                                                </a>
                                            </section>
                                        </header>
                                    </div>
                                    <form id="login-form" class="form needs-validation user" action="/" method="post">
                                        <input type="text" name="keycode" class="d-none" value="<?= $_SESSION['csrf_keycode_backend']?>" style="display:none">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="id_employer" aria-describedby="CODE" name="id_employer"
                                                placeholder="ID empleado ES-xxx-xxx-xxx" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Contraseña" required>
                                        </div>
                                    <div class="server-response my-5 d-none small text-danger text-center"></div>
                                        <div class="form-group mt-5">
                                            <button type="submit" class="btn btn-dark btn-user btn-block">
                                                <span class="mr-3">Entrar</span>
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- Core plugin JavaScript-->
    <!-- Custom scripts for all pages-->
    <script src="/static/js/src/login.js"></script>
    <script src="/static/js/min/sb-admin-2.min.js"></script>
</body>
</html>