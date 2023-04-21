<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add Stock Products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('transaction/stock/save_data', ['class' => 'form-add']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="date" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="date" name="date" value="<?= date("d-m-Y H:i:s")?>" placeholder="type date here" readonly title="Input Date">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="products" class="col-sm-2 col-form-label">Products</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="products" id="products" title="Select Products">
                            <?php foreach($data_products as $data_products){ ?>
                                <option value="<?php echo $data_products['id']; ?>"><?php echo $data_products['barcode'] . ' - '. $data_products['name'] ; ?></option>';
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorproducts">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="stock" name="stock" placeholder="type stock here" title="Input Stock">
                        <div class="invalid-feedback errorstock">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type" class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="type" id="type" title="Select Type">
                            <option value="1">In</option>
                            <option value="2">Out</option>
                        </select>
                        <div class="invalid-feedback errortype">
                        </div>
                    </div>
                </div>
                <div class="form-group row form-supplier">
                    <label for="supplier" class="col-sm-2 col-form-label">Supplier</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="supplier" id="supplier" title="Select Supplier">
                            <?php foreach($data_supplier as $data_supplier){ ?>
                                <option value="<?php echo $data_supplier['id']; ?>"><?php echo $data_supplier['name'] ; ?></option>';
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorsupplier">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="note" class="col-sm-2 col-form-label">Note</label>
                    <div class="col-sm-10">                        
                        <textarea name="note" id="note" cols="80" rows="2" class="form-control" placeholder="type note here" title="Input Note"></textarea>
                        <div class="invalid-feedback errornote">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm btn-save">Save</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".select2").select2({
            placeholder: 'Select Item',
            width: '100%'
        }).val('').trigger('change');
        $('#type').on('select2:select', function(e) {
            if ($(this).val() == 1) {
                $(".form-supplier").show()
            } else {
                $(".form-supplier").hide()
            }
        })

        $('.form-add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btn-save').attr('disable', 'disabled');
                    $('.btn-save').html('<i class="fas fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btn-save').removeAttr('disable');
                    $('.btn-save').html('Save');
                },
                success: function(response) {
                    if (response.error) {
                        $.each(response.error, function(key, value ) {
                            if (value) {
                                $('#'+key).addClass('is-invalid');
                                $('.error'+key).html(value);
                            } else {
                                $('#'+key).removeClass('is-invalid');
                                $('#'+key).html('');
                            }
                        });
                        if (response.error.select_products) {
                            $('#products + span').addClass('is-invalid');
                            $('.errorproducts').html(response.error.select_products);
                        } else {
                            $('#products + span').removeClass('is-invalid');
                            $('.errorproducts').html('');
                        }
                        if (response.error.select_type) {
                            $('#type + span').addClass('is-invalid');
                            $('.errortype').html(response.error.select_type);
                        } else {
                            $('#type + span').removeClass('is-invalid');
                            $('.errortype').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1800
                        })
                        $('#addModal').modal('hide');
                        getStock();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>