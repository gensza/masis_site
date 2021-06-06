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
                            <div class="row">
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
                            </div>

                            <div class="row mt-3 mb-3">
                                <div class="col-lg-8 col-4">
                                    <h4 class="header-title ml-2">Data Table</h4>
                                </div>
                                <div class="col-lg-4 col-8 text-right">
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalReport"><i class="mdi mdi-file"></i> Report</button>
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAssets"><i class="mdi mdi-plus"></i> Add Assets</button>
                                </div>
                            </div>
                            <table id="example" class="table table-striped">
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
                                    <?php $no = 1  ?>
                                    <?php foreach ($assets as $a) : ?>
                                        <tr>
                                            <td><?= $no++  ?></td>
                                            <td><?= $a['kode_assets'] ?></td>
                                            <td><?= $a['merk'] ?></td>
                                            <td><?= $a['category'] ?></td>
                                            <td><?= $a['serial_number'] ?></td>
                                            <td><?= $a['alias'] ?></td>
                                            <td><?= $a['lokasi'] ?></td>
                                            <td><?php if ($a['idle'] == 'on') {
                                                    echo "Ya";
                                                } ?>
                                            </td>
                                            <td><?= $a['user'] ?></td>
                                            <td>
                                                <?php
                                                if ($a['kondisi'] == 1) {
                                                ?>
                                                    <p>BAIK</p>
                                                <?php
                                                } else {
                                                ?>
                                                    <p>RUSAK</p>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($a['status_unit'] == 1 and $a['kondisi'] == 1) {
                                                ?>
                                                    <p style="color: green;"><b>Tersedia!</b></p>
                                                <?php
                                                } elseif ($a['kondisi'] == 0) {
                                                ?>
                                                    <p style="color: red;"><b>Rusak</b></p>
                                                <?php
                                                } else {
                                                ?>
                                                    <p style="color: blue;"><b>Dipinjam</b></p>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <a id="detail_aset" class="btn btn-sm btn-info mr-2" data-toggle="modal" data-target="#modal-detail-aset" data-cpu="<?= $a['cpu'] ?>" data-ram="<?= $a['ram'] ?>" data-storage="<?= $a['storage'] ?>" data-gpu="<?= $a['gpu'] ?>" data-display="<?= $a['display'] ?>" data-lain="<?= $a['lain'] ?>"><i class="mdi mdi-eye" style="color: white;"></i></a>
                                                    <?php
                                                    if ($a['status_unit'] == 1) {
                                                    ?>
                                                        <div class="row">
                                                            <?= anchor('DataAssets/editAssets/' . $a['id_assets'], '<button class="btn btn-sm btn-warning ml-1"><i
                                                        class="mdi mdi-lead-pencil"></i></button>') ?>
                                                            <?php
                                                            if ($a['kondisi'] == 1) {
                                                            ?>
                                                                <button onclick="Swal.fire({
                                                        title: 'Hapus Aset?',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#d33',
                                                        cancelButtonColor: '#3085d6',
                                                        confirmButtonText: 'Ya, Hapus'
                                                        }).then((result) => {
                                                        if (result.value) {
                                                            window.location.href='DataAssets/deleteAssets/<?= $a['id_assets'] . '/' . $a['qty_id'] ?>';
                                                            }
                                                        })" class="btn btn-sm btn-danger ml-1">
                                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                                </button>
                                                            <?php
                                                            } else {
                                                            }
                                                            ?>
                                                        </div>
                                                    <?php
                                                    } else {
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
    <div class="modal fade" id="modalAssets" tabindex="-1" aria-labelledby="modalAssetsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newRoleModalLabel">Add New Assets</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <form action="<?= base_url('DataAssets/addAssets') ?>" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-3">
                                <label for="">Category</label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="" selected disabled>- Select category - </option>
                                    <?php foreach ($category as $c) : ?>
                                        <option value="<?= $c['id_qty'] ?>"><?= $c['category'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="">Merk</label>
                                <input type="text" class="form-control" id="merk" name="merk" placeholder="Merk">
                            </div>
                            <div class="form-group col-3">
                                <label for="">No PO</label>
                                <input type="text" class="form-control" id="no_po" name="no_po" placeholder="No PO">
                            </div>
                            <div class="form-group col-3">
                                <label for="">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" placeholder="Rp.">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-1 col-4">
                                <label for="">Serial Number</label>
                                <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Serial Number">
                            </div>
                            <div class="form-group mb-1 col-4">
                                <label for="">PT</label>
                                <select name="id_pt" id="id_pt" class="form-control" required>
                                    <option value="" selected disabled>- Select PT - </option>
                                    <?php foreach ($pt_add as $p) : ?>
                                        <option value="<?= $p['id_pt'] ?>"><?= $p['alias'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mb-1 col-4">
                                <label for="">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi">
                            </div>

                        </div>
                        <div class="mt-2">
                            <label for="">Spesifikasi</label>
                            <div class="row">
                                <div class="form-group mb-1 col-6">
                                    <input type="text" class="form-control" id="CPU" name="cpu" placeholder="CPU">
                                </div>
                                <div class="form-group mb-1 col-6">
                                    <input type="text" class="form-control" id="RAM" name="ram" placeholder="RAM">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-1 col-6">
                                    <input type="text" class="form-control" id="Storage" name="storage" placeholder="Storage">
                                </div>
                                <div class="form-group mb-1 col-6">
                                    <input type="text" class="form-control" id="GPU" name="gpu" placeholder="GPU">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-1 col-6">
                                    <input type="text" class="form-control" id="Display" name="display" placeholder="Display">
                                </div>
                                <div class="form-group mb-1 col-6">
                                    <input type="text" class="form-control" id="Lain-lain" name="lain" placeholder="Lain-lain ..">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mt-2 col-6">
                                <label for="">Tanggal Pembelian</label>
                                <input type="date" class="form-control" id="tgl_pembelian" name="tgl_pembelian" placeholder="Tgl Pembelian">
                            </div>
                            <div class="form-group mt-2 col-6">
                                <label for="">Kondisi</label>
                                <select name="kondisi" id="kondisi" class="form-control" required>
                                    <option value="" selected disabled>- Select kondisi - </option>
                                    <option value="1">Baik</option>
                                    <option value="0">Rusak</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-5">
                                <label for="">User</label>
                                <input type="text" class="form-control" id="user" name="user" placeholder="User">
                            </div>
                            <div class="form-group col-5">
                                <label for="">Status Kondisi</label>
                                <select name="status_kondisi" id="status_kondisi" class="form-control">
                                    <option value="" selected disabled>- Select status - </option>
                                    <option value="Baru">Baru</option>
                                    <option value="Bekas">Bekas</option>
                                    <option value="Hibah">Hibah</option>
                                </select>
                            </div>
                            <div class="custom-control custom-checkbox mt-4 ml-2 col-1">
                                <input type="checkbox" name="idle" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Idle?</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-5">
                                <label for="">Fisik</label>
                                <select name="fisik" id="fisik" class="form-control">
                                    <option value="" selected disabled>- Select Fisik - </option>
                                    <option value="Baik">Baik</option>
                                    <option value="Setengah">Setengah</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group col-7">
                                <label for="">Keterangan Fisik</label>
                                <textarea type="text" class="form-control" id="ket_fisik" name="ket_fisik" rows="3" placeholder="Ket fisik..">
                                </textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

        $(document).ready(function() {
            $('#example').DataTable({
                "scrollY": 400,
                "scrollX": true
            });
        });
    </script>