<?php 
include 'timezone.php';
 
class SettingPenjualanTerhadapAkuntansi extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_settingpenjualanterhadapakuntansi');

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
   $status_menu=$rows_hakpengguna['menu_master'];

   #kondisi akses & menu
   if($hak_akses<>NULL && $status_menu=="Aktif") {
      $data = array('get_all_setting' => $this->M_settingpenjualanterhadapakuntansi->get_all_setting(), 
        'get_all_data_akun' => $this->M_settingpenjualanterhadapakuntansi->get_all_data_akun(),
        'get_all_data_kode_jenis_jurnal' => $this->M_settingpenjualanterhadapakuntansi->get_all_data_kode_jenis_jurnal(),

    );
      $this->load->view('v_setting_penjualan_terhadap_akuntansi',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


  #function insert data
  public function insert_data(){

        #input text form
        $kode_akun = $this->input->post('kode_akun');
        $posisi_saldo = $this->input->post('posisi_saldo');
        $kode_jenis_jurnal = $this->input->post('kode_jenis_jurnal');
        $deskripsi = $this->input->post('deskripsi');

        #akun
        $rows_akun = $this->db->query("SELECT * FROM kode_akuntansi where kode_akun='".$kode_akun."'")->row_array();
        $nama_akun=$rows_akun['nama_akun'];



        #form to array
        $simpan_data=array(
            'kode_akun' => $kode_akun,
            'nama_akun' => $nama_akun, 
            'posisi_saldo' => $posisi_saldo, 
            'kode_jenis_jurnal' => $kode_jenis_jurnal, 
            'deskripsi' => $deskripsi, 
        );

        #send to model
        $this->M_settingpenjualanterhadapakuntansi->insert_data($simpan_data);

    }


  


    #function hapus data
    public function delete_data()
    {
      $id_setting = $this->uri->segment('4');
      $this->M_settingpenjualanterhadapakuntansi->delete_data($id_setting);
    }





}

?>