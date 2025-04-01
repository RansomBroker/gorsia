<?php
include 'timezone.php';

class MemberFitnes extends CI_Controller
{

   function __construct()
   {
      parent::__construct();
      #memuat pengenalan database
      $this->load->database();

      #memuat pengenalan helper url
      $this->load->helper(array('form', 'url'));

      #memuat pengenalan model
      $this->load->model('M_member_fitnes');

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
         //   $data = array('get_all_member' => $this->M_member->get_all_member());
         $data = $this->M_member_fitnes->getAll();
         $this->load->view('v_member_fitnes', ['dataMember' => $data]);
      } else {
         redirect(site_url() . "?/Login");
      }
   } #end function index

   public function create()
   {
      $dariDB = $this->M_member_fitnes->cekkodemember();

      // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
      $nourut = substr($dariDB, 3, 4);

      $kodeMemberSekarang = $nourut + 1;
      // var_dump($dariDB);
      // die;

      $this->load->view('v_member_fitnes_add', ['kodemember' => $kodeMemberSekarang]);
   }
   public function store()
   {
      $this->M_member_fitnes->simpanData();
      redirect(site_url() . "?/MemberFitnes");
      // redirect('index.php/barang/index');
      // var_dump($nama);
      // die;
   }

   public function show($id)
   {
      $data = $this->M_member_fitnes->editData($id);
      $this->load->view('v_member_fitnes_show', ['data' => $data]);
   }
   public function edit($id)
   {
      $data = $this->M_member_fitnes->editData($id);
      $this->load->view('v_member_fitnes_edit', ['data' => $data]);
      // var_dump($data->nomor_member);
      // die;
   }
   public function update($id)
   {
      $this->M_member_fitnes->updateData($id);
      redirect(base_url('?/MemberFitnes'));
   }
   public function delete($id)
   {
      $data['pelanggan'] = $this->M_member_fitnes->deleteData($id, 'pelanggan');
      redirect(base_url('?/MemberFitnes'));
   }
}