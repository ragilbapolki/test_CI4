<div class="table-responsive">
    <div class="card-body p-0">
        <table class="table">
            <tr>
                <td colspan="2" class="p-1"><strong>Code</strong></td>
                <td colspan="2" class="p-1"><strong>Date</strong></td>
            </tr>
            <tr>
                <td colspan="2" class="p-1"><?= $data_first[0]['code']; ?></td>
                <td colspan="2" class="p-1"><?= date_format(new DateTime(($data_first[0]['created_at'])),'d-m-Y'); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="p-1"><strong>Initiator</strong></td>
                <td colspan="2" class="p-1"><strong>Recipient</strong></td>
            </tr>
            <tr>
                <td colspan="2" class="p-1"><?= $data_first[0]['initiator_name']; ?></td>
                <td colspan="2" class="p-1"><?= $data_first[0]['recipient_name']; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="p-1"><strong>Verified By</strong></td>
                <td colspan="2" class="p-1"><strong>Due Date</strong></td>
            </tr>
            <tr>
                <td colspan="2" class="p-1"><?= $data_first[0]['verified_name']; ?></td>
                <td colspan="2" class="p-1"><?= date_format(new DateTime(($data_first[0]['due_date'])),'d-m-Y'); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="p-1"><strong>Effectiveness</strong></td>
                <td colspan="2" class="p-1"><strong>Stage</strong></td>
            </tr>
            <tr>
                <td colspan="2" class="p-1"><?= $data_first[0]['effectiveness']=='1' ? 'Effective': 'Not Effective' ?></td>
                <td colspan="2" class="p-1">
                    <?php 
                        if ($data_first[0]['stage'] == 0) {
                            echo '<a style="background-color: #bbd7fa;" class="badge badge">Draft</a>';
                        } elseif ($data_first[0]['stage'] == 17) {
                            echo '<a style="background-color: #72abf2;" class="badge badge">Open</a>';
                        } elseif ($data_first[0]['stage'] == 24) {
                            echo '<a style="background-color: #8ebefa;" class="badge badge">Submitted</a>';
                        } elseif ($data_first[0]['stage'] == 22) {
                            echo '<a style="background-color: #2885fa;" class="badge badge">Responded</a>';
                        } elseif ($data_first[0]['stage'] == 21) {
                            echo '<a style="background-color: #2ded94;" class="badge badge">Verified</a>';
                        } elseif ($data_first[0]['stage'] == 19) {
                            echo '<a style="background-color: #02ad5e;" class="badge badge">Closed</a>';
                        } elseif ($data_first[0]['stage'] == 20) {
                            echo '<a style="background-color: #e37907;" class="badge badge">Re-Open</a>';
                        } elseif ($data_first[0]['stage'] == 18) {
                            echo '<a style="background-color: #525252;" class="badge badge">Voided</a>';
                        }  
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="p-1"><strong>Status</strong></td>
            </tr>
            <tr>
                <td colspan="2" class="p-1">
                    <?php 
                        if ($data_first[0]['status'] == 1) {
                            echo '<a style="background-color: #e37907;" class="badge badge">Open</a>';
                        } elseif ($data_first[0]['status'] == 2) {
                            echo '<a style="background-color: #525252;" class="badge badge">Canceled</a>';
                        } elseif ($data_first[0]['status'] == 3) {
                            echo '<a style="background-color: #02ad5e;" class="badge badge">Closed</a>';
                        } else {
                            echo '<a style="background-color: #bbd7fa;" class="badge badge">Draft</a>';
                        }
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <a class="btn btn-primary btn-sm add-progress"style="color: white;position: absolute;right: 0px;margin-right: 20px;" title="Add"><i class="fas fa-plus-square"></i> Add Progress</a><br><br>
    <table class="table table-bordered" id="getCARPProgress" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($data_carp_progress as $datas) : ?>
            <tr>
                <td><?= date_format(new DateTime(($datas['created_at'])),'d-m-Y');?></td>
                <td><?= esc($datas['description']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="view-modal-progress" style="display: none;">
        <div class="modal fade" id="addModalProgress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add Progress</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open('transaction/carp_pic/save_progress', ['class' => 'form-add']); ?>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" value="<?= $data_first[0]['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">                        
                                <textarea name="description" id="description" cols="80" rows="4" class="form-control" placeholder="type description here" title="Input Description"></textarea>
                                <div class="invalid-feedback errordescription">
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
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm btn-back" data-dismiss="modal">Back</button>
        <button type="submit" class="btn btn-success btn-sm btn-submit" onclick="submited('<?= $data_first[0]['id']; ?>')">Submit</button>
    </div>
</div>

 <script>
    $(document).ready(function() {
        var id    = <?= $data_first[0]['id']; ?>;

        $('#getCARPProgress').DataTable({
            "searching": false,
            paging: false,
            ordering: false,
            info: false,
        });
        $('.add-progress').click(function(e) {
            $('.view-modal-progress').show();
            $('#addModalProgress').modal('show')
        });
        $('.btn-back').click(function(e) {
            $('.view-progress').hide();
            $('.view-data').show();
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.success,
                        showConfirmButton: false,
                        timer: 1800
                    })
                    $('#addModalProgress').modal('hide');
                    progress(id)
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

    });
    submited = (id) => {
         Swal.fire({
             title: 'Are you sure?',
             icon: 'question',
             showCancelButton: true,
             confirmButtonColor: '#d33',
             cancelButtonColor: '#3085d6',
             confirmButtonText: 'Yes',
             cancelButtonText: 'Cancel'
         }).then((result) => {
             if (result.value) {
                 $.ajax({
                     type: "post",
                     url: "<?= base_url('transaction/carp_pic/update_stage'); ?>",
                     data: {
                         id: id,
                         stage:'24'
                     },
                     dataType: "json",
                     success: function(response) {
                        console.log(response);
                         if (response.success) {
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Updated',
                                 text: response.success,
                             });
                            $('.view-progress').hide();
                            $('.view-data').show();
                            getCARP();
                         }
                     },
                     error: function(xhr, ajaxOptions, thrownError) {
                         alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                     }
                 });
             }
         });
    }
     

 </script>