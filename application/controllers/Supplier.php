<?php 
include 'timezone.php';
 
class Supplier extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_supplier');

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
      $data = array('get_all_supplier' => $this->M_supplier->get_all_supplier());
      $this->load->view('v_supplier',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


  #function insert data
  public function insert_data(){

        #input text form
        $kode_suplier = $this->input->post('kode_suplier');
        $nama_suplier = $this->input->post('nama_suplier');
        $alamat = $this->input->post('alamat');
        $telepon = $this->input->post('telepon');
        $email = $this->input->post('email');

        #form to array
        $simpan_data=array(
            'kode_suplier' => str_replace(" ", "_", $kode_suplier),
            'nama_suplier' => $nama_suplier, 
            'alamat' => $alamat, 
            'telepon' => $telepon, 
            'email' => $email, 
        );

        #send to model
        $this->M_supplier->insert_data($simpan_data);

    }


  #function untuk ambil inputan form untuk update data
  public function update_data(){

        #input text form
         #input text form
        $kode_suplier = $this->input->post('kode_suplier');
        $nama_suplier = $this->input->post('nama_suplier');
        $alamat = $this->input->post('alamat');
        $telepon = $this->input->post('telepon');
        $email = $this->input->post('email');

        #form to array
        $simpan_data=array(
            'nama_suplier' => $nama_suplier, 
            'alamat' => $alamat, 
            'telepon' => $telepon, 
            'email' => $email, 
        );
      
        #send to model
        $this->M_supplier->update_data($kode_suplier, $simpan_data);

    }


    #function hapus data
    public function delete_data()
    {
      $kode_suplier = $this->uri->segment('4');
      $this->M_supplier->delete_data($kode_suplier);
    }





}

?>