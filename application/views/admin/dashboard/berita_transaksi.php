<div class="box box-info">
    <div class="box-header">
        <i class="fa fa-pencil"></i>
        <h4 class="box-title">Transaksi Penjualan Terbaru</h4>
        <div class="card-tools" style="float: right;">
            <button type="button" class="btn btn-tool" data-target="#transaksi" data-toggle="collapse" aria-expanded="true" aria-controls="collapsetransaksi"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
    </div>

    <!-- id="dataTable" -->
    <div class="collapse" id="transaksi">
        <div class="card-body">
            <table class='table table-hover table-condensed'>
                <thead>
                    <tr>
                        <th width="20px">No</th>
                        <th>Kode Transaksi</th>
                        <th>Total Belanja</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $record = $this->ModelOrders->orders_report_home(10);
                    foreach ($record->result_array() as $row) {
                        if ($row['proses'] == '0') {
                            $proses = '<i class="text-danger">Pending</i>';
                        } elseif ($row['proses'] == '1') {
                            $proses = '<i class="text-warning">Packing</i>';
                        } elseif ($row['proses'] == '2') {
                            $proses = '<i class="text-info">Konfirmasi</i>';
                        } elseif ($row['proses'] == '3') {
                            $proses = '<i class="text-success">Dikirim</i>';
                        } else {
                            $proses = '<i class="text-primary">Diterima </i>';
                        }
                        $total = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `penjualan` a JOIN detail_penjualan b ON a.id_penjualan=b.id_penjualan JOIN produk c ON b.id_produk=c.id_produk where a.kode_transaksi='$row[kode_transaksi]'")->row_array();
                        echo "<tr>
                                    <td>$no</td>
                                    <td>$row[kode_transaksi]</td>
                                    <td style='color:red;'>Rp " . rupiah($total['total'] + $total['ongkir']) . "</td>
                                    <td>$proses</td>
                                    <td>" . cek_terakhir($row['waktu_transaksi']) . " lalu</td>
                                    <td>
                                    <a class='badge badge-info' title='Detail data pesanan' href='" . base_url() . "admin/tracking/$row[kode_transaksi]'><span class='glyphicon glyphicon-search'></span>detail</a>
                                    <a class='badge badge-danger ' title='Delete Data' href='" . base_url() . "admin/delete_transaksi/$row[id_penjualan]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span>delete</a>
                                    </td>
                                     
                        </tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>