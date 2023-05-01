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
                    <table class="table table-bordered tbl-info" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Moneys</th>
                                <th>Total Payment</th>
                                <th>Customer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0;
                                foreach ($order as $datas) : ?>
                                <tr>
                                    <td style="width: 20%;"><?= esc($datas['no']); ?></td>
                                    <td><?= date_format(new DateTime(($datas['date'])),'d-m-Y');?></td>
                                    <td><?= number_format(esc($datas['moneys'])); ?></td>
                                    <td><?= number_format(esc($datas['total_payment'])); ?></td>
                                    <td><?= esc($datas['name']); ?></td>
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
