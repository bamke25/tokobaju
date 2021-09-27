<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Import extends CI_Controller
{

    public function excel()
    {
        if (isset($_FILES["file"]["name"])) {
            // upload
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];
            $file_size = $_FILES['file']['size'];
            $file_type = $_FILES['file']['type'];
            // move_uploaded_file($file_tmp,"uploads/".$file_name); // simpan filenya di folder uploads

            $object = PHPExcel_IOFactory::load($file_tmp);

            foreach ($object->getWorksheetIterator() as $worksheet) {

                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();

                for ($row = 4; $row <= $highestRow; $row++) {

                    $id_kategori = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $nama_produk = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $satuan = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $harga_beli = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $harga = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $berat = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $diskon = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $keterangan = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $gambar = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

                    $data[] = array(
                        'id_kategori' => $id_kategori,
                        'nama_produk' => $nama_produk,
                        'satuan' => $satuan,
                        'harga_beli' => $harga_beli,
                        'harga' => $harga,
                        'berat' => $berat,
                        'diskon' => $diskon,
                        'keterangan' => $keterangan,
                        'gambar' => $gambar,
                    );
                }
            }

            $this->db->insert_batch('produk', $data);

            $message = array(
                'message' => '<div class="alert alert-success">Import file excel berhasil disimpan di database</div>',
            );

            $this->session->set_flashdata($message);
            redirect('admin/produk');
        } else {
            $message = array(
                'message' => '<div class="alert alert-danger">Import file gagal, coba lagi</div>',
            );

            $this->session->set_flashdata($message);
            redirect('admin/produk');
        }
    }
}

    /* End of file Import.php */
    /* Location: ./application/controllers/Import.php */