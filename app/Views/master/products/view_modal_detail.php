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
            <input type="hidden" name="id" value="<?= $data_first[0]['id']; ?>">
            <div class="modal-body">
              <div class="card-body p-0">
                <table class="table">
                    <tr>
                        <td colspan="2" class="p-1"><strong>Barcode</strong></td>
                        <td colspan="2" class="p-1"><strong>Name</strong></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><?= $data_first[0]['barcode']; ?></td>
                        <td colspan="2" class="p-1"><?= $data_first[0]['name']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><strong>Category</strong></td>
                        <td colspan="2" class="p-1"><strong>Unit</strong></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><?= $data_first[0]['category']; ?></td>
                        <td colspan="2" class="p-1"><?= $data_first[0]['unit'].' ( '.$data_first[0]['code_unit'].' )';?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-1"><strong>Description</strong></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="p-1"><?= $data_first[0]['description']; ?></td>
                    </tr>
                </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="getProductDetail" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <!-- <th>No</th> -->
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($data_detail as $datas) : ?>
                                <tr>
                                    <!-- <td width="1%"><?= $no++; ?></td> -->
                                    <td style="width: 20%;"><?= esc($datas['stock']); ?></td>
                                    <td style="width: 15%;"><?= number_format(esc($datas['price'])); ?></td>
                                    <td style="width: 20%;"><?= date_format(new DateTime(($datas['start_date'])),'d-m-Y H:i'); ?></td>
                                    <td style="width: 20%;"><?= ($datas['end_date'] == null) ? '' : date_format(new DateTime(($datas['end_date'])),'d-m-Y H:i'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
</script>