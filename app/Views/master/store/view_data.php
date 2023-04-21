 <div class="table-responsive">
     <table class="table table-bordered" id="getStore" width="100%" cellspacing="0">
         <thead>
             <tr>
                 <th style="width: 20%;">Name</th>
                 <th style="width: 20%;">Address</th>
                 <th style="width: 10%;">Phone</th>
                 <th style="width: 15%;">Note</th>
                 <th style="width: 5%;">Action</th>
             </tr>
         </thead>
         <tbody>
             <?php 
                foreach ($data_store as $datas) : ?>
                 <tr>
                     <td  style="width: 20%;"><?= esc($datas['name']); ?></td>
                     <td  style="width: 20%;"><?= esc($datas['address']); ?></td>
                     <td  style="width: 10%;"><?= esc($datas['phone']); ?></td>
                     <td  style="width: 15%;"><?= esc($datas['note']); ?></td>
                     <td class="text-center" width="5%">
                         <button class="btn btn-success btn-sm mb-1" onclick="edit('<?= $datas['id']; ?>')">
                            <i class="fas fa-pencil-alt"></i>
                         </button>

                         <button class="btn btn-danger btn-sm mb-1" onclick="deletes('<?= $datas['id']; ?>')">
                            <i class="fas fa-trash"></i>    
                         </button>
                     </td>
                 </tr>
             <?php endforeach; ?>
         </tbody>
     </table>
 </div>

 <script>
     $(document).ready(function() {
         $('#getStore').DataTable();
     });

     edit = (id) => {
         $.ajax({
             type: "post",
             url: "<?= base_url('master/store/get_modal_edit'); ?>",
             data: {
                 id: id
             },
             dataType: "json",
             success: function(response) {
                 if (response.output) {
                     $('.view-modal').html(response.output).show();
                     $('#editModal').modal('show');
                 }
             },
             error: function(xhr, ajaxOptions, thrownError) {
                 alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
             }
         });
     }

     deletes = (id) => {
         Swal.fire({
             title: 'Are you sure?',
             text: `You won't be able to revert this!`,
             icon: 'question',
             showCancelButton: true,
             confirmButtonColor: '#d33',
             cancelButtonColor: '#3085d6',
             confirmButtonText: 'Yes, delete it!',
             cancelButtonText: 'Cancel'
         }).then((result) => {
             if (result.value) {
                 $.ajax({
                     type: "post",
                     url: "<?= base_url('master/store/delete_data'); ?>",
                     data: {
                         id: id
                     },
                     dataType: "json",
                     success: function(response) {
                         if (response.output) {
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Deleted',
                                 text: response.output,
                             });
                             getStore();
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