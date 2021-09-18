<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Semua Produk</h1>
    <p class="mb-4">Menampilkan semua produk dari toko baju MasCitra.com</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $this->session->flashdata('message'); ?>
            <a href="<?= base_url('admin/tambah_produk'); ?>" class="btn btn-primary btn-sm">Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 30px;">No</th>
                            <th>Nama produk</th>
                            <th>Harga</th>
                            <!-- <th>Stok</th> -->
                            <th>Satuan</th>
                            <th>Berat</th>
                            <th style="width: 70px;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php 
                        // $jual = $this->ModelProduk->jual($row['id_produk'])->row_array();
                        // $beli = $this->ModelProduk->beli($row['id_produk'])->row_array();
                        foreach ($produk as $p) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $p['nama_produk']; ?></td>
                                <td><?= $p['harga']; ?></td>
                                
                                <td><?= $p['satuan']; ?></td>
                                <td><?= $p['berat']; ?></td>
                                <td>
                                    <a type="button" class="badge badge-success" href="<?= base_url('admin/edit_produk/') .  $p['id_produk']; ?>">edit</span></a>
                                    <a type="button" class="badge badge-danger" data-toggle="modal" data-target="#hapusModal" onclick="confirm_modal('<?= base_url('admin/delete/') . $p['id_produk']; ?>')" href="#">delete</a>
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



<!-- Logout Modal-->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Hapus Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data tersebut? Pilih "Hapus" untuk menghapus, pilih "Batal" untuk kembali ke panel ini.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a id="delete_link" class="btn btn-primary" href="">Hapus</a>
            </div>
        </div>
    </div>
</div>