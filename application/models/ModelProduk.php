<?php 
class ModelProduk extends CI_model
{
    public function view_produk()
    {
        return $this->db->get('produk')->result_array();
    }

    public function view_tambah_produk($table,$order,$ordering)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function tambah_produk($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function edit_produk($table, $data)
    {
        return $this->db->get_where($table, $data);
    }

    public function update_produk($table, $data, $where)
    {
        return $this->db->update($table, $data, $where); 
    }

    public function hapus($id)
    {
        $this->db->where('id_produk', $id);
        return $this->db->delete('produk');
    }

    public function jual($id){
        return $this->db->query("SELECT sum(a.jumlah) as jual FROM rb_penjualan_detail a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan where a.id_produk='$id' AND b.proses='1'");
    }

    public function beli($id){
        return $this->db->query("SELECT sum(a.jumlah_pesan) as beli FROM rb_pembelian_detail a where a.id_produk='$id'");
    }


}