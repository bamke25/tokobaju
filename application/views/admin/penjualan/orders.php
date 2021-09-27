<div class='container-fluid'>

    <h1 class="h3 mb-2 text-gray-800">Semua order pesanan</h1>
    <p class="mb-4">Menampilkan semua order pesanan dari dari toko baju MasCitra.com</p>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <a target='_BLANK' class='pull-right btn btn-warning btn-sm' href='<?php echo base_url(); ?>admin/print_orders'>Print Report</a>
        </div>
        <div class='card-body'>
            <div class='table-responsive'>
                <table id="dataTable" class='table table-bordered' width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th>Kode Transaksi</th>
                            <th>Total Belanja</th>
                            <th>Pengiriman</th>
                            <th>Tujuan</th>
                            <th>Waktu Transaksi</th>
                            <th style="width: 90px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($record->result_array() as $row) {
                            if ($row['proses'] == '0') {
                                $proses = '<i class="text-danger">Pending</i>';
                                $color = 'danger';
                                $text = 'Pending';
                            } elseif ($row['proses'] == '1') {
                                $proses = '<i class="text-warning">Packing</i>';
                                $color = 'warning';
                                $text = 'Packing';
                            } elseif ($row['proses'] == '2') {
                                $proses = '<i class="text-info">Konfirmasi</i>';
                                $color = 'info';
                                $text = 'Konfirmasi';
                            } elseif ($row['proses'] == '3') {
                                $proses = '<i class="text-success">Dikirim</i>';
                                $color = 'success';
                                $text = 'Dikirim';
                            } else {
                                $proses = '<i class="text-success">Diterima </i>';
                                $color = 'primary';
                                $text = 'Diterima';
                            }
                            $total = $this->db->query(
                                "SELECT a.kode_transaksi, a.kurir, a.service, a.proses, a.ongkir, e.nama_kota, f.nama_provinsi, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) 
                                    as total, sum(c.berat*b.jumlah) as total_berat 
                                    FROM `penjualan` a 
                                    JOIN detail_penjualan b 
                                    ON a.id_penjualan=b.id_penjualan JOIN produk c ON b.id_produk=c.id_produk 
                                    JOIN user d ON a.id_pembeli=d.id
                                    JOIN kota e ON d.kota_id=e.kota_id 
                                    JOIN provinsi f ON e.provinsi_id=f.provinsi_id 
                                    where a.kode_transaksi='$row[kode_transaksi]'"
                            )->row_array();

                            echo "<tr><td>$no</td>
                                            <td>$row[kode_transaksi]</td>
                                            <td style='color:red;'>Rp $total[total]+$total[ongkir]+ ".substr($this->uri->segment(3),-3)."</td>
                                            <td><span style='text-transform:uppercase'>$total[kurir]</span> ($total[service])</td>
                                            <td><a target='_BLANK' title='$total[nama_provinsi] -> $total[nama_kota]' href='https://www.google.com/maps/place/$total[nama_kota]'>$total[nama_kota]</a></td>
                                            <td>$row[waktu_transaksi]</td>
                                            <td width='150px'>
                                              <div class='btn-group'> 
                                                <button style='width:70px' type='button' class='badge badge-$color'>$text</button> 
                                                <button type='button' class='badge badge-$color dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> <span class='caret'></span> <span class='sr-only'>Toggle Dropdown</span> </button> 
                                                  <ul class='dropdown-menu' style='border:1px solid #cecece;'> 
                                                    <li><a href='" . base_url() . "admin/orders_status/$row[id_penjualan]/0' onclick=\"return confirm('Apa anda yakin untuk ubah status jadi Pending ?')\"> Pending</a></li> 
                                                    <li><a href='" . base_url() . "admin/orders_status/$row[id_penjualan]/1' onclick=\"return confirm('Apa anda yakin untuk ubah status jadi Packing ?')\"> Packing</a></li> 
                                                    <li><a href='" . base_url() . "admin/orders_status/$row[id_penjualan]/2' onclick=\"return confirm('Apa anda yakin untuk ubah status jadi Konfirmasi ?')\"> Konfirmasi</a></li> 
                                                    <li><a href='" . base_url() . "admin/orders_status/$row[id_penjualan]/3' onclick=\"return confirm('Apa anda yakin untuk ubah status jadi Dikirim ?')\"> Dikirim</a></li> 
                                                    <li><a href='" . base_url() . "admin/orders_status/$row[id_penjualan]/4' onclick=\"return confirm('Apa anda yakin untuk ubah status jadi Diterima ?')\"> Diterima</a></li> 
                                                  </ul> 
                                              </div>
                                            <a class='badge badge-info' title='Detail data pesanan' href='" . base_url() . "admin/tracking/$row[kode_transaksi]'><span class='glyphicon glyphicon-search'></span>detail</a>
                                            <a class='badge badge-danger' title='Delete Data' href='" . base_url() . "admin/delete_transaksi/$row[id_penjualan]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span>del</a></td>
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