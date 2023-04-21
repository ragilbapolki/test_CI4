 <div class="table-responsive">
     <table class="table table-bordered" id="getPrice" width="100%" cellspacing="0">
         <thead>
             <tr>
                 <th>Barcode</th>
                 <th>Product</th>
                 <th>Price</th>
                 <th>Date</th>
                 <th>Note</th>
             </tr>
         </thead>
         <tbody>
             <?php 
                foreach ($data_price_products as $datas) : ?>
                 <tr>
                     <td><?= esc($datas['barcode']); ?></td>
                     <td><?= esc($datas['name']); ?></td>
                     <td><?= number_format(esc($datas['price'])); ?></td>
                     <td><?= date_format(new DateTime(($datas['date'])),'d-m-Y H:i');?></td>
                     <td><?= esc($datas['note']); ?></td>
                 </tr>
             <?php endforeach; ?>
         </tbody>
     </table>
 </div>

 <script>
     $(document).ready(function() {
         $('#getPrice').DataTable();
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

 </script>