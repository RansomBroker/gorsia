<?php 
include 'timezone.php';
 
class KodeJurnal extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_kodejurnal');

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
   $status_menu=$rows_hakpengguna['menu_akuntansi'];

   #kondisi akses & menu
   if($hak_akses<>NULL && $status_menu=="Aktif") {
      $data = array('get_all_kode_jurnal' => $this->M_kodejurnal->get_all_kode_jurnal());
      $this->load->view('v_kodejurnal',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


  #function insert data
  public function insert_data(){

        #input text form
        $kode_jenis_jurnal = str_replace(" ", "", $this->input->post('kode_jenis_jurnal'));
        $deskripsi = $this->input->post('deskripsi');

        #form to array
        $simpan_data=array(
            'kode_jenis_jurnal' => $kode_jenis_jurnal,
            'deskripsi' => $deskripsi, 
        );

        #send to model
        $this->M_kodejurnal->insert_data($simpan_data);

    }


  #function untuk ambil inputan form untuk update data
  public function update_data(){

         #input text form
        $kode_jenis_jurnal = $this->input->post('kode_jenis_jurnal');
        $deskripsi = $this->input->post('deskripsi');

        #form to array
        $simpan_data=array(
           'deskripsi' => $deskripsi, 

        );
      
        #send to model
        $this->M_kodejurnal->update_data($kode_jenis_jurnal, $simpan_data);

    }


    #function hapus data
    public function delete_data()
    {
      $kode_jenis_jurnal = $this->uri->segment('4');
      $this->M_kodejurnal->delete_data($kode_jenis_jurnal);
    }





}

?>