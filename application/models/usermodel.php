<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodel extends CI_Model{
    public function getProduk(){
        $data = $this->db->query("SELECT * FROM produk");
        return $data->result_array();
    }
    public function getSearchProduk($nama){
        $data = $this->db->query("SELECT * FROM produk WHERE nama_produk LIKE '%$nama%'");
        return $data->result_array();
    }
}
?>