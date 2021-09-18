<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Produk Baru</h3>
        </div>
        <div class="box-body">
            <form action="<?= base_url('admin/tambah_produk'); ?>" method="POST" enctype="multipart/form-data">
                <div class="col-md-12">
                    <table class="table table-condensed table-bordered">
                        <tbody>
                            <input type='hidden' name='id' value=''>
                            <tr>
                                <th scope="row">Kategori</th>
                                <td>
                                    <select name="id_kategori" class="form-control" required>
                                        <option value="" selected>- Pilih Kategori Produk -</option>
                                        <?php foreach ($kategori as $kt) : ?>
                                            <option value="<?= $kt['id_kategori'] ?>"><?= $kt['nama_kategori']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th width="130px;" scope="row">Nama Produk</th>
                                <td><input type="text" class="form-control" name="nama_produk" required></td>
                            </tr>
                            <tr>
                                <th scope="row">Satuan</th>
                                <td><input type="text" class="form-control" name="satuan"></td>
                            </tr>
                            <tr>
                                <th scope="row">Harga</th>
                                <td><input type="text" class="form-control" name="harga"></td>
                            </tr>
                            <tr>
                                <th scope="row">Berat</th>
                                <td><input type="text" class="form-control" name="berat"></td>
                            </tr>
                            <tr>
                                <th scope="row">Keterangan</th>
                                <td><textarea id="" class="form-control" name="keterangan"></textarea></td>
                            </tr>
                            <tr>
                                <th scope="row">Gambar</th>
                                <td><input type="file" class="form-control" name="gambar"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-info">Tambahkan</button>
                    <a style="float: right; margin:2px;" href="<?= base_url('admin/produk'); ?>"><button type="button" class="btn btn-dark">Cancel</button></a>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- <tr>
        <th scope='row'>Harga Beli</th>
        <td><input type='number' class='form-control' name='d'></td>
    </tr>
    <tr>
        <th scope='row'>Harga Reseller</th>
        <td><input type='number' class='form-control' name='e'></td>
    </tr> -->