<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('master/employee/save_data', ['class' => 'form-add']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="type name here" title="Input Name">
                        <div class="invalid-feedback errorname">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="type phone here" title="Input Phone">
                        <div class="invalid-feedback errorphone">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <textarea name="address" id="address" cols="80" rows="2" class="form-control" placeholder="type address here" title="Input Address"></textarea>
                        <div class="invalid-feedback erroraddress">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Position</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="position" id="position" title="Select Position">
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
                        <select class="form-control select2" name="division" id="division" title="Select Division">
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
                        <select class="form-control select2" name="branch" id="branch" title="Select Branch">
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
                        $('#addModal').modal('hide');
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