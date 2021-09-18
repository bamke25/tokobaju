<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Semua Produk</h1>
    <p class="mb-4">Menampilkan semua produk dari toko baju MasCitra.com</p>

    <?php
    $attributes = array('class' => 'form-horizontal', 'role' => 'form');
    echo form_open_multipart('admin/tambah_stok_barang', $attributes); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <table class='table table-condensed table-bordered' hidden>
                <tbody>
                    <tr>
                        <th width='140px' scope='row'>Kode Pembelian</th>
                        <td><input type='text' class='form-control' value='<?php echo "$rows[kode_pembelian]"; ?>' name='a'></td>
                    </tr>

                </tbody>
            </table>
            <?= $this->session->flashdata('message'); ?>
            <input class='btn btn-primary btn-sm' type="submit" name='submit1' value='Tambah Stok'>
            <?php if ($this->session->idp != '') { ?>
                <a class='btn btn-dark btn-sm' href='<?php echo base_url(); ?>admin/produk'>Selesai</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style='width:40px'>No</th>
                            <th>Nama Produk</th>
                            <!-- <th>Harga Pesan</th> -->
                            <th>Tambah Stok Barang</th>
                            <th>Satuan</th>
                            <!-- <th>Sub Total</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    echo "<tr>
                                <td></td>
                                <input type='hidden'  value='" . $this->uri->segment(3) . "' name='idpd'>
                                <td><select name='aa' class='combobox form-control' onchange=\"changeValue(this.value)\" autofocus>
                                                                      <option value='' selected> Cari Barang </option>";
                    $jsArray = "var prdName = new Array();\n";
                    foreach ($produk as $r) {
                        if ($r['id_produk'] == $row['id_produk']) {
                            echo "<option value='$r[id_produk]' selected>$r[nama_produk]</option>";
                            $jsArray .= "prdName['" . $r['id_produk'] . "'] = {name:'" . addslashes($r['harga_beli']) . "',desc:'" . addslashes($r['satuan']) . "'};\n";
                        } else {
                            echo "<option value='$r[id_produk]'>$r[nama_produk]</option>";
                            $jsArray .= "prdName['" . $r['id_produk'] . "'] = {name:'" . addslashes($r['harga_beli']) . "',desc:'" . addslashes($r['satuan']) . "'};\n";
                        }
                    }
                    echo "</select></td>
                                
                                <td><input class='form-control' type='number' name='cc' value='$row[jumlah_pesan]' id='harga'></td>
                                <td><input class='form-control' type='text' name='dd' id='satuan' value='$row[satuan]' readonly='on'> </td>
                               
                                <td>
                                    <button type='submit' name='submit' class='badge badge-success'><span class='glyphicon glyphicon-ok' aria-hidden='true'>Ok</span></button>
                                    <a class='badge badge-danger' title='Delete Data' href='" . base_url() . "admin/tambah_stok_barang'><span class='glyphicon glyphicon-remove'>Del</span></a>
                                </td>
                        </tr>";
                    ?>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($record as $row) {
                            echo "<tr><td>$no</td>
                              <td>$row[nama_produk]</td>
                            
                              <td>$row[jumlah_pesan]</td>
                              <td>$row[satuan]</td>
                             
                              <td>
                                <a class='badge badge-warning' title='Edit Data' href='" . base_url() . "admin/tambah_stok_barang/$row[id_pembelian_detail]'><span class='glyphicon glyphicon-edit'>Edit</span></a>
                                <a class='badge badge-danger' title='Delete Data' href='" . base_url() . "admin/delete_tambah_stok_barang/$row[id_pembelian_detail]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'>Del</span></a>
                              </td>
                          </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            <?php } ?>
            </div>
        </div>
    </div>
</div>





<script type="text/javascript">
    <?php echo $jsArray; ?>

    function changeValue(id) {
        document.getElementById('harga').value = prdName[id].name;
        document.getElementById('satuan').value = prdName[id].desc;
    };
</script>