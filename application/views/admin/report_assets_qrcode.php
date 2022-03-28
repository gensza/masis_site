<?php 
$pt_qr = $this->session->userdata('app_pt');
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Data Assets</title>
    <style>
        .title {
            text-align: center;
        }
        
    </style>
</head><body>

<p class="title"><b>REPORT DATA ASSETS QR-CODE</b></p><br>

    <table style="margin-top: 20px;" border="0">
        <head>
            <tr>
                <th>QR</th>
                <th style="position : left;">DETAIL</th>
            </tr>
        </head>
        <body>
            <?php foreach ($data_assets as $d) : ?>
            <tr>
                <td><img style="width: 100px;" src="./assets/qrcode/data_asset/<?= $pt_qr ?>/<?= $d['id_assets'] ?>.png"></td>
                <td>
                   Kategori&nbsp;:&nbsp;<?= $d['category'] ?> <br> 
                   Kode aset&nbsp;:&nbsp;<?= $d['kode_assets'] ?> <br>
                   Serial number&nbsp;:&nbsp;<?= $d['serial_number'] ?> <br>
                   No PO&nbsp;:&nbsp;<?= $d['no_po'] ?> <br>
                   Lokasi&nbsp;:&nbsp;<?= $d['lokasi'] ?> <br>

                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <?php endforeach; ?>
        </body>
    </table>

</body></html>