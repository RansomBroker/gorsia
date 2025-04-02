<?php
include 'timezone.php';

class Forecasting extends CI_Controller
{

   function __construct()
   {
      parent::__construct();
      #memuat pengenalan database
      $this->load->database();

      #memuat pengenalan helper url
      $this->load->helper(array('form', 'url'));

      #memuat pengenalan model
      $this->load->model('M_daftar_member');
      $this->load->model('M_member_fitnes');
      $this->load->model('M_forecasting');
      $this->load->model('M_harga_paket_sewa');
      $this->load->model('M_penyewaan');

      #cek kondisi sesion login
      if ($this->session->userdata('status') != "login") {
         redirect(site_url() . "?/login");
      }

      #cek hak akses
      $rows = $this->db->query("SELECT * FROM user where username='" . $this->session->username . "'")->row_array();
      $hak_akses = $rows['hak_akses'];

      #cek akses menu
      $rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses where hak_akses='" . $hak_akses . "'")->row_array();
      $status_menu = $rows_hakpengguna['menu_master'];

      #kondisi akses & menu
      if(empty($hak_akses) && $status_menu!="Aktif") {
         redirect(site_url() . "?/login");
      }
   }

   private function getPreviousMonths($currentMonthIndex, $months, $count = 6) {
      $previousMonths = [];
      for ($i = 1; $i <= $count; $i++) {
         $index = ($currentMonthIndex - $i + 12) % 12;
         $previousMonths[] = $index;
      }
      return array_reverse($previousMonths);
  }

   public function pendapatan()
   {
      // pendapatan sewa lapangan
      $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      $label = [];
      $datasets = [];
      $total = 0;   
      $total_bulan = 6; 
      
      $periode = $this->input->post('periode');
      if ($periode == NULL) {
         $periode = date("Y-m");
      }
      
      $currentMonthIndex = date('m', strtotime($periode)) - 1;
      $previousMonths = $this->getPreviousMonths($currentMonthIndex, $bulan);
      
      $pendapatan = $this->M_forecasting->get_pendapatan_sewa_by_interval($periode, $total_bulan, 0);
      foreach ($previousMonths as $month) {
         $datasets['sewa'][$month] = 0;
         $label[$month] = $bulan[$month];
         foreach ($pendapatan as $k => $v) {
            $index = (int) $v->month - 1;
            if ($index == $month) {
               $datasets['sewa'][$index] = $v->pendapatan;
               $total += $v->pendapatan;
            }
         }
      }
      
      $datasets['sewa'][date('m', strtotime($periode))+1] = $total / $total_bulan;
      $total = 0;
      // pendapatan member
      $pendapatan = $this->M_forecasting->get_pendapatan_member_by_interval($periode, $total_bulan);
      foreach ($previousMonths as $month) {
         $datasets['member'][$month] = 0;
         foreach ($pendapatan as $k => $v) {
            $index = (int) $v->month - 1;
            if ($index == $month) {
               $datasets['member'][$index] = $v->pendapatan;
               $total += $v->pendapatan;
            }
         }
      }

      $datasets['member'][date('m', strtotime($periode))+1] = $total / $total_bulan;
      $data = [
         'forecasting' => $pendapatan,
         'label' => $label,
         'datasets' => $datasets,
         'periode' => $periode
      ];
      // echo '<pre>';
      // var_dump(json_encode($datasets));die();
      return $this->load->view('v_forecasting_pendapatan',$data);
   }

   /*
   public function pendapatan_filter()
   {
      $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      $periode = $this->input->post('periode');
      $filter = DateTime::createFromFormat('Y-m', $periode)->format('m');
      // pendapatan sewa lapangan
      $pendapatan = $this->M_forecasting->get_pendapatan_sewa_all($periode);
      $label = [];
      $datasets = [];
      $total = 0;
      $total_bulan = 6;
      for($i=($filter-$total_bulan); $i <= $filter-0; $i++) {
         $label[$i+1] = $bulan[$i-1];
         $datasets['sewa'][$i+1] = 0;
      }
      foreach ($pendapatan as $key => $value) {
         if($value->month <= $filter) {
            $datasets['sewa'][$value->month] = $value->pendapatan;
            $total += $value->pendapatan;
         }
      }
      $datasets['sewa'][$filter+1] = $total / $total_bulan;
      $total = 0;
      // pendapatan member
      $pendapatan = $this->M_forecasting->get_pendapatan_member($periode);
      for($i=($filter-$total_bulan); $i <= $filter-0; $i++) {
         $datasets['member'][$i+1] = 0;
      }
      foreach ($pendapatan as $key => $value) {
         if($value->month <= $filter) {
            $datasets['member'][$value->month] = $value->pendapatan;
            $total += $value->pendapatan;
         }
      }
      $datasets['member'][$filter+1] = $total / $total_bulan;
      $data = [
         'forecasting' => $pendapatan,
         'label' => $label,
         'datasets' => $datasets,
         'periode' => $periode
      ];
      // echo '<pre>';
      // var_dump($data);exit;
      return $this->load->view('v_forecasting_pendapatan',$data);
   }
   */

   public function sewa()
   {
      // sewa lapangan badminton
      $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      $label = [];
      $datasets = [];
      $total = 0;   
      $total_bulan = 6; 
      
      $periode = $this->input->post('periode');
      if ($periode == NULL) {
         $periode = date("Y-m");
      }
      
      $currentMonthIndex = date('m', strtotime($periode)) - 1;
      $previousMonths = $this->getPreviousMonths($currentMonthIndex, $bulan);
      
      $pendapatan = $this->M_forecasting->get_pendapatan_sewa_by_interval($periode, $total_bulan, 2);
      foreach ($previousMonths as $month) {
         $datasets['badminton'][$month] = 0;
         $label[$month] = $bulan[$month];
         foreach ($pendapatan as $k => $v) {
            $index = (int) $v->month - 1;
            if ($index == $month) {
               $datasets['badminton'][$index] = $v->pendapatan;
               $total += $v->pendapatan;
            }
         }
      }
      
      $datasets['badminton'][date('m', strtotime($periode))+1] = $total / $total_bulan;
      $total = 0;
      // pendapatan member
      $pendapatan = $this->M_forecasting->get_pendapatan_sewa_by_interval($periode, $total_bulan, 1);
      foreach ($previousMonths as $month) {
         $datasets['futsal'][$month] = 0;
         foreach ($pendapatan as $k => $v) {
            $index = (int) $v->month - 1;
            if ($index == $month) {
               $datasets['futsal'][$index] = $v->pendapatan;
               $total += $v->pendapatan;
            }
         }
      }

      $datasets['futsal'][date('m', strtotime($periode))+1] = $total / $total_bulan;
      $data = [
         'forecasting' => $pendapatan,
         'label' => $label,
         'datasets' => $datasets,
         'periode' => $periode
      ];
      // echo '<pre>';
      // var_dump(json_encode($datasets));die();
      return $this->load->view('v_forecasting_sewa',$data);
   }

   /*
   public function sewa_filter()
   {
      $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      $periode = $this->input->post('periode');
      // sewa lapangan badminton
      $pendapatan = $this->M_forecasting->get_pendapatan_sewa_filter(2, $periode);
      $label = [];
      $datasets = [];
      $total = 0;
      $total_bulan = 6;
      $filter = DateTime::createFromFormat('Y-m', $periode)->format('m');
      for($i=($filter-$total_bulan); $i <= $filter-0; $i++) {
         $label[$i+1] = $bulan[$i-1];
         $datasets['badminton'][$i+1] = 0;
      }
      // var_dump($label,$periode);exit;
      foreach ($pendapatan as $key => $value) {
         if($value->month <= $filter) {
            $datasets['badminton'][$value->month] = $value->pendapatan;
            $total += $value->pendapatan;
         }
      }
      $datasets['badminton'][$filter+1] = $total / $total_bulan;
      $total = 0;
      // sewa lapangan futsal
      $pendapatan = $this->M_forecasting->get_pendapatan_sewa_filter(1, $periode);
      for($i=($filter-$total_bulan); $i <= $filter-0; $i++) {
         $datasets['futsal'][$i+1] = 0;
      }
      foreach ($pendapatan as $key => $value) {
         if($value->month <= $filter) {
            $datasets['futsal'][$value->month] = $value->pendapatan;
            $total += $value->pendapatan;
         }
      }
      $datasets['futsal'][$filter+1] = $total / $total_bulan;
      $data = [
         'forecasting' => $pendapatan,
         'label' => $label,
         'datasets' => $datasets,
         'periode' => $periode
      ];

      return $this->load->view('v_forecasting_sewa',$data);
   }
   */
}
