<?php
class ModelRekening extends CI_model
{
    function rekening()
    {
        return $this->db->get('rekening')->result_array();
    }

    function rekening_tambah()
    {
        $data = [
            'nama_bank' => htmlspecialchars($this->input->post('nama_bank')),
            'no_rekening' => htmlspecialchars($this->input->post('no_rekening')),
            'pemilik_rekening' => htmlspecialchars($this->input->post('pemilik_rekening'))
        ];
        $this->db->insert('rekening', $data);
    }

    function rekening_edit($id)
    {
        return $this->db->query("SELECT * FROM rekening where id_rekening=$id");
    }

    function rekening_update()
    {
        $data = array(
            'nama_bank' => $this->db->escape_str($this->input->post('nama_bank')),
            'no_rekening' => $this->db->escape_str($this->input->post('no_rekening')),
            'pemilik_rekening' => $this->db->escape_str($this->input->post('pemilik_rekening'))
        );
        $this->db->where('id_rekening', $this->input->post('id_rekening'));
        $this->db->update('rekening', $data);
    }

    function rekening_delete($id)
    {
        return $this->db->query("DELETE FROM rekening where id_rekening=$id");
    }
}
