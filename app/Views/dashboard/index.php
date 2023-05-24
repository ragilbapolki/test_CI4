<?= $this->extend('layout/templates'); ?>

<?= $this->Section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb">
            <div class="row">
                <label for="name" class="col-sm- col-form-label">Date</label>&nbsp;
                <div class="input-group">
                    <input type="text" class="form-control" id="date" name="date" placeholder="type date here" title="Input Date">
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text" style="height: 38px"><i class="fa fa-calendar" style="height: 38px"></i>
                    </div>
                </div>
            </div>
            </ol>
            
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-1"></i>
                        Effectiveness
                        </h3>
                        <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                        </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                        <div class="chart tab-pane active" id="" style="position: relative; height: 300px;">
                            <canvas id="chart-bar" height="300" style="height: 300px;"></canvas>
                        </div>
                        </div>
                    </div>
                    </div>
                </section>
          
                <section class="col-lg-12 connectedSortable">
                    <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Status
                        </h3>
                        <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                        </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                        <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 300px;">
                            <canvas id="chart-donut" height="300" style="height: 300px;"></canvas>
                        </div>
                        </div>
                    </div>
                    </div>
                </section>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg" style="background-color: #bbd7fa;color: white;">
                    <div class="inner">
                        <h3 id='count_draft' class="p_1"> <?= number_format($count_draft[0]['id']); ?></h3>
                        <p>DRAFT</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" data-link="<?= number_format($count_draft[0]['id_stage']); ?>" class="small-box-footer btn-info">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg" style="background-color: #8ebefa;color: white;">
                    <div class="inner">
                        <h3 id='count_submitted' class="p_1"> <?= number_format($count_submitted[0]['id']); ?></h3>
                        <p>Submitted</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" data-link="<?= number_format($count_submitted[0]['id_stage']); ?>" class="small-box-footer btn-info">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg" style="background-color: #3c89e9;color: white;">
                    <div class="inner">
                        <h3 id='count_open' class="p_1"> <?= number_format($count_open[0]['id']); ?></h3>
                        <p>Open</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-box"></i>
                    </div>
                    <a href="#" data-link="<?= number_format($count_open[0]['id_stage']); ?>" class="small-box-footer btn-info">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg" style="background-color: #003f8f;color: white;">
                    <div class="inner">
                        <h3 id='count_responded' class="p_1"> <?= number_format($count_responded[0]['id']); ?></h3>
                        <p>Responded</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-social-dropbox"></i>
                    </div>
                    <a href="#" data-link="<?= number_format($count_responded[0]['id_stage']); ?>" class="small-box-footer btn-info">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg" style="background-color: #2ded94;color: white;">
                    <div class="inner">
                        <h3 id='count_verified' class="p_1"> <?= number_format($count_verified[0]['id']); ?></h3>
                        <p>Verified</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" data-link="<?= number_format($count_verified[0]['id_stage']); ?>" class="small-box-footer btn-info">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg" style="background-color: #02ad5e;color: white;">
                    <div class="inner">
                        <h3 id='count_closed' class="p_1"> <?= number_format($count_closed[0]['id']); ?></h3>
                        <p>Closed</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" data-link="<?= number_format($count_closed[0]['id_stage']); ?>" class="small-box-footer btn-info">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg" style="background-color: #e37907;color: white;">
                    <div class="inner">
                        <h3 id='count_reopen' class="p_1"> <?= number_format($count_reopen[0]['id']); ?></h3>
                        <p>Re-Open</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-box"></i>
                    </div>
                    <a href="#" data-link="<?= number_format($count_reopen[0]['id_stage']); ?>"class="small-box-footer btn-info">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg" style="background-color: #525252;color: white;">
                    <div class="inner">
                        <h3 id='count_voided' class="p_1"> <?= number_format($count_voided[0]['id']); ?></h3>
                        <p>Voided</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-social-dropbox"></i>
                    </div>
                    <a href="#" data-link="<?= number_format($count_voided[0]['id_stage']); ?>" class="small-box-footer btn-info">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Get Modal -->
    <div class="view-modal" style="display: none;"></div>

    <script type="text/javascript">
        // view output
        $(document).ready(function() {
            let start_date = null
            let end_date = null

            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';
            $('#date').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    format: 'DD-MM-YYYY',
                    cancelLabel: 'Clear'
                }
            });
            $('#date').on('apply.daterangepicker', function(ev, picker) {
                start_date= picker.startDate.format('YYYY-MM-DD')
                end_date = picker.endDate.format('YYYY-MM-DD')
                getDataDashboard(start_date, end_date)
                dataChartDonut(start_date, end_date)
                dataChartBar(start_date, end_date)
            });
            $(".btn-info").click(function() {
                let data = $(this).attr("data-link")
                console.log(data);
                $.ajax({
                    url: "<?= base_url('dashboard/get_modal_info') ?>",
                    data: { 
                        p_start_date: start_date,
                        p_end_date: end_date ,
                        p_data: data
                    }, 
                    dataType: "json",
                    success: function(response) {
                        $('.view-modal').html(response.output).show();
                        $('#detailModal').modal('show');
                    }
                })
            })
            $(".info-stock").click(function() {
                let data_stock = $(this).attr("data-link")
                $.ajax({
                    url: "<?= base_url('dashboard/get_modal_info_stock') ?>",
                    data: { 
                        p_start_date: start_date,
                        p_end_date: end_date ,
                        p_data: data_stock
                    }, 
                    dataType: "json",
                    success: function(response) {
                        $('.view-modal').html(response.output).show();
                        $('#detailModal').modal('show');                        
                    }
                })
            })
            getDataDashboard()
            dataChartDonut()
            dataChartBar()
        })

        getDataDashboard = (start_date, end_date) => {
            $.ajax({
                url: "<?= base_url('dashboard/get_data_dashboard') ?>",
                data: { 
                    p_start_date: start_date,
                    p_end_date: end_date 
                }, 
                dataType: "json",
                success: function(response) {
                    $('.p_1').empty()
                    $('#count_draft').append(response.count_draft[0].id)
                    $('#count_submitted').append(response.count_submitted[0].id)
                    $('#count_open').append(response.count_open[0].id)
                    $('#count_responded').append(response.count_responded[0].id)
                    $('#count_verified').append(response.count_verified[0].id)
                    $('#count_closed').append(response.count_closed[0].id)
                    $('#count_reopen').append(response.count_reopen[0].id)
                    $('#count_voided').append(response.count_voided[0].id)
                }
            })
        }

        donutChart = (chart_data_donut) =>{
            var pieChartCanvas = $('#chart-donut')
            var pieData = chart_data_donut
            var pieOptions = {
                legend: {
                    position: 'top',
                },
                maintainAspectRatio: false,
            }
            var pieChart = new Chart(pieChartCanvas, { 
                type: 'doughnut',
                data: pieData,
                options: pieOptions
            })
        }
        barChart = (chart_data) => {
            var salesChartCanvas = $("#chart-bar")
            var salesChartData = chart_data

            var salesChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                display: false
                },
                scales: {
                xAxes: [{
                    gridLines: {
                    display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                    display: false
                    }
                }]
                }
            }

            var salesChart = new Chart(salesChartCanvas, { 
                type: 'bar',
                data: salesChartData,
                options: salesChartOptions
            })
        }
        
        dataChartDonut = (start_date, end_date) => {
            $.ajax({
                url: "<?= base_url('dashboard/get_data_chart_status') ?>",
                data: { 
                    p_start_date: start_date,
                    p_end_date: end_date 
                }, 
                dataType: "json",
                success: function(response) {
                    let status_name = [];
                    let count_status = [];

                    $.each(response.data_status, function(key, value ) {
                        status_name.push(value.status_name);
                        count_status.push(value.count_status);
                    });
                    
                    var chart_data_donut = {
                        labels:status_name,
                        datasets: [
                            {
                                data: count_status,
                                backgroundColor: [
                                    '#3c89e9',
                                    '#02ad5e',
                                    '#525252'
                                ]
                            }
                        ]
                    };
                    donutChart(chart_data_donut)
                }
            })
        }
        
        dataChartBar = (start_date, end_date) => {
            $.ajax({
                url: "<?= base_url('dashboard/get_data_chart_bar') ?>",
                data: { 
                    p_start_date: start_date,
                    p_end_date: end_date 
                }, 
                dataType: "json",
                success: function(response) {
                    let label_name = [];
                    let data_effective = [];
                    let data_non = [];
                    $.each(response.data_status, function(key, value ) {
                        label_name.push(value.name);
                        data_effective.push(value.data_effective);
                        data_non.push(value.data_non);
                    });
                    var chart_data = {
                        labels:label_name,
                        datasets:[ {
                                label:'Effective',
                                backgroundColor:'#003f8f',
                                data:data_effective
                            },
                            {
                                label:'Not Effective',
                                backgroundColor:'#e37907',
                                data:data_non
                            }
                        ],
                    };
                    barChart(chart_data)
                }
            })
        }
        
    </script>

    <?= $this->endSection(); ?>