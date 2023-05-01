<div class="table-responsive">
     <table class="table table-bordered" id="getOrder" width="100%" cellspacing="0">
         <thead>
             <tr>
                 <th>No</th>
                 <th>Date</th>
                 <th>Moneys</th>
                 <th>Total Payment</th>
                 <th>Customer</th>
                 <th>Action</th>
             </tr>
         </thead>
         <tbody>
             <?php 
                foreach ($data_order as $datas) : ?>
                 <tr>
                     <td><?= esc($datas['no']); ?></td>
                     <td><?= date_format(new DateTime(($datas['date'])),'d-m-Y');?></td>
                     <td><?= number_format(esc($datas['moneys'])); ?></td>
                     <td><?= number_format(esc($datas['total_payment'])); ?></td>
                     <td><?= esc($datas['name']); ?></td>
                     <td>
                        <button class="btn btn-info btn-sm mb-1" onclick="detail('<?= $datas['id']; ?>')">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                     </td>
                 </tr>
             <?php endforeach; ?>
         </tbody>
     </table>
 </div>

 <script>
     $(document).ready(function() {
         $('#getOrder').DataTable();
     });
         
     detail = (id) => {
        $.ajax({
            type: "post",
            url: "<?= base_url('report/get_modal_detail'); ?>",
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


 </script>