<?php
include 'timezone.php';

class PendapatanFitnes extends CI_Controller
{

   function __construct()
   {
      parent::__construct();
      #memuat pengenalan database
      $this->load->database();

      #memuat pengenalan helper url
      $this->load->helper(array('form', 'url'));

      #memuat pengenalan model
      $this->load->model('M_pendapatan_fitnes');

      #cek kondisi sesion login
      if ($this->session->userdata('status') != "login") {
         redirect(site_url() . "?/login");
      }
   }


   #menampilkan halaman utama controller
   public function index()
   {
       // Cek hak akses
       $rows = $this->db->query("SELECT * FROM user where username='" . $this->session->username . "'")->row_array();
       $hak_akses = $rows['hak_akses'];
   
       // Cek akses menu
       $rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses where hak_akses='" . $hak_akses . "'")->row_array();
       $status_menu = $rows_hakpengguna['menu_master'];
   
       // Kondisi akses & menu
       if ($hak_akses != NULL && $status_menu == "Aktif") {
   
           // Ambil filter bulan dan tahun dari GET, default ke bulan dan tahun sekarang jika tidak ada
           $bulan = $this->input->get('bulan') ? $this->input->get('bulan') : date('n');
           $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');
   
           // Jika bulan/tahun "All", set sebagai "all" di filter
           if ($bulan == 'all') {
               $bulan = 'all';
           }
           if ($tahun == 'all') {
               $tahun = 'all';
           }
   
           // Kirim parameter filter ke model
           $dataPendapatan = $this->M_pendapatan_fitnes->getAll($bulan, $tahun);
   
           $this->load->view('v_pendapatan_fitnes', [
               'dataPendapatan' => $dataPendapatan,
               'selected_bulan' => $bulan,
               'selected_tahun' => $tahun
           ]);
       } else {
           redirect(site_url() . "?/Login");
       }
   }
   


}