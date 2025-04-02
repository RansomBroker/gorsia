<?php 
include 'timezone.php';
 
class BukuBesar extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_buku_besar');

        #cek kondisi sesion login
		    if($this->session->userdata('status') != "login"){
			     redirect(site_url()."?/login");
		    }
	}


	#menampilkan halaman utama controller
	public function index(){
      #cek hak akses
      $rows = $this->db->query("SELECT * FROM user where username='".$this->session->username."'")->row_array();
      $hak_akses=$rows['hak_akses'];

      #cek akses menu
      $rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses where hak_akses='".$hak_akses."'")->row_array();
      $status_menu=$rows_hakpengguna['menu_master'] == 'Aktif' || $rows_hakpengguna['menu_akuntansi'] == 'Aktif';

      #kondisi akses & menu
      if($hak_akses<>NULL && $status_menu) {
         $data = [
            'get_all_data_akun' => $this->M_buku_besar->get_all_data_akun(),
            'get_all_buku_besar' => $this->M_buku_besar->get_all_data_buku(),
            'periode' => date('m'),
            'tahun' => date('Y'),
         ];
         $this->load->view('v_buku_besar_new',$data);
      }

      else{
         redirect(site_url()."?/Login");
      }

	}#end function index


   public function filterpencarian(){
          $param_id_akun = $this->input->post('txt_id_akun');
          $periode = $this->input->post('periode');
          $tahun = $this->input->post('tahun');
          $data = [
            'get_all_data_akun' => $this->M_buku_besar->get_all_data_akun(),
            'get_all_buku_besar'=> $this->M_buku_besar->get_all_data_buku_by_month_year($param_id_akun, $periode, $tahun),
            'param_id_akun' => $param_id_akun,
            'periode' => $periode,
            'tahun' => $tahun,
          ];

         $this->load->view('v_buku_besar_new',$data);

      }

   }

?>