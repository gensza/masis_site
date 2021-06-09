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
                                    <h4 class="page-title">Data Assets Maintenance</h4>
                              </div>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-12">
                              <div class="card">
                                    <div class="card-body">
                                          <div class="row mb-3">
                                                <div class="col-lg-8 col-4">
                                                      <h4 class="header-title">Data Table</h4>
                                                </div>
                                                <div class="col-lg-4 col-8 text-right">
                                                      <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalReport"><i class="mdi mdi-file"></i> Report</button>
                                                      <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalFilter"><i class="mdi mdi-filter"></i> Filter</button>
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
                                                            <th>User</th>
                                                            <th>Frekuensi Maintenance</th>
                                                            <th>Tgl Mulai Maintenance</th>
                                                            <th>Tgl Jadwal Maintenance</th>
                                                            <th>Maintenance</th>
                                                            <th>Opsi</th>
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
            <div class="modal-dialog modal-lg">
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
                                          <tr class="bg-light">
                                                <th>Merk</th>
                                                <th>CPU</th>
                                                <th>OS</th>
                                                <th>Storage</th>
                                                <th>RAM</th>
                                                <th>GPU</th>
                                                <th>Display</th>
                                                <th>Lainya</th>
                                          </tr>
                                          <tr>
                                                <td><span id="merk"></span></td>
                                                <td><span id="cpu"></span></td>
                                                <td><span id="os"></span></td>
                                                <td><span id="storage"></span></td>
                                                <td><span id="ram"></span></td>
                                                <td><span id="gpu"></span></td>
                                                <td><span id="display"></span></td>
                                                <td><span id="lain"></span></td>
                                          </tr>
                                    </tbody>
                              </table>
                        </div>
                  </div>
            </div>
      </div>

      <div class="modal fade" id="modalReport">
            <div class="modal-dialog modal-lg">
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
                                                <select name="pilih_pt" id="pilih_pt" class="form-control">
                                                      <option value="Y">- Semua PT - </option>
                                                      <?php foreach ($pt_report as $p) : ?>
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
                                                <select name="divisi" id="divisi" class="form-control" required>
                                                      <option value="Y">- Semua Divisi - </option>
                                                </select>
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
                                          <button type="submit" class="btn btn-sm btn-danger" onclick="cetak_report()">Cetak Report</button>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
      </div>

      <div class="modal fade" id="modalFilter">
            <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                        <div class="modal-header">
                              <h4 class="modal-title">Filter Berdasarkan</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                        <div class="modal-body table-responsive">
                              <div class="row">
                                    <input type="hidden" name="filter" value="filter">
                                    <div class="form-group col-4">
                                          <select name="pilih_pt" id="filter_pilih_pt" class="form-control" required>
                                                <option value="Y">Semua PT</option>
                                                <?php foreach ($pt_filter as $p) : ?>
                                                      <option value="<?= $p['id_pt'] ?>"><?= $p['alias'] ?></option>
                                                <?php endforeach; ?>
                                          </select>
                                    </div>
                                    <div class="form-group col-5">
                                          <select name="pilih_category" id="filter_pilih_category" class="form-control" required>
                                                <option value="Y">Semua Category</option>
                                                <?php foreach ($category as $c) : ?>
                                                      <option value="<?= $c['id_qty'] ?>"><?= $c['category'] ?></option>
                                                <?php endforeach; ?>
                                          </select>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-1 col-3">
                                          <input type="checkbox" name="filter_cb_idle2" class="custom-control-input" id="filter_cb_idle2">
                                          <label class="custom-control-label" for="filter_cb_idle2">Idle</label>
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="form-group col-5">
                                          <select name="pilih_kondisi" id="filter_pilih_kondisi" class="form-control" required>
                                                <option value="Y">Semua Kondisi</option>
                                                <option value="1">Baik</option>
                                                <option value="0">Rusak</option>
                                          </select>
                                    </div>
                                    <div class="form-group col-3">
                                          <select name="divisi" id="filter_divisi" class="form-control" required>
                                                <option value="Y">- Semua Divisi - </option>
                                          </select>
                                    </div>
                                    <div class="form-group col-4">
                                          <select name="status_unit" id="filter_status_unit" class="form-control" required>
                                                <option value="Y">Semua Status</option>
                                                <option value="1">Tersedia</option>
                                                <option value="0">Dipinjam</option>
                                          </select>
                                    </div>
                              </div>
                              <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-sm btn-warning" onclick="filter_assets()">Filter</button>
                              </div>
                        </div>
                  </div>
            </div>
      </div>

      <script>
            var table;

            function cetak_report() {
                  $('#modalReport').modal('hide');
            }

            //menjalankan js ketika masuk halaman
            $(document).ready(function() {

                  //menjalankan data table saat masuk halaman
                  filter_assets();

                  //report
                  $('#pilih_pt').change(function() {
                        var id_pt = $(this).val();

                        console.log(id_pt);
                        $.ajax({
                              url: "<?php echo site_url('Maintenance/select_get_divisi_maintenance'); ?>",
                              method: "POST",
                              data: {
                                    id_pt: id_pt
                              },
                              async: true,
                              dataType: 'json',
                              success: function(data) {

                                    var html = '';
                                    var i;
                                    html += '<option value="Y">- Semua Divisi - </option>';
                                    for (i = 0; i < data.length; i++) {
                                          html += '<option value=' + data[i].id_divisi + '>' + data[i].nama_divisi + '</option>';
                                    }
                                    $('#divisi').html(html);

                              }
                        });
                  });

                  $('#filter_pilih_pt').change(function() {
                        var id_pt = $(this).val();

                        console.log(id_pt);
                        $.ajax({
                              url: "<?php echo site_url('dataAssets/select_get_divisi_maintenance'); ?>",
                              method: "POST",
                              data: {
                                    id_pt: id_pt
                              },
                              async: true,
                              dataType: 'json',
                              success: function(data) {

                                    var html = '';
                                    var i;
                                    html += '<option value="Y">- Semua Divisi - </option>';
                                    for (i = 0; i < data.length; i++) {
                                          html += '<option value=' + data[i].id_divisi + '>' + data[i].nama_divisi + '</option>';
                                    }
                                    $('#filter_divisi').html(html);

                              }
                        });
                  });

            });

            $(document).on('click', '#detail_aset', function() {

                  var merk = $(this).data('merk');
                  var cpu = $(this).data('cpu');
                  var os = $(this).data('os');
                  var storage = $(this).data('storage');
                  var ram = $(this).data('ram');
                  var gpu = $(this).data('gpu');
                  var display = $(this).data('display');
                  var lain = $(this).data('lain');
                  // Set data to Form Edit
                  $('#merk').text(merk);
                  $('#cpu').text(cpu);
                  $('#os').text(os);
                  $('#storage').text(storage);
                  $('#ram').text(ram);
                  $('#gpu').text(gpu);
                  $('#display').text(display);
                  $('#lain').text(lain);
            });

            function filter_assets() {
                  //datatables

                  $('#modalFilter').modal('hide');

                  var idel;
                  $('input[name="filter_cb_idle2"]:checked').each(function() {
                        idel = $(this).val()
                  });

                  $('#data_assets').DataTable().destroy();
                  table = $('#data_assets').DataTable({

                        "processing": true,
                        "serverSide": true,
                        "order": [],

                        "scrollY": 400,
                        "scrollX": true,

                        "ajax": {
                              "data": {
                                    pilih_pt: $('#filter_pilih_pt').val(),
                                    pilih_category: $('#filter_pilih_category').val(),
                                    pilih_kondisi: $('#filter_pilih_kondisi').val(),
                                    divisi: $('#filter_divisi').val(),
                                    cb_idle2: idel,
                                    status_unit: $('#filter_status_unit').val()
                              },
                              "url": "<?php echo site_url('Maintenance/get_data_assets_maintenance') ?>",
                              "type": "POST"
                        },


                        "columnDefs": [{
                              "targets": [0],
                              "orderable": false,
                        }, ],

                  });
            }
      </script>