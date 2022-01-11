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
                        <h4 class="page-title">Quantity Assets</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-12">
                    <?= form_error('category', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-between mb-3">
                                <h4 class="header-title">Data Table</h4>
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalCategory">Add category</button>
                            </div>
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category</th>
                                        <th>Total Assets</th>
                                        <th>Asset Terpakai</th>
                                        <th>Idle Assets</th>
                                        <th>Asset Dipinjam</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1  ?>
                                    <?php foreach ($qty_assets as $qty) : ?>
                                        <tr>
                                            <td><?= $no++  ?></td>
                                            <td><?= $qty['category'] ?></td>
                                            <td><?= $qty['qty'] ?></td>
                                            <td>
                                                <?php
                                                $result = "SELECT idle FROM tb_assets WHERE qty_id = $qty[id_qty] AND (idle <> 'on'OR idle IS NULL)";
                                                $count = $this->db_masis_pt->query($result)->num_rows();
                                                // var_dump($count);
                                                echo $count;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $result = "SELECT COUNT(idle) as idle FROM tb_assets WHERE qty_id = $qty[id_qty] AND idle = 'on'";
                                                $count = $this->db_masis_pt->query($result)->row_array();
                                                // var_dump($count);
                                                echo $count['idle'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $result = "SELECT COUNT(status_unit) as pinjam FROM tb_assets WHERE qty_id = $qty[id_qty] AND status_unit = 0";
                                                $count = $this->db_masis_pt->query($result)->row_array();
                                                // var_dump($count);
                                                echo $count['pinjam'];
                                                ?>
                                            </td>
                                            <td>
                                                <?= anchor('DataAssets/editCategory/' . $qty['id_qty'], '<button class="btn btn-sm btn-warning"><i class="mdi mdi-lead-pencil"></i></button>') ?>
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
    <!-- modal add menu -->
    <div class="modal fade" id="modalCategory" tabindex="-1" aria-labelledby="modalCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCategoryLabel">Add New Category</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <form action="<?= base_url('DataAssets/addCategory') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="category" name="category" placeholder="Category">
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