<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
    table tr td, table tr th {
        font-size: 6px !important;
    }
    </style>
</head>

<body>

        <table style="width: 100%;">
            <tr>
                <th>No</th>
                <th><?= $data_first[0]['no']; ?></th>
            </tr>
            <tr>
                <th>Date</th>
                <th><?= date_format(new DateTime(($data_first['created_at'])),'d-m-Y H:i:s'); ?></th>
            </tr>
            <tr>
                <th>Cashier</th>
                <th><?= $data_first[0]['username']; ?></th>
            </tr>
            <tr>
                <th>Customer</th>
                <th><?= $data_first[0]['name']; ?></th>
            </tr>
        </table>
        <hr>
        <table>
                <?php $total = 0; ?>
                <?php foreach ($data_detail as $datas) :
                    $sub_total = $datas['price'] * $datas['quantity'];
                    $total += $sub_total;
                ?>
                    <tr>
                        <td><?= $datas['barcode']; ?></td>
                        <td><?= $datas['name']; ?></td>
                        <td><?= ($datas['quantity']); ?> X <?= number_format(($datas['price'])); ?></td>
                        <td style="text-align: right;"><?= number_format($sub_total); ?></td>
                    </tr>
                <?php endforeach; ?>
        </table>
        <hr>
        <table>
            <tr>
                <th><strong>Total</strong></th>
                <th style="text-align: right;"><strong><?= number_format($data_first[0]['total_payment']); ?></strong></th>
            </tr>
            <tr>
                <th>Cash</th>
                <th style="text-align: right;"><?= number_format($data_first[0]['moneys']); ?></th>
            </tr>
            <tr>
                <th>Change</th>
                <th style="text-align: right;"><?= number_format($data_first[0]['change']); ?></th>
            </tr>
        </table>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>