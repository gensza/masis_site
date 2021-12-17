<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                </div>
                                <?= $this->session->flashdata('message') ?>
                                <form class="user" method="POST" action="<?php base_url('Auth/index') ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username...">
                                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="kode_pt" name="kode_pt" required>
                                            <option value="" selected disabled>--pilih PT--</option>
                                            <!-- <option value="99">PT Develop</option> -->
                                            <?php
                                            foreach ($pt as $d) : {
                                            ?>
                                                    <option value="<?= $d['kode_pt']; ?>"><?= $d['nama_pt']; ?></option>
                                            <?php
                                                }
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <!-- <a class="small" href="<?= base_url('auth/registration') ?>">Create an Account!</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>