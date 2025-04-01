<?php 
include 'timezone.php';
 
class MyProfile extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_my_profile');

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

   #kondisi akses & menu
   if($hak_akses<>NULL) {
      $this->load->view('v_my_profile');
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


  #function insert data
  public function update_profile(){

        #input text form
        $username = $this->input->post('username');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $hak_akses = $this->input->post('hakakses');
        $password = md5($this->input->post('password'));
        $foto = str_replace(" ", "_",$_FILES['file_gambar']['name']);

        #form to array
        $simpan_data=array(
                'foto' => $foto,
                'nama_lengkap' => $nama_lengkap,
                'hak_akses' => $hak_akses,
                'password' => $password,
        );

        #form to array
        $simpan_data_tanpa_foto=array(
                'nama_lengkap' => $nama_lengkap,
                'hak_akses' => $hak_akses,
                'password' => $password,
        );


        if($foto<>""){


          $config['upload_path']          = './assets/backend/img/avatars';
          $config['allowed_types']        = 'gif|jpg|png';
          $config['max_size']             = 800; #2MB
          $config['file_name']            = $foto;

          $this->load->library('upload', $config);

          if ( ! $this->upload->do_upload('file_gambar')){

            $error = array('error' => $this->upload->display_errors());

            $this->session->set_flashdata('msg', 'Gagal untuk upload foto. Ukuran size, tipe atau pixel tidak sesuai! <br>Tipe : gif, jpeg, jpg. <br>Ukuran pixel maksimal 3600px dan Size maksimal 800KB.');

            redirect(site_url() . '?/MyProfile');

            //echo "<script>javascript:history.go(-1);</script>";
          }#end if tidak upload

          else{

            #pengiriman data ke model untuk insert data
            #send to model
                $this->M_my_profile->update_data($username, $simpan_data);

            }

        }

        else{
                $this->M_my_profile->update_data($username, $simpan_data_tanpa_foto);

        }

        

    }





}

?>