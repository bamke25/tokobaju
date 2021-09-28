 <div class="katalogtitle">
        <h1>MY ACCOUNT</h1>
    </div>
    <div class="katalog">
        <form action="" class="account">
            <div class="boxform">
                <div class="form">
                    <label for="name">nama</label>
                    <input type="text" name="name" id="name" placeholder="masukan nama anda" value="<?php echo $this->session->userdata('name'); ?>" disabled>
                </div>
                <div class="form">
                    <label for="tlp">No telepon</label>
                    <input type="text" tlp="tlp" id="tlp" placeholder="masukan no telepon">
                </div>
                <div class="form">
                    <label for="profinsi">profinsi</label>
                    <input type="text" name="profinsi" id="profinsi" placeholder="masukan profinsi anda">
                </div>
                <div class="form">
                    <label for="kota">Kota</label>
                    <input type="text" name="Kota" id="Kota" placeholder="masukan kota anda">
                </div>
                <div class="form">
                    <label for="alamat">alamat</label>
                    <input type="text" name="alamat" id="alamat" placeholder="masukan alamat anda">
                </div>
                <div class="form">
                    <button type="submit">save</button>
                    <button type="submit">edit</button>
                </div>
            </div>
        </form>
    </div>