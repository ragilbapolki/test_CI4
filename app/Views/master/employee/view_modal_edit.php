<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Edit Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('master/employee/update_data', ['class' => 'form-edit']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id" value="<?= $records['id']; ?>">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $records['name']; ?>" placeholder="type name here" title="Input Name">
                        <div class="invalid-feedback errorname">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= $records['phone']; ?>" placeholder="type phone here" title="Input Phone">
                        <div class="invalid-feedback errorphone">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <textarea name="address" id="address" cols="80" rows="2" class="form-control" placeholder="type address here" title="Input Address"><?= $records['address']; ?></textarea>
                        <div class="invalid-feedback erroraddress">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Position</label>
                    <div class="col-sm-10">
                        <select class="form-control select2position" name="position" id="position" title="Select Position">
                            <?php foreach($data_position as $data_position){ ?>
                                <option value="<?php echo $data_position['id']; ?>"><?php echo $data_position['name']; ?></option>';
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorposition">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Division</label>
                    <div class="col-sm-10">
                        <select class="form-control select2division" name="division" id="division" title="Select Division">
                            <?php foreach($data_div as $data_div){ ?>
                                <option value="<?php echo $data_div['id']; ?>"><?php echo $data_div['name']; ?></option>';
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errordivision">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Branch</label>
                    <div class="col-sm-10">
                        <select class="form-control select2branch" name="branch" id="branch" title="Select Branch">
                            <?php foreach($data_branch as $data_branch){ ?>
                                <option value="<?php echo $data_branch['id']; ?>"><?php echo $data_branch['name']; ?></option>';
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorbranch">
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
        var val_brach  = <?= $records['brach_id']; ?>;
        var val_div    = <?= $records['div_id']; ?>;
        var val_pos    = <?= $records['pos_id']; ?>;
        $(".select2branch").select2({
            placeholder: 'Select Item',
            width: '100%'
        }).val(val_brach).trigger('change');
        $(".select2division").select2({
            placeholder: 'Select Item',
            width: '100%'
        }).val(val_div).trigger('change');
        $(".select2position").select2({
            placeholder: 'Select Item',
            width: '100%'
        }).val(val_pos).trigger('change');
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
                        if (response.error.select_branch) {
                            $('#branch + span').addClass('is-invalid');
                            $('.errorbranch').html(response.error.select_branch);
                        } else {
                            $('#branch + span').removeClass('is-invalid');
                            $('.errorbranch').html('');
                        }
                        if (response.error.select_division) {
                            $('#division + span').addClass('is-invalid');
                            $('.errordivision').html(response.error.select_division);
                        } else {
                            $('#division + span').removeClass('is-invalid');
                            $('.errordivision').html('');
                        }
                        if (response.error.select_position) {
                            $('#position + span').addClass('is-invalid');
                            $('.errorposition').html(response.error.select_position);
                        } else {
                            $('#position + span').removeClass('is-invalid');
                            $('.errorposition').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1800
                        })

                        $('#editModal').modal('hide');                        
                        getEmployee();
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