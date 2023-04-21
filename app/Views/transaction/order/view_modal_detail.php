<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Detail Products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="id" value="<?= $data_first[0]['id']; ?>">
            <div class="modal-body">
              <div class="card-body p-0">
                <table class="table">
                    <tr>
                        <td colspan="2" class="p-1"><strong>No</strong></td>
                        <td colspan="2" class="p-1"><?= $data_first[0]['no']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><strong>Date</strong></td>
                        <td colspan="2" class="p-1"><?= date_format(new DateTime(($data_first['created_at'])),'d-m-Y H:i:s'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><strong>Kasir</strong></td>
                        <td colspan="2" class="p-1"><?= $data_first[0]['username']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><strong>Customer</strong></td>
                        <td colspan="2" class="p-1"><?= $data_first[0]['name']; ?></td>
                    </tr>
                </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="getProductDetail" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0;
                                foreach ($data_detail as $datas) : 
                                $sub_total = $datas['price'] * $datas['quantity'];
                                $total += $sub_total;?>
                                <tr>
                                    <td style="width: 20%;"><?= esc($datas['barcode']); ?></td>
                                    <td style="width: 20%;"><?= esc($datas['name']); ?></td>
                                    <td style="width: 20%;"><?= esc($datas['quantity']); ?></td>
                                    <td style="width: 15%;"><?= number_format(esc($datas['price'])); ?></td>
                                    <td style="width: 15%;"><?= number_format(esc($sub_total)); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <td colspan="4" style="text-align: right;">
                            <strong> Total</strong>
                            </td>
                            <td><?= number_format(esc($total)); ?></td>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm btn-print-invoice">Print</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".btn-print-invoice").click(function(){
            let id = $("#id").val()
            printInvoice(id)
        });
    });
    printInvoice = (id) => {
        $.ajax({
            url: "<?= base_url('report/print_invoice'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                if (response.output) {
                    $('.view-modal').html(response.output).show();
                    $('#detailModal').modal('show');
                }
            }
        });
    }
        
</script>