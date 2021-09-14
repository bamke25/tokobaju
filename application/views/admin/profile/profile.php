
<title><?= $title ?></title>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>My Profile</h3>
        </div>
        <!-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('User/profile'); ?>">Home</a></li>
          </ol>
        </div> -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content-wrapper">

    <br><br>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-8">
          <?= $this->session->flashdata('message'); ?>
        </div>
      </div>
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-5">
            <img width="250px" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-fluid rounded-start">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <th>
                <h3>
                  <tr>
                    <td><?php echo $user['name'] ?></td>
                  </tr> <br>
                </h3>
                <h5>
                  <tr>
                    <td><?php echo $user['email'] ?></td>
                  </tr>
                </h5>
              </th>
              <p class="card-text"><small class="text-muted">As a Member since <?= date('d F Y', $user['date_created']); ?> </small></p>
              <div class="row">
                <div class="col-sm-5">
                  <a class="btn btn-secondary btn-sm" href="<?= base_url('user/edit_profile'); ?>">Edit Profile</a>
                </div>
                <div class="col-sm-7">
                  <a class="btn btn-secondary btn-sm" href="<?= base_url('user/change_password'); ?>">Change Password</a>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->






</section>
<!-- /.content -->
</div>