<?php 
include 'timezone.php';
 
class Barang extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_barang');

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
      $data = array('get_all_barang' => $this->M_barang->get_all_barang());
      $this->load->view('v_barang',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


  #function insert data
  public function insert_data(){

        #input text form
        $kode_barang = str_replace(" ", "_", $this->input->post('kode_barang'));
        $nama_barang = $this->input->post('nama_barang');
        $satuan = $this->input->post('satuan');
        $stok = $this->input->post('stok');
        $status_aktif = $this->input->post('status_aktif');

        #form to array
        $simpan_data=array(
            'kode_barang' => $kode_barang,
            'nama_barang' => $nama_barang, 
            'satuan' => $satuan, 
            'stok' => $stok, 
            'status_aktif' => $status_aktif, 
        );

        #send to model
        $this->M_barang->insert_data($simpan_data);

    }


  #function untuk ambil inputan form untuk update data
  public function update_data(){

        #input text form
        $kode_barang = $this->input->post('kode_barang');
        $nama_barang = $this->input->post('nama_barang');
        $satuan = $this->input->post('satuan');
        $stok = $this->input->post('stok');
        $status_aktif = $this->input->post('status_aktif');

        #form to array
        $simpan_data=array(
            'nama_barang' => $nama_barang, 
            'satuan' => $satuan, 
            'stok' => $stok, 
            'status_aktif' => $status_aktif,

        );
      
        #send to model
        $this->M_barang->update_data($kode_barang, $simpan_data);

    }


    #function hapus data
    public function delete_data()
    {
      $kode_barang = $this->uri->segment('4');
      $this->M_barang->delete_data($kode_barang);
    }





}

?>