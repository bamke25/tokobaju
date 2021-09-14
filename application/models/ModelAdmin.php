<?php 
class ModelAdmin extends CI_model
{
    public function view_kategori()
    {
        return $this->db->get('kategori_produk')->result_array();
    }

    public function view_produk()
    {
        return $this->db->get('produk')->result_array();
    }

    public function tambah_kategori_produk()
    {
        return $this->db->insert('kategori_produk', ['nama_kategori'=> $this->input->post('kategori')]);
    }

    public function edit_kategori($table, $data)
    {
        return $this->db->get_where($table, $data);
    }

    public function update_kategori($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    public function tambah_produk($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function view_tambah_produk($table,$order,$ordering)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function update_produk($table, $data, $where)
    {
        return $this->db->update($table, $data, $where); 
    }

    public function edit_produk($table, $data)
    {
        return $this->db->get_where($table, $data);
    }

    //cara 1
    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    //cara 2
    public function hapus($id)
    {
        $this->db->where('id_produk', $id);
        return $this->db->delete('produk');
    }

}