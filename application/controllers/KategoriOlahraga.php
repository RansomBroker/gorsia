<?php 
include 'timezone.php';
 
class KategoriOlahraga extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_kategori_olahraga');

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
      $data = array('get_all_kategori_olahraga' => $this->M_kategori_olahraga->get_all_kategori_olahraga());
      $this->load->view('v_kategori_olahraga',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


  #function insert data
  public function insert_data(){

        #input text form
        $kategori_olahraga = $this->input->post('kategori_olahraga');
        $memiliki_lapangan = $this->input->post('memiliki_lapangan');

        #form to array
        $simpan_data=array(
            'kategori_olahraga' => $kategori_olahraga,
            'memiliki_lapangan' => $memiliki_lapangan, 
        );

        #send to model
        $this->M_kategori_olahraga->insert_data($simpan_data);

    }


  #function untuk ambil inputan form untuk update data
  public function update_data(){

        #input text form
        $id_kategori_olahraga = $this->input->post('id_kategori_olahraga');
        $kategori_olahraga    = $this->input->post('kategori_olahraga');
        $memiliki_lapangan    = $this->input->post('memiliki_lapangan');

        #form to array
        $simpan_data=array(
            'kategori_olahraga' => $kategori_olahraga,
            'memiliki_lapangan' => $memiliki_lapangan, 

        );
      
        #send to model
        $this->M_kategori_olahraga->update_data($id_kategori_olahraga, $simpan_data);

    }


    #function hapus data
    public function delete_data()
    {
      $id_kategori_barang = $this->uri->segment('4');
      $this->M_kategori_olahraga->delete_data($id_kategori_barang);
    }





}

?>