<?php 
include 'timezone.php';
 
class KodeAkuntansi extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_kode_akuntansi');

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
      $data = array('get_all_akun' => $this->M_kode_akuntansi->get_all_akun(), 'get_all_kode_parent' => $this->M_kode_akuntansi->get_all_kode_parent());
      $this->load->view('v_kode_akuntansi',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


  #function insert data
  public function insert_data(){

        #input text form
        $level = $this->input->post('level');

        if($level==1){
            $is_parent = "1";
        }
        else{
            $is_parent = "0";
        }

        $kode_parent = $this->input->post('kode_parent');
        $kode_akun = $this->input->post('kode_akun');
        $nama_akun = $this->input->post('nama_akun');
        $saldo_normal = $this->input->post('saldo_normal');
        $pos = $this->input->post('pos');
        $created_at = date("Y-m-d H:i:s");
        $user_created = $this->session->username;

        #form to array
        $simpan_data=array(
            'level' => $level,
            'is_parent' => $is_parent, 
            'kode_parent' => $kode_parent, 
            'kode_akun' => $kode_akun, 
            'nama_akun' => $nama_akun, 
            'saldo_normal' => $saldo_normal, 
            'pos' => $pos, 
            'created_at' => $created_at, 
            'user_created' => $user_created, 
        );

        #send to model
        $this->M_kode_akuntansi->insert_data($simpan_data);

    }


  #function untuk ambil inputan form untuk update data
  public function update_data(){

        #input text form
        $id_kode_akuntansi = $this->input->post('id_akun');
        $level = $this->input->post('level');

        if($level==1){
            $is_parent = "1";
        }
        else{
            $is_parent = "0";
        }

        $kode_parent = $this->input->post('kode_parent');
        $kode_akun = $this->input->post('kode_akun');
        $nama_akun = $this->input->post('nama_akun');
        $saldo_normal = $this->input->post('saldo_normal');
        $pos = $this->input->post('pos');
        $modified_at = date("Y-m-d H:i:s");
        $user_modified = $this->session->username;

        #form to array
        $simpan_data=array(
           'level' => $level,
            'is_parent' => $is_parent, 
            'kode_parent' => $kode_parent, 
            'kode_akun' => $kode_akun, 
            'nama_akun' => $nama_akun, 
            'saldo_normal' => $saldo_normal, 
            'pos' => $pos, 
            'modified_at' => $modified_at, 
            'user_modified' => $user_modified, 

        );
      
        #send to model
        $this->M_kode_akuntansi->update_data($id_kode_akuntansi, $simpan_data);

    }


    #function hapus data
    public function delete_data()
    {
      $id_kode_akuntansi = $this->uri->segment('4');
      $this->M_kode_akuntansi->delete_data($id_kode_akuntansi);
    }

    

}

?>