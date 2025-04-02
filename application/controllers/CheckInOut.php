<?php
include 'timezone.php';

class CheckInOut extends CI_Controller
{

   function __construct()
   {
      parent::__construct();
      #memuat pengenalan database
      $this->load->database();

      #memuat pengenalan helper url
      $this->load->helper(array('form', 'url'));

      #memuat pengenalan model
      $this->load->model('M_check_in_out');
      $this->load->model('M_kuota_fitness');

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
      $status_menu=$rows_hakpengguna['menu_master'] == 'Aktif' || $rows_hakpengguna['menu_operasional'] == 'Aktif';

      #kondisi akses & menu
      if ($hak_akses <> NULL && $status_menu == "Aktif") {
         //   $data = array('get_all_member' => $this->M_member->get_all_member());
         $data = $this->M_check_in_out->getAll();
         $this->load->view('v_check_in_out', ['dataMember' => $data]);
      } else {
         redirect(site_url() . "?/Login");
      }
   } #end function index

   public function create()
   {
      $total_check_in = $this->M_check_in_out->get_total_check_in();
      $dariDB=$this->M_kuota_fitness->get_kuota();
      $data = array(
         'get_all_member' => $this->M_check_in_out->get_all_member(), 
         'totalCheckIn' => $total_check_in,
         'totalMaxCheckIn' => ($dariDB != null) ? $dariDB[0]->kuota : 0,
      );
      // var_dump($data);
      // die;
      $this->load->view('v_check_in_out_add', $data);
   }
   public function store()
   {
      $kodeMember = $_POST['kodeMember'];
      $dariDB = $this->M_check_in_out->get_by_kode_member($kodeMember);

      if ($dariDB == null) {
         $this->M_check_in_out->simpanData();
      } else{
         $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
         Anda terdaftar sedang Check In !!
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
      }
      redirect(site_url() . "?/CheckInOut");
      
      // redirect('index.php/barang/index');
      // var_dump($nama);
      // die;
   }

   public function show($id)
   {
      $data = $this->M_check_in_out->editData($id);
      $this->load->view('v_check_in_out_show', ['data' => $data]);
   }
   public function edit($id)
   {
      $data = $this->M_check_in_out->editData($id);
      $this->load->view('v_check_in_out_edit', ['data' => $data]);
      // var_dump($data->nomor_member);
      // die;
   }
   public function update($id)
   {
      $this->M_check_in_out->updateData($id);
      redirect(base_url('?/CheckInOut'));
   }
   public function delete($id)
   {
      $data['check_in_out'] = $this->M_check_in_out->deleteData($id, 'check_in_out');
      redirect(base_url('?/CheckInOut'));
   }
}