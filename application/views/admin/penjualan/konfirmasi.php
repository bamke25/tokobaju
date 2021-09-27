<div class='container-fluid'>

    <h1 class="h3 mb-2 text-gray-800">Semua Konfirmasi Pembayaran</h1>
    <p class="mb-4">Menampilkan semua konfirmasi pembayaran pembeli dari dari toko baju MasCitra.com</p>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>

        </div>
        <div class='card-body'>
            <div class='table-responsive'>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20px">No</th>
                            <th>Kode Transaksi</th>
                            <th>Total Transfer</th>
                            <th>Pengirim</th>
                            <th>Rekening Tujuan</th>
                            <th>Waktu Transfer</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($record->result_array() as $row) {
                            // if ($row['proses'] == '0') {
                            //     $proses = '<i class="text-danger">Pending</i>';
                            // } elseif ($row['proses'] == '1') {
                            //     $proses = '<i class="text-warning">Proses</i>';
                            // } elseif ($row['proses'] == '2') {
                            //     $proses = '<i class="text-info">Konfirmasi</i>';
                            // } else {
                            //     $proses = '<i class="text-success">Packing </i>';
                            // }
                            echo "<tr><td>$no</td>
                                            <td>#</td>
                                            <td style='color:red;'>$row[total_transfer]</td>
                                            <td>$row[nama_pengirim]</td>
                                            <td>$row[nama_bank]</td>
                                            <td>$row[tanggal_transfer]</td>
                                            <td width='50px'><a class='badge badge-success' href='" . base_url() . "admin/tracking/$row[kode_transaksi]'>detail</a></td>
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
