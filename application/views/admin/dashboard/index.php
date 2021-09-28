<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <a href="<?= base_url('admin/member'); ?>" class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Konsumen</div>
                            <?php $jumlah = $this->db->query("SELECT * FROM user")->num_rows(); ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah - 1 ?></div> <!-- catatan: dikurangi satu karena pada tabel user ada 1 admin -->
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Earnings (Monthly) Card Example -->
        <a href="<?= base_url('admin/kategori_produk'); ?>" class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Kategori</div>
                            <?php $jumlah = $this->db->query("SELECT * FROM kategori_produk")->num_rows(); ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-th-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Earnings (Monthly) Card Example -->
        <a href="<?= base_url('admin/produk'); ?>" class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Produk</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <?php $jumlah = $this->db->query("SELECT * FROM produk")->num_rows(); ?>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jumlah ?></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fab fa-buromobelexperte fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Pending Requests Card Example -->
        <a href="<?= base_url('admin/orders'); ?>" class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Transaksi</div>
                            <?php $jumlah = $this->db->query("SELECT * FROM penjualan")->num_rows(); ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <section class="col-lg-12 connectedSortable">
        <?php include "berita_transaksi.php"; ?>
    </section><!-- right col -->





</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->