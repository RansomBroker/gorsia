<?php 
include 'timezone.php';
 
class TransaksiJurnal extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		$this->load->model('M_transaksi_jurnal');

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
      $data = array('get_all_kode_jenis_jurnal' => $this->M_transaksi_jurnal->get_all_kode_jenis_jurnal());
      $this->load->view('v_transaksi_jurnal',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


    public function pencarian(){

  $data = array('get_all_data_jurnal' => $this->M_transaksi_jurnal->get_all_data_jurnal());

  #untuk mengambil data hak akses
  $rows = $this->db->query("SELECT * FROM user where username='".$this->session->username."'")->row_array();
  $hak_akses=$rows['hak_akses'];

   #cek akses menu
   $rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses where hak_akses='".$hak_akses."'")->row_array();
   $status_menu=$rows_hakpengguna['menu_akuntansi'];


  if($hak_akses<>NULL && $status_menu=="Aktif") {
    $this->load->view('v_transaksi_jurnal_pencarian',$data);
  }

  else{
    redirect(site_url()."?/Login");
  }
  

  }


    #menampilkan halaman utama controller
    public function viewer(){
     #cek hak akses
   $rows = $this->db->query("SELECT * FROM user where username='".$this->session->username."'")->row_array();
   $hak_akses=$rows['hak_akses'];

   #cek akses menu
   $rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses where hak_akses='".$hak_akses."'")->row_array();
   $status_menu=$rows_hakpengguna['menu_akuntansi'];

   #kondisi akses & menu
   if($hak_akses<>NULL && $status_menu=="Aktif") {
      $data = array('get_all_kode_jenis_jurnal' => $this->M_transaksi_jurnal->get_all_kode_jenis_jurnal(), 
        'get_data_transaksi_per_id' => $this->M_transaksi_jurnal->get_data_transaksi_per_id(),
        'get_jurnal_detil' => $this->M_transaksi_jurnal->get_jurnal_detil(),
        'get_all_data_akun' => $this->M_transaksi_jurnal->get_all_data_akun(),

    );
      $this->load->view('v_transaksi_jurnal',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

    }#end function index


  #function insert data
  public function insert_data(){

        #input text form
        $no_bukti       = date("Y", strtotime($this->input->post('tanggal')));
        $periode        = date("Ym", strtotime($this->input->post('tanggal')));
        $tanggal_now    = date("dmY", strtotime($this->input->post('tanggal')));
        $kode_jenis_jurnal   = $this->input->post('kode_jenis_jurnal');

        #read max number
        $rows_lastnumb  = $this->db->query("SELECT max(last_numb_perperiode) as max_data FROM jurnal_umum where periode='".$periode."'")->row_array();
        $max_data       = doubleval($rows_lastnumb['max_data']);
        $last_numb      = $max_data+1;


        $no_bukti       = $kode_jenis_jurnal.'00'.$last_numb.'-'.$periode;

        #form input
        $tanggal_now         = $this->input->post('tanggal');
        $no_referensi        = $this->input->post('no_referensi');
        $dari                = $this->input->post('dari');
        $kepada              = $this->input->post('kepada');
        $keterangan          = $this->input->post('keterangan');
        $user_created = $this->session->username;
        $created_at = date("Y-m-d H:i:s");

        #variabel array
        $simpan_data=array(
            'periode'               => $periode,
            'last_numb_perperiode'  => $last_numb,
            'kode_jenis_jurnal'     => $kode_jenis_jurnal,
            'no_bukti'              => $no_bukti,
            'tanggal'               => $tanggal_now,
            'no_referensi'          => $no_referensi,
            'dari'                  => $dari,
            'kepada'                => $kepada,
            'keterangan'            => $keterangan,
            'user_created'          => $user_created,
            'created_at'            => $created_at
        );

        #send to model
        $this->M_transaksi_jurnal->insert_data($simpan_data, $no_bukti);

    }


  #function untuk ambil inputan form untuk update data
  public function update_data(){

        #form input
        $no_bukti            = $this->input->post('no_bukti');
        $tanggal_now         = date("dmY", strtotime($this->input->post('tanggal')));
        $periode             = date("Ym", strtotime($this->input->post('tanggal')));

        $tanggal_now         = $this->input->post('tanggal');
        $no_referensi        = $this->input->post('no_referensi');
        $dari                = $this->input->post('dari');
        $kepada              = $this->input->post('kepada');
        $keterangan          = $this->input->post('keterangan');
        $modified_at         = date("Y-m-d H:i:s");
        $user_modified       = $this->session->username;

        #form to array
        $simpan_data=array(
            'no_referensi'               => $no_referensi,
            'periode'               => $periode,
            'tanggal'               => $tanggal_now,
            'dari'               => $dari,
            'kepada'               => $kepada,
            'keterangan'               => $keterangan,
            'modified_at'      => $modified_at,
            'user_modified'      => $user_modified,

        );
      
        #send to model
        $this->M_transaksi_jurnal->update_data($no_bukti, $simpan_data);

    }


    #function hapus data
    public function delete_data()
    {
     $no_bukti = $this->uri->segment('4');
      $this->M_transaksi_jurnal->delete_data($no_bukti);
    }



    public function insert_data_detail(){
        # mengambil input dari form
        $no_bukti               = $this->input->post('no_bukti');
        $id_kode_akuntansi      = $this->input->post('id_kode_akuntansi');
        $uraian                 = $this->input->post('uraian');
        $debet                  = $this->input->post('debet');
        $kredit                 = $this->input->post('kredit');

        $user_created = $this->session->username;
        $created_at = date("Y-m-d H:i:s");


        #data dari form dijadikan array 
        $simpan_data_detail=array(
            'no_bukti'              => $no_bukti,
            'uraian'                => $uraian,
            'id_kode_akuntansi'     => $id_kode_akuntansi,
            'debet'                 => $debet,
            'kredit'                => $kredit,
            'user_created'          => $user_created,
            'created_at'            => $created_at
        );


            #pengiriman data ke model untuk insert data
            $this->M_transaksi_jurnal->insert_data_detail($simpan_data_detail, $no_bukti);



    }


    public function delete_data_detail()
    {

      $no_bukti = $this->uri->segment('4');
      $id_jurnal_umum_detail = $this->uri->segment('6');

      $this->M_transaksi_jurnal->delete_data_detail($no_bukti, $id_jurnal_umum_detail);

    }


    

}

?>