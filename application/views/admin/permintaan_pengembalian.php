<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Permintaan Pengembalian</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Kategori</th>
                                        <th>Serial Number</th>
                                        <th>Dept Peminjam</th>
                                        <th>Dept MIS</th>
                                        <th>Status</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Tgl Kembali</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1  ?>
                                    <?php foreach ($assets as $a) : ?>
                                    <tr>
                                        <td><?= $no++  ?></td>
                                        <td><?= $a['nama'] ?></td>
                                        <td><?= $a['category'] ?></td>
                                        <td><?= $a['serial_number'] ?></td>
                                        <td>
                                            <?php
                                                if ($a['apprvd_y_dept'] == 0) {
                                                ?>
                                            <h5><span class="badge bg-soft-warning text-warning"><i
                                                        class="mdi mdi-timer-sand"></i>waiting</span>
                                            </h5>
                                            <?php
                                                } else if ($a['apprvd_y_dept'] == 1) {
                                                ?>
                                            <h5><span class="badge badge-success">Approved</span></h5>
                                            <?php
                                                } else {
                                                ?>
                                            <h5><span class="badge badge-danger">Rejected</span></h5>
                                            <?php
                                                }
                                                ?>
                                        </td>
                                        <td>
                                            <?php
                                                if ($a['apprvd_mis_dept'] == 0) {
                                                ?>
                                            <h5><span class="badge bg-soft-warning text-warning"><i
                                                        class="mdi mdi-timer-sand"></i>waiting</span>
                                            </h5>
                                            <?php
                                                } else if ($a['apprvd_mis_dept'] == 1) {
                                                ?>
                                            <h5><span class="badge badge-success">Approved</span></h5>
                                            <?php
                                                } else {
                                                ?>
                                            <h5><span class="badge badge-danger">Rejected</span></h5>
                                            <?php
                                                }
                                                ?>
                                        </td>
                                        <td>
                                            <?php
                                                if ($a['lend_status'] == 2) {
                                                ?>
                                            <button type="button" class="btn btn-success waves-effect waves-light">
                                                <span class="btn-label"><i
                                                        class="mdi mdi-check-all"></i></span>Dipinjamkan
                                                <?php
                                                }
                                                    ?>
                                        </td>
                                        <td><?= date('d-m-Y H:i:s', strtotime($a['date_lend'])); ?></td>
                                        <td><?= date('d-m-Y', strtotime($a['due_date'])); ?></td>
                                        <td><?= date('d-m-Y H:i:s', strtotime($a['date_return'])); ?></td>
                                        <td>
                                            <button onclick="Swal.fire({
                                                title: 'Setujui Pengembalian?',
                                                showCancelButton: true,
                                                confirmButtonColor: 'green',
                                                cancelButtonColor: '#3085d6',
                                                confirmButtonText: 'Ya, Setujui'
                                                }).then((result) => {
                                                if (result.value) {
                                                    window.location.href='PermintaanPengembalian/pengembalianAssets/<?= $a['id_lend'] . '/' . $a['assets_id'] . '/' . $a['qty_id'] ?>';
                                                    }
                                                })" class="btn btn-sm btn-primary">
                                                Setujui
                                            </button>

                                            <button onclick="Swal.fire({
                                                title: 'Batalkan Pengembalian?',
                                                showCancelButton: true,
                                                confirmButtonColor: '#d33',
                                                cancelButtonColor: '#3085d6',
                                                confirmButtonText: 'Ya, Batalkan'
                                                }).then((result) => {
                                                if (result.value) {
                                                    window.location.href='permintaanPengembalian/cancelReturn/<?= $a['id_lend'] ?>';
                                                    }
                                                })" class="btn btn-sm btn-danger ml-1">
                                                Batalkan
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->