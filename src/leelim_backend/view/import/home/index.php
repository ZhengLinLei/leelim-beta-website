<?php
$mvc = new MVCcontroller();

if (!isset($_SESSION['season'])) {
    $_SESSION['season']['tag'] = $mvc->get_season_tag();
}
//EARNING GET IN 30 MIN
if (!isset($_SESSION['earning']) || (isset($_SESSION['earning']) && (time() - $_SESSION['earning']['date']) > 10)) {
    $_SESSION['earning'] = [];
    //DATE
    $_SESSION['earning']['date'] = time();
    //MONTH
    $month = $mvc->get_earning_month();
    $year = $mvc->get_earning_year();
    $day = $mvc->get_earning_day();

    $_SESSION['earning']['data']['month'] = ((empty($month)) ? 0 : $month[0]['sum']);
    $_SESSION['earning']['data']['year'] = ((empty($year)) ? 0 : $year[0]['sum']);
    $_SESSION['earning']['data']['day'] = ((empty($day)) ? 0 : $day[0]['sum']);
    //PER MONTH
    $_SESSION['earning']['data']['per_month'] = $mvc->get_earning_per_month_annual(date('Y', time()));
}
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">General</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <?php
        if ($_SESSION['employer_account']['role']['analytic']) :
        ?>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <a href="/analytic/?type=earning" class="card-body" style="text-decoration:none;">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Entradas (Mensual)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">€ <?= number_format($_SESSION['earning']['data']['month'], 2) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <a href="/analytic/?type=earning" class="card-body" style="text-decoration:none;">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Entradas (Anual)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">€ <?= number_format($_SESSION['earning']['data']['year'], 2) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php
        endif;
        ?>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <a href="/todo/" class="card-body" style="text-decoration:none;">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tareas realizadas</div>
                            <div class="row no-gutters align-items-center">
                                <?php
                                $pending_todo = count($mvc->get_peding_todo());
                                $all_todo = count($_SESSION['employer_account']['data']['todo_list']);
                                $per = ($all_todo == 0)?0:(($all_todo - $pending_todo) * 100) / $all_todo;
                                ?>
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $per ?>%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?= $per ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php
        if ($_SESSION['employer_account']['role']['order']) :
        ?>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <a class="card-body text-decoration-none" href="/pending_order/?type=pack">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pendientes Empaquetar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($mvc->get_pending_pack_order()) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <a class="card-body text-decoration-none" href="/pending_order/?type=send">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pendientes Enviar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($mvc->get_pending_send_order()) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shipping-fast fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php
        endif;
        ?>
        <?php
        if ($_SESSION['employer_account']['role']['email']) :
        ?>
            <!-- Pending Email Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <a class="card-body text-decoration-none" href="/email/">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pendientes Correos</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $_SESSION['email_message_unseen']['count'] ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php
        endif;
        ?>
    </div>
    <!-- Content Row -->
    <div class="row">
        <?php
        if ($_SESSION['employer_account']['role']['analytic']) :
        ?>
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafica de entradas en el año <?=date('Y', time())?></h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Descargar:</div>
                            <a class="dropdown-item" href="javascript:downloadPDF()">PDF</a>
                            <a class="dropdown-item" href="javascript:downloadImage()">Image</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">SQL</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <?php
        endif;
        ?>
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Analisis de tareas</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Acciones:</div>
                            <a class="dropdown-item" href="/todo/">Abrir tareas</a>
                            <a class="dropdown-item" href="/todo/#addItem">Añadir</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">PDF</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="todoPie"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Completadas
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-dark"></i> No completadas
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">
        <?php
        if ($_SESSION['employer_account']['role']['asset']) :
        ?>
        <!-- Content Column -->
        <div class="col-lg-6 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Misiones Generales</h6>
                </div>
                <div class="card-body">
                    <?php 
                    $month = 10000;
                    $year = 120000;
                    //
                    $month_per = ($_SESSION['earning']['data']['month']*100)/$month;
                    $year_per = ($_SESSION['earning']['data']['year']*100)/$year;
                    ?>
                    <h4 class="small font-weight-bold">Entradas mensuales: € <?= number_format($month)?> <span class="float-right"><?= number_format($month_per,2)?>%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?=$month_per?>%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Entradas anuales: € <?= number_format($year)?> <span class="float-right"><?= number_format($year_per,2)?>%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: <?=$year_per?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        endif;
        ?>

        <div class="col-lg-6 mb-4">
            <!-- Illustrations -->
            <?php
            if ($_SESSION['employer_account']['role']['product']) :
            ?>
            <div class="card shadow mb-4" id="season-tag">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Season tag</h6>
                </div>
                <div class="card-body">
                    <div class=" d-flex flex-wrap align-items-center">
                        <style>
                            .season-tag {
                                margin: 5px;
                                background-color: #f5f5f5;
                                border-radius: 100px;
                                padding: 5px 10px;
                            }
                        </style>
                        <?php
                        foreach ($_SESSION['season']['tag'] as $key => $value) :
                        ?>
                            <div class="season-tag"><?= $value['name'] ?></div>
                        <?php
                        endforeach;
                        ?>
                        <a href="/season/?type=tag" class="mx-2">más...</a>
                    </div>
                </div>
            </div>
            <?php
            endif;
            ?>
            <!-- Approach -->
            <?php
            if ($_SESSION['employer_account']['role']['analytic']) :
            ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Productos mejores vendidos</h6>
                </div>
                <div class="card-body">
                    <table class="w-100">
                        <thead class="border-bottom">
                            <tr>
                                <th style="width: 100px" class="text-center">Puesto</th>
                                <th class="w-100 text-center">Producto</th>
                                <th class="w-100 text-center">Compras</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $best_product = $mvc->get_best_product();
                            foreach ($best_product as $key => $value) :
                            ?>
                                <tr class="border-bottom">
                                    <td class="text-center"><?php if ($key == 0) : ?><i class="fas fa-crown  text-warning mx-5"></i><?php endif; ?><?= $key + 1 ?></td>
                                    <td class="text-center py-4"><a href="https://leelim.es/producto/<?= str_replace(' ', '-', $value['name']) ?>/<?= $value['product_code'] ?>/"><?= $value['product_code'] ?></a></td>
                                    <td class="text-center"><?= $value['order_times'] ?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>
<!-- JS PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<!-- CHART.JS -->
<script src="/static/js/min/Chart.min.js"></script>
<!-- TODOPIE -->
<script defer>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Raleway', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';
    // Pie Chart Example
    var ctx = document.getElementById("todoPie");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Completado", "No completado"],
            datasets: [{
                data: [<?= $per ?>, <?= 100 - $per ?>],
                backgroundColor: ['#1cc88a', '#5a5c69'],
                hoverBackgroundColor: ['#17a673', '#32333a'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
    //AREA
    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
    <?php
    if ($_SESSION['employer_account']['role']['analytic']){
        $array_sum = array_fill(1, 12, 0);

        foreach ($_SESSION['earning']['data']['per_month'] as $key => $value) {
            $array_sum[intval($value['month'])] = $value['sum'];
        }
    ?>
    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Ene", "Feb.", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
            datasets: [{
                label: "Entradas",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [<?=implode(',', $array_sum)?>],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return '€ ' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': € ' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
    <?php
    }
    ?>
</script>
<script>
    //PDF EXPORT
    //donwload pdf from original canvas
    function downloadPDF() {
        var canvas = document.querySelector('#myAreaChart');
        //creates image
        var canvasImg = myLineChart.toBase64Image();
        
        //creates PDF from img
        var doc = new jsPDF('landscape', 'px', [canvas.width, canvas.height]);
        doc.addImage(canvasImg, 'PNG', 100, 40);
        doc.save('entradas_<?=date('Y', time())?>_LEELIM.pdf');
    }
    function downloadImage(){
        var a = document.createElement('a');
        a.href = myLineChart.toBase64Image();
        a.download = 'entradas_<?=date('Y', time())?>_LEELIM.png';

        // Trigger the download
        a.click();
    }
</script>