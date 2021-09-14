<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelAdmin');
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Dashboard';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function produk()
    {
        $data['produk'] = $this->ModelAdmin->view_produk();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Produk';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/produk/produk', $data);
        $this->load->view('templates/footer');
    }

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

    public function tambah_produk()
    {
        $data['kategori'] = $this->ModelAdmin->view_tambah_produk('kategori_produk', 'id_kategori', 'DESC');
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
            $this->ModelAdmin->tambah_produk('produk', $data);
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
        $data['kategori'] = $this->ModelAdmin->view_tambah_produk('kategori_produk', 'id_kategori', 'DESC');
        $id = $this->uri->segment(3);
        $data['edit'] = $this->ModelAdmin->edit_produk('produk', array('id_produk' => $id))->row_array();
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
            $this->ModelAdmin->update_produk('produk', $data, $where);
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
        $this->ModelAdmin->hapus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk berhasil dihapus!</div>');
        redirect('admin/produk');
    }


    public function member()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Member';
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/member');
    }
}
