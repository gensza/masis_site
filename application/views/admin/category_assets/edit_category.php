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
                        <h4 class="page-title">Edit Category</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-between mb-3">
                                <h4 class="header-title">Edit Data</h4>
                            </div>
                            <form action="<?= base_url('DataAssets/updateCategory') ?>" method="POST">
                                <?php foreach ($category as $c) : ?>
                                <div class="form-group">
                                    <input type="text" name="id" id="" value="<?= $c['id_qty']; ?>" hidden>
                                    <input type="text" class="form-control" id="category" name="category"
                                        value="<?= $c['category']; ?>" required>
                                </div>
                                <div class="row mt-3 align-content-between float-right">
                                    <a class="btn btn-secondary" href="<?= base_url('DataAssets/qtyAssets') ?>"><i
                                            class="mdi mdi-arrow-left"></i> Back to Data
                                        Assets</a>
                                    <button type="submit" class="btn btn-primary ml-1">Save</button>
                                </div>
                                <?php endforeach; ?>
                            </form>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
            <!-- end page title -->
        </div> <!-- container -->
    </div> <!-- content -->