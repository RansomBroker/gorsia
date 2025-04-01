<?php 
include 'timezone.php';
 
class HargaPaketSewa extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_harga_paket_sewa');

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
      $data = array('get_all_paket_sewa' => $this->M_harga_paket_sewa->get_all_paket_sewa(), 'get_all_kategori' => $this->M_harga_paket_sewa->get_all_kategori(), 'get_all_satuan' => $this->M_harga_paket_sewa->get_all_satuan() );
      $this->load->view('v_harga_paket_sewa',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


  #function insert data
  public function insert_data(){

        #input text form
        $id_kategori_olahraga = $this->input->post('id_kategori_olahraga');
        $id_satuan = $this->input->post('id_satuan');
        $harga = $this->input->post('harga');
        $info = $this->input->post('info');

        #form to array
        $simpan_data=array(
            'id_kategori_olahraga' => $id_kategori_olahraga,
            'id_satuan' => $id_satuan, 
            'harga' => $harga, 
            'info' => $info, 
        );

        #send to model
        $this->M_harga_paket_sewa->insert_data($simpan_data);

    }


  #function untuk ambil inputan form untuk update data
  public function update_data(){

        #input text form
        $id_paket_sewa = $this->input->post('id_paket_sewa');
        $id_kategori_olahraga = $this->input->post('id_kategori_olahraga');
        $id_satuan = $this->input->post('id_satuan');
        $harga = $this->input->post('harga');
        $info = $this->input->post('info');

        #form to array
        $simpan_data=array(
            'id_kategori_olahraga' => $id_kategori_olahraga,
            'id_satuan' => $id_satuan, 
            'harga' => $harga, 
            'info' => $info, 

        );
      
        #send to model
        $this->M_harga_paket_sewa->update_data($id_paket_sewa, $simpan_data);

    }


    #function hapus data
    public function delete_data()
    {
      $id_paket_sewa = $this->uri->segment('4');
      $this->M_harga_paket_sewa->delete_data($id_paket_sewa);
    }





}

?>