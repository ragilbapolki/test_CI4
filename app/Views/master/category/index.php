<?= $this->extend('layout/templates'); ?>

<?= $this->Section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"> <?= $title; ?></h1>
            <!-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol> -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                        List Categories
                </div>
                <div class="card-body">
                    <a href="" class="btn btn-primary btn-sm mb-2 add-modal" title="Add"><i class="fas fa-plus-square"></i> Add </a>

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
        // Function get product 
        getCategory = () => {
            $.ajax({
                url: "<?= base_url('master/category/get_data') ?>",
                dataType: "json",
                success: function(response) {
                    $('.view-data').html(response.output);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        }

        // view output
        $(document).ready(function() {
            getCategory();
            $('.add-modal').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?= base_url('master/category/get_modal'); ?>",
                    dataType: "json",
                    success: function(response) {
                        $('.view-modal').html(response.output).show();

                        $('#addModal').modal('show')
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            });
        });
    </script>

    <?= $this->endSection(); ?>