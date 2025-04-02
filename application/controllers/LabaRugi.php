<?php 
ini_set('display_errors','off');

include 'timezone.php';
 
class LabaRugi extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_laba_rugi');

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
      $data = array('get_all_data_akun' => $this->M_laba_rugi->get_all_data_akun(),
      'get_all_parent_akun_laba_rugi' => $this->M_laba_rugi->get_all_parent_akun_laba_rugi(),);
      $this->load->view('v_laba_rugi_new',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


public function filterpencarian(){

$param_tahun = $this->input->post('txt_tahun');
$param_bulan = $this->input->post('txt_periode');
$param_periode = $param_tahun.$param_bulan;

      $data=array(
         'get_all_data_akun' => $this->M_laba_rugi->get_all_data_akun(),
         'get_all_parent_akun_laba_rugi' => $this->M_laba_rugi->get_all_parent_akun_laba_rugi(),
      );
    $this->load->view('v_laba_rugi_new',$data);

    }






}

?>