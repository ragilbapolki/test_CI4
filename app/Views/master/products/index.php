<?= $this->extend('layout/templates'); ?>

<?= $this->Section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <!-- <h1 class="mt-4"><i class="fas fa-spinner"></i> Master Product</h1> -->
            <h1 class="mt-4"> <?= $title; ?></h1>
            <!-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol> -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    List Products 
                </div>
                <div class="card-body">
                    <a href="" class="btn btn-primary btn-sm mb-2 add-modal"  title="Add"><i class="fas fa-plus-square"></i> Add </a>
                    <div class="row">
                        <label for="name" class="col-sm- col-form-label">Category</label>
                        <div class="col-sm-3">
                            <select class="form-control select2" id="p_category" title="Select Category">
                                <option value="0">All</option>;
                                <?php foreach($data_category_products as $data_category){ ?>
                                    <option value="<?php echo $data_category['id']; ?>"><?php echo $data_category['name']; ?></option>';
                                <?php } ?>
                            </select>
                        </div>
                        <label for="name" class="col-sm- col-form-label">Unit</label>
                        <div class="col-sm-2">
                            <select class="form-control select2" id="p_unit" title="Select Unit">
                                <option value="0">All</option>;
                                <?php foreach($data_unit as $data_unit){ ?>
                                    <option value="<?php echo $data_unit['id']; ?>"><?php echo $data_unit['code']; ?></option>';
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
        $(document).ready(function() {
            var p_category  
            var p_unit      
            getProducts();
            $('.select2').on('select2:select', function(e) {
                if ($(this).attr('id') == 'p_category') {
                    p_category = $(this).val()
                } else {
                    p_unit = $(this).val()
                }
                getProducts(p_category, p_unit);
            })
            $(".select2").select2({
                placeholder: 'Select Item',
                width: '100%'
            }).val('').trigger('change');
            $('.add-modal').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?= base_url('master/products/get_modal'); ?>",
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
        // Function get product 
        getProducts = (p_category,p_unit) => {
            $.ajax({
                url: "<?= base_url('master/products/get_data') ?>",
                data: { 
                    p_category: p_category,
                    p_unit: p_unit 
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