<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Data Assets</title>
    <style>
        .title {
            text-align: center;
        }

        .outtable {
            padding: 20px;
            /* border: 1px solid #e3e3e3; */
            /* width: 600px; */
            border-radius: 5px;
        }

        table {
            border-collapse: collapse;
            font-family: arial;
            /* color: #5E5B5C; */
            /* margin-left: -38px; */
            table-layout: fixed;
            page-break-after: fixed;

        }

        body td {
            border-top: 1px solid #e3e3e3;
            padding: 3px;
            /* font-size: 10px; */
            table-layout: fixed;
        }

        body tr {
            border-top: 1px solid #e3e3e3;
            padding: 0px;
            /* font-size: 12px; */
        }

        .tbl {
            background: #EAE9F5
        }

        .ket {
            /* margin-left: -20px; */
            /* font-size: 13px; */
            margin-top: 15px;
            color: #484848;
        }

        .spc {
            color: white;
        }

        .aleft {
            text-align: left;
        }
    </style>
</head><body>

    <p class="title"><b>REPORT DATA ASSETS</b></p>


    <div class="outtable">
        <table border="1">

            <head>
                <tr>
                    <th class="tbl" style="padding: 3px;">No</th>
                    <th class="tbl" style="padding: 3px;">Name</th>
                    <th class="tbl" style="padding: 3px;">Kategori</th>
                    <th class="tbl" style="padding: 3px;">Merk</th>
                    <th class="tbl" style="padding: 3px;">Serial Number</th>
                    <th class="tbl" style="padding: 3px;">Status</th>
                    <th class="tbl" style="padding: 3px;">Tgl Pinjam</th>
                    <th class="tbl" style="padding: 3px;">Jatuh Tempo</th>
                    <th class="tbl" style="padding: 3px;">Notes</th>
                </tr>
            </head>

            <body>
            <?php $no = 1  ?>
            <?php foreach ($assets as $a) : ?>
                <?php
                if ($a['apprvd_y_dept'] == 1 and $a['apprvd_mis_dept'] == 1 and $a['lend_status'] == 0 or $a['lend_status'] == 3) {
                } else {
                ?>
                    <tr>
                        <td><?= $no++  ?></td>
                        <td><?= $a['nama'] ?></td>
                        <td><?= $a['category'] ?></td>
                        <td><?= $a['merk'] ?></td>
                        <td><?= $a['serial_number'] ?></td>

                        <td>
                            <?php
                            if ($a['lend_status'] == 3) {
                            ?>
                                <button type="button" class="btn btn-danger waves-effect waves-light">
                                    <span class="btn-label"><i class="fe-x-circle"></i></span>CANCELED
                                </button>
                            <?php
                            } elseif ($a['apprvd_y_dept'] == 0 or $a['apprvd_mis_dept'] == 0) {
                            ?>
                                <button type="button" class="btn btn-warning waves-effect waves-light">
                                    <span class="btn-label"><i class="mdi mdi-timer-sand"></i></span>WAITING
                                </button>
                            <?php
                            } elseif ($a['lend_status'] == 1) {
                            ?>
                                <button type="button" class="btn btn-success waves-effect waves-light">
                                    <span class="btn-label"><i class="mdi mdi-check-all"></i></span>DIPINJAMKAN
                                </button>
                            <?php
                            } elseif ($a['apprvd_y_dept'] == 2 or $a['apprvd_mis_dept'] == 2) {
                            ?>
                                <button type="button" class="btn btn-danger waves-effect waves-light">
                                    <span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span>REJECTED
                                </button>
                            <?php
                            }
                            ?>
                        </td>
                        <td><?= date('d-m-Y H:i:s', strtotime($a['date_lend'])); ?></td>
                        <td><?= date('d-m-Y', strtotime($a['due_date'])); ?></td>
                        <td><?= $a['notes'] ?></td>
                        
                    </tr>
                <?php
                }
                ?>
            <?php endforeach; ?>
            </body>
        </table>
    </div>

</body></html>