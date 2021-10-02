<div class='container-fluid'>

    <h1 class="h4 mb-2 text-gray-800">Semua detail konfirmasi Pembayaran</h1>
    <p class="mb-4">Menampilkan semua detail konfirmasi pembayaran pembeli dari dari toko baju MasCitra.com</p>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <a style="float: right;" class='btn btn-warning btn-sm' href=<?= base_url('admin/orders'); ?>>Kembali</a>
        </div>

        <div class="card-body">
            <div class="row g-0">
                <?php if ($total['proses'] == '0') {
                    $proses = '<i class="text-danger">Pending</i>';
                } elseif ($total['proses'] == '1') {
                    $proses = '<i class="text-warning">Packing</i>';
                } elseif ($total['proses'] == '2') {
                    $proses = '<i class="text-info">Konfirmasi</i>';
                } elseif ($total['proses'] == '3') {
                    $proses = '<i class="text-success">Dikirim</i>';
                } else {
                    $proses = '<i class="text-success">Diterima</i>';
                } ?>
                <div class="col-md-7">
                    <dl class="dl-horizontal">
                        <dt>Nama</dt>
                        <dd><?= $rows['name']; ?></dd>
                        <dt>No Telp</dt>
                        <dd><?= $rows['no_hp'] ?></dd>
                        <dt>Email</dt>
                        <dd><?= $rows['email'] ?></dd>
                        <dt>Kota</dt>
                        <dd><?= $rows['nama_kota'] ?></dd>
                        <dt>Alamat Lengkap</dt>
                        <dd><?= $rows['alamat_lengkap'] ?></dd>
                    </dl>
                </div>
                <div class="col-md-5">
                    <center>
                        Total Tagihan
                        <h4 style="margin: 0px;">
                            <?= "Rp " . rupiah($total['total'] + $total['ongkir']); ?> <br> <br>
                            <span style="text-transform: uppercase;"><?= $total['kurir']; ?></span> <?= $total['service']; ?>
                        </h4>
                        Status: <i><?= $proses ?></i>
                        <form action="<?= base_url('admin/tracking') . $this->uri->segment(3) . $total['id_penjualan']; ?>" method="POST">
                            Input resi <input type="text" name="resi" class="form-control" value="<?= $total['resi'] ?>" style="display: inline-block; color:red; width:60%">
                            <input type="submit" name="submit" value="submit" id="">
                        </form>
                    </center> <br> <br>
                </div>

                <table class="table table-striped table-condensed">
                    <thead>
                        <tr bgcolor="#e3e3e3">
                            <th width="30px">No</th>
                            <th width="47%">Nama Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Berat</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $diskon_total = 0;
                        foreach ($record->result_array() as $row) {
                            $sub_total = (($row['harga_jual'] - $row['diskon']) * $row['jumlah']);
                            if ($row['diskon'] != '0') {
                                $diskon = "<del style='color:red'>$row[harga_jual]</del>";
                            } else {
                                $diskon = "";
                            }
                            if (trim($row['gambar']) == '') {
                                $foto_produk = 'no-image.png';
                            } else {
                                $foto_produk = $row['gambar'];
                            }
                            $diskon_total = $diskon_total + $row['diskon'] * $row['jumlah'];
                            echo "
                            <tr>
                                <td>$no</td>
                                <td class='valign'><a href='" . base_url() . "produk/detail/$row[produk_seo]'>$row[nama_produk]</a><br>
                                <small>Note : $row[keterangan_order]</small></td>
                                <td class='valign'>$row[harga_jual] - $row[diskon] . $diskon</td>
                                <td class='valign'>$row[jumlah]</td>
                                <td class='valign'>" . ($row['berat'] * $row['jumlah']) . " Gram</td>
                                <td class='valign'>$sub_total</td>
                            </tr>";
                            $no++;
                        }
                        echo "
                            <tr class='success'>
                                <td colspan='5'><b>Subtotal </b> <i class='pull-right'>(" . $total['total'] . " Rupiah)</i></td>
                                <td><b>Rp " . ($total['total']) . "</b></td>
                            </tr>

                            <tr class='success'>
                                <td colspan='5'><b>Ongkir </b> <i class='pull-right'>(" . ($total['ongkir']) . " Rupiah)</i></td>
                                <td><b>Rp " . ($total['ongkir']) . "</b></td>
                            </tr>

                            <tr class='success'>
                                <td colspan='5'><b>Berat</b> <i class='pull-right'>(" . ($total['total_berat']) . " Gram)</i></td>
                                <td><b>$total[total_berat] Gram</b></td>
                            </tr>";
                        ?>
                    </tbody>
                </table>

                <?php
                $cek_konfirmasi = $this->ModelOrders->view_where('konfirmasi', array('id_penjualan' => $total['id_penjualan']));
                if ($cek_konfirmasi->num_rows() >= 1) {
                    echo "
                        <div class='alert alert-success' style='border-radius:0px; padding:5px'>Konfirmasi Pembayaran dari Pembeli : </div>";
                    $konfirmasi = $this->ModelOrders->view_join_where('konfirmasi', 'rekening', 'id_rekening', array('id_penjualan' => $total['id_penjualan']), 'id_konfirmasi_pembayaran', 'DESC');
                    foreach ($konfirmasi as $r) {
                        echo "
                            <div class='col-md-8'>
                                <dl class='dl-horizontal'>
                                    <dt>Nama Pengirim</dt>       <dd>$r[nama_pengirim]</dd>
                                    <dt>Total Transfer</dt>      <dd>$r[total_transfer]</dd>
                                    <dt>Tanggal Transfer</dt>    <dd>$r[tanggal_transfer]</dd>
                                    <dt>Bukti Transfer</dt>      <dd></dd>
                                    <dt>Rekening Tujuan</dt>     <dd>$r[nama_bank] - $r[no_rekening] - $r[pemilik_rekening]</dd>
                                    <dt>Waktu Konfirmasi</dt>    <dd>$r[waktu_konfirmasi]</dd>
                                </dl>
                            </div>";
                    }
                }
                ?>

            </div>
        </div>

    </div>
</div>