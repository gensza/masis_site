<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Form Peminjaman</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-body">
                        <h5 class="card-title">Approve Department Peminjam</h5>
                        <div class="form-group mb-2">
                            <select class="custom-select" id="deptPem" onchange="deptPemChange()">
                                <option selected disabled>Select opsi</option>
                                <option value="1">Approved</option>
                                <option value="2">Reject</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-body">
                        <h5 class="card-title">Approve Department MIS</h5>
                        <div class="form-group mb-2">
                            <select class="custom-select" id="deptMis" onchange="deptMisChange()">
                                <option selected disabled>Select opsi</option>
                                <option value="1">Approved</option>
                                <option value="2">Reject</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="border p-3 mt-4 mt-lg-0 rounded">
                                        <h4 class="header-title mb-3">Detail Asset</h4>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <?php foreach ($asset as $a) : ?>
                                                    <tr>
                                                        <td>Kode :</td>
                                                        <td><?= $a['kode_assets']  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Merk : </td>
                                                        <td><?= $a['merk']  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Serial Number: </td>
                                                        <td><?= $a['serial_number']  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>CPU :</td>
                                                        <td><?= $a['cpu']  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>RAM:</td>
                                                        <td><?= $a['ram']  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Storage :</td>
                                                        <td><?= $a['storage']  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>GPU:</td>
                                                        <td><?= $a['gpu']  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Display :</td>
                                                        <td><?= $a['display']  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lainnya :</td>
                                                        <td><?= $a['lain']  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kategori : </td>
                                                        <td><?= $a['category']  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Pembelian :</td>
                                                        <td><?= $a['tgl_pembelian']  ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-lg-8">
                                    <div class="tab-content p-3">
                                        <div class="tab-pane fade active show" id="custom-v-pills-billing"
                                            role="tabpanel" aria-labelledby="custom-v-pills-billing-tab">
                                            <h4 class="header-title">Form Data</h4>
                                            <form action="<?= base_url('PermintaanPeminjaman/trxLend') ?>"
                                                method="POST">
                                                <input type="text" name="id_assets" value="<?= $a['id_assets'] ?>"
                                                    hidden>
                                                <input type="text" name="id_users" value="<?= $nama ?>" hidden>
                                                <input type="text" name="qty_id" value="<?= $a['qty_id'] ?>" hidden>
                                                <input type="text" id="dept_pem" name="dept_pem" hidden>
                                                <input type="text" id="dept_mis" name="dept_mis" hidden>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="billing-first-name">Full Name</label>
                                                            <input class="form-control bg-light" type="text" id="name"
                                                                name="name" value="<?= urldecode($nama) ?>" readonly />
                                                        </div>
                                                    </div>
                                                </div> <!-- end row -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="billing-first-name">Department</label>
                                                            <input class="form-control bg-light" type="text"
                                                                id="department" name="department" value="" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="billing-first-name">position</label>
                                                            <input class="form-control bg-light" type="text"
                                                                id="position" name="position" value="" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php foreach ($trx as $l) : ?>
                                                <div class=" row">
                                                    <div class="col-md-6">
                                                        <label for="billing-town-city">Date Lend</label>
                                                        <input type="text" name="id_lend" value="<?= $l['id_lend'] ?>"
                                                            hidden>
                                                        <input class="form-control bg-light" type="text"
                                                            name="date_lend" value="<?= $l['date_lend'] ?>" readonly />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="billing-state">Date of Return</label>
                                                            <input class="form-control bg-light" name="date_return"
                                                                value="<?= $l['due_date'] ?>" type="text" readonly />
                                                        </div>
                                                    </div>
                                                </div> <!-- end row -->
                                                <?php endforeach; ?>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="example-textarea">Notes :</label>
                                                            <textarea class="form-control" id="example-textarea"
                                                                rows="3" name="notes" placeholder="Write some note.."
                                                                required></textarea>
                                                        </div>
                                                    </div>
                                                </div> <!-- end row -->
                                                <div class="row mt-2">
                                                    <div class="col-sm-6">
                                                        <a class="btn btn-secondary"
                                                            href="<?= base_url('PermintaanPeminjaman/formAssets/' . $l['id_lend'] . '/' . $a['qty_id'] . '/' . $nama) ?>"><i
                                                                class="mdi mdi-arrow-left"></i> Back to Select
                                                            Assets</a>
                                                    </div> <!-- end col -->
                                                    <div class="col-sm-6">
                                                        <div class="text-sm-right mt-2 mt-sm-0">
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="mdi mdi-archive-arrow-down-outline mr-1"></i>
                                                                Proceed for
                                                                approved</button>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container -->
</div> <!-- content -->