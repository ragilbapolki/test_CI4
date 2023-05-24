<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add Setting User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('administrator/setting_user/save_data', ['class' => 'form-add']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="category" class="col-sm-4 col-form-label">Employee </label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="employee" id="employee" title="Select Employee">
                            <?php foreach($data_employee as $data_employee){ ?>
                                <option value="<?php echo $data_employee['id']; ?>"><?php echo $data_employee['name']; ?></option>';
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback erroremployee">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-4 col-form-label">Username / Email </label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="username" id="username" title="Select Employee">
                            <?php foreach($data_user as $data_user){ ?>
                                <option value="<?php echo $data_user['id']; ?>"><?php echo $data_user['username'] ." - ". $data_user['email']; ?></option>';
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorusername">
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
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1800
                        })
                        $('#addModal').modal('hide');
                        getSettingUser();
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