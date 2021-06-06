<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                        </div>
                        <h4 class="page-title">Data Assets</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?= form_error('kondisi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <?= form_error('category', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card">
                        <div class="card-body">
                            <!-- <div class="row">
                                <div class="col-lg-4 col-12">
                                    <form action="<?= base_url('DataAssets') ?>" method="POST">
                                        <div class="row">
                                            <div class="col-lg-8 col-6">
                                                <select name="filter" id="category" class="form-control">
                                                    <option selected disabled>- Select category - </option>
                                                    <?php foreach ($category as $c) : ?>
                                                        <option value="<?= $c['id_qty'] ?>"><?= $c['category'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-1">
                                                <button type="submit" class="btn btn-sm btn-primary">filter</button>
                                            </div>
                                        </div>
                                        <p class="mt-1">Filter : <?= $filtered ?></p>
                                    </form>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <form action="<?= base_url('DataAssets/filterPt') ?>" method="POST">
                                        <div class="row">
                                            <div class="col-lg-8 col-6">
                                                <select name="filter" id="category" class="form-control" required>
                                                    <option value="" selected disabled>- Select PT - </option>
                                                    <?php foreach ($pt as $pt) : ?>
                                                        <option value="<?= $pt['id_pt'] ?>"><?= $pt['alias'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-1">
                                                <button type="submit" class="btn btn-sm btn-info">filter</button>
                                            </div>
                                        </div>
                                        <p class="mt-1">Filter : <?= $filtered2 ?></p>
                                    </form>
                                </div>
                            </div> -->

                            <div class="row mb-3">
                                <div class="col-lg-8 col-4">
                                    <h4 class="header-title">Data Table</h4>
                                </div>
                                <div class="col-lg-4 col-8 text-right">
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalReport"><i class="mdi mdi-file"></i> Report</button>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalFilter"><i class="mdi mdi-filter"></i> Filter</button>
                                    <a href="<?= base_url('DataAssets/input_assets') ?>" class="btn btn-sm btn-success"><i class="mdi mdi-plus"></i> Add Assets</a>
                                </div>
                            </div>
                            <table id="data_assets" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode </th>
                                        <th>Merk</th>
                                        <th>Kategori</th>
                                        <th>Serial Number</th>
                                        <th>PT</th>
                                        <th>Lokasi</th>
                                        <th>Idle</th>
                                        <th>User</th>
                                        <th>Kondisi</th>
                                        <th>Status</th>
                                        <th width="150px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
            <!-- end page title -->
        </div> <!-- container -->
    </div> <!-- content -->

    <div class="modal fade" id="modal-detail-aset">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Spesifikasi Aset</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered no-margin w-100">
                        <tbody>
                            <tr>
                                <th width="30%">CPU</th>
                                <td><span id="cpu"></span></td>
                            </tr>
                            <tr>
                                <th>RAM</th>
                                <td><span id="ram"></span></td>
                            </tr>
                            <tr>
                                <th>Storage</th>
                                <td><span id="storage"></span></td>
                            </tr>
                            <tr>
                                <th>GPU</th>
                                <td><span id="gpu"></span></td>
                            </tr>
                            <tr>
                                <th>Display</th>
                                <td><span id="display"></span></td>
                            </tr>
                            <tr>
                                <th>Lainya</th>
                                <td><span id="lain"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalReport">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Filter Report Berdasarkan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    <form action="<?= base_url('DataAssets/reportDataAssets') ?>" method="POST" target="_blank">
                        <div class="row">
                            <div class="form-group col-4">
                                <select name="pilih_pt" id="pilih_pt" class="form-control" required>
                                    <option value="Y">Semua PT</option>
                                    <?php foreach ($pt_add as $p) : ?>
                                        <option value="<?= $p['id_pt'] ?>"><?= $p['alias'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-5">
                                <select name="pilih_category" id="pilih_category" class="form-control" required>
                                    <option value="Y">Semua Category</option>
                                    <?php foreach ($category as $c) : ?>
                                        <option value="<?= $c['id_qty'] ?>"><?= $c['category'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="custom-control custom-checkbox mt-1 col-3">
                                <input type="checkbox" name="cb_idle" class="custom-control-input" id="cb_idle">
                                <label class="custom-control-label" for="cb_idle">Idle</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-5">
                                <select name="pilih_kondisi" id="pilih_kondisi" class="form-control" required>
                                    <option value="Y">Semua Kondisi</option>
                                    <option value="1">Baik</option>
                                    <option value="0">Rusak</option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <input type="text" class="form-control" id="cari_lokasi" name="cari_lokasi" placeholder="Lokasi">
                            </div>
                            <div class="form-group col-4">
                                <select name="status_unit" id="status_unit" class="form-control" required>
                                    <option value="Y">Semua Status</option>
                                    <option value="1">Tersedia</option>
                                    <option value="0">Dipinjam</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-danger">Cetak Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFilter">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Filter Berdasarkan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    <form action="<?= base_url('DataAssets') ?>" method="POST">
                        <div class="row">
                            <input type="hidden" name="filter" value="filter">
                            <div class="form-group col-4">
                                <select name="pilih_pt" id="pilih_pt" class="form-control" required>
                                    <option value="Y">Semua PT</option>
                                    <?php foreach ($pt_add as $p) : ?>
                                        <option value="<?= $p['id_pt'] ?>"><?= $p['alias'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-5">
                                <select name="pilih_category" id="pilih_category" class="form-control" required>
                                    <option value="Y">Semua Category</option>
                                    <?php foreach ($category as $c) : ?>
                                        <option value="<?= $c['id_qty'] ?>"><?= $c['category'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="custom-control custom-checkbox mt-1 col-3">
                                <input type="checkbox" name="cb_idle2" class="custom-control-input" id="cb_idle2">
                                <label class="custom-control-label" for="cb_idle2">Idle</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-5">
                                <select name="pilih_kondisi" id="pilih_kondisi" class="form-control" required>
                                    <option value="Y">Semua Kondisi</option>
                                    <option value="1">Baik</option>
                                    <option value="0">Rusak</option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <input type="text" class="form-control" id="cari_lokasi" name="cari_lokasi" placeholder="Lokasi">
                            </div>
                            <div class="form-group col-4">
                                <select name="status_unit" id="status_unit" class="form-control" required>
                                    <option value="Y">Semua Status</option>
                                    <option value="1">Tersedia</option>
                                    <option value="0">Dipinjam</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-danger">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            // get Edit Product
            $(document).on('click', '#detail_aset', function() {

                var cpu = $(this).data('cpu');
                var ram = $(this).data('ram');
                var storage = $(this).data('storage');
                var gpu = $(this).data('gpu');
                var display = $(this).data('display');
                var lain = $(this).data('lain');
                // Set data to Form Edit
                $('#cpu').text(cpu);
                $('#ram').text(ram);
                $('#storage').text(storage);
                $('#gpu').text(gpu);
                $('#display').text(display);
                $('#lain').text(lain);
            });
        });

        var table;
        $(document).ready(function() {

            //datatables
            table = $('#data_assets').DataTable({

                "processing": true,
                "serverSide": true,
                "order": [],

                "scrollY": 400,
                "scrollX": true,

                "ajax": {
                    "url": "<?php echo site_url('DataAssets/get_data_assets') ?>",
                    "type": "POST"
                },


                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                }, ],

            });

        });

        function edit_assets(id_assets) {

            window.location.href = '<?= base_url('DataAssets/editAssets/') ?>' + id_assets;
        }

        function delete_assets(id_assets, qty_id) {

            Swal.fire({
                text: "Yakin akan menghapus Data ini?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya Hapus!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = '<?= base_url('DataAssets/deleteAssets/') ?>' + id_assets + '/' + qty_id;
                }
            });
        }
    </script>