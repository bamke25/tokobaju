<title><?= $title ?></title>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ubah Password</h1>
    <p class="mb-4">Menampilkan form ubah password </p>

    <!-- Main content -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url('user/change_password'); ?>" method="POST">
                <button type="submit" class="btn btn-secondary btn-md">Update password</button>

        </div>
        <!-- Main content -->
        <div class="card-body">

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="currentpassword">Current Password</label>
                        <input type="password" class="form-control" id="currentpassword" name="currentpassword">
                        <small class="text-danger"><?= form_error('currentpassword') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="newpassword1">New Password</label>
                        <input type="password" class="form-control" id="newpassword1" name="newpassword1">
                        <small class="text-danger"><?= form_error('newpassword1') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="newpassword2">Repeat New Password</label>
                        <input type="password" class="form-control" id="newpassword2" name="newpassword2">
                        <small class="text-danger"><?= form_error('newpassword2') ?></small>
                    </div>
                    <!-- <div class="form-group">
                        <button type="submit" class="btn btn-secondary">Change Password</button>
                    </div> -->
                    </form>
                </div>
            </div>

        </div>

        <!-- /.content -->
    </div>

    <!-- /.content -->
</div>