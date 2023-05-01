<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered tbl-info" style="width:100%" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Barcode</th>
                                <th>Product</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th style="width: 15%;">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0;
                                foreach ($stock as $datas) : ?>
                                <tr>
                                    <td><?= date_format(new DateTime(($datas['date'])),'d-m-Y H:i');?></td>
                                    <td><?= esc($datas['barcode']); ?></td>
                                    <td><?= esc($datas['name']); ?></td>
                                    <td><?= esc($datas['stock']); ?></td>
                                    <td><?= number_format(esc($datas['price'])); ?></td>
                                    <td  style="width: 15%;"><?= esc($datas['note']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
