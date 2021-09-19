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
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Berat</th>
                            <th style="width: 70px;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($produk as $row) {
                            $jual = $this->ModelProduk->jual($row['id_produk'])->row_array();
                            $beli = $this->ModelProduk->beli($row['id_produk'])->row_array();
                            echo "<tr><td>$no</td>
                              <td>$row[nama_produk]</td>
                              <td>$row[harga]</td>
                              <td>" . ($beli['beli'] - $jual['jual']) . "</td>
                              <td>$row[satuan]</td>
                              <td>$row[berat] Gram</td>
                     
                              <td><center>
                                <a class='badge badge-success' title='Edit data' href='" . base_url() . "administrator/edit_produk/$row[id_produk]'>edit</a>
                                <a type='button' class='badge badge-danger' title='Hapus data' data-toggle='modal' data-target='#hapusModal'>delete</a>
                              </center></td>
                          </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->




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
            <?php foreach ($produk as $row) : ?>
                <form action="<?= base_url('admin/delete/') . $row['id_produk']; ?>" method="POST">
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