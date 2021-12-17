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
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-between mb-3">
                                <h4 class="header-title">Edit Data</h4>
                            </div>
                            <form action="<?= base_url('DataAssets/updateAssets') ?>" method="POST">
                                <?php foreach ($assets as $a) : ?>
                                    <input type="text" name="id_assets" value="<?= $a['id_assets'] ?>" hidden>
                                    <div class="row">
                                        <div class="form-group col-3">
                                            <label for="">Category*</label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="<?= $a['qty_id'] ?>" selected><?= $a['category'] ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="">Kode Asset</label>
                                            <input type="text" class="form-control" id="kode_asset" name="kode_asset" value="<?= $a['kode_assets'] ?>" placeholder="Kode Asset" required>
                                        </div>
                                        <div class="form-group col-2">
                                            <label for="">Type</label>
                                            <input type="text" class="form-control" id="type" name="type" value="<?= $a['type'] ?>" placeholder="Type">
                                        </div>
                                        <div class="form-group mb-1 col-2">
                                            <label for="">Serial Number</label>
                                            <input type="text" class="form-control" id="serial_number" name="serial_number" value="<?= $a['serial_number'] ?>" placeholder="Serial Number">
                                        </div>
                                        <div class="form-group mb-1 col-2">
                                            <label for="">Satuan</label>
                                            <select name="satuan" id="satuan" class="form-control">
                                                <option value="<?= $a['satuan'] ?>" selected><?= $a['satuan'] ?>
                                                <option value="" disabled></option>
                                                <option value="unit">Unit</option>
                                                <option value="pcs">Pcs</option>
                                                <option value="set">Set</option>
                                                <option value="tower">Tower</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group mb-1 col-3">
                                            <label for="">PT*</label>
                                            <select name="id_pt" id="id_pt" class="form-control" required>
                                                <option value="<?= $a['id_pt'] ?>" selected><?= $a['id_pt'] ?>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1 col-3">
                                            <label for="">Divisi</label>
                                            <select name="divisi" id="divisi" class="form-control" required>
                                                <option value="<?= $a['id_divisi'] ?>" selected><?= $a['id_divisi'] ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-2">
                                            <label for="">User</label>
                                            <input type="text" class="form-control" id="user" name="user" value="<?= $a['user'] ?>" placeholder="User">
                                        </div>
                                        <div class="form-group mb-1 col-2">
                                            <label for="">Lokasi</label>
                                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= $a['lokasi'] ?>" placeholder="Lokasi">
                                        </div>
                                        <div class="form-group col-2">
                                            <label for="">No PO</label>
                                            <input type="text" class="form-control" id="no_po" name="no_po" value="<?= $a['no_po'] ?>" placeholder="No PO">
                                        </div>
                                    </div>

                                    <hr class="mt-1 mb-1">
                                    <div class="mb-0">
                                        <label for="">Spesifikasi</label>
                                        <div class="row">
                                            <div class="form-group mb-1 col-3">
                                                <input type="text" class="form-control" id="merk" name="merk" value="<?= $a['merk'] ?>" placeholder="Merk">
                                            </div>
                                            <div class="form-group mb-1 col-3">
                                                <input type="text" class="form-control" id="CPU" name="cpu" value="<?= $a['cpu'] ?>" placeholder="CPU">
                                            </div>
                                            <div class="form-group mb-1 col-3">
                                                <input type="text" class="form-control" id="os" name="os" value="<?= $a['os'] ?>" placeholder="OS">
                                            </div>
                                            <div class="form-group mb-1 col-3">
                                                <input type="text" class="form-control" id="Storage" name="storage" value="<?= $a['storage'] ?>" placeholder="Storage">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-1 col-3">
                                                <input type="text" class="form-control" id="RAM" name="ram" value="<?= $a['ram'] ?>" placeholder="RAM">
                                            </div>
                                            <div class="form-group mb-1 col-3">
                                                <input type="text" class="form-control" id="GPU" name="gpu" value="<?= $a['gpu'] ?>" placeholder="GPU">
                                            </div>
                                            <div class="form-group mb-1 col-3">
                                                <input type="text" class="form-control" id="Display" name="display" value="<?= $a['display'] ?>" placeholder="Display">
                                            </div>
                                            <div class="form-group mb-1 col-3">
                                                <input type="text" class="form-control" id="Lain-lain" name="lain" value="<?= $a['lain'] ?>" placeholder="Lain-lain ..">
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb-1 mt-1">
                                    <div class="mt-0 form_mokeymo">
                                        <div class="row">
                                            <label for="" class="col-2 text-right ml-4">Monitor</label>
                                            <label for="" class="col-2"></label>
                                            <label for="" class="col-2 text-right ml-2">Keyboard</label>
                                            <label for="" class="col-2"></label>
                                            <label for="" class="col-2" style="margin-left: 85px;">Mouse</label>
                                            <label for="" class="col-2"></label>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-1 col-2">
                                                <input type="text" class="form-control bg-light" id="merk_monitor" name="merk_monitor" value="<?= $a['merk_monitor'] ?>" placeholder="Merk/type Monitor" disabled>
                                            </div>
                                            <div class="form-group mb-1 col-2">
                                                <input type="text" class="form-control bg-light" id="sn_monitor" name="sn_monitor" value="<?= $a['sn_monitor'] ?>" placeholder="SN Monitor" disabled>
                                            </div>

                                            <div class="form-group mb-1 col-2">
                                                <input type="text" class="form-control bg-light" id="merk_keyboard" name="merk_keyboard" value="<?= $a['merk_keyboard'] ?>" placeholder="Merk/type Keyboard" disabled>
                                            </div>
                                            <div class="form-group mb-1 col-2">
                                                <input type="text" class="form-control bg-light" id="sn_keyboard" name="sn_keyboard" value="<?= $a['sn_keyboard'] ?>" placeholder="SN Keyboard" disabled>
                                            </div>

                                            <div class="form-group mb-1 col-2">
                                                <input type="text" class="form-control bg-light" id="merk_mouse" name="merk_mouse" value="<?= $a['merk_mouse'] ?>" placeholder="Merk/type Mouse" disabled>
                                            </div>
                                            <div class="form-group mb-1 col-2">
                                                <input type="text" class="form-control bg-light" id="sn_mouse" name="sn_mouse" value="<?= $a['sn_mouse'] ?>" placeholder="SN Mouse" disabled>
                                            </div>
                                        </div>
                                        <hr class="mt-1 mb-0">
                                    </div>

                                    <div class="row sikon">
                                        <div class="form-group mt-2 col-4">
                                            <label for="">Tanggal Pembelian</label>
                                            <input type="date" class="form-control" id="tgl_pembelian" name="tgl_pembelian" value="<?= $a['tgl_pembelian'] ?>" placeholder="Tgl Pembelian">
                                        </div>
                                        <div class="form-group mt-2 col-4">
                                            <label for="">Kondisi*</label>
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
                                        <div class="form-group mt-2 col-4">
                                            <label for="">NO BA</label>
                                            <input type="text" class="form-control bg-light" id="no_ba" name="no_ba" value="<?= $a['no_ba'] ?>" placeholder="NO BA" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-3">
                                            <label for="">Harga</label>
                                            <input type="number" class="form-control" id="harga" name="harga" value="<?= $a['harga'] ?>" placeholder="Rp.">
                                        </div>
                                        <div class="form-group col-3">
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
                                        <div class="form-group col-3">
                                            <label for="">Fisik</label>
                                            <select name="fisik" id="fisik" class="form-control">
                                                <option value="<?= $a['fisik'] ?>" selected><?= $a['fisik'] ?></option>
                                                <option value="" disabled></option>
                                                <option value="Baik">Baik</option>
                                                <option value="Setengah">Setengah</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                        <div class="custom-control custom-checkbox mt-4 ml-2 col-1">
                                            <input type="checkbox" name="idle" class="custom-control-input" id="customCheck1" <?php if ($a['idle'] == 'on') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                            <label class="custom-control-label" for="customCheck1">Idle?</label>
                                        </div>
                                    </div>
                                    <div class="row maintenance">
                                        <div class="form-group col-3">
                                            <label for="">Frekuensi Maintenance</label>
                                            <div class="row">
                                                <input type="number" name="frek_maintenan" id="frek_maintenan" class="form-control col-6 ml-2" value="<?= $a['frek_maintenan'] ?>" placeholder="jumlah hari">
                                                <label class="col-5 ml-0 mt-1">Hari</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="">Tgl Mulai Maintenance</label>
                                            <input type="date" class="form-control" id="tgl_mulai_maintenan" name="tgl_mulai_maintenan" value="<?= $a['tgl_mulai_maintenan'] ?>">
                                            </input>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="">Keterangan Fisik</label>
                                            <textarea type="text" class="form-control" id="ket_fisik" name="ket_fisik" rows="3" placeholder="Ket fisik.."><?= $a['ket_fisik'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-secondary" href="<?= base_url('DataAssets') ?>"><i class="mdi mdi-arrow-left"></i> Back to Data
                                            Assets</a>
                                        <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                                    </div>
                                <?php endforeach; ?>
                            </form>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div> <!-- container -->

        <script>
            $(document).ready(function() {

                $("#frek_maintenan").keyup(function() {
                    $('.maintenance').find('#tgl_mulai_maintenan').attr('required', '');
                });

                //pertama kali muncul Devisi
                var id_pt = $('#id_pt').val();
                var id_divisi = $('#divisi').val();
                $.ajax({
                    url: "<?php echo site_url('dataAssets/select_get_divisi'); ?>",
                    method: "POST",
                    data: {
                        id_pt: id_pt
                    },
                    async: true,
                    dataType: 'json',
                    success: function(data) {

                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            if (data[i].id_divisi == id_divisi) {
                                html += '<option value=' + data[i].id_divisi + ' selected>' + data[i].nama_divisi + '</option>';
                            } else {
                                html += '<option value=' + data[i].id_divisi + '>' + data[i].nama_divisi + '</option>';
                            }
                        }
                        $('#divisi').html(html);

                    }
                });

                //for PT
                var id_pt = $('#id_pt').val();
                console.log
                $.ajax({
                    url: "<?php echo site_url('dataAssets/select_get_pt'); ?>",
                    method: "POST",
                    data: {},
                    async: true,
                    dataType: 'json',
                    success: function(data) {

                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            if (data[i].id_pt == id_pt) {
                                html += '<option value=' + data[i].id_pt + ' selected>' + data[i].nama_pt + '</option>';
                            } else {
                                html += '<option value=' + data[i].id_pt + '>' + data[i].nama_pt + '</option>';
                            }
                        }
                        $('#id_pt').html(html);

                    }
                });

                $('#kondisi').change(function() {
                    var kondisi = $(this).val();

                    $('#no_ba').val('');

                    if (kondisi == 0) {
                        $('.sikon').find('#no_ba').removeClass('bg-light');
                        $('.sikon').find('#no_ba').removeAttr('disabled', '');
                    } else {
                        $('.sikon').find('#no_ba').addClass('bg-light');
                        $('.sikon').find('#no_ba').attr('disabled', '');
                    }
                });

                var qty_id = $('#category').val();
                if (qty_id == 18) {
                    $('.form_mokeymo').find('#merk_monitor, #sn_monitor, #merk_keyboard,#sn_keyboard, #merk_mouse, #sn_mouse').removeClass('bg-light');
                    $('.form_mokeymo').find('#merk_monitor, #sn_monitor, #merk_keyboard,#sn_keyboard, #merk_mouse, #sn_mouse').removeAttr('disabled', '');
                } else {
                    $('.form_mokeymo').find('#merk_monitor, #sn_monitor, #merk_keyboard,#sn_keyboard, #merk_mouse, #sn_mouse').addClass('bg-light');
                    $('.form_mokeymo').find('#merk_monitor, #sn_monitor, #merk_keyboard,#sn_keyboard, #merk_mouse, #sn_mouse').attr('disabled', '');
                }

                var kondisi = $('#kondisi').val();
                if (kondisi == 0) {
                    $('.sikon').find('#no_ba').removeClass('bg-light');
                    $('.sikon').find('#no_ba').removeAttr('disabled', '');
                } else {
                    $('.sikon').find('#no_ba').addClass('bg-light');
                    $('.sikon').find('#no_ba').attr('disabled', '');
                }
            });

            //kalo ganti pt
            $('#id_pt').change(function() {
                var id_pt = $(this).val();

                $.ajax({
                    url: "<?php echo site_url('dataAssets/select_get_divisi'); ?>",
                    method: "POST",
                    data: {
                        id_pt: id_pt
                    },
                    async: true,
                    dataType: 'json',
                    success: function(data) {

                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<option value=' + data[i].id_divisi + '>' + data[i].nama_divisi + '</option>';
                        }
                        $('#divisi').html(html);

                    }
                });
            });
        </script>