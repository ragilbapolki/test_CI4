 <div class="table-responsive">
     <table class="table table-bordered" id="getEmployee" width="100%" cellspacing="0">
         <thead>
             <tr>
                 <th>Name</th>
                 <th>Phone</th>
                 <th>Address</th>
                 <th>Position</th>
                 <th>Division</th>
                 <th>Branch</th>
                 <th>Action</th>
             </tr>
         </thead>
         <tbody>
             <?php 
                foreach ($data_employee as $datas) : ?>
                 <tr>
                     <td><?= esc($datas['employee_name']); ?></td>
                     <td><?= esc($datas['phone']); ?></td>
                     <td><?= esc($datas['address']); ?></td>
                     <td><?= esc($datas['position_name']); ?></td>
                     <td><?= esc($datas['div_name']); ?></td>
                     <td><?= esc($datas['branch_name']); ?></td>
                     <td class="text-center" width="20%">
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
         $('#getEmployee').DataTable();
     });

     edit = (id) => {
         $.ajax({
             type: "post",
             url: "<?= base_url('master/employee/get_modal_edit'); ?>",
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
                     url: "<?= base_url('master/employee/delete_data'); ?>",
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
                             getEmployee();
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