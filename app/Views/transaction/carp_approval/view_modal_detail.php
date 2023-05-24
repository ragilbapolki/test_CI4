<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Detail CARP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="id" value="<?= $data_first[0]['id']; ?>">
            <div class="modal-body">
              <div class="card-body p-0">
                <table class="table">
                    <tr>
                        <td colspan="2" class="p-1"><strong>Code</strong></td>
                        <td colspan="2" class="p-1"><?= $data_first[0]['code']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><strong>Date</strong></td>
                        <td colspan="2" class="p-1"><?= date_format(new DateTime(($data_first[0]['created_at'])),'d-m-Y'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><strong>Initiator</strong></td>
                        <td colspan="2" class="p-1"><?= $data_first[0]['initiator_name']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><strong>Recipient</strong></td>
                        <td colspan="2" class="p-1"><?= $data_first[0]['recipient_name']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><strong>Verified By</strong></td>
                        <td colspan="2" class="p-1"><?= $data_first[0]['verified_name']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><strong>Due Date</strong></td>
                        <td colspan="2" class="p-1"><?= date_format(new DateTime(($data_first[0]['due_date'])),'d-m-Y'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><strong>Effectiveness</strong></td>
                        <td colspan="2" class="p-1"><?= $data_first[0]['effectiveness']=='1' ? 'Effective': 'Not Effective' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><strong>Stage</strong></td>
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
                
                <div class="table-responsive">
                    <table class="table table-bordered" id="getProgress" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($data_progress as $datas) : ?>
                            <tr>
                                <td><?= date_format(new DateTime(($datas['created_at'])),'d-m-Y');?></td>
                                <td><?= esc($datas['description']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button  value='21' class="btn btn-info btn-sm btn-pic">Verified</button>
                <button  value='19' class="btn btn-success btn-sm btn-pic">Closed</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".btn-pic").click(function(){
            let stage = this.value
            let id = $("#id").val()
            updateStage(id, stage)
        });
        
        $('#getProgress').DataTable({
            "searching": false,
            paging: false,
            ordering: false,
            info: false,
        });
    });
    
    updateStage = (id,stage) => {
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
                         stage:stage
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
                            $('#detailModal').modal('hide');
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