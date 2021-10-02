<?php
class ModelOrders extends CI_model
{
    public function konfirmasi_bayar()
    {
        return $this->db->query("SELECT b.kode_transaksi, a.*, c.* FROM `konfirmasi` a JOIN penjualan b ON a.id_penjualan=b.id_penjualan JOIN rekening c ON a.id_rekening=c.id_rekening ORDER BY a.id_konfirmasi_pembayaran DESC");
    }

    public function orders_report_all()
    {
        return $this->db->query("SELECT * FROM `penjualan` a ORDER BY a.id_penjualan DESC");
    }

    public function update($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    function orders_report($id)
    {
        return $this->db->query("SELECT * FROM `penjualan` a where a.id_pembeli='$id' ORDER BY a.id_penjualan DESC");
    }

    public function view_where($table, $data)
    {
        $this->db->where($data);
        return $this->db->get($table);
    }

    function orders_report_home($limit)
    {
        return $this->db->query("SELECT * FROM `penjualan` a ORDER BY a.id_penjualan DESC LIMIT $limit");
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
}
