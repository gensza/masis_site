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
                        <h4 class="page-title">Data Users</h4>
                    </div>
                </div>
            </div>
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-between mb-3">
                                <h4 class="header-title">Data Table</h4>
                                <!-- <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalUsers"><i
                                        class="mdi mdi-plus"></i>Tambah Data</button> -->
                            </div>
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>nama</th>
                                        <th>email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1  ?>
                                    <?php foreach ($users_ho as $u) : ?>
                                    <tr>
                                        <td><?= $no++  ?></td>
                                        <td><?= $u['username'] ?></td>
                                        <td><?= $u['nama'] ?></td>
                                        <td><?= $u['email'] ?></td>
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
    <div class="modal fade" id="modalUsers" tabindex="-1" aria-labelledby="modalUsersLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newModalUsersLabel">Add New Assets</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <form action="<?= base_url('DataUsers/addUsers') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="dept" name="dept" placeholder="Department"
                                required>
                        </div>
                        <div class="form-group">
                            <select name="position" id="position" class="form-control">
                                <option selected disabled>Select position</option>
                                <option value="Lt 1">Lt 1</option>
                                <option value="Lt 2">Lt 2</option>
                                <option value="Lt 3">Lt 3</option>
                                <option value="Lt 4">Lt 4</option>
                                <option value="Lt 5">Lt 5</option>
                                <option value="Mess">Mess</option>
                            </select>
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