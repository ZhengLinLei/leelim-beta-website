<?php
$mvc = new MVCcontroller();
//ORDER GET IN 30 MIN
if (!isset($_SESSION['order']) || (isset($_SESSION['order']) && (time() - $_SESSION['order']['date']) > 10)) {
    $_SESSION['order'] = [];
    //DATE
    $_SESSION['order']['date'] = time();
    //MONTH
    $month = $mvc->get_order_month();
    $year = $mvc->get_order_year();
    $day = $mvc->get_order_day();

    $_SESSION['order']['data']['month'] = ((empty($month)) ? 0 : $month[0]['sum']);
    $_SESSION['order']['data']['year'] = ((empty($year)) ? 0 : $year[0]['sum']);
    $_SESSION['order']['data']['day'] = ((empty($day)) ? 0 : $day[0]['sum']);
    //PER MONTH
    $_SESSION['order']['data']['per_month'] = $mvc->get_order_per_month_annual(date('Y', time()));
}
?>
<!-- Content Row -->
<div class="row justify-content-center">
    <!-- Area Chart -->
    <div class="col-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Grafica de pedidos en el año <?= date('Y', time()) ?></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLinkY" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLinkY">
                        <div class="dropdown-header">Descargar:</div>
                        <a class="dropdown-item" href="javascript:downloadPDF('Year')">PDF</a>
                        <a class="dropdown-item" href="javascript:downloadImage('Year')">Image</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">SQL</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChartYear"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Grafica de pedidos de este mes</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLinkM" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLinkM">
                        <div class="dropdown-header">Descargar:</div>
                        <a class="dropdown-item" href="javascript:downloadPDF('Month')">PDF</a>
                        <a class="dropdown-item" href="javascript:downloadImage('Month')">Image</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">SQL</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChartMonth"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<!-- Content Row -->
<div class="row">
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
</div>
<hr>
<!-- Content Row -->
<div class="row">
    <div class="col-12 mb-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Grafica de pedidos de hoy</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLinkD" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLinkD">
                        <div class="dropdown-header">Descargar:</div>
                        <a class="dropdown-item" href="javascript:downloadPDF('Day')">PDF</a>
                        <a class="dropdown-item" href="javascript:downloadImage('Day')">Image</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">SQL</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChartDay"></canvas>
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
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Raleway', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';
    //AREA
    <?php
    $array_sum = array_fill(1, 12, 0);

    foreach ($_SESSION['order']['data']['per_month'] as $key => $value) {
        $array_sum[intval($value['month'])] = $value['sum'];
    }
    ?>
    var myLineChart = {};
    // Area Chart Example
    var ctxY = document.getElementById("myAreaChartYear");
    myLineChart['Year'] = new Chart(ctxY, {
        type: 'line',
        data: {
            labels: ["Ene", "Feb.", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
            datasets: [{
                label: "Pedidos",
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
                data: [<?= implode(',', $array_sum) ?>],
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
                            // return number_format(value);
                            if (Math.floor(value) === value) {
                                return value;
                            }
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
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
    <?php
    function UltimoDia($anho, $mes)
    {
        if (((fmod($anho, 4) == 0) and (fmod($anho, 100) != 0)) or (fmod($anho, 400) == 0)) {
            $dias_febrero = 29;
        } else {
            $dias_febrero = 28;
        }
        switch ($mes) {
            case '01':
                return 31;
                break;
            case '02':
                return $dias_febrero;
                break;
            case '03':
                return 31;
                break;
            case '04':
                return 30;
                break;
            case '05':
                return 31;
                break;
            case '06':
                return 30;
                break;
            case '07':
                return 31;
                break;
            case '08':
                return 31;
                break;
            case '09':
                return 30;
                break;
            case '10':
                return 31;
                break;
            case '11':
                return 30;
                break;
            case '12':
                return 31;
                break;
        }
    }
    //==========
    //EARNING GET IN 30 MIN
    if (!isset($_SESSION['order']['data']['per_day']) || (isset($_SESSION['order']['data']['per_day']) && (time() - $_SESSION['order']['date']) > 1800)) {
        //PER DAY
        $_SESSION['order']['data']['per_day'] = $mvc->get_order_per_day_mensual(date('m', time()), date('Y', time()),);
    }
    //==========
    $day = range(1, UltimoDia(date('Y', time()), date('m', time())));

    $array_sum = array_fill(1, 31, 0);
    foreach ($_SESSION['order']['data']['per_day'] as $key => $value) {
        $array_sum[intval($value['day'])] = $value['sum'];
    }
    ?>
    var ctxM = document.getElementById("myAreaChartMonth");
    myLineChart['Month'] = new Chart(ctxM, {
        type: 'line',
        data: {
            labels: ["<?= implode('","', $day) ?>"],
            datasets: [{
                label: "Pedidos",
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
                data: [<?= implode(',', $array_sum) ?>],
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
                        maxTicksLimit: 20
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            // return number_format(value);
                            if (Math.floor(value) === value) {
                                return value;
                            }
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
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
    //========
    //DAY
    <?php
    //==========
    //EARNING GET IN 30 MIN
    if (!isset($_SESSION['order']['data']['per_hour']) || (isset($_SESSION['order']['data']['per_hour']) && (time() - $_SESSION['order']['date']) > 1800)) {
        //PER DAY
        $_SESSION['order']['data']['per_hour'] = $mvc->get_order_per_hour_daily(date('d', time()), date('m', time()), date('Y', time()),);
    }
    //==========
    $hour = range(0, 24);
    $array_sum = array_fill(0, 25, 0);
    foreach ($_SESSION['order']['data']['per_hour'] as $key => $value) {
        $array_sum[intval($value['hour'])] = $value['sum'];
    }
    ?>
    var ctxM = document.getElementById("myAreaChartDay");
    myLineChart['Day'] = new Chart(ctxM, {
        type: 'line',
        data: {
            labels: ["<?= implode('","', $hour) ?>"],
            datasets: [{
                label: "Pedidos",
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
                data: [<?= implode(',', $array_sum) ?>],
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
                        maxTicksLimit: 20
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        beginAtZero: true,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            // return number_format(value);
                            if (Math.floor(value) === value) {
                                return value;
                            }
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
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
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
        doc.save('pedidos_<?= date('Y', time()) ?>_LEELIM.pdf');
    }

    function downloadImage(type) {
        var a = document.createElement('a');
        a.href = myLineChart[type].toBase64Image();
        a.download = 'pedidos_<?= date('Y', time()) ?>_LEELIM.png';

        // Trigger the download
        a.click();
    }
</script>