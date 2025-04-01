<?php 
include 'timezone.php';
 
class AkunUser extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_akun_user');

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
   $status_menu=$rows_hakpengguna['menu_pengguna'];

   #kondisi akses & menu
   if($hak_akses<>NULL && $status_menu=="Aktif") {
      $data = array('get_all_user' => $this->M_akun_user->get_all_user(), 'get_all_hak_akses' => $this->M_akun_user->get_all_hak_akses());
      $this->load->view('v_akun_user',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


  #function insert data
  public function insert_data(){

        #input text form
        $nama_lengkap = $this->input->post('nama_lengkap');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $hak_akses = $this->input->post('hak_akses');
        $foto = "1.png";
        $status = $this->input->post('radio_status_aktif');

        #form to array
        $simpan_data=array(
            'nama_lengkap' => $nama_lengkap,
            'username' => $username, 
            'password' => md5($password), 
            'hak_akses' => $hak_akses, 
            'foto' => $foto, 
            'status' => $status, 
        );

        #send to model
        $this->M_akun_user->insert_data($simpan_data);

    }


  #function untuk ambil inputan form untuk update data
  public function update_data(){

        #input text form
        $id_user = $this->input->post('id_user');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $username = $this->input->post('username');
        $hak_akses = $this->input->post('hak_akses');
        $status = $this->input->post('status_aktif');

        #form to array
        $simpan_data=array(
            'nama_lengkap' => $nama_lengkap,
            'username' => $username, 
            'hak_akses' => $hak_akses, 
            'status' => $status, 

        );
      
        #send to model
        $this->M_akun_user->update_data($id_user, $simpan_data);

    }


    #function hapus data
    public function delete_data()
    {
      $id_user = $this->uri->segment('4');
      $this->M_akun_user->delete_data($id_user);
    }

     #function reset password data
    public function reset_password()
    {
      $id_user = $this->uri->segment('4');

      $simpan_data=array(
            'password' => md5("1234"),

        );

      $this->M_akun_user->reset_password($id_user, $simpan_data);
    }





}

?>