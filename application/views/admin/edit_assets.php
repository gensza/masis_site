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
                <div class="col-lg-10 col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-between mb-3">
                                <h4 class="header-title">Edit Data</h4>
                            </div>
                            <form action="<?= base_url('DataAssets/updateAssets') ?>" method="POST">
                                <?php foreach ($assets as $a) : ?>
                                <div class="modal-body">
                                    <input type="text" name="id_assets" value="<?= $a['id_assets'] ?>" hidden>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="">Category</label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="<?= $a['qty_id'] ?>" selected><?= $a['category'] ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Merk</label>
                                            <input type="text" class="form-control" id="merk" name="merk"
                                                value="<?= $a['merk'] ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group mb-1 col-4">
                                            <label for="">Serial Number</label>
                                            <input type="text" class="form-control" id="Serial Number"
                                                name="serial_number" value="<?= $a['serial_number'] ?>">
                                        </div>
                                        <div class="form-group mb-1 col-4">
                                            <label for="">PT</label>
                                            <select name="id_pt" id="id_pt" class="form-control" required>
                                                <option value="<?= $a['id_pt'] ?>" selected><?= $a['pt_name'] ?>
                                                </option>
                                                <option value="" disabled></option>
                                                <?php foreach ($pt as $pt) : ?>
                                                <option value="<?= $pt['id_pt'] ?>"><?= $pt['pt_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1 col-4">
                                            <label for="">Lokasi</label>
                                            <input type="text" class="form-control" id="lokasi" name="lokasi"
                                                value="<?= $a['lokasi'] ?>">
                                        </div>
                                    </div>
                                    <div class=" mt-2">
                                        <label for=""><b>
                                                <h5>Spesifikasi</h5>
                                            </b></label>
                                        <div class="row">
                                            <div class="form-group mb-1 col-6">
                                                <label for="">CPU</label>
                                                <input type="text" class="form-control" id="CPU" name="cpu"
                                                    value="<?= $a['cpu'] ?>">
                                            </div>
                                            <div class="form-group mb-1 col-6">
                                                <label for="">RAM</label>
                                                <input type="text" class="form-control" id="RAM" name="ram"
                                                    value="<?= $a['ram'] ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-1 col-6">
                                                <label for="">Storage</label>
                                                <input type="text" class="form-control" id="Storage" name="storage"
                                                    value="<?= $a['storage'] ?>">
                                            </div>
                                            <div class="form-group mb-1 col-6">
                                                <label for="">GPU</label>
                                                <input type="text" class="form-control" id="GPU" name="gpu"
                                                    value="<?= $a['gpu'] ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-1 col-6">
                                                <label for="">Display</label>
                                                <input type="text" class="form-control" id="Display" name="display"
                                                    value="<?= $a['display'] ?>">
                                            </div>
                                            <div class="form-group mb-1 col-6">
                                                <label for="">Lainya</label>
                                                <input type="text" class="form-control" id="Lain-lain" name="lain"
                                                    value="<?= $a['lain'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group mt-3 col-6">
                                            <label for="">Tanggal Pembelian</label>
                                            <input type="date" class="form-control" id="tgl_pembelian"
                                                name="tgl_pembelian" value="<?= $a['tgl_pembelian'] ?>">
                                        </div>
                                        <div class="form-group mt-3 col-6">
                                            <label for="">Kondisi</label>
                                            <select name="kondisi" id="kondisi" class="form-control">
                                                <?php
                                                    if ($a['kondisi'] == 1) {
                                                    ?>
                                                <option value="1" selected>Baik</option>
                                                <?php
                                                    } else {
                                                    ?>
                                                <option value="0" selected>Rusak</option>
                                                <?php
                                                    }
                                                    ?>
                                                <option disabled></option>
                                                <option value="1">Baik</option>
                                                <option value="0">Rusak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-5">
                                            <label for="">User</label>
                                            <input type="text" class="form-control" id="user" name="user"
                                                value="<?= $a['user'] ?>">
                                        </div>
                                        <div class="form-group col-5">
                                            <label for="">Status Kondisi</label>
                                            <select name="status_kondisi" id="status_kondisi" class="form-control">
                                                <option value="<?= $a['status_kondisi'] ?>" selected>
                                                    <?= $a['status_kondisi'] ?></option>
                                                <option value="" disabled></option>
                                                <option value="Baru">Baru</option>
                                                <option value="Bekas">Bekas</option>
                                                <option value="Hibah">Hibah</option>
                                            </select>
                                        </div>
                                        <div class="custom-control custom-checkbox mt-4 ml-2 col-1">
                                            <input type="checkbox" name="idle" class="custom-control-input"
                                                id="customCheck1"
                                                <?php if ($a['idle'] == 'on') {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                            <label class="custom-control-label" for="customCheck1">Idle?</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-5">
                                            <label for="">Fisik</label>
                                            <select name="fisik" id="fisik" class="form-control">
                                                <option value="<?= $a['fisik'] ?>" selected><?= $a['fisik'] ?></option>
                                                <option value="" disabled></option>
                                                <option value="Baik">Baik</option>
                                                <option value="Setengah">Setengah</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-7">
                                            <label for="">Keterangan Fisik</label>
                                            <textarea type="text" class="form-control" id="ket_fisik" name="ket_fisik"
                                                rows="3" placeholder="Ket fisik.."><?= $a['ket_fisik'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-secondary" href="<?= base_url('DataAssets') ?>"><i
                                            class="mdi mdi-arrow-left"></i> Back to Data
                                        Assets</a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                <?php endforeach; ?>
                            </form>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div> <!-- container -->