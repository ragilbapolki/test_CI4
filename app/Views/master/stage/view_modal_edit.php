<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Edit Stage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('master/stage/update_data', ['class' => 'form-edit']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id" value="<?= $id; ?>">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>">
                        <div class="invalid-feedback errorname">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="code" name="code" value="<?= $code; ?>">
                        <div class="invalid-feedback errorcode">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control select2status" name="status" id="status" title="Select Status">
                                <option value="1">Open</option>;
                                <option value="2">Closed</option>;
                                <option value="3">Canceled</option>;
                        </select>
                        <div class="invalid-feedback errorstatus">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="description" cols="80" rows="4" class="form-control"><?= $description; ?></textarea>
                        <div class="invalid-feedback errordescription">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm btn-update">Update</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var val_status_id  = <?= $status_id; ?>;
        $(".select2status").select2({
            placeholder: 'Select Item',
            width: '100%'
        }).val(val_status_id).trigger('change');
        $('.form-edit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btn-update').attr('disable', 'disabled');
                    $('.btn-update').html('<i class="fas fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btn-update').removeAttr('disable');
                    $('.btn-update').html('Update');
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

                        $('#editModal').modal('hide');                        
                        getStage();
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