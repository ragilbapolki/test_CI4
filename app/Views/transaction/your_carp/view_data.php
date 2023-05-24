 <div class="table-responsive">
     <table class="table table-bordered" id="getCARP" width="100%" cellspacing="0">
         <thead>
             <tr>
                 <th>Create Date</th>
                 <th>Code</th>
                 <th>Category</th>
                 <th>Initiator</th>
                 <th>Recipient</th>
                 <th>Verified By</th>
                 <th>Due Date</th>
                 <th>Effectiveness</th>
                 <th>Status Date</th>
                 <th>Stage</th>
                 <th>Status</th>
                 <th>Action</th>
             </tr>
         </thead>
         <tbody>
             <?php 
                foreach ($data_carp_pic as $datas) : ?>
                 <tr>
                    <td><?= date_format(new DateTime(($datas['created_at'])),'d-m-Y');?></td>
                    <td><?= esc($datas['code']); ?></td>
                    <td><?= esc($datas['category_name']); ?></td>
                    <td><?= esc($datas['initiator_name']); ?></td>
                    <td><?= esc($datas['recipient_name']); ?></td>
                    <td><?= esc($datas['verified_name']); ?></td>
                    <td><?= date_format(new DateTime(($datas['due_date'])),'d-m-Y');?></td>
                    <td><?= esc($datas['effectiveness']); ?></td>
                    <td><?= date_format(new DateTime(($datas['status_date'])),'d-m-Y');?></td>
                    <td>
                        <?php
                        if ($datas['stage'] == 0) {
                            echo '<a style="background-color: #bbd7fa;color: white;" class="badge badge">Draft</a>';
                        } elseif ($datas['stage'] == 17) {
                            echo '<a style="background-color: #3c89e9;color: white;" class="badge badge">Open</a>';
                        } elseif ($datas['stage'] == 24) {
                            echo '<a style="background-color: #8ebefa;color: white;" class="badge badge">Submitted</a>';
                        } elseif ($datas['stage'] == 22) {
                            echo '<a style="background-color: #003f8f;color: white;" class="badge badge">Responded</a>';
                        } elseif ($datas['stage'] == 21) {
                            echo '<a style="background-color: #2ded94;color: white;" class="badge badge">Verified</a>';
                        } elseif ($datas['stage'] == 19) {
                            echo '<a style="background-color: #02ad5e;color: white;" class="badge badge">Closed</a>';
                        } elseif ($datas['stage'] == 20) {
                            echo '<a style="background-color: #e37907;color: white;" class="badge badge">Re-Open</a>';
                        } elseif ($datas['stage'] == 18) {
                            echo '<a style="background-color: #525252;color: white;" class="badge badge">Voided</a>';
                        }  
                        ?>
                    </td>
                    <td>
                        <?php
                            if ($datas['status'] == 1) {
                                echo '<a style="background-color: #e37907;" class="badge badge">Open</a>';
                            } elseif ($datas['status'] == 2) {
                                echo '<a style="background-color: #02ad5e;" class="badge badge">Closed</a>';
                            } elseif ($datas['status'] == 3) {
                                echo '<a style="background-color: #525252;" class="badge badge">Canceled</a>';
                            } else {
                                echo '<a style="background-color: #bbd7fa;" class="badge badge">Draft</a>';
                            }
                        ?>
                    </td>
                    <td class="text-center" width="20%">
                    <?php
                        if ($datas['stage'] == 0) {
                    ?>
                        <button class="btn btn-info btn-sm mb-1" onclick="detail('<?= $datas['id']; ?>')">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                    <?php } else {
                    ?>
                        <button class="btn btn-primary btn-sm mb-1" onclick="progress('<?= $datas['id']; ?>')">
                        <i class="fas fa-chart-line"></i>
                        </button>
                    </td>
                    <?php } ?>
                 </tr>
             <?php endforeach; ?>
         </tbody>
     </table>
 </div>

 <script>
     $(document).ready(function() {
         $('#getCARP').DataTable();
     });

    detail = (id) => {
        $.ajax({
            type: "post",
            url: "<?= base_url('transaction/carp_pic/get_modal_detail'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.output) {
                    $('.view-modal').html(response.output).show();
                    $('#detailModal').modal('show');
                }
            }
        });
    }
     
    progress = (id) => {
        $.ajax({
            type: "post",
            url: "<?= base_url('transaction/carp_pic/get_progress') ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('.view-progress').html(response.output);
                $('.view-progress').show();
                $('.view-data').hide();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

 </script>