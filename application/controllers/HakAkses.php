<?php 
include 'timezone.php';
 
class HakAkses extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_hak_akses');

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
      $data = array('get_all_hak_akses' => $this->M_hak_akses->get_all_hak_akses());
      $this->load->view('v_hak_akses',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


  #function insert data
  public function insert_data(){

        #input text form
        $hak_akses = $this->input->post('hak_akses');
        $akses_create_check = $this->input->post('CreateCheck');
        $akses_read_check = $this->input->post('ReadCheck');
        $akses_update_check = $this->input->post('UpdateCheck');
        $akses_delete_check = $this->input->post('DeleteCheck');
        $akses_cetak_check = $this->input->post('PrintCheck');
        $menu_master = $this->input->post('radio_menu_master');
        $menu_pengguna = $this->input->post('radio_menu_pengguna');
        $menu_operasional = $this->input->post('radio_menu_operasional');
        $menu_akuntansi = $this->input->post('radio_menu_akuntansi');

        if($akses_create_check=="1"){
            $akses_create = "Aktif";
        }
        if($akses_read_check=="1"){
            $akses_read = "Aktif";
        }
        if($akses_update_check=="1"){
            $akses_update = "Aktif";
        }
        if($akses_delete_check=="1"){
            $akses_delete = "Aktif";
        }
        if($akses_cetak_check=="1"){
            $akses_cetak = "Aktif";
        }

        #form to array
        $simpan_data=array(
            'hak_akses' => $hak_akses,
            'akses_create' => $akses_create, 
            'akses_read' => $akses_read, 
            'akses_update' => $akses_update, 
            'akses_delete' => $akses_delete, 
            'akses_cetak' => $akses_cetak, 
            'menu_master' => $menu_master, 
            'menu_pengguna' => $menu_pengguna, 
            'menu_operasional' => $menu_operasional, 
            'menu_akuntansi' => $menu_akuntansi, 
        );

        #send to model
        $this->M_hak_akses->insert_data($simpan_data);

    }


  #function untuk ambil inputan form untuk update data
  public function update_data(){

       #input text form
        $id_hak_akses = $this->input->post('id_hak_akses');
        $hak_akses = $this->input->post('hak_akses');
        $akses_create_check = $this->input->post('CreateCheck');
        $akses_read_check = $this->input->post('ReadCheck');
        $akses_update_check = $this->input->post('UpdateCheck');
        $akses_delete_check = $this->input->post('DeleteCheck');
        $akses_cetak_check = $this->input->post('PrintCheck');
        $menu_master = $this->input->post('radio_menu_master');
        $menu_pengguna = $this->input->post('radio_menu_pengguna');
        $menu_operasional = $this->input->post('radio_menu_operasional');
        $menu_akuntansi = $this->input->post('radio_menu_akuntansi');

        if($akses_create_check=="1"){
            $akses_create = "Aktif";
        }
        if($akses_read_check=="1"){
            $akses_read = "Aktif";
        }
        if($akses_update_check=="1"){
            $akses_update = "Aktif";
        }
        if($akses_delete_check=="1"){
            $akses_delete = "Aktif";
        }
        if($akses_cetak_check=="1"){
            $akses_cetak = "Aktif";
        }

        #form to array
        $simpan_data=array(
            'akses_create' => $akses_create, 
            'akses_read' => $akses_read, 
            'akses_update' => $akses_update, 
            'akses_delete' => $akses_delete, 
            'akses_cetak' => $akses_cetak, 
            'menu_master' => $menu_master, 
            'menu_pengguna' => $menu_pengguna, 
            'menu_operasional' => $menu_operasional, 
            'menu_akuntansi' => $menu_akuntansi, 

        );
      
        #send to model
        $this->M_hak_akses->update_data($id_hak_akses, $simpan_data);

    }


    #function hapus data
    public function delete_data()
    {
      $id_hak_akses = $this->uri->segment('4');
      $this->M_hak_akses->delete_data($id_hak_akses);
    }





}

?>