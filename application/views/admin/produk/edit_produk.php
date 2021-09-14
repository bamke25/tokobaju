<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h4 class="box-title">Edit produk terpilih</h4>
        </div> <br>
        <div class="card shadow mb-4">
            <form action="<?= base_url('admin/edit_produk/'); ?>" method="POST" enctype="multipart/form-data">
                <div class="col-md-12">
                    <table class="table table-condensed ">
                        <tbody>
                            <input type='hidden' name='id' value='<?= $edit['id_produk']; ?>'>
                            <tr>
                                <th scope="row">Kategori</th>
                                <td>
                                    <select name="id_kategori" class="form-control" required>
                                        <option value="" selected>- Pilih Kategori Produk -</option>
                                        <?php foreach ($kategori as $kt) : ?>
                                            <?php if ($edit['id_kategori'] == $kt['id_kategori']) {
                                                echo "<option value= '$kt[id_kategori]' selected>$kt[nama_kategori]</option>";
                                            } else {
                                                echo " <option value = '$kt[id_kategori]'>$kt[nama_kategori]</option> ";
                                            }
                                            ?>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th width="130px;" scope="row">Nama Produk</th>
                                <td><input type="text" class="form-control" name="nama_produk" value="<?= $edit['nama_produk']; ?>"></td>
                            </tr>
                            <tr>
                                <th scope="row">Satuan</th>
                                <td><input type="text" class="form-control" name="satuan" value="<?= $edit['satuan']; ?>"></td>
                            </tr>
                            <tr>
                                <th scope="row">Harga</th>
                                <td><input type="text" class="form-control" name="harga" value="<?= $edit['harga']; ?>"></td>
                            </tr>
                            <tr>
                                <th scope="row">Berat</th>
                                <td><input type="text" class="form-control" name="berat" value="<?= $edit['berat']; ?>"></td>
                            </tr>
                            <tr>
                                <th scope="row">Keterangan</th>
                                <td><input id="" class="form-control" name="keterangan" value="<?= $edit['keterangan']; ?>"></input></td>
                            </tr>
                            <tr>
                                <th scope="row">Gambar</th>
                                <td><input type="file" class="form-control" name="gambar">
                                    <?php if ($edit['gambar'] != '') {
                                        echo
                                        "<i style='color:red'> Lihat gambar saat ini: </i> <a target='_BLANK' href='" . base_url() . "assets/img/produk/$edit[gambar]'>$edit[gambar]</a>";
                                    } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-info">Update</button>
                    <a style="float:right; margin:2px;" href="<?= base_url('admin/produk'); ?>"><button type="button" class="btn btn-dark">Cancel</button></a>
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