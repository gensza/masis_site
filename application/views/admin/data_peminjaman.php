<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box mt-4"></div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <?= $this->session->flashdata('message'); ?>
                    <?= form_error('id_qty', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <?= form_error('id_user', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <?= form_error('notes_user', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="page-title mb-3">Pinjam Aset</h4>
                            <form method="POST" action="<?= base_url('DataPeminjaman/trx') ?>">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="form-group col-lg-2 col-md-6">
                                            <select class="custom-select" id="status-select" name="id_qty">
                                                <option selected disabled>Select category</option>
                                                <?php foreach ($category as $c) : ?>
                                                    <option value="<?= $c['id_qty'] ?>"><?= $c['category'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-2 col-md-6">
                                            <select class="custom-select" id="status-select" name="id_user">
                                                <option selected disabled>Select name</option>
                                                <?php foreach ($users_ho as $u) : ?>
                                                    <option value="<?= $u['nama'] ?>"><?= $u['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-2 col-md-6 mt-0">
                                            <input placeholder="Tgl Peminjaman" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" name="date_lend" type="text" id="date" required />
                                        </div>
                                        <div class="form-group col-lg-2 col-md-6 mt-0">
                                            <input placeholder="Tgl Pengembalian" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" name="date_return" type="text" id="date" required />
                                        </div>
                                        <div class="form-group col-lg-3 col-md-6">
                                            <input class="form-control" name="notes_user" type="text" id="notes_user" placeholder="Keterangan" />
                                        </div>
                                        <div class="col-lg-1 col-md-1">
                                            <button type="submit" class="btn btn-success">
                                                Proceed</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row ml-2 mt-2" style="line-height: 0;">
                                <p class="text-muted">Stok Tersedia : &nbsp;</p>
                                <?php foreach ($category as $c) : ?>
                                    <?php
                                    $result = "SELECT COUNT(idle) as idle FROM tb_assets WHERE qty_id = $c[id_qty] AND idle = 'on'";
                                    $count = $this->db_masis_pt->query($result)->row_array();
                                    ?>
                                    <p class="text-muted">
                                        <small><?= $c['category'] . ' : ' . $count['idle'] . '&nbsp;| &nbsp;' ?></small>
                                    </p>
                                <?php endforeach; ?>
                            </div>
                            <hr class="mt-1">

                            <div class="row justify-content-between mb-2 ml-0 mr-0">
                                <label class="page-title"><b>Data Peminjaman</b></label>
                                <a href="<?= base_url('DataPeminjaman/reportDataPeminjaman') ?>" target="_blank" class="btn btn-xs btn-danger"><i class="mdi mdi-file"></i> Report</a>
                            </div>

                            <table id="example" class="table table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Kategori</th>
                                        <th>Merk</th>
                                        <th>Serial Number</th>
                                        <th style="width: 200px;">Status</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Notes</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                                            <span class="btn-label"><i class="fe-x-circle"></i></span>Canceled
                                                        </button>
                                                    <?php
                                                    } elseif ($a['apprvd_y_dept'] == 0 or $a['apprvd_mis_dept'] == 0) {
                                                    ?>
                                                        <button type="button" class="btn btn-warning waves-effect waves-light">
                                                            <span class="btn-label"><i class="mdi mdi-timer-sand"></i></span>Waiting
                                                        </button>
                                                    <?php
                                                    } elseif ($a['lend_status'] == 1) {
                                                    ?>
                                                        <button type="button" class="btn btn-success waves-effect waves-light">
                                                            <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Dipinjamkan
                                                        </button>
                                                    <?php
                                                    } elseif ($a['apprvd_y_dept'] == 2 or $a['apprvd_mis_dept'] == 2) {
                                                    ?>
                                                        <button type="button" class="btn btn-danger waves-effect waves-light">
                                                            <span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span>Rejected
                                                        </button>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= date('d-m-Y H:i:s', strtotime($a['date_lend'])); ?></td>
                                                <td><?= date('d-m-Y', strtotime($a['due_date'])); ?></td>
                                                <td><?= $a['notes'] ?></td>
                                                <?php
                                                if ($a['apprvd_y_dept'] == 0 and $a['apprvd_mis_dept'] == 0 and $a['lend_status'] == 0) {
                                                ?>
                                                    <td>
                                                        <button onclick="Swal.fire({
                                                    title: 'Batalkan Permintaan?',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Ya, Batalkan'
                                                    }).then((result) => {
                                                    if (result.value) {
                                                        window.location.href='DataPeminjaman/cancelRequest/<?= $a['id_lend'] ?>';
                                                        }
                                                    })" class="btn btn-sm btn-danger ml-1">
                                                            Batalkan
                                                        </button>
                                                    </td>
                                                <?php
                                                } elseif ($a['lend_status'] == 2) {
                                                ?>
                                                    <td>
                                                        <h6><i><b>Waiting for return</b></i></h6>
                                                    </td>
                                                <?php
                                                } elseif ($a['lend_status'] == 1) {
                                                ?>
                                                    <td>
                                                        <button onclick="Swal.fire({
                                                    title: 'Kembalikan Asset?',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Ya, Kembalikan'
                                                    }).then((result) => {
                                                    if (result.value) {
                                                        window.location.href='DataPeminjaman/approveReturn/<?= $a['id_lend'] ?>';
                                                        }
                                                    })" class="btn btn-sm btn-info ml-1">
                                                            Kembalikan
                                                        </button>
                                                    </td>
                                                <?php
                                                } elseif ($a['lend_status'] == 3) {
                                                ?>
                                                    <td>
                                                        <h6 style="color: red;"><i><b>Canceled!</b></i></h6>
                                                    </td>
                                                <?php
                                                } else {
                                                ?>
                                                    <td></td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        <?php
                                        }
                                        ?>
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