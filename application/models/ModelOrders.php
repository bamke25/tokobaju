<?php
class ModelOrders extends CI_model
{
    public function konfirmasi_bayar()
    {
        return $this->db->query("SELECT b.kode_transaksi, a.*, c.* FROM `konfirmasi` a JOIN penjualan b ON a.id_penjualan=b.id_penjualan JOIN rekening c ON a.id_rekening=c.id_rekening ORDER BY a.id_konfirmasi_pembayaran DESC");
    }

    public function orders_report_all()
    {
        return $this->db->query("SELECT * FROM `rb_penjualan` a ORDER BY a.id_penjualan DESC");
    }
}
