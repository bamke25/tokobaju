<div class='container-fluid'>
  <div class='box box-info'>
    <h1 class="h3 mb-2 text-gray-800">My Profile</h1>
    <p class="mb-4">Menampilkan detail profile admin dari toko baju MasCitra.com</p>

    <div class='card shadow mb-4'>
      <div class='card-header py-3'>

      </div>
      <div class='card-body'>

        <!-- <div class='panel-body'> -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="keuangan-tab" data-toggle="tab" href="#keuangan" role="tab" aria-controls="keuangan" aria-selected="false">History Transaksi Belanja</a>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab"> <br>
            <div class='col-md-6'>
              <table class='table table-condensed table-bordered'>
                <tbody>
                  <tr bgcolor='#e3e3e3'>
                    <th rowspan='14' width='110px'>
                      <center><?php echo "<img style='border:1px solid #cecece; height:85px; width:85px' src='" . base_url() . "assets/img/profile/$user[image]' class='img-circle img-thumbnail'>"; ?></center>
                    </th>
                  </tr>
                  <tr>
                    <th width='130px' scope='row'>Username</th>
                    <td><?php echo $user['username'] ?></td>
                  </tr>
                  <tr>
                    <th scope='row'>Password</th>
                    <td>xxxxxxxxxxxxxxx</td>
                  </tr>
                  <tr>
                    <th scope='row'>Nama</th>
                    <td><?php echo $user['name'] ?></td>
                  </tr>
                  <tr>
                    <th scope='row'>Email</th>
                    <td><?php echo $user['email'] ?></td>
                  </tr>
                  <tr>
                    <th scope='row'>No Hp</th>
                    <td><?php echo $user['no_hp'] ?></td>
                  </tr>
                  <tr>
                    <th scope='row'>Jenis Kelamin</th>
                    <td><?php echo $user['jenis_kelamin'] ?></td>
                  </tr>
                  <tr>
                    <th scope='row'>Alamat</th>
                    <td><?php echo $user['alamat_lengkap'] ?></td>
                  </tr>
                  <tr>
                    <th scope='row'>Tanggal Daftar</th>
                    <td><?= date('d F Y', $user['date_created']); ?></td>
                  </tr>
                </tbody>
              </table>
              <div class="card-footer">
                <a style="float:right;" class="btn btn-secondary btn-sm" href="<?= base_url('user/change_password'); ?>">Change Password</a>
                <a style="float: right; margin-right:2px" class="btn btn-secondary btn-sm" href="<?= base_url('user/edit_profile'); ?>">Edit Profile</a>
              </div>
            </div>
          </div>
          <div style='clear:both'></div>
          <!-- </div> -->

          <div class="tab-pane fade" id="keuangan" role="tabpanel" aria-labelledby="keuangan-tab"> <br> <br>
            <div class='col-md-12'>
              <table id="dataTable" class='table table-hover table-condensed'>
                <thead>
                  <tr>
                    <th width="20px">No</th>
                    <th>Kode Transaksi</th>
                    <th>Total Belanja</th>
                    <th>Pengiriman</th>
                    <th>Status</th>
                    <th>Waktu Transaksi</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($record->result_array() as $row) {
                    if ($row['proses'] == '0') {
                      $proses = '<i class="text-danger">Pending</i>';
                    } elseif ($row['proses'] == '1') {
                      $proses = '<i class="text-warning">Proses</i>';
                    } elseif ($row['proses'] == '2') {
                      $proses = '<i class="text-info">Konfirmasi</i>';
                    } else {
                      $proses = '<i class="text-success">Packing </i>';
                    }
                    $total = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `penjualan` a JOIN detail_penjualan b ON a.id_penjualan=b.id_penjualan JOIN produk c ON b.id_produk=c.id_produk where a.kode_transaksi='$row[kode_transaksi]'")->row_array();
                    echo "<tr><td>$no</td>
                                            <td>$row[kode_transaksi]</td>
                                            <td style='color:red;'>Rp $total[total]+$total[ongkir]</td>
                                            <td><span style='text-transform:uppercase'>$total[kurir]</span> ($total[service])</td>
                                            <td>$proses</td>
                                            <td>$row[waktu_transaksi]</td>
                                            <td width='50px'><a class='badge badge-info' title='Detail data pesanan' href='" . base_url() . "admin/tracking/$row[kode_transaksi]'><span class='glyphicon glyphicon-search'></span>detail</a></td>
                                         </tr>";
                    $no++;
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- </div> -->

        </div>
      </div>
    </div>
  </div>