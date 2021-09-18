<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Semua rekening milih admin</h1>
    <p class="mb-4">Menampilkan semua rekening bank dari toko baju MasCitra.com</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= form_error('kategori', '<div class="alert alert-danger" role="alert">', '</div>') ?>
            <?= $this->session->flashdata('message'); ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Data</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style='width:30px'>No</th>
                            <th>Nama Bank</th>
                            <th>No Rekning</th>
                            <th>No Atas Nama</th>
                            <th style='width:70px'>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($rekening as $rk) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $rk['nama_bank']; ?></td>
                                <td><?= $rk['no_rekening']; ?></td>
                                <td><?= $rk['pemilik_rekening']; ?></td>
                                <td>
                                    <a class="badge badge-success" href="<?= base_url('admin/edit_rekening/') . $rk['id_rekening']; ?>">edit</a>
                                    <a type="button" class="badge badge-danger" data-toggle="modal" data-target="#hapusModal" href="#">delete</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<!-- Logout Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('admin/tambah_rekening'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama_bank" placeholder="Nama Bank">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="no_rekening" placeholder="No Rekening">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="pemilik_rekening" placeholder="Atas Nama">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary" href="#">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Logout Modal Hapus-->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Tambah Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php foreach ($rekening as $rk) : ?>
                <form action="<?= base_url('admin/delete_rekening/') . $rk['id_rekening']; ?>" method="POST">
                <?php endforeach; ?>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data tersebut? Pilih "Hapus" untuk menghapus, pilih "Batal" untuk kembali ke panel ini.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" href="#">Hapus</button>
                </div>
                </form>
        </div>
    </div>
</div>