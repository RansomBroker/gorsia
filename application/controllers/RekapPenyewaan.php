<?php
include 'timezone.php';

class RekapPenyewaan extends CI_Controller{

    function __construct(){
        parent::__construct();
        // Memuat database, helper, dan model
        $this->load->database();
        $this->load->helper(array('form','url'));
        $this->load->model('M_rekap_penyewaan');

        // Cek kondisi session login
        if($this->session->userdata('status') != "login"){
            redirect(site_url()."?/login");
        }
    }

    // Menampilkan halaman utama dengan filter default (bulan & tahun berjalan)
    public function index(){
        // Cek hak akses
        $rows = $this->db->query("SELECT * FROM user WHERE username='".$this->session->username."'")->row_array();
        $hak_akses = $rows['hak_akses'];

        // Cek akses menu
        $rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses WHERE hak_akses='".$hak_akses."'")->row_array();
        $status_menu = $rows_hakpengguna['menu_master'] == 'Aktif' || $rows_hakpengguna['menu_operasional'] == 'Aktif';

        if($hak_akses != NULL && $status_menu) {
            // Default filter: bulan dan tahun berjalan
            $periode = date('m');
            $tahun = date('Y');
            // Menggunakan fungsi filter model dengan parameter default
            $data = array(
                'get_all_rekap_penyewaan' => $this->M_rekap_penyewaan->get_all_rekap_penyewaan_by_month_year($periode, $tahun, ""),
                'get_all_kategori' => $this->M_rekap_penyewaan->get_all_kategori(),
                'periode' => $periode,
                'tahun' => $tahun
            );
            $this->load->view('v_rekap_penyewaan', $data);
        } else {
            redirect(site_url()."?/Login");
        }
    }

    // Fungsi filter: menangkap parameter GET dan memanggil fungsi model yang sesuai
    public function filter(){
        $periode = $this->input->get('periode');
        $tahun   = $this->input->get('tahun');
        $status  = $this->input->get('status');
        $data = array(
            'get_all_rekap_penyewaan' => $this->M_rekap_penyewaan->get_all_rekap_penyewaan_by_month_year($periode, $tahun, $status),
            'get_all_kategori' => $this->M_rekap_penyewaan->get_all_kategori(),
            'periode' => $periode,
            'tahun'   => $tahun,
            'status'  => $status
        );
        $this->load->view('v_rekap_penyewaan', $data);
    }

    // Function untuk menghapus data (tidak perlu diubah untuk filter)
    public function delete_data(){
        $id_transaksi = $this->uri->segment('4');
        $this->M_rekap_penyewaan->delete_data($id_transaksi);
    }
}
