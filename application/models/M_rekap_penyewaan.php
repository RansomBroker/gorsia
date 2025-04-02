<?php
class M_rekap_penyewaan extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk mengambil data kategori
    public function get_all_kategori(){
        $table = "kategori_olahraga";
        $this->db->order_by("kategori_olahraga", "asc");
        $this->db->where("memiliki_lapangan", "1");
        $query = $this->db->get($table);
        return $query->result();
    }

    // Fungsi untuk mengambil data transaksi sewa tanpa filter (tidak digunakan untuk tampilan default)
    public function get_all_rekap_penyewaan(){
        $table = "transaksi_sewa";
        $this->db->order_by("tanggal", "desc");
        $query = $this->db->get($table);
        return $query->result();
    }

    // Fungsi untuk mengambil data berdasarkan filter bulan, tahun, dan status (jika ada)
    public function get_all_rekap_penyewaan_by_month_year($month, $year, $status = ""){
        $table = "transaksi_sewa";
        $this->db->order_by("tanggal", "desc");
        $this->db->where('MONTH(tanggal)', $month);
        $this->db->where('YEAR(tanggal)', $year);
        if(!empty($status)){
            $this->db->where('status_transaksi', $status);
        }
        $query = $this->db->get($table);
        return $query->result();
    }

    // Fungsi untuk menghapus data (tidak perlu diubah)
    function delete_data($id_transaksi){
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->delete('transaksi_sewa');

        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->delete('transaksi_sewa_detil');

        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
        Sukses Hapus Data !!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        redirect(site_url() . '?/RekapPenyewaan');
    }
}
