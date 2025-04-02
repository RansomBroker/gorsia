<?php
include 'timezone.php';

class KuotaFitness extends CI_Controller
{

   function __construct()
   {
      parent::__construct();
      #memuat pengenalan database
      $this->load->database();

      #memuat pengenalan helper url
      $this->load->helper(array('form', 'url'));

      #memuat pengenalan model
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
         $data = $this->M_kuota_fitness->getAll();
         $this->load->view('v_kuota_fitness', ['dataMember' => $data]);
      } else {
         redirect(site_url() . "?/Login");
      }
   } #end function index

   public function create()
   {
      $data=array();
      $this->load->view('v_kuota_fitness_add', $data);
   }
   public function store()
   {
      $this->M_kuota_fitness->simpanData();
      redirect(site_url() . "?/KuotaFitness");
   }

   public function show($id)
   {
      $data = $this->M_kuota_fitness->editData($id);
      $this->load->view('v_kuota_fitness_show', ['data' => $data]);
   }
   public function edit($id)
   {
      $data = $this->M_kuota_fitness->editData($id);
      $this->load->view('v_kuota_fitness_edit', ['data' => $data]);
      // var_dump($data->nomor_member);
      // die;
   }
   public function update($id)
   {
      $this->M_kuota_fitness->updateData($id);
      redirect(base_url('?/KuotaFitness'));
   }
   public function delete($id)
   {
      $data['kuota_fitness'] = $this->M_kuota_fitness->deleteData($id, 'kuota_fitness');
      redirect(base_url('?/KuotaFitness'));
   }
}