<?php
$mvc = new MVCcontroller();
?>
<!-- Content Row -->
<div class="row">
    <!--  -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cuentas totales</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mvc->get_total_user_account()[0]['sum'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cuentas no verificadas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mvc->get_total_not_verified_user_account()[0]['sum'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-ninja fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body text-decoration-none">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Recuperando Contraseña</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mvc->get_total_not_recovery_user_account()[0]['sum'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-lock-open fa-2x text-gray-300"></i>
                    </div>
                </div>
</div>
        </div>
    </div>
</div>
<!-- JS PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<!-- CHART.JS -->
<script src="/static/js/min/Chart.min.js"></script>
<script>

</script>
<script>
    //PDF EXPORT
    //donwload pdf from original canvas
    function downloadPDF(type) {
        var canvas = document.querySelector('#myAreaChart' + type);
        //creates image
        var canvasImg = myLineChart.toBase64Image();

        //creates PDF from img
        var doc = new jsPDF('landscape', 'px', [canvas.width, canvas.height]);
        doc.addImage(canvasImg, 'PNG', 100, 40);
        doc.save('entradas_<?= date('Y', time()) ?>_LEELIM.pdf');
    }

    function downloadImage(type) {
        var a = document.createElement('a');
        a.href = myLineChart[type].toBase64Image();
        a.download = 'entradas_<?= date('Y', time()) ?>_LEELIM.png';

        // Trigger the download
        a.click();
    }
</script>