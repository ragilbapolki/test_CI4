<?= $this->extend('layout/templates'); ?>

<?= $this->Section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= $title; ?></h1>
            <!-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol> -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    List Order 
                </div>
                <div class="card-body">
                    <!-- <a href="" class="btn btn-primary btn-sm mb-2 add-modal" title="Add"><i class="fas fa-plus-square"></i> Add </a> -->
                    <button class="btn btn-info btn-sm mb-2 btn-search" disabled title="Search"><i class="fas fa-search"></i> Search </button>
                    <div class="row col">
                        <label for="name" class="col-sm- mb-2 col-form-label">Start Date</label>&nbsp;
                        <div class="col-sm-3 input-group">
                            <input type="text" class="form-control col-sm"  id="start_date" name="start_date" placeholder="type start date here" title="Input Start Date">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text" style="height: 38px"><i class="fa fa-calendar" style="height: 38px"></i></div>
                        </div>
                        </div>
                        <label for="name" class="col-sm- mb-2 col-form-label">End Date</label>&nbsp;
                        <div class="col-sm-3 input-group">
                            <input type="text" class="form-control col-sm"  id="end_date" name="end_date" placeholder="type end date here" title="Input End Date">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text" style="height: 38px"><i class="fa fa-calendar" style="height: 38px"></i></div>
                        </div>
                    </div>
                    <!-- Get Data -->
                    <div class="table-responsive view-data">

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
            $("#start_date,#end_date").datepicker({
                dateFormat: 'dd-mm-yy' 
            });
            getDataReport();
        });
        $("#start_date,#end_date").change(function(){
            p_start_date =  $("#start_date").val()
            p_end_date =  $("#end_date").val()
            if (p_start_date != null && p_end_date != null) {
                $(".btn-search").attr("disabled", false)
            } else {
                $(".btn-search").attr("disabled", true)
            }
        })
        $(".btn-search").click(function(){
            if (p_end_date == null || p_end_date == '') {
                toastr.error('End date is empty');
                return false;
            } 
            getDataReport(p_start_date, p_end_date)
        })
        getDataReport = (p_start_date, p_end_date) => {
            $.ajax({
                url: "<?= base_url('report/get_data') ?>",
                data: { 
                    p_start_date: p_start_date,
                    p_end_date : p_end_date
                }, 
                dataType: "json",
                success: function(response) {
                    $('.view-data').html(response.output);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        }
    </script>

    <?= $this->endSection(); ?>