<?php
$mvc = new MVCcontroller();
//NOT ALLOWED
if(!$_SESSION['employer_account']['role']['tools'] || !$_SESSION['employer_account']['role']['payment']){
    $mvc->include_modules('error/403');
}else{
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Busqueda por Transacciones</h1>
    <p class="mb-4">Busca aquí información de los pagos: <a href="/payment/?type=paypal">PayPal</a> - <a href="/payment/?type=credit-card">Stripe</a> - <a href="/payment/?type=wallet">Monedero</a></p>
    <?php
    if(isset($_GET['type'])):
    ?>
    <div class="my-5 py-5">
        <form method="get" action="/payment/" class="row">
            <div class="input-group col-12 col-md-6">
                <input type="text" name="type" class="d-none" value="<?=$_GET['type']?>">
                <input type="text" class="form-control" placeholder="Codigo de la Transacción" name="s" aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <?php
    endif;
    ?>
    <!-- DataTales Example -->
    <?php
    if(!isset($_GET['type'])){
        $mvc->include_modules('home/tools_payment/empty');
    }else{
        $mvc->include_modules('home/tools_payment/'.$_GET['type']);
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
<?php
}
?>