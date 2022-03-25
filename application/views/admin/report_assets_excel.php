<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en">

<head>
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
                  margin-left: -38px;
                  table-layout: fixed;
                  page-break-after: fixed;

            }

            body td {
                  border-top: 1px solid #e3e3e3;
                  padding: 3px;
                  font-size: 10px;
                  table-layout: fixed;
            }

            body tr {
                  border-top: 1px solid #e3e3e3;
                  padding: 0px;
                  font-size: 12px;
            }

            .tbl {
                  background: #EAE9F5
            }

            .ket {
                  margin-left: -20px;
                  font-size: 13px;
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
</head>

<body>

      <p class="title"><b>REPORT DATA ASSETS</b></p>

      <div class="outtable">
            <table border="1">

                  <head>
                        <tr>
                              <th class="tbl" style="padding: 3px;">No</th>
                              <th class="tbl" style="padding: 3px;">Kode Assets</th>
                              <th class="tbl" style="padding: 3px;">Kategori</th>
                              <th class="tbl" style="padding: 3px;">Merk</th>
                              <th class="tbl" style="padding: 3px;">No.PO</th>
                              <th class="tbl" style="padding: 3px;">Harga</th>
                              <th class="tbl" style="padding: 3px;">Serial Number</th>
                              <th class="tbl" style="padding: 3px;">PT</th>
                              <th class="tbl" style="padding: 3px;">Lokasi</th>
                              <th class="tbl" style="padding: 3px;">CPU</th>
                              <th class="tbl" style="padding: 3px;">Storage</th>
                              <th class="tbl" style="padding: 3px;">Display</th>
                              <th class="tbl" style="padding: 3px;">RAM</th>
                              <th class="tbl" style="padding: 3px;">GPU</th>
                              <th class="tbl" style="padding: 3px;">Lain-lain</th>
                              <th class="tbl" style="padding: 3px;">Tgl Pembelian</th>
                              <th class="tbl" style="padding: 3px;">Kondisi</th>
                              <th class="tbl" style="padding: 3px;">User</th>
                              <th class="tbl" style="padding: 3px;">Status Kondisi</th>
                              <th class="tbl" style="padding: 3px;">Idle</th>
                              <th class="tbl" style="padding: 3px;">Fisik</th>
                              <th class="tbl" style="padding: 3px;">Ket Fisik</th>
                        </tr>
                  </head>

                  <body>
                        <?php $no = 1; ?>
                        <?php foreach ($data_assets as $d) : ?>
                              <tr>
                                    <td style="width: 10px;"><?= $no; ?></td>
                                    <td style="width: 60px;"><?= $d['kode_assets']; ?></td>
                                    <td style="width: 50px;"><?= $d['category']; ?></td>
                                    <?php
                                    if ($d['merk'] == NULL) {
                                          echo "<td style='width: 60px;'>&nbsp;</td>";
                                    } else {
                                          $merk = $d['merk'];
                                          echo "<td style='width: 60px;'>$merk</td>";
                                    }
                                    ?>
                                    <?php
                                    if ($d['no_po'] == NULL) {
                                          echo "<td style='width: 40px;'>&nbsp;</td>";
                                    } else {
                                          $no_po = $d['no_po'];
                                          echo "<td style='width: 40px;'>$no_po</td>";
                                    }
                                    ?>
                                    <td style="width: 50px;"><?= $d['harga']; ?></td>
                                    <?php
                                    if ($d['serial_number'] == NULL) {
                                          echo "<td style='width: 70px;'>&nbsp;</td>";
                                    } else {
                                          $sn = $d['serial_number'];
                                          echo "<td style='width: 70px;'>$sn</td>";
                                    }
                                    ?>
                                    <td style="width: 80px;"><?= $d['alias']; ?></td>
                                    <td style="width: 40px;"><?= $d['lokasi']; ?></td>
                                    <td style="width: 30px;"><?= $d['cpu']; ?></td>
                                    <?php
                                    if ($d['storage'] == NULL) {
                                          echo "<td style='width: 40px;'>&nbsp;</td>";
                                    } else {
                                          $st = $d['storage'];
                                          echo "<td style='width: 40px;'>$st</td>";
                                    }
                                    ?>
                                    <?php
                                    if ($d['display'] == NULL) {
                                          echo "<td style='width: 40px;'>&nbsp;</td>";
                                    } else {
                                          $dp = $d['display'];
                                          echo "<td dpyle='width: 40px;'>$dp</td>";
                                    }
                                    ?>
                                    <td style="width: 30px;"><?= $d['ram']; ?></td>
                                    <td style="width: 40px;"><?= $d['gpu']; ?></td>
                                    <?php
                                    if ($d['lain'] == NULL) {
                                          echo "<td style='width: 65px;'>&nbsp;</td>";
                                    } else {
                                          $lain = $d['lain'];
                                          echo "<td style='width: 65px;'>$lain</td>";
                                    }
                                    ?>
                                    <td style="width: 55px;"><?= $d['tgl_pembelian']; ?></td>
                                    <?php
                                    if ($d['kondisi'] == 1) {
                                          echo "<td style='width: 40px;'>Baik</td>";
                                    } else {
                                          echo "<td style='width: 40px;'>Rusak</td>";
                                    }
                                    ?>
                                    <td style="width: 30px;"><?= $d['user']; ?></td>
                                    <td style="width: 40px;"><?= $d['status_kondisi']; ?></td>
                                    <?php
                                    if ($d['idle'] == 'on') {
                                          echo "<td style='width: 23px;'>Ya</td>";
                                    } else {
                                          echo "<td style='width: 23px;'>&nbsp;</td>";
                                    }
                                    ?>
                                    <td style="width: 40px;"><?= $d['fisik']; ?></td>
                                    <?php
                                    if ($d['ket_fisik'] == NULL) {
                                          echo "<td style='width: 55px;'>&nbsp;</td>";
                                    } else {
                                          $kf = $d['ket_fisik'];
                                          echo "<td style='width: 55px;'>$kf</td>";
                                    }
                                    ?>
                                    <?php
                                    // if($d['status_unit'] == '1')
                                    // {
                                    // echo "<td>Tersedia</td>";
                                    // }else{
                                    // echo "<td>Dipinjam</td>";
                                    // }
                                    ?>
                              </tr>
                              <?php $no++; ?>
                        <?php endforeach; ?>
                  </body>
            </table>
      </div>
</body>

</html>