<?php 
include 'timezone.php';
 
class Lapangan extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_lapangan');

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
      $data = array('get_all_lapangan' => $this->M_lapangan->get_all_lapangan(), 'get_all_kategori' => $this->M_lapangan->get_all_kategori());
      $this->load->view('v_lapangan',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


  #function insert data
  public function insert_data(){

        #input text form
        $id_kategori_olahraga = $this->input->post('kategori_olahraga');
        $nama_lapangan = $this->input->post('nama_lapangan');
        $ukuran_lapangan = $this->input->post('ukuran_lapangan');
        $maksimal_kapasitas_orang = $this->input->post('maksimal_kapasitas_orang');
        $status_aktif = $this->input->post('radio_status_booking');
        $status_booking = $this->input->post('radio_status_aktif');

        #form to array
        $simpan_data=array(
            'id_kategori_olahraga' => $id_kategori_olahraga,
            'nama_lapangan' => $nama_lapangan, 
            'ukuran_lapangan' => $ukuran_lapangan, 
            'maksimal_kapasitas_orang' => $maksimal_kapasitas_orang, 
            'status_aktif' => $status_aktif, 
            'status_booking' => $status_booking, 
        );

        #send to model
        $this->M_lapangan->insert_data($simpan_data);

    }


  #function untuk ambil inputan form untuk update data
  public function update_data(){

        #input text form
        $id_lapangan = $this->input->post('id_lapangan');
        $id_kategori_olahraga = $this->input->post('kategori_olahraga');
        $nama_lapangan = $this->input->post('nama_lapangan');
        $ukuran_lapangan = $this->input->post('ukuran_lapangan');
        $maksimal_kapasitas_orang = $this->input->post('maksimal_kapasitas_orang');
        $status_aktif = $this->input->post('status_booking');
        $status_booking = $this->input->post('status_aktif');

        #form to array
        $simpan_data=array(
            'id_kategori_olahraga' => $id_kategori_olahraga,
            'nama_lapangan' => $nama_lapangan, 
            'ukuran_lapangan' => $ukuran_lapangan, 
            'maksimal_kapasitas_orang' => $maksimal_kapasitas_orang, 
            'status_aktif' => $status_aktif, 
            'status_booking' => $status_booking, 

        );
      
        #send to model
        $this->M_lapangan->update_data($id_lapangan, $simpan_data);

    }


    #function hapus data
    public function delete_data()
    {
      $id_lapangan = $this->uri->segment('4');
      $this->M_lapangan->delete_data($id_lapangan);
    }





}

?>