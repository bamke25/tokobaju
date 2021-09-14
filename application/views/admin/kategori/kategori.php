<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Semua Kategori Produk</h1>
    <p class="mb-4">Menampilkan semua kategori produk dari toko baju MasCitra.com</p>

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
                            <th>Nama kategori produk</th>
                            <th style='width:70px'>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($kategori as $kt) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $kt['nama_kategori']; ?></td>
                                <td>
                                    <a class="badge badge-success" href="<?= base_url('admin/edit_kategori/') . $kt['id_kategori']; ?>">edit</a>
                                    <a type="button" class="badge badge-danger" data-toggle="modal" data-target="#hapusModal" onclick="confirm_modal('<?= base_url('admin/delete_kategori/') . $kt['id_kategori']; ?>')" href="#">delete</a>
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
            <form action="<?= base_url('admin/kategori_produk'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="kategori produk">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" href="#">Tambah</button>
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
            <?php foreach ($kategori as $kt) : ?>
                <form action="<?= base_url('admin/delete_kategori/') . $kt['id_kategori']; ?>" method="POST">
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