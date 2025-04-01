<?php 
include 'timezone.php';
 
class Pembelian extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		$this->load->model('M_pembelian');

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
   $status_menu=$rows_hakpengguna['menu_operasional'];

   #kondisi akses & menu
   if($hak_akses<>NULL && $status_menu=="Aktif") {
      $data = array(
        'get_all_kode_suplier' => $this->M_pembelian->get_all_kode_suplier(),
        'get_all_kode_akun_beban' => $this->M_pembelian->get_all_kode_akun_beban(),
        'get_all_kode_akun_kas' => $this->M_pembelian->get_all_kode_akun_kas(),
        'get_all_kode_akun_hutang' => $this->M_pembelian->get_all_kode_akun_hutang(),
        'get_all_kode_jenis_jurnal' => $this->M_pembelian->get_all_kode_jenis_jurnal(),



    );
      $this->load->view('v_pembelian',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index


    public function pencarian(){

  $data = array('get_all_data_pembelian' => $this->M_pembelian->get_all_data_pembelian());

  #untuk mengambil data hak akses
  $rows = $this->db->query("SELECT * FROM user where username='".$this->session->username."'")->row_array();
  $hak_akses=$rows['hak_akses'];

   #cek akses menu
   $rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses where hak_akses='".$hak_akses."'")->row_array();
   $status_menu=$rows_hakpengguna['menu_operasional'];


  if($hak_akses<>NULL && $status_menu=="Aktif") {
    $this->load->view('v_pembelian_pencarian',$data);
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
   $status_menu=$rows_hakpengguna['menu_operasional'];

   #kondisi akses & menu
   if($hak_akses<>NULL && $status_menu=="Aktif") {
      $data = array(
        'get_data_transaksi_per_id' => $this->M_pembelian->get_data_transaksi_per_id(),
        'get_pembelian_detil' => $this->M_pembelian->get_pembelian_detil(),
        'get_all_data_barang' => $this->M_pembelian->get_all_data_barang(),



    );
      $this->load->view('v_pembelian',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

    }#end function index


  #function insert data
  public function insert_data(){

        #input text form
        $data_tahun     = date("Y", strtotime($this->input->post('tanggal')));
        $periode        = date("Ym", strtotime($this->input->post('tanggal')));
        $tanggal_now    = date("dmY", strtotime($this->input->post('tanggal')));
        $kode_jenis_jurnal      = $this->input->post('kode_jenis_jurnal');


        #read max number
        $rows_lastnumb  = $this->db->query("SELECT max(last_numb_perperiode) as max_data FROM pembelian where periode='".$periode."'")->row_array();
        $max_data       = doubleval($rows_lastnumb['max_data']);
        $last_numb      = $max_data+1;

        #read max number jurnal
        $rows_lastnumb_jurnal  = $this->db->query("SELECT max(last_numb_perperiode) as max_data FROM jurnal_umum where periode='".$periode."'")->row_array();
        $max_data_jurnal_umum       = doubleval($rows_lastnumb_jurnal['max_data']);
        $last_numb_jurnal_umum      = $max_data+1;


        $no_pembelian       = 'NBGOR'.'00'.$last_numb.'-'.$periode;
        $no_bukti_jurnal       = $kode_jenis_jurnal.'00'.$last_numb.'-'.$periode;

        #form input
        $tanggal                = $this->input->post('tanggal');
        $nota_pembelian         = $this->input->post('nota_pembelian');
        $kode_suplier           = $this->input->post('kode_suplier');
        $cara_bayar             = $this->input->post('cara_bayar');
        $id_kode_akun_beban_debet               = $this->input->post('id_kode_akun_beban_debet');
        $id_kode_akun_pembayaran_kas_kredit     = $this->input->post('id_kode_akun_pembayaran_kas_kredit');
        $id_kode_akun_hutang_bertambah_kredit   = $this->input->post('id_kode_akun_hutang_bertambah_kredit');
        $user_created           = $this->session->username;
        $created_at             = date("Y-m-d H:i:s");

        #variabel array
        $simpan_data_beli=array(
            'no_pembelian'          => $no_pembelian,
            'data_tahun'            => $data_tahun,
            'periode'               => $periode,
            'last_numb_perperiode'  => $last_numb,
            'tanggal'               => $tanggal,
            'nota_pembelian'        => $nota_pembelian,
            'kode_suplier'          => $kode_suplier,
            'cara_bayar'            => $cara_bayar,
            'kode_jenis_jurnal'     => $kode_jenis_jurnal,
            'id_kode_akun_beban_debet'              => $id_kode_akun_beban_debet,
            'id_kode_akun_pembayaran_kas_kredit'    => $id_kode_akun_pembayaran_kas_kredit,
            'id_kode_akun_hutang_bertambah_kredit'  => $id_kode_akun_hutang_bertambah_kredit,
            'no_bukti_jurnal'       => $no_bukti_jurnal,
            'user_created'          => $user_created,
            'created_at'            => $created_at
        );


        $simpan_jurnal=array(
            'kode_jenis_jurnal'       => $kode_jenis_jurnal,
            'no_bukti'       => $no_bukti_jurnal,
            'periode'               => $periode,
            'last_numb_perperiode'  => $last_numb_jurnal_umum,
            'tanggal'               => $tanggal,
            'no_referensi'          => $nota_pembelian,
            'dari'                  => "Pembelian",
            'kepada'                => "Keuangan",
            'user_created'          => $user_created,
            'created_at'            => $created_at
        );
        #send to model
        $this->M_pembelian->insert_data($simpan_data_beli, $simpan_jurnal, $no_pembelian);
        #insert data jurnal

    }


  #function untuk ambil inputan form untuk update data
  public function update_data(){

        #form input
        $no_pembelian            = $this->input->post('no_pembelian');
        $data_tahun     = date("Y", strtotime($this->input->post('tanggal')));
        $tanggal                = $this->input->post('tanggal');
        $periode        = date("Ym", strtotime($this->input->post('tanggal')));
        $nota_pembelian         = $this->input->post('nota_pembelian');
        $modified_at         = date("Y-m-d H:i:s");
        $user_modified       = $this->session->username;

        #form to array
        $simpan_data=array(
            'data_tahun'               => $data_tahun,
            'periode'               => $periode,
            'tanggal'               => $tanggal,
            'nota_pembelian'               => $nota_pembelian,
            'modified_at'      => $modified_at,
            'user_modified'      => $user_modified,

        );
      
        #send to model
        $this->M_pembelian->update_data($no_pembelian, $simpan_data);

    }


    #function hapus data
    public function delete_data()
    {
     $no_pembelian = $this->uri->segment('4');

     #baca total sebelumnya
        $rows_beli  = $this->db->query("SELECT * FROM pembelian where no_pembelian='".$no_pembelian."'")->row_array();
        $no_bukti_jurnal       = $rows_beli['no_bukti_jurnal'];

      $this->M_pembelian->delete_data($no_pembelian, $no_bukti_jurnal);
    }



    public function insert_data_detail(){
        # mengambil input dari form
        $no_pembelian               = $this->input->post('no_pembelian');
        $kode_barang                = $this->input->post('kode_barang');
        $jumlah                     = $this->input->post('jumlah');
        $harga_beli                 = $this->input->post('harga_beli');
        $no_bukti_jurnal                 = $this->input->post('no_bukti_jurnal');

        $subtotal = doubleval($jumlah*$harga_beli);

        $user_created = $this->session->username;
        $created_at = date("Y-m-d H:i:s");

        #baca total sebelumnya
        $rows_read_total  = $this->db->query("SELECT SUM(subtotal) as subtotal_before FROM pembelian_detail where no_pembelian='".$no_pembelian."'")->row_array();
        $subtotal_before       = doubleval($rows_read_total['subtotal_before']);

        $subtotal_after = doubleval($subtotal_before+$subtotal);

        #barang
        $rows_barang = $this->db->query("SELECT * FROM barang where kode_barang='".$kode_barang."'")->row_array();
        $kode_barang_dt=$rows_barang['kode_barang'];
        $nama_barang_dt=$rows_barang['nama_barang'];
        $satuan_barang_dt=$rows_barang['satuan'];

        #baca kode beban dll
        $rows_pm  = $this->db->query("SELECT * FROM pembelian where no_pembelian='".$no_pembelian."'")->row_array();
        $id_kode_akun_beban_debet  = $rows_pm['id_kode_akun_beban_debet'];
        $id_kode_akun_pembayaran_kas_kredit  = $rows_pm['id_kode_akun_pembayaran_kas_kredit'];
        $id_kode_akun_hutang_bertambah_kredit  = $rows_pm['id_kode_akun_hutang_bertambah_kredit'];

        $uraian = $nama_barang_dt.' - '.$jumlah.' '.$satuan_barang_dt;


        #data dari form dijadikan array 
        $simpan_data_detail=array(
            'no_pembelian'          => $no_pembelian,
            'kode_barang'           => $kode_barang,
            'jumlah'                => $jumlah,
            'harga_beli'            => $harga_beli,
            'subtotal'              => $subtotal,
            'user_created'          => $user_created,
            'created_at'            => $created_at
        );

        $update_data_total=array(
            'total'          => $subtotal_after,
        );

        $simpan_data_beban=array(
            'no_bukti'          => $no_bukti_jurnal,
            'id_kode_akuntansi'           => $id_kode_akun_beban_debet,
            'uraian'                => $uraian,
            'debet'            => $subtotal,
            'kredit'              => 0,
            'user_created'          => $user_created,
            'created_at'            => $created_at
        );

        $simpan_data_pembayaran=array(
            'no_bukti'          => $no_bukti_jurnal,
            'id_kode_akuntansi'           => $id_kode_akun_pembayaran_kas_kredit,
            'uraian'                => $uraian,
            'debet'            => 0,
            'kredit'              => $subtotal,
            'user_created'          => $user_created,
            'created_at'            => $created_at
        );

        $simpan_data_hutang=array(
            'no_bukti'          => $no_bukti_jurnal,
            'id_kode_akuntansi'           => $id_kode_akun_hutang_bertambah_kredit,
            'uraian'                => $uraian,
            'debet'            => 0,
            'kredit'              => $subtotal,
            'user_created'          => $user_created,
            'created_at'            => $created_at
        );


           $this->M_pembelian->insert_data_detail_jurnal($simpan_data_beban);

            if($id_kode_akun_pembayaran_kas_kredit<>0){
                $this->M_pembelian->insert_data_detail_jurnal($simpan_data_pembayaran);
            }

            if($id_kode_akun_hutang_bertambah_kredit<>0){
                $this->M_pembelian->insert_data_detail_jurnal($simpan_data_hutang);
            }


            #pengiriman data ke model untuk insert data
            $this->M_pembelian->insert_data_detail($simpan_data_detail, $update_data_total, $no_pembelian, $no_bukti_jurnal);



    }


    public function delete_data_detail()
    {

      $no_pembelian = $this->uri->segment('4');
      $id_pembelian_detail = $this->uri->segment('6');

      $this->M_pembelian->delete_data_detail($no_pembelian, $id_pembelian_detail);

    }


    

}

?>