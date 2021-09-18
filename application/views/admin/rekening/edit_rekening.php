<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h4 class="box-title">Edit produk terpilih</h4>
        </div> <br>
        <div class="card shadow mb-4">
            <form action="<?= base_url('admin/edit_rekening/'); ?>" method="POST">
                <div class="col-md-12">
                    <table class="table table-condensed ">
                        <tbody>
                            <input type='hidden' name='id_rekening' value='<?= $edit['id_rekening']; ?>'>    
                            <tr>
                                <th width="130px;" scope="row">Nama Bank</th>
                                <td><input type="text" class="form-control" name="nama_bank" value="<?= $edit['nama_bank']; ?>" required></td>
                            </tr>
                            <tr>
                                <th width="130px;" scope="row">No Rekening</th>
                                <td><input type="text" class="form-control" name="no_rekening" value="<?= $edit['no_rekening']; ?>" required></td>
                            </tr>
                            <tr>
                                <th width="130px;" scope="row">Atas Nama</th>
                                <td><input type="text" class="form-control" name="pemilik_rekening" value="<?= $edit['pemilik_rekening']; ?>" required></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-info">Update</button>
                    <a style="float:right; margin:2px;" href="<?= base_url('admin/rekening'); ?>"><button type="button" class="btn btn-dark">Cancel</button></a>
                </div>
            </form>
        </div>
    </div>
</div>

