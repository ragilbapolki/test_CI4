 <div class="table-responsive">
     <table class="table table-bordered" id="getSettingUser" width="100%" cellspacing="0">
         <thead>
             <tr>
                 <th>Email</th>
                 <th>User name</th>
                 <th>Employee name</th>
                 <!-- <th>Action</th> -->
             </tr>
         </thead>
         <tbody>
             <?php 
                foreach ($data_user as $datas) : ?>
                 <tr>
                     <td><?= esc($datas['email']); ?></td>
                     <td><?= esc($datas['username']); ?></td>
                     <td><?= esc($datas['name']); ?></td>
                 </tr>
             <?php endforeach; ?>
         </tbody>
     </table>
 </div>

 <script>
     $(document).ready(function() {
         $('#getSettingUser').DataTable();
     });

     edit = (id) => {
         $.ajax({
             type: "post",
             url: "<?= base_url('master/position/get_modal_edit'); ?>",
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
                     url: "<?= base_url('master/position/delete_data'); ?>",
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
                             getSettingUser();
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