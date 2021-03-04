<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Permintaan Peminjaman</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="scroll-horizontal-datatable" class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Kategori</th>
                                        <th>Dept Peminjam</th>
                                        <th>Dept MIS</th>
                                        <th>Keterangan</th>
                                        <th width="120px">Status</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Jatuh Tempo</th>
                                        <th width="100px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1  ?>
                                    <?php foreach ($assets as $a) : ?>
                                    <tr>
                                        <td><?= $no++  ?></td>
                                        <td><?= $a['nama'] ?></td>
                                        <td><?= $a['category'] ?></td>
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
                                        <td><?= $a['notes_user'] ?></td>
                                        <td>
                                            <?php
                                                if ($a['apprvd_y_dept'] == 0 or $a['apprvd_mis_dept'] == 0) {
                                                ?>
                                            <button type="button" class="btn btn-warning waves-effect waves-light">
                                                <span class="btn-label"><i class="mdi mdi-timer-sand"></i></span>Waiting
                                            </button>
                                            <?php
                                                } elseif ($a['lend_status'] == 1) {
                                                ?>
                                            <button type="button" class="btn btn-success waves-effect waves-light">
                                                <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Dipinjam
                                            </button>
                                            <?php
                                                } elseif ($a['apprvd_y_dept'] == 2 or $a['apprvd_mis_dept'] == 2) {
                                                ?>
                                            <button type="button" class="btn btn-danger waves-effect waves-light">
                                                <span class="btn-label"><i
                                                        class="mdi mdi-close-circle-outline"></i></span>Rejected
                                            </button>
                                            <?php
                                                } elseif ($a['apprvd_y_dept'] == 1 and $a['apprvd_mis_dept'] == 1 and $a['lend_status'] == 0) {
                                                ?>
                                            <button type="button" class="btn btn-secondary waves-effect waves-light">
                                                <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Returned
                                            </button>
                                            <?php
                                                }
                                                ?>
                                        </td>
                                        <td><?= date('d-m-Y H:i:s', strtotime($a['date_lend'])); ?></td>
                                        <td><?= date('d-m-Y', strtotime($a['due_date'])); ?></td>
                                        <td>
                                            <div class="row">
                                                <button onclick="Swal.fire({
                                                title: 'Tolak Permintaan?',
                                                showCancelButton: true,
                                                confirmButtonColor: '#d33',
                                                cancelButtonColor: '#3085d6',
                                                confirmButtonText: 'Ya, Tolak'
                                                }).then((result) => {
                                                if (result.value) {
                                                    window.location.href='PermintaanPeminjaman/tolakPermintaan/<?= $a['id_lend'] ?>';
                                                    }
                                                })" class="btn btn-sm btn-danger">
                                                    Tolak
                                                </button>
                                                <?= anchor('PermintaanPeminjaman/formAssets/' . $a['id_lend'] . '/' . $a['qty_id'] . '/' . $a['nama'], '<button class="btn btn-sm btn-success ml-1">Approve</button>') ?>
                                            </div>
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