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
                    List Price
                </div>
                <div class="card-body">
                    <a href="" class="btn btn-primary btn-sm mb-2 add-modal" title="Add"><i class="fas fa-plus-square"></i> Add </a>
                    <div class="row">
                        <label for="name" class="col-sm- col-form-label">Products</label>
                        <div class="col-sm-3">
                            <select class="form-control select2" id="p_product" title="Select Products">
                                <option value="0">All</option>;
                                <?php foreach($data_products as $data_products){ ?>
                                    <option value="<?php echo $data_products['id']; ?>"><?php echo $data_products['barcode'] . ' - '. $data_products['name']; ?></option>';
                                <?php } ?>
                            </select>
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
            var p_product    
            getPrice();
            $('.select2').on('select2:select', function(e) {
                p_product = $(this).val()
                getPrice(p_product);
            })
            $(".select2").select2({
                placeholder: 'Select Item',
                width: '100%'
            }).val('').trigger('change');
            $('.add-modal').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?= base_url('transaction/price_products/get_modal'); ?>",
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
        getPrice = (p_product) => {
            $.ajax({
                url: "<?= base_url('transaction/price_products/get_data') ?>",
                data: { 
                    p_product: p_product
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