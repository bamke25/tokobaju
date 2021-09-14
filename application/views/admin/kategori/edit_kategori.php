<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h4 class="box-title">Edit produk terpilih</h4>
        </div> <br>
        <div class="card shadow mb-4">
            <form action="<?= base_url('admin/edit_kategori/'); ?>" method="POST">
                <div class="col-md-12">
                    <table class="table table-condensed ">
                        <tbody>
                            <input type='hidden' name='id' value='<?= $kategori['id_kategori']; ?>'>    
                            <tr>
                                <th width="130px;" scope="row">Nama Kategori</th>
                                <td><input type="text" class="form-control" name="nama_kategori" value="<?= $kategori['nama_kategori']; ?>" required></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-info">Update</button>
                    <a style="float:right; margin:2px;" href="<?= base_url('admin/kategori_produk'); ?>"><button type="button" class="btn btn-dark">Cancel</button></a>
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