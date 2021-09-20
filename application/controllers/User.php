<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('usermodel');
    }
    public function index()
    {
        $this->load->model('usermodel');
        $data['produk'] = $this->usermodel->getProduk();
        $this->load->view('templates/user_header');
        $this->load->view('templates/user_navbar');
        $this->load->view('user/index', $data);
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

    public function admin()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
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
            } else {
                if (password_verify($pass, $login->password)) {
                //if the username and password is a math
                    $this->session->set_userdata('name', $login->name);

                    redirect('index.php');
                } else {
                     echo '<script>alert("Username atau Password yang Anda masukan salah.");window.location.href="'.base_url('index.php').'";</script>';
                }
            }
        }
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
            //system prints message in alert command
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
