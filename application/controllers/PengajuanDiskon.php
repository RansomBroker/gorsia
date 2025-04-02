<?php 
include 'timezone.php';
 
class PengajuanDiskon extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_pengajuan_diskon');

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
   $status_menu=$rows_hakpengguna['menu_master'] == 'Aktif' || $rows_hakpengguna['menu_operasional'] == 'Aktif';

   #kondisi akses & menu
   if($hak_akses<>NULL && $status_menu) {
      $data = array('get_all_pengajuan_diskon' => $this->M_pengajuan_diskon->get_all_pengajuan_diskon());
      $this->load->view('v_pengajuan_diskon',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index



    #function hapus data
    public function delete_data()
    {
      $id_transaksi = $this->uri->segment('4');
      $this->M_pengajuan_diskon->delete_data($id_transaksi);
    }





}

?>