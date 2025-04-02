<?php
include 'timezone.php';

class PendapatanFitnes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Memuat database dan helper URL
        $this->load->database();
        $this->load->helper(array('form', 'url'));

        // Memuat model
        $this->load->model('M_pendapatan_fitnes');

        // Cek session login
        if ($this->session->userdata('status') != "login") {
            redirect(site_url() . "?/login");
        }
    }

    // Menampilkan halaman utama (default menampilkan data dengan filter bulan berjalan)
    public function index()
    {
        // Cek hak akses user
        $rows = $this->db->query("SELECT * FROM user WHERE username='" . $this->session->username . "'")->row_array();
        $hak_akses = $rows['hak_akses'];

        // Cek akses menu (menggunakan kondisi OR untuk menu_operasional)
        $rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses WHERE hak_akses='" . $hak_akses . "'")->row_array();
        $status_menu = ($rows_hakpengguna['menu_master'] == 'Aktif' || $rows_hakpengguna['menu_operasional'] == 'Aktif');

        // Jika hak akses dan menu aktif
        if ($hak_akses != NULL && $status_menu) {
            // Default filter: bulan dan tahun berjalan
            $periode = date('m');
            $tahun = date('Y');

            // Dapatkan data pendapatan fitness sesuai default filter
            $dataPendapatan = $this->M_pendapatan_fitnes->get_all_pendapatan_fitness_by_month_year($periode, $tahun);

            // Tampilkan view dengan data dan filter default
            $this->load->view('v_pendapatan_fitnes', [
                'dataPendapatan' => $dataPendapatan,
                'periode' => $periode,
                'tahun' => $tahun
            ]);
        } else {
            redirect(site_url() . "?/Login");
        }
    }

    // Fungsi filter berdasarkan GET parameter
    public function filter()
    {
        $periode = $this->input->get('periode');
        $tahun = $this->input->get('tahun');
        $data = [
            'dataPendapatan' => $this->M_pendapatan_fitnes->get_all_pendapatan_fitness_by_month_year($periode, $tahun),
            'periode' => $periode,
            'tahun' => $tahun
        ];
        $this->load->view('v_pendapatan_fitnes', $data);
    }
}
