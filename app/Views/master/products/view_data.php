 <div class="table-responsive">
     <table class="table table-bordered" id="getProducts" width="100%" cellspacing="0">
         <thead>
             <tr>
                 <!-- <th>No</th> -->
                 <th>Barcode</th>
                 <th>Name</th>
                 <th>Description</th>
                 <th>Price</th>
                 <th>Stock</th>
                 <th>Action</th>
             </tr>
         </thead>
         <tbody>
             <?php 
                foreach ($data_products as $datas) : ?>
                 <tr>
                     <td style="width: 20%;"><?= esc($datas['barcode']); ?></td>
                     <td style="width: 20%;"><?= esc($datas['name']); ?></td>
                     <td style="width: 20%;"><?= esc($datas['description']); ?></td>
                     <td style="width: 15%;"><?= number_format(esc($datas['price'])); ?></td>
                     <td style="width: 10%;"><?= esc($datas['stock']); ?></td>
                     <td class="text-center" width="25%">
                         <button class="btn btn-success btn-sm mb-1" title="Update" onclick="edit('<?= $datas['id']; ?>')">
                            <i class="fas fa-pencil-alt"></i>
                         </button>

                         <button class="btn btn-danger btn-sm mb-1" title="Delete" onclick="deletes('<?= $datas['id']; ?>')">
                            <i class="fas fa-trash"></i>    
                         </button>
                         
                         <button class="btn btn-info btn-sm mb-1" title="Delete" onclick="detail('<?= $datas['id']; ?>')">
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
         $('#getProducts').DataTable();
     });
        number_separator = (value) => {
            var val = value;
            val = val.replace(/[^0-9\.]/g,'');
            if(val != "") {
                valArr = val.split('.');
                valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
                val = valArr.join('.');
            }
            return val;
        }

        edit = (id) => {
            $.ajax({
                type: "post",
                url: "<?= base_url('master/products/get_modal_edit'); ?>",
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
                        url: "<?= base_url('master/products/delete_data'); ?>",
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
                                getProducts();
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                }
            });
        }
         
        detail = (id) => {
            $.ajax({
                type: "post",
                url: "<?= base_url('master/products/get_modal_detail'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.output) {
                        $('.view-modal').html(response.output).show();
                        $('#detailModal').modal('show');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
 </script>