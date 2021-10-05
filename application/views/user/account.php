 <div class="katalogtitle">
        <h1>MY ACCOUNT</h1>
    </div>
    <div class="katalog">
        <form action="<?php echo base_url('user/account_act')?>" class="account" method="POST">
            <div class="boxform">
                <div class="form">
                    <label for="name">nama</label>
                    <input type="text" name="name" id="name" placeholder="masukan nama anda" value="<?php echo $this->session->userdata('name'); ?>" readonly>
                </div>
                <div class="form">
                    <label for="tlp">No telepon</label>
                    <input type="text" name="tlp" id="tlp" placeholder="masukan no telepon" required>
                </div>
                <div class="form">
                    <label for="provinsi">provinsi</label><br><br>
                    <select class= "select" id="provinsi" name="provinsi" required>
                        <?php 
                        // i do not know how to print out the MariaDB data from model
                        // so i fetch data natively on php not by codeigniter
                            $mysqli = new mysqli("localhost", "root", "", "toko_baju");
                            if ($result = $mysqli->query("select * from provinsi")){
                                while ($prov = $result->fetch_assoc()){?>
                        <option value="<?php echo $prov['nama_provinsi'];?>">
                            <?php echo $prov['nama_provinsi']; }?>
                        </option>
                    <?php }?>
                    </select>
                </div>
                <div class="form">
                    <label for="kota">Kota</label> <br><br>
                   <select id="kota" name="kota" class="select" required>
                    <?php 
                        $i = 1;
                        foreach ($kota as $kota) {?>
                       <option value="<?php echo $kota->kota_id; ?>">
                        <?php echo $kota->nama_kota;?>
                       </option>
                   <?php } ?>
                   </select>
                </div>

                <div class="form">
                    <label for="alamat">alamat</label>
                    <input type="text" name="alamat" id="alamat" placeholder="masukan alamat anda" required>
                </div>
                <div class="form">
                    <button type="submit">save</button>
                    <button type="submit">edit</button>
                </div>
            </div>
        </form>
    </div>