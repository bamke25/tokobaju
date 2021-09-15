<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h4 class="box-title">Detail Member</h4>
        </div> <br>
        <div class="card shadow mb-4">
                <div class="col-md-12">
                    <table class="table table-condensed ">
                        <tbody>
                            <input type='hidden' name='id' value='<?= $detail['id']; ?>'>
                            <tr>
                                <th width="130px;" scope="row">Nama Member</th>
                                <td><input type="text" class="form-control" name="nama_produk" value="<?= $detail['name']; ?>"></td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td><input type="text" class="form-control" name="satuan" value="<?= $detail['email']; ?>"></td>
                            </tr>
                            <tr>
                                <th scope="row">Bergabung sejak</th>
                                <td><input type="text" class="form-control" name="harga" value="<?= date('d F Y',  $detail['date_created']); ?>"></td>
                            </tr>
                            <tr>
                                <th scope="row">Gambar</th>
                                <td>
                                <!-- <input type="file" class="form-control" name="gambar"> -->
                                    <?php if ($detail['image'] != '') {
                                        echo 
                                        "<i style='color:red'> Lihat gambar saat ini: </i> <a target='_BLANK' href='" . base_url() . "assets/img/profile/$detail[image]'>$detail[image]</a>";
                                    } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <a style="float:right; margin:2px;" href="<?= base_url('admin/member'); ?>"><button type="button" class="btn btn-dark">Cancel</button></a>
                </div>
 
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