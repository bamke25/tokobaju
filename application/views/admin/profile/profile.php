<div class='container-fluid'>

  <h1 class="h4 mb-2 text-gray-800">My Profile</h1>
  <p class="mb-4">Menampilkan detail profile admin dari toko baju MasCitra.com</p>

  <div class='card shadow mb-4'>
    <div class='card-header py-3'>

    </div>
    <div class='card-body'>
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
</div>