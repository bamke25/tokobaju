<?php
class ModelAdmin extends CI_model
{
    public function member()
    {
        return $this->db->get('user')->result_array();
    }

    public function edit_member($table, $data)
    {
        return $this->db->get_where($table, $data);
    }

    public function view_kategori()
    {
        return $this->db->get('kategori_produk')->result_array();
    }

    public function tambah_kategori_produk()
    {
        return $this->db->insert('kategori_produk', ['nama_kategori' => $this->input->post('kategori')]);
    }

    public function edit_kategori($table, $data)
    {
        return $this->db->get_where($table, $data);
    }

    public function update_kategori($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function view_ordering($table, $order, $ordering)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order, $ordering);
        return $this->db->get()->result_array();
    }
    public function view_where($table, $data)
    {
        // $this->db->where($data);
        // return $this->db->get($table);
        return $this->db->get_where($table, $data);
    }

    public function view_join()
    {
        $this->db->select('*');
        $this->db->from('detail_pembelian');
        $this->db->join('produk', 'produk.id_produk = detail_pembelian.id_produk');

        $query = $this->db->get()->result_array();
        return $query;
    }

    public function view_join_where($table1, $table2, $field, $where, $order, $ordering)
    {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1 . '.' . $field . '=' . $table2 . '.' . $field);
        $this->db->where($where);
        $this->db->order_by($order, $ordering);
        return $this->db->get()->result_array();
    }

    public function insert($table, $data)
    {
        return $this->db->insert($table, $data);
    }
    public function update($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }
}
