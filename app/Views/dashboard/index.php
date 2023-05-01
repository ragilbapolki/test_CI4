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
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id='count_order' class="p_1"> <?= number_format($count_order[0]['id']); ?></h3>
                        <p>Sales</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" data-link="order" class="small-box-footer btn-info">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id='count_customer' class="p_1"> <?= number_format($count_customer[0]['id']); ?></h3>
                        <p>Customer</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" data-link="customer" class="small-box-footer btn-info">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id='count_products' class="p_1"> <?= number_format($count_products[0]['id']); ?></h3>
                        <p>Products</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-box"></i>
                    </div>
                    <a href="#" data-link="products"class="small-box-footer btn-info">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 id='count_supplier' class="p_1"><?= number_format($count_supplier[0]['id']); ?></h3>
                        <p>Supplier</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-social-dropbox"></i>
                    </div>
                    <a href="#" data-link="supplier" class="small-box-footer btn-info">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-pie mr-1"></i>
                                Categories
                        </div>
                        <div class="card-body"><canvas id="typeProductChartDonut" width="100%" height="40"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar mr-1"></i>
                            Sales
                        </div>
                        <div class="card-body"><canvas id="salesChartBar" width="100%" height="40"></canvas></div>
                    </div>
                </div>
            </div>
            <h5 class="mb-2">Info Stock</h5>
            <div class="row">
            <div class="col-md-4 col-sm-6 col-12  info-stock" data-link="sum">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-archive"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Stock</span>
                    <span class="info-box-number p_1" id='sum_stoc'><?= number_format($sum_stoc[0]['stock']); ?></span>
                </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12  info-stock" data-link="in">
                <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-arrow-down"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Stock In</span>
                    <span class="info-box-number p_1" id='sum_stoc_in'><?= number_format($sum_stoc_in[0]['stock']); ?></span>
                </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12 info-stock" data-link="out">
                <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-arrow-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Stock Out</span>
                    <span class="info-box-number p_1" id='sum_stoc_out'><?= number_format($sum_stoc_out[0]['stock']); ?></span>
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
                salesChart(start_date, end_date)
                typeProductChart(start_date, end_date)
                getDataDashboard(start_date, end_date)
            });
            $(".btn-info").click(function() {
                let data = $(this).attr("data-link")
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
            salesChart()
            typeProductChart()
            getDataDashboard()
        });
        salesChart = (start_date, end_date) => {
            $.ajax({
                url: "<?= base_url('dashboard/get_data_chart_sales') ?>",
                data: { 
                    p_start_date: start_date,
                    p_end_date: end_date 
                }, 
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    let tahun = [];
                    let bulan = [];
                    let qty = [];

                    $.each(response.data_order, function(key, value ) {
                        tahun.push(value.tahun);
                        bulan.push(value.bulan);
                        qty.push(value.qty);
                    });
                    let ctx = $("#salesChartBar");
                    let salesChartBar = new Chart(ctx, {
                        type: 'bar',
                        data: {
                        labels: bulan,
                        datasets: [{
                            label: "Sales",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: qty,
                        }],
                        },
                        options: {
                        scales: {
                            xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            }
                            }],
                            yAxes: [{
                            ticks: {
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                display: true
                            }
                            }],
                        },
                        legend: {
                            display: false
                        }
                        }
                    });
                }
            })
        }

        typeProductChart = (start_date, end_date) => {
            $.ajax({
                url: "<?= base_url('dashboard/get_data_chart_category') ?>",
                data: { 
                    p_start_date: start_date,
                    p_end_date: end_date 
                }, 
                dataType: "json",
                success: function(response) {
                    let name_category = [];
                    let count_product = [];

                    $.each(response.data_products, function(key, value ) {
                        name_category.push(value.name_category);
                        count_product.push(value.count_product);
                    });
                    let typeProductChartDonut = $("#typeProductChartDonut");
                    let salesChartBar = new Chart(typeProductChartDonut, {
                        type: 'pie',
                        data: {
                        labels: name_category,
                        datasets: [{
                            label: "Categories",
                            backgroundColor: [
                            '#34ebdc',
                            '#4287f5',
                            '#d0eb34',
                            '#ffbc03',
                            '#ff4203'
                            ],
                            color: '#000000',
                            data: count_product,
                        }],
                        },
                        options: {
                            legend: {
                                display: true
                            },
                            plugins: {
                                    outlabels: {
                                        text: '%p.2',
                                        color: 'white',
                                        stretch: 10,
                                        font: {
                                            resizable: true,
                                            minSize: 12,
                                            maxSize: 18
                                        }
                                    },
                                datalabels: {
                                    formatter: (value, typeProductChartDonut) => {
                                    let datasets = typeProductChartDonut.chart.data.datasets;
                                    if (datasets.indexOf(ctx.dataset) === datasets.length - 1) {
                                        let sum = datasets[0].data.reduce((a, b) => a + b, 0);
                                        let percentage = Math.round((value / sum) * 100) + '%';
                                        return '';
                                    } else {
                                        return '';
                                    }
                                    },
                                    color: '#000000',
                                    font: {
                                    weight: 'bold',
                                    size: 18,
                                    },
                                    display: function(context) {
                                    return context.dataset.data[context.dataIndex] !== 0; // or >= 1 or ...
                                    }
                                }
                            }
                        }
                    });
                }
            })
            
        }

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
                    $('#count_customer').append(response.count_customer[0].id)
                    $('#count_order').append(response.count_order[0].id)
                    $('#count_products').append(response.count_products[0].id)
                    $('#count_supplier').append(response.count_supplier[0].id)
                    $('#sum_stoc').append(response.sum_stoc[0].stock)
                    $('#sum_stoc_in').append(response.sum_stoc_in[0].stock)
                    $('#sum_stoc_out').append(response.sum_stoc_out[0].stock)

                    console.log(response);
                }
            })
        }
    </script>

    <?= $this->endSection(); ?>