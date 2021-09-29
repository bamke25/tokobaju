<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('usermodel');
        $this->load->model('ModelOrders');
        $this->load->model('ModelAdmin');
    }

    public function index()
    {
        $this->load->model('usermodel');
        $data['produk'] = $this->usermodel->getProduk(1);
        $data['keranjang'] = $this->usermodel->getKeranjang();
        $data['jumlah'] = $this->usermodel->getTolkeranjang();
        $data['provinsi'] = $this->usermodel->getProvinsi();
        $harga = $this->usermodel->getTotalkeranjang();
        $data['total'] = $harga['total'];
        $data['name'] = $this->session->userdata('name');
        $this->load->view('templates/user_header',$data);
        $this->load->view('templates/user_navbar');
        $this->load->view('user/index', $data);
        $this->load->view('templates/user_footer');
    }
    public function shopeall()
    {
        $this->load->model('usermodel');
        $data['name'] = $this->session->userdata('name');
        $data['produk'] = $this->usermodel->getProduk(0);
        $data['keranjang'] = $this->usermodel->getKeranjang();
        $data['jumlah'] = $this->usermodel->getTolkeranjang();
        $harga = $this->usermodel->getTotalkeranjang();
        $data['total'] = $harga['total'];
        $this->load->view('templates/user_header',$data);
        $this->load->view('templates/user_navbar');
        $this->load->view('user/shopeall', $data);
        $this->load->view('templates/user_footer');
    }

    public function search_katalog()
    {
        $this->load->model('usermodel');
        $nama = $this->input->get('search');
        $data['produk'] = $this->usermodel->getSearchProduk($nama);
        $this->load->view('templates/user_header');
        $this->load->view('templates/user_navbar');
        $this->load->view('user/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function cart()
    {
        $this->load->model('usermodel');
        $id_produk = $this->input->post('id_produk');
        $quantity = $this->input->post('quantity');
        $harga = $this->usermodel->getHargaProduk($id_produk);
        $hrg = $harga['harga'];
        $total = $hrg * $quantity;
        $data = array(
                'id_produk' =>$id_produk,
                'quantity'  =>$quantity,
                'total'     => $total
                );

        $this->usermodel->insertKeranjang($data,'keranjang');
        redirect('user/#cart');


    }
     public function delete_cart($id)
    {
        $this->load->model('usermodel');
        $where = array('id' => $id); 
        $this->usermodel->deleteKeranjang($where,'keranjang');
        redirect('user/#cart');
    }
     public function editKeranjang()
    {
        $this->load->model('usermodel');
        $id = $this->input->post('id');
        $harga = $this->input->post('harga');
        $quantity = $this->input->post('qty');
        $result =  array();
        foreach ($id as $key => $val) {
            $result[] =  array(
                'id' => $id[$key],
                'quantity' => $quantity[$key],
                'total' => $harga[$key]*$quantity[$key]
            );
        }
        $this->usermodel->editKeranjang('keranjang', $result, 'id');
        redirect('user/#cart');
    }
    public function get_kota(){
        $this->load->model('usermodel');
        $id_provinsi = $this->input->post('id_provinsi');
        $kota = $this->usermodel->get_city($id_provinsi);
 
        // Buat variabel untuk menampung tag-tag option nya
        // Set defaultnya dengan tag option Pilih
        $lists = "<option value=''>Kota atau Kabupaten</option>";
        foreach($kota as $data){
            $lists .= "<option value='".$data->kota_id.".".$data->nama_kota."'>".$data->nama_kota."</option>"; // Tambahkan tag option ke variabel $lists
        }
        $callback = array('get_city'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
        echo json_encode($callback);
    }

    public function account(){
        $this->load->model('Usermodel');

        $data['name'] = $this->session->userdata('name');
        $data['produk'] = $this->usermodel->getProduk(0);
        $data['keranjang'] = $this->usermodel->getKeranjang();
        $data['jumlah'] = $this->usermodel->getTolkeranjang();
        $harga = $this->usermodel->getTotalkeranjang();
        $data['total'] = $harga['total'];

        $this->load->view('templates/user_navbar', $data);
        $this->load->view('user/account');
        $this->load->view('templates/user_header',$data);
    }


    public function admin()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>$this->session->userdata('email')])->row_array();
        $id = $this->uri->segment(3);
		$data['record'] = $this->ModelOrders->orders_report($id);
		$data['rows'] = $this->ModelAdmin->profile_konsumen($id)->row_array();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/profile/profile', $data);
        $this->load->view('templates/footer');
    }

    public function edit_profile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/profile/edit_profile', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //Cek jika ada gambar yg akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Your profile has been update!</div>');
            redirect('user/admin');
        }
    }

    public function history(){

    }
    public function update_alamat(){
        $nama = $this->input->post('nama');
        $no = $this->input->post('no_tlp');
        $lahir = $this->input->post('lahir');
        $kota = $this->input->post('kota');
        $id_kota = explode(".", $kota);
        $alamat = $this->input->post('alamat');
        $data = array(
                        'alamat_lengkap'  => $alamat,
                        'tempat_lahir'  => $lahir,
                        'kota_id' => $id_kota[0],
                        'no_hp' => $no
        );
        $this->usermodel->update_alamat($nama,$data);
        // Buat variabel untuk menampung tag-tag option nya
        // Set defaultnya dengan tag option Pilih
        
 //
    }

    public function login(){
        $this->load->library('form_validation');

        $this->load->library('session');
        $this->load->model('Usermodel');

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run() == FALSE){
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('input', $this->input->post());
            redirect('index.php'); //login
        } else {
            $email = htmlspecialchars($this->input->post('email'));
            $pass = htmlspecialchars($this->input->post('password'));

            //cek ke database berdasarkan email
            $login = $this->Usermodel->login($email);

            if ($login == FALSE) {
                 echo '<script>alert("Username yang Anda masukan salah.");window.location.href="'.base_url('index.php').'";</script>';
                 redirect('index.php', 'refresh');
            } else {
                if (password_verify($pass, $login->password)) {
                //if the username and password is matched
                    $this->session->set_userdata('name', $login->name);
                    redirect('index.php');
                } else {
                     echo '<script>alert("Username atau Password yang Anda masukan salah.");window.location.href="'.base_url('index.php').'";</script>';
                }
            }
        }
    }

    public function logout(){
        // unset current session then redirect to home page
        $this->session->sess_destroy();
        echo 'alert("Sukses! Anda berhasil logout."); window.location.href="'.base_url('index.php/').'";';
        redirect('index.php');
    }

    public function register(){
        //load libraries and a model.
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Usermodel');

        //input required
        $this->form_validation->set_rules('regemail', 'email', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('regpassword', 'Password', 'required');

        // if no input, system will redirect user to homepage then system asks user to type required inputs.
        if($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('input', $this->input->post());
            redirect('index.php');
        } else { //if all input is typed, system will encrypt password and send it to database
            $email = $this->input->post('regemail');
            $name = $this->input->post('name');
            $password = $this->input->post('regpassword');

            $pass = password_hash($password, PASSWORD_DEFAULT);

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $pass,
                'role_id' => 2
            ];

            // send hashed password and other input to database
            $insert = $this->Usermodel->register("user", $data);
            //system prints message such as below
            if($insert) {
                echo '<script>alert("Sukses! Anda berhasil melakukan register. Silahkan login untuk mengakses data.");window.location.href="'.base_url('index.php').'";</script>';
            }
        }
    }

    public function change_password()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('currentpassword', 'current password', 'required|trim');
        $this->form_validation->set_rules('newpassword1', 'new password', 'required|trim|min_length[5]|matches[newpassword2]');
        $this->form_validation->set_rules('newpassword2', 'repeat password', 'required|trim|min_length[5]|matches[newpassword1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/profile/change_password', $data);
            $this->load->view('templates/footer');
        } else {
            $currentpassword = $this->input->post('currentpassword');
            $newpassword = $this->input->post('newpassword1');
            if (!password_verify($currentpassword, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong current password</div>');
                redirect('user/change_password');
            } else {
                if ($currentpassword == $newpassword) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    new password cannot be the same as a current password!</div>');
                    redirect('user/change_password');
                } else {
                    //password bagus
                    $password_hash = password_hash($newpassword, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password change!</div>');
                    redirect('user/admin');
                }
            }
        }
    }


}
