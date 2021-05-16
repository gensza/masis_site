<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Data Assets</h4>
                    </div>
                </div>
            </div> -->
            <!-- end page title -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Data Assets Tersedia</h4>
                            <h5 class="text-muted"><?= urldecode($nama) ?> | <?= $category['category'] ?></h5>
                            <div class="table-responsive">
                                <table id="example" class="table w-100 table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Kode </th>
                                            <th>Merk</th>
                                            <th>serial number</th>
                                            <th>CPU</th>
                                            <th>RAM</th>
                                            <th>Stotage</th>
                                            <th>GPU</th>
                                            <th>Display</th>
                                            <th>Lainya</th>
                                            <th>Kategori</th>
                                            <th>Tgl Pembelian</th>
                                            <th>Kondisi</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1  ?>
                                        <?php foreach ($assets as $a) : ?>
                                            <tr>
                                                <td><?= $no++  ?></td>
                                                <td><?= $a['kode_assets'] ?></td>
                                                <td><?= $a['merk'] ?></td>
                                                <td><?= $a['serial_number'] ?></td>
                                                <td><?= $a['cpu'] ?></td>
                                                <td><?= $a['ram'] ?></td>
                                                <td><?= $a['storage'] ?></td>
                                                <td><?= $a['gpu'] ?></td>
                                                <td><?= $a['display'] ?></td>
                                                <td><?= $a['lain'] ?></td>
                                                <td><?= $a['category'] ?></td>
                                                <td><?= $a['tgl_pembelian'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($a['kondisi'] == 1) {
                                                    ?>
                                                        <h5><span><b>BAIK</b></span></h5>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($a['status_unit'] == 1) {
                                                    ?>
                                                        <h5><span class="badge badge-success">Tersedia</span></h5>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?= anchor('permintaanPeminjaman/detailPeminjaman/' . $a['id_assets'] . '/' . $id_lend . '/' . $nama, '<button class="btn btn-sm btn-primary">Pinjamkan</button>') ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->