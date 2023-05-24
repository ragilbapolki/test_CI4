<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add CARP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('transaction/carp/save_data', ['class' => 'form-add']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" readonly id="code" name="code" placeholder="type name here" title="Input Code" value="<?= $code_carp; ?>">
                        <div class="invalid-feedback errorcode">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="category" id="category" title="Select Category">
                            <?php foreach($data_category as $data_category){ ?>
                                <option value="<?php echo $data_category['id']; ?>"><?php echo $data_category['name']; ?></option>';
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorbranch">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Initiator</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="initiator" id="initiator" title="Select Initiator">
                            <?php foreach($data_initiator_by as $data_initiator_by){ ?>
                                <option value="<?php echo $data_initiator_by['id']; ?>"><?php echo $data_initiator_by['name']; ?></option>';
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorbranch">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Recipient</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="recipient" id="recipient" title="Select Recipient">
                            <?php foreach($data_recipient_by as $data_recipient_by){ ?>
                                <option value="<?php echo $data_recipient_by['id']; ?>"><?php echo $data_recipient_by['name']; ?></option>';
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorbranch">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Verified By</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="verified" id="verified" title="Select Verified By">
                            <?php foreach($data_verified_by as $data_verified_by){ ?>
                                <option value="<?php echo $data_verified_by['id']; ?>"><?php echo $data_verified_by['name']; ?></option>';
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorbranch">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Due Date</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  id="due_date" name="due_date" placeholder="type due date here" title="Input Due Date">
                        <div class="invalid-feedback errorstatus">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Effectiveness</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="effectiveness" id="effectiveness" title="Select Effectiveness">
                                <option value="1">Effective</option>;
                                <option value="2">Not Effective</option>;
                        </select>
                        <div class="invalid-feedback errorstatus">
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
        $("#due_date").datepicker({
                dateFormat: 'dd-mm-yy' 
            });
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
                        getCARP();
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