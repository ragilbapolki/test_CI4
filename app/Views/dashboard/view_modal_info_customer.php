<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"> <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered tbl-info" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 20%;">Name</th>
                                <th style="width: 5%;">Genre</th>
                                <th style="width: 20%;">Address</th>
                                <th style="width: 10%;">Phone</th>
                                <th style="width: 15%;">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0;
                                foreach ($customer as $datas) : ?>
                                <tr>
                                    <td  style="width: 20%;"><?= esc($datas['name']); ?></td>
                                    <td  style="width: 20%;"><?= (esc($datas['genre']) == '1') ? 'Male' : 'Female' ?></td>
                                    <td  style="width: 20%;"><?= esc($datas['address']); ?></td>
                                    <td  style="width: 10%;"><?= esc($datas['phone']); ?></td>
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
