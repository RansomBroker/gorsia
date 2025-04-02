<?php 
include 'timezone.php';
 
class Member extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_member');

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
      $data = array('get_all_member' => $this->M_member->get_all_member());
      $this->load->view('v_member',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


  #function insert data
  public function insert_data(){

        #input text form
        #baca last number
        $rows_ln = $this->db->query("SELECT MAX(last_number) as last_number FROM member")->row_array();
        $last_number=$rows_ln['last_number'];

        $id_member = "GORMBR00".$last_number;
        $nama_pelanggan = $this->input->post('nama_pelanggan');
        $no_telepon = $this->input->post('no_telepon');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $usia = $this->input->post('usia');
        $jenis_kelamin = $this->input->post('jenis_kelamin');

        #form to array
        $simpan_data=array(
            'id_member' => $id_member,
            'nama_pelanggan' => $nama_pelanggan, 
            'no_telepon' => $no_telepon, 
            'email' => $email, 
            'alamat' => $alamat, 
            'usia' => $usia, 
            'jenis_kelamin' => $jenis_kelamin, 
        );

        #send to model
        $this->M_member->insert_data($simpan_data);

    }


  #function untuk ambil inputan form untuk update data
  public function update_data(){

        #input text form
        $id_member = $this->input->post('id_member');
        $nama_pelanggan = $this->input->post('nama_pelanggan');
        $no_telepon = $this->input->post('no_telepon');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $usia = $this->input->post('usia');
        $jenis_kelamin = $this->input->post('jenis_kelamin');

        #form to array
        $simpan_data=array(
            'nama_pelanggan' => $nama_pelanggan, 
            'no_telepon' => $no_telepon, 
            'email' => $email, 
            'alamat' => $alamat, 
            'usia' => $usia, 
            'jenis_kelamin' => $jenis_kelamin, 

        );
      
        #send to model
        $this->M_member->update_data($id_member, $simpan_data);

    }


    #function hapus data
    public function delete_data()
    {
      $id_member = $this->uri->segment('4');
      $this->M_member->delete_data($id_member);
    }





}

?>