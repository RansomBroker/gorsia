<?php
include 'timezone.php';

class DaftarMember extends CI_Controller
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
      $this->load->model('M_daftar_member');
      $this->load->model('M_harga_paket_sewa');


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
      $status_menu = $rows_hakpengguna['menu_master'];

      #kondisi akses & menu
      if ($hak_akses <> NULL && $status_menu == "Aktif") {

         $data = $this->M_daftar_member->getAllMember();
         // var_dump($data);
         // die;
         $this->load->view('v_daftar_member', ['data' => $data]);
      } else {
         redirect(site_url() . "?/Login");
      }
   } #end function index

   public function create()
   {
      $dariDB = $this->M_daftar_member->cekkodemember();

      // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
      $nourut = substr($dariDB, 3, 4);

      $kodeMemberSekarang = $nourut + 1;
      // $aggotaAll = $this->M_member_fitnes->getAll();
      $paketFitnes = $this->M_member_fitnes->getPaketFitnes();
      // var_dump($paketFitnes);
      // die;
      $this->load->view('v_daftar_member_add', ['kodemember' => $kodeMemberSekarang, 'paketSewa' => $paketFitnes]);
   }
   public function store()
   {

      // var_dump($nama);
      // die;
      //add the header here

      $simpan = $this->M_daftar_member->simpanData();
      if ($simpan) {
         header('Content-Type: application/json');
         echo json_encode($simpan);
      }
      // redirect(site_url() . "?/DaftarMember");
      // redirect('index.php/barang/index');

   }

   public function show($id)
   {
      $datamember = $this->M_daftar_member->historiData($id);
      $datahistori = $this->M_daftar_member->histori($id);
      // var_dump($datahistori);
      // die;
      $this->load->view('v_daftar_member_histori', ['dataMember' => $datamember, 'datahistori' => $datahistori]);
   }
   public function update($id)
   {
      // var_dump($_POST['paketID']);
      // die;
      // $this->M_daftar_member->updateData($id);
      $idPaket = $_POST['paketID'];
      $dariDB = $this->M_daftar_member->cekkotransaksi();
      $durasiMember = $_POST['durasi_member'];
      $startDate = $_POST['tanggal_mulai'];
      $Expired = date('Y-m-d', strtotime($startDate . ' + ' . $durasiMember . ' days'));

      $dataPaket = $this->M_harga_paket_sewa->get_by_id($idPaket);


      if ($dariDB == null) {
         // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
         $nourut = '000';
      } else {
         // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
         $nourut = substr($dariDB, 9, 4);
      }
      // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
      // $nourut = substr($dariDB, 3, 4);
      // var_dump($nourut);
      // die;
      $kodeMemberSekarang = $nourut + 1;
      $kodeTransaksi = sprintf("TRXFITNES%04s", $kodeMemberSekarang);

      $simpan = $this->M_daftar_member->simpanDataDetail($kodeTransaksi, $dataPaket->harga);
      redirect(site_url() . "?/DaftarMember");
   }
   public function perpanjangMember($id)
   {
      $paketFitnes = $this->M_member_fitnes->getPaketFitnes();
      $this->load->view('v_daftar_member_perpanjang', ['idMember' => $id, 'paketSewa' => $paketFitnes]);
   }
}