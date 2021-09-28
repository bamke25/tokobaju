<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('cek_helper');
        $this->load->model('ModelAdmin');
        $this->load->model('ModelRekening');
        $this->load->model('ModelProduk');
        $this->load->model('ModelOrders');
    }

    // Login dan Registrasi
    public function index()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // Validasi sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        // Jika user ada
        if ($user) {
            // Jika user aktif
            if ($user['is_active'] == 1) {
                // Cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    redirect('admin/dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                this password is wrong!!</div>');
                    redirect('admin');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                this email has not been activated!</div>');
                redirect('admin');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            this email not registered</div>');
            redirect('admin');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('name', 'name', 'required|trim');
        $this->form_validation->set_rules(
            'email',
            'email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'is_unique' => 'this email has already registered!'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'password',
            'required|trim|min_length[5]|matches[password2]',
            [
                'matches' => 'password do not match!',
                'min_length' => 'password too short!'
            ]
        );
        $this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registation';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulations! Your Account has been createrd. Please Login!</div>');
            redirect('admin');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You have been logout!</div>');
        redirect('admin');
    }

    public function forgot_password()
    {
        // buat judul di tab
        // don't touch after it works well
        echo "<head><title>Forgot Password</title></head>";
        $this->load->view('templates/auth_header');
        $this->load->view('templates/auth_footer');
        $this->load->view('auth/forgot_password');
    }


    // Controller Dashboard
    public function dashboard()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Dashboard';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/dashboard/index', $data);
        $this->load->view('templates/footer');
    }



    // Controller Produk
    public function produk()
    {
        $data['produk'] = $this->ModelProduk->view_produk();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Produk';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/produk/produk', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_produk()
    {
        $data['kategori'] = $this->ModelProduk->view_tambah_produk('kategori_produk', 'id_kategori', 'DESC');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Tambah Produk';


        if (isset($_POST['submit'])) {
            $config['upload_path'] = './assets/img/produk/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $hasil = $this->upload->data();
            if ($hasil['file_name'] == '') {
                $data = array(
                    'id_kategori' => $this->input->post('id_kategori'),
                    'nama_produk' => $this->db->escape_str($this->input->post('nama_produk')),
                    'satuan' => $this->input->post('satuan'),
                    'harga' => $this->input->post('harga'),
                    'berat' => $this->input->post('berat'),
                    'keterangan' => $this->input->post('keterangan')
                );
            } else {
                $data = array(
                    'id_kategori' => $this->input->post('id_kategori'),
                    'nama_produk' => $this->db->escape_str($this->input->post('nama_produk')),
                    'satuan' => $this->input->post('satuan'),
                    'harga' => $this->input->post('harga'),
                    'berat' => $this->input->post('berat'),
                    'keterangan' => $this->input->post('keterangan'),
                    'gambar' => $hasil['file_name']
                );
            }
            $this->ModelProduk->tambah_produk('produk', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk berhasil ditambahkan!</div>');
            redirect('admin/produk');
        } else {
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/produk/tambah_produk', $data);
            $this->load->view('templates/footer');
        }
    }

    public function edit_produk()
    {
        $data['kategori'] = $this->ModelProduk->view_tambah_produk('kategori_produk', 'id_kategori', 'DESC');
        $id = $this->uri->segment(3);
        $data['edit'] = $this->ModelProduk->edit_produk('produk', array('id_produk' => $id))->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Edit Produk';

        if (isset($_POST['submit'])) {
            $config['upload_path'] = './assets/img/produk/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $hasil = $this->upload->data();

            if ($hasil['file_name'] == '') {
                $data = array(
                    'id_kategori' => $this->input->post('id_kategori'),
                    'nama_produk' => $this->db->escape_str($this->input->post('nama_produk')),
                    'satuan' => $this->input->post('satuan'),
                    'harga' => $this->input->post('harga'),
                    'berat' => $this->input->post('berat'),
                    'keterangan' => $this->input->post('keterangan')
                );
            } else {
                $data = array(
                    'id_kategori' => $this->input->post('id_kategori'),
                    'nama_produk' => $this->db->escape_str($this->input->post('nama_produk')),
                    'satuan' => $this->input->post('satuan'),
                    'harga' => $this->input->post('harga'),
                    'berat' => $this->input->post('berat'),
                    'keterangan' => $this->input->post('keterangan'),
                    'gambar' => $hasil['file_name']
                );
            }
            $where = array('id_produk' => $this->input->post('id'));
            $this->ModelProduk->update_produk('produk', $data, $where);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk berhasil diupdate!</div>');
            redirect('admin/produk');
        } else {
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/produk/edit_produk', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete($id)
    {
        $this->ModelProduk->hapus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk berhasil dihapus!</div>');
        redirect('admin/produk');
    }



    // Controller Kategori Produk
    public function kategori_produk()
    {
        $data['kategori'] = $this->ModelAdmin->view_kategori();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Kategori Produk';

        $this->form_validation->set_rules('kategori', 'kategori produk', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/kategori/kategori', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ModelAdmin->tambah_kategori_produk();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori produk berhasil ditambahkan!</div>');
            redirect('admin/kategori_produk');
        }
    }

    public function edit_kategori()
    {
        if (isset($_POST['submit'])) {
            $data = array('nama_kategori' => $this->input->post('nama_kategori'));
            $where = array('id_kategori' => $this->input->post('id'));
            $this->ModelAdmin->update_kategori('kategori_produk', $data, $where);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori produk berhasil diupdate!</div>');
            redirect('admin/kategori_produk');
        } else {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['title'] = 'Edit kategori produk';
            $id = $this->uri->segment(3);
            $edit = $this->ModelAdmin->edit_kategori('kategori_produk', array('id_kategori' => $id))->row_array();
            $dataa = array('kategori' => $edit);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/kategori/edit_kategori', $dataa);
            $this->load->view('templates/footer');
        }
    }

    public function delete_kategori()
    {
        $id = array('id_kategori' => $this->uri->segment(3));
        $this->ModelAdmin->delete('kategori_produk', $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk berhasil dihapus!</div>');
        redirect('admin/kategori_produk');
    }





    // Controller Member
    public function member()
    {
        $data['member'] = $this->ModelAdmin->member();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Member';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/member/member', $data);
        $this->load->view('templates/footer');
    }

    public function detail_member()
    {
        $data['member'] = $this->ModelAdmin->member();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Member';
        $id = $this->uri->segment(3);
        $data['record'] = $this->ModelOrders->orders_report($id);
        $data['rows'] = $this->ModelAdmin->profile_konsumen($id)->row_array();
        $data['detail'] = $this->ModelAdmin->edit_member('user', array('id' => $id))->row_array();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/member/detail_member', $data);
        $this->load->view('templates/footer');
    }




    // Controller Rekening
    public function rekening()
    {
        $data['rekening'] = $this->ModelRekening->rekening();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Rekening';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/rekening/rekening', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_rekening()
    {
        $data['rekening'] = $this->ModelRekening->rekening();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Rekening';

        if (isset($_POST['submit'])) {
            $this->ModelRekening->rekening_tambah();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Rekening berhasil ditambah!</div>');
            redirect('admin/rekening');
        } else {
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/rekening/rekening', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete_rekening()
    {
        $id = $this->uri->segment(3);
        $this->ModelRekening->rekening_delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Rekening berhasil dihapus!</div>');
        redirect('admin/rekening');
    }

    public function edit_rekening()
    {
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])) {
            $this->model_rekening->rekening_update();
            redirect('admin/rekening');
        } else {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['title'] = 'Edit Rekening';
            $data['edit'] = $this->ModelRekening->rekening_edit($id)->row_array();
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/rekening/edit_rekening', $data);
            $this->load->view('templates/footer');
        }
    }



    // Controller Stok Barang
    public function tambah_stok_barang()
    {
        if (isset($_POST['submit1'])) {
            if ($this->session->idp == '') {
                $data = array(
                    'waktu_beli' => date('Y-m-d H:i:s')
                );
                $this->ModelAdmin->insert('pembelian', $data);
                $idp = $this->db->insert_id();
                $this->session->set_userdata(array('idp' => $idp));
            } else {
                $data = array('waktu_beli' => date('Y-m-d H:i:s'));
                $where = array('id_pembelian' => $this->session->idp);
                $this->ModelAdmin->update('pembelian', $data, $where);
            }
            redirect('admin/tambah_stok_barang');
        } else
        if (isset($_POST['submit'])) {
            if ($this->input->post('idpd') == '') {
                $data = array(
                    'id_pembelian' => $this->session->idp,
                    'id_produk' => $this->input->post('aa'),
                    //   'harga_pesan'=>$this->input->post('bb'),
                    'jumlah_pesan' => $this->input->post('cc'),
                    'satuan' => $this->input->post('dd')
                );
                $this->ModelAdmin->insert('detail_pembelian', $data);
            } else {
                $data = array(
                    'id_produk' => $this->input->post('aa'),
                    //   'harga_pesan'=>$this->input->post('bb'),
                    'jumlah_pesan' => $this->input->post('cc'),
                    'satuan' => $this->input->post('dd')
                );
                $where = array('id_pembelian_detail' => $this->input->post('idpd'));
                $this->ModelAdmin->update('detail_pembelian', $data, $where);
            }
            redirect('admin/tambah_stok_barang');
        } else {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['title'] = 'Stok Barang';
            $data['produk'] = $this->ModelAdmin->view_ordering('produk', 'id_produk', 'ASC');
            $data['record'] = $this->ModelAdmin->view_join_where('detail_pembelian', 'produk', 'id_produk', array('id_pembelian' => $this->session->idp), 'id_pembelian_detail', 'DESC');
            $data['rows'] = $this->ModelAdmin->view_where('pembelian', array('id_pembelian' => $this->session->idp))->row_array();
            if ($this->uri->segment(3) != '') {
                $data['row'] = $this->ModelAdmin->view_where('detail_pembelian', array('id_pembelian_detail' => $this->uri->segment(3)))->row_array();
            }
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/stok_barang/tambah_stok', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete_tambah_stok_barang()
    {
        $id = array('id_pembelian_detail' => $this->uri->segment(3));
        $this->ModelAdmin->delete('detail_pembelian', $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Stok barang berhasil dihapus!</div>');
        redirect('admin/tambah_stok_barang');
    }




    // Controller Konfirmasi
    public function konfirmasi()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Konfirmasi Pembayaran Pesanan';
        $data['record'] = $this->ModelOrders->konfirmasi_bayar();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/penjualan/konfirmasi', $data);
        $this->load->view('templates/footer');
    }

    public function tracking()
    {
        if ($this->uri->segment(3) != '') {
            $kode_transaksi = filter($this->uri->segment(3));
            $data['title'] = 'Tracking Order ' . $kode_transaksi;
            $data['rows'] = $this->db->query("SELECT * FROM penjualan a JOIN user b ON a.id_pembeli=b.id JOIN kota c ON b.kota_id=c.kota_id where a.kode_transaksi='$kode_transaksi'")->row_array();
            $data['record'] = $this->db->query("SELECT a.kode_transaksi, b.*, c.nama_produk, c.satuan, c.berat, c.diskon FROM `penjualan` a JOIN detail_penjualan b ON a.id_penjualan=b.id_penjualan JOIN produk c ON b.id_produk=c.id_produk where a.kode_transaksi='" . $kode_transaksi . "'");
            $data['total'] = $this->db->query("SELECT a.resi, a.id_penjualan, a.kode_transaksi, a.kurir, a.service, a.proses, a.ongkir, sum((b.harga_jual*b.jumlah)-(c.diskon*b.jumlah)) as total, sum(c.berat*b.jumlah) as total_berat FROM `penjualan` a JOIN detail_penjualan b ON a.id_penjualan=b.id_penjualan JOIN produk c ON b.id_produk=c.id_produk where a.kode_transaksi='" . $kode_transaksi . "'")->row_array();
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/penjualan/detail_konfirmasi', $data);
            $this->load->view('templates/footer');
        }

        if (isset($_POST['submit'])) {
            $data = array('resi' => $this->input->post('resi'));
            $where = array('id_penjualan' => $this->uri->segment('4'));
            $this->model_app->update('rb_penjualan', $data, $where);
            redirect('administrator/tracking/' . $this->uri->segment('3'));
        }
    }




    // Controller Orders
    public function orders()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Laporan Pesanan Masuk';
        $data['record'] = $this->ModelOrders->orders_report_all();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/penjualan/orders', $data);
        $this->load->view('templates/footer');
    }
    public function orders_status()
    {
        $data = array('proses' => $this->uri->segment(4));
        $where = array('id_penjualan' => $this->uri->segment(3));
        $this->ModelOrders->update('penjualan', $data, $where);
        redirect('admin/orders');
    }

    public function print_orders()
    {
        $data['title'] = 'Laporan Pesanan Masuk';
        $data['record'] = $this->ModelOrders->orders_report_all();
        $this->load->view('admin/penjualan/orders_print', $data);
    }
}
