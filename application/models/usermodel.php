<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodel extends CI_Model{
    public function getProduk($val){
        if ($val > 0) {
            $data = $this->db->query("SELECT * FROM produk limit 0,6");
        } else {
            $data = $this->db->query("SELECT * FROM produk");
        }
        return $data->result_array();
    }
    public function getSearchProduk($nama){
        $data = $this->db->query("SELECT * FROM produk WHERE nama_produk LIKE '%$nama%'");
        return $data->result_array();
    }

    public function register($table, $data){
    	return $this->db->insert($table, $data);
    }

    public function login($email){
    	$hasil = $this->db->where('email', $email)->limit(1)->get('user');
    	if($hasil->num_rows() > 0){
    		return $hasil->row();
    	} else{
    		return array();
    	}
    }
    public function getHargaProduk($id){
        $data = $this->db->query("SELECT * FROM produk WHERE id_produk =  '$id'");
        return $data->row_array();
    }
    public function getTotalkeranjang(){
        $data = $this->db->query("SELECT SUM(total) as total FROM keranjang");
        return $data->row_array();
    }
    public function getTolkeranjang(){
        $data = $this->db->get("keranjang");
        return $data->num_rows();
    }

    public function getKeranjang(){

		$this->db->select("keranjang.id,produk.gambar,produk.harga,keranjang.quantity,keranjang.total");
		$this->db->join("produk","produk.id_produk = keranjang.id_produk");
     	return $this->db->get('keranjang')->result_array();
    }
    public function getProvinsi(){
        $data = $this->db->get("provinsi");
        return $data->result_array();
    }
    public function insertKeranjang($data,$table){
        $this->db->insert($table,$data);
    }
    public function update_alamat($id,$data){
        $this->db->where('name', $id)->update("user", $data);
        return $this->db->affected_rows();  
    }
    public function deleteKeranjang($id,$table){
        $this->db->where($id);
        $this->db->delete($table);
    }
    public function editKeranjang($table,$data,$id){
        $this->db->update_batch($table,$data,$id);
    }
    public function get_city($id)
    {
       $this->db->where('provinsi_id', $id);
        $result = $this->db->get("kota")->result(); // Tampilkan semua data kota berdasarkan id provinsi
        return $result; 
    }

}
?>