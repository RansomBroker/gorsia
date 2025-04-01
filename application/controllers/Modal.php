<?php 
include 'timezone.php';
 
class Modal extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_modal');

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
      $data = array('get_all_modal' => $this->M_modal->get_all_modal(), 'get_all_kode_akuntansi_modal' => $this->M_modal->get_all_kode_akuntansi_modal());
      $this->load->view('v_modal',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


  #function insert data
  public function insert_data(){

        #input text form
        $periode = $this->input->post('periode');
        $id_kode_akuntansi = $this->input->post('id_kode_akuntansi');
        $sampai_dengan_tanggal = $this->input->post('sampai_dengan_tanggal');
        $uraian = $this->input->post('uraian');
        $debet = $this->input->post('debet');
        $kredit = $this->input->post('kredit');

        #form to array
        $simpan_data=array(
            'periode' => $periode,
            'id_kode_akuntansi' => $id_kode_akuntansi, 
            'sampai_dengan_tanggal' => $sampai_dengan_tanggal, 
            'uraian' => $uraian, 
            'debet' => $debet, 
            'kredit' => $kredit, 
        );

        #send to model
        $this->M_modal->insert_data($simpan_data);

    }


  #function untuk ambil inputan form untuk update data
  public function update_data(){

         #input text form
        $id_perubahan_modal = $this->input->post('id_perubahan_modal');
        $periode = $this->input->post('periode');
        $id_kode_akuntansi = $this->input->post('id_kode_akuntansi');
        $sampai_dengan_tanggal = $this->input->post('sampai_dengan_tanggal');
        $uraian = $this->input->post('uraian');
        $debet = $this->input->post('debet');
        $kredit = $this->input->post('kredit');

        #form to array
        $simpan_data=array(
           'periode' => $periode,
            'id_kode_akuntansi' => $id_kode_akuntansi, 
            'sampai_dengan_tanggal' => $sampai_dengan_tanggal, 
            'uraian' => $uraian, 
            'debet' => $debet, 
            'kredit' => $kredit, 

        );
      
        #send to model
        $this->M_modal->update_data($id_perubahan_modal, $simpan_data);

    }


    #function hapus data
    public function delete_data()
    {
      $id_perubahan_modal = $this->uri->segment('4');
      $this->M_modal->delete_data($id_perubahan_modal);
    }





}

?>