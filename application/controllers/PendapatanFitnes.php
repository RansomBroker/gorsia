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
      #cek hak akses
      $rows = $this->db->query("SELECT * FROM user where username='" . $this->session->username . "'")->row_array();
      $hak_akses = $rows['hak_akses'];

      #cek akses menu
      $rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses where hak_akses='" . $hak_akses . "'")->row_array();
      $status_menu = $rows_hakpengguna['menu_master'] == 'Aktif' || $rows_hakpengguna['menu_operasional'] == 'Aktif';

      #kondisi akses & menu
      if ($hak_akses <> NULL && $status_menu) {
         //   $data = array('get_all_member' => $this->M_member->get_all_member());
         $dataPendapatan = $this->M_pendapatan_fitnes->getAll();
         // var_dump($dataPendapatan);
         // die;
         $this->load->view('v_pendapatan_fitnes', ['dataPendapatan' => $dataPendapatan]);
      } else {
         redirect(site_url() . "?/Login");
      }
   } #end function index

   public function filter()
   {
      $periode = $this->input->get('periode');
      $tahun = $this->input->get('tahun');
      $data = [
         'dataPendapatan' => $this->M_pendapatan_fitnes->get_all_pendapatan_fitness_by_month_year($periode, $tahun),
         'periode' => $periode,
         'tahun' => $tahun
      ];
      $this->load->view('v_pendapatan_fitnes',$data);
   }

}