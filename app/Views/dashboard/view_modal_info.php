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
                                <th>Create Date</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Initiator</th>
                                <th>Recipient</th>
                                <th>Verified By</th>
                                <th>Due Date</th>
                                <th>Effectiveness</th>
                                <th>Status Date</th>
                                <th>Stage</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($data as $datas) : ?>
                                <tr>
                                    <td><?= date_format(new DateTime(($datas['created_at'])),'d-m-Y');?></td>
                                    <td><?= esc($datas['code']); ?></td>
                                    <td><?= esc($datas['category_name']); ?></td>
                                    <td><?= esc($datas['initiator_name']); ?></td>
                                    <td><?= esc($datas['recipient_name']); ?></td>
                                    <td><?= esc($datas['verified_name']); ?></td>
                                    <td><?= date_format(new DateTime(($datas['due_date'])),'d-m-Y');?></td>
                                    <td><?= esc($datas['effectiveness']); ?></td>
                                    <td><?= date_format(new DateTime(($datas['status_date'])),'d-m-Y');?></td>
                                    <td>
                                        <?php
                                        if ($datas['stage'] == 0 || $datas['stage'] == 23) {
                                            echo '<a style="background-color: #bbd7fa;" class="badge badge">Draft</a>';
                                        } elseif ($datas['stage'] == 17) {
                                            echo '<a style="background-color: #3c89e9;color: white;" class="badge badge">Open</a>';
                                        } elseif ($datas['stage'] == 24) {
                                            echo '<a style="background-color: #8ebefa;color: white;" class="badge badge">Submitted</a>';
                                        } elseif ($datas['stage'] == 22) {
                                            echo '<a style="background-color: #2885fa;color: white;" class="badge badge">Responded</a>';
                                        } elseif ($datas['stage'] == 21) {
                                            echo '<a style="background-color: #2ded94;color: white;" class="badge badge">Verified</a>';
                                        } elseif ($datas['stage'] == 19) {
                                            echo '<a style="background-color: #02ad5e;color: white;" class="badge badge">Closed</a>';
                                        } elseif ($datas['stage'] == 20) {
                                            echo '<a style="background-color: #e37907;color: white;" class="badge badge">Re-Open</a>';
                                        } elseif ($datas['stage'] == 18) {
                                            echo '<a style="background-color: #525252;color: white;" class="badge badge">Voided</a>';
                                        }  
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if ($datas['status'] == 1) {
                                                echo '<a style="background-color: #e37907;" class="badge badge">Open</a>';
                                            } elseif ($datas['status'] == 2) {
                                                echo '<a style="background-color: #02ad5e;" class="badge badge">Closed</a>';
                                            } elseif ($datas['status'] == 3) {
                                                echo '<a style="background-color: #525252;" class="badge badge">Canceled</a>';
                                            } else {
                                                echo '<a style="background-color: #bbd7fa;" class="badge badge">Draft</a>';
                                            }
                                        ?>
                                    </td>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
