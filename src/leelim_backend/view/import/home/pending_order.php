<?php
$mvc = new MVCcontroller();
//NOT ALLOWED
if(!$_SESSION['employer_account']['role']['order'] && !$_SESSION['employer_account']['role']['shipping']){
    $mvc->include_modules('error/403');
}else{
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pedidos Pendientes</h1>
    <?php
    if(!isset($_GET['type'])){
        $mvc->include_modules('home/pending_order/empty');
    }else{
        if(($_GET['type'] == 'pack' && !$_SESSION['employer_account']['role']['order']) || ($_GET['type'] == 'send' && !$_SESSION['employer_account']['role']['shipping'])){
            $mvc->include_modules('error/403');
        }else{
            $key = ['pack', 'send'];
            if(!in_array($_GET['type'], $key)){
                $mvc->include_modules('error/404');
            }else{
                $mvc->include_modules('home/pending_order/'.$_GET['type']);
            }
        }
    }
    ?>
</div>
<!-- Page level plugins -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js" defer></script>
<!-- RESPONSIVE -->
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js" defer></script>
<!-- SELECT -->
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js" defer></script>
<script src="/static/js/src/pending_order.js" defer></script>
<?php
}
?>