<title><?= $title ?></title>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">My Profile</h1>
    <p class="mb-4">Menampilkan profile admin toko baju MasCitra.com</p>

    <!-- Main content -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url('user/edit_profile'); ?>" method="POST" enctype="multipart/form-data">
                <button type="submit" class="btn btn-secondary btn-md">Update profile</button>
            
        </div>
        <!-- Main content -->
        <div class="card-body">

            <div class="row">
                <div class="col-lg-8">
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                            <small class="text-danger"><?= form_error('name') ?></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">Gambar</div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail" width="100px">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-secondary">Edit</button>
                        </div>
                    </div> -->
                    </form>
                </div>
            </div>

        </div>

        <!-- /.content -->
    </div>

    <!-- /.content -->
</div>