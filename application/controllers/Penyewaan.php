<?php 
include 'timezone.php';
ini_set('display_errors','off');
 
class Penyewaan extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        $this->load->library('Pdf');        

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_penyewaan');

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
      $data = array('get_all_jadwal_sesi' => $this->M_penyewaan->get_all_jadwal_sesi(), 'get_all_kategori' => $this->M_penyewaan->get_all_kategori(), 'get_all_lapangan' => $this->M_penyewaan->get_all_lapangan());
      $this->load->view('v_penyewaan',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

	}#end function index

    #menampilkan halaman utama controller
    public function view(){
     #cek hak akses
   $rows = $this->db->query("SELECT * FROM user where username='".$this->session->username."'")->row_array();
   $hak_akses=$rows['hak_akses'];

   #cek akses menu
   $rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses where hak_akses='".$hak_akses."'")->row_array();
   $status_menu=$rows_hakpengguna['menu_master'];

   #kondisi akses & menu
   if($hak_akses<>NULL && $status_menu=="Aktif") {
      $data = array('get_all_jadwal_sesi' => $this->M_penyewaan->get_all_jadwal_sesi(), 'get_all_kategori' => $this->M_penyewaan->get_all_kategori(), 'get_all_lapangan' => $this->M_penyewaan->get_all_lapangan(), 'get_all_member' => $this->M_penyewaan->get_all_member(), 'get_all_sewa_detil' => $this->M_penyewaan->get_all_sewa_detil());
      $this->load->view('v_penyewaan_view_id_trx',$data);
   }

   else{
      redirect(site_url()."?/Login");
   }

    }#end function index


  #function insert data
  public function insert_data_pilih_lapangan(){

        #input text form
        $id_transaksi = "TRX".date("dmyHis");
        $id_kategori_olahraga = $this->input->post('id_kategori_olahraga');
        $id_lapangan = $this->input->post('id_lapangan');
        $status_transaksi = "Draft";

       
        #form to array
        $simpan_data=array(
            'id_kategori_olahraga' => $id_kategori_olahraga,
            'id_lapangan' => $id_lapangan, 
            'id_transaksi' => $id_transaksi, 
            'status_transaksi' => $status_transaksi, 
        );

        #send to model
        $this->M_penyewaan->insert_data_pilih_lapangan($simpan_data, $id_transaksi);

    }


     #untuk menapilkan info member
    function get_info_member(){
        $id=$this->input->post('id');
        $data=$this->M_penyewaan->get_info_member($id);
        echo json_encode($data);
    }


  #function untuk ambil inputan form untuk update data
  public function update_data_penyewaan(){

        #input text form
        $id_transaksi = $this->uri->segment('4');
        $tanggal = $this->input->post('tanggal');
        $nama_pelanggan = $this->input->post('nama_pelanggan');
        $no_telepon = $this->input->post('no_telepon');
        $id_member = $this->input->post('id_member');
        if($id_member=="NONMEMBER"){
            $member = "Tidak";
        }
        else{
             $member = "Ya";
        }

        #form to array
        $simpan_data=array(
            'tanggal' => $tanggal, 
            'nama_pelanggan' => $nama_pelanggan, 
            'no_telepon' => $no_telepon, 
            'id_member' => $id_member, 
            'member' => $member, 
        );
      
        #send to model
        $this->M_penyewaan->update_data_penyewaan($id_transaksi, $simpan_data);

    }


 function select_sesi_sewa(){
    $id_trx = $this->uri->segment('4');

     #lapangan yg disewa
    $rows_lapangan_disewa = $this->db->query("SELECT * FROM transaksi_sewa where id_transaksi='".$id_trx."'")->row_array();
    $id_kategori_olahraga=$rows_lapangan_disewa['id_kategori_olahraga'];
    $tanggal=$rows_lapangan_disewa['tanggal'];
    $nama_pelanggan=$rows_lapangan_disewa['nama_pelanggan'];
    $id_lapangan=$rows_lapangan_disewa['id_lapangan'];

     #paket sewa
    $rows_paket_sewa = $this->db->query("SELECT * FROM paket_sewa where id_kategori_olahraga='".$id_kategori_olahraga."'")->row_array();
    $id_paket_sewa=$rows_paket_sewa['id_paket_sewa'];

    #kategori or
    $rows_kat = $this->db->query("SELECT * FROM kategori_olahraga where id_kategori_olahraga='".$id_kategori_olahraga."'")->row_array();
    $kategori_olahraga=$rows_kat['kategori_olahraga'];

    #id lapangan
    $rows_lap = $this->db->query("SELECT * FROM lapangan where id_lapangan='".$id_lapangan."'")->row_array();
    $nama_lapangan=$rows_lap['nama_lapangan'];

    $query_sesi = $this->db->query("SELECT * FROM jadwal_sesi WHERE id_kategori_olahraga ='".$id_kategori_olahraga."' ORDER BY id_jadwal_sesi ASC ");

    foreach ($query_sesi->result() as $row)
        {

            $id_jadwal_sesi =  $row->id_jadwal_sesi;

            $checklist_check = $this->input->post('txt_check_id_jadwal_sesi_'.$id_jadwal_sesi);

             if($checklist_check=="1"){

            $harga = $this->input->post('txt_harga');


                 $simpan_data_sesi=array(
                    'id_transaksi' => $id_trx,
                    'id_jadwal_sesi' => $id_jadwal_sesi,
                    'harga' => $harga,

                );


                  $this->M_penyewaan->insert_sesi_ke_transaksi($simpan_data_sesi);

             }


        }

        #baca sumary total detil
        $rows_total  = $this->db->query("SELECT SUM(harga) as total_harga FROM transaksi_sewa_detil where id_transaksi='".$id_trx."'")->row_array();
        $total_harga=$rows_total['total_harga'];

        $rows_lama_sewa  = $this->db->query("SELECT count(id_transaksi_detil) as lama_sewa FROM transaksi_sewa_detil where id_transaksi='".$id_trx."'")->row_array();
        $lama_sewa=$rows_lama_sewa['lama_sewa'];


        #update total harga
         $update_data_total=array(
                    'id_paket_sewa' => $id_paket_sewa,
                    'lama_sewa' => $lama_sewa,
                    'harga' => $harga,
                    'total' => $total_harga,
                    'status_transaksi' => "Booking",
                );

        $this->M_penyewaan->update_total_harga($id_trx, $update_data_total);

        #masukan transaksi ke jurnal 
        #baca aturan
         $query_setting_penjualan = $this->db->query("SELECT * FROM setting_penjualan_terhadap_kode_akuntansi ORDER BY id_setting ASC ");

    foreach ($query_setting_penjualan->result() as $row_s)
        {

            $kode_akun =  $row_s->kode_akun;

            #kode akun
            $rows_kode_akun  = $this->db->query("SELECT * FROM kode_akuntansi where kode_akun='".$kode_akun."'")->row_array();
            $id_kode_akuntansi       = $rows_kode_akun['id_kode_akuntansi'];

            $posisi_saldo =  $row_s->posisi_saldo;

            if($posisi_saldo=="Debet"){
                $debet = $harga;
                $kredit = "0";
            }

            else{
                $debet = "0";
                $kredit = $harga;
            }

            $no_bukti       = date("Y", strtotime($tanggal));
            $periode        = date("Ym", strtotime($tanggal));
            $tanggal_now    = date("dmY", strtotime($tanggal));
            $kode_jenis_jurnal =  $row_s->kode_jenis_jurnal;


        #read max number
            $rows_lastnumb  = $this->db->query("SELECT max(last_numb_perperiode) as max_data FROM jurnal_umum where periode='".$periode."'")->row_array();
            $max_data       = doubleval($rows_lastnumb['max_data']);
            $last_numb      = $max_data+1;


            $no_bukti       = $kode_jenis_jurnal.'00'.$last_numb.'-'.$periode;

        #form input
            $tanggal_now         = $tanggal;
            $no_referensi        = $id_trx;
            $dari                = $nama_pelanggan;
            $kepada              = "KASIR";
            $keterangan          = "Hasil Sewa Lapangan";
            $user_created = $this->session->username;
            $created_at = date("Y-m-d H:i:s");

            #detail
            $uraian = $kategori_olahraga.' - ' .$nama_lapangan. ' - '.$lama_sewa. ' sesi';

            #variabel array
        $simpan_data_jurnal=array(
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
        $this->M_penyewaan->insert_data_jurnal($simpan_data_jurnal, $no_bukti);


         $simpan_data_jurnal_detail=array(
            'no_bukti'              => $no_bukti,
            'uraian'                => $uraian,
            'id_kode_akuntansi'     => $id_kode_akuntansi,
            'debet'                 => $debet,
            'kredit'                => $kredit,
            'user_created'          => $user_created,
            'created_at'            => $created_at
        );

         #pengiriman data ke model untuk insert data
            $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx);


        }


            redirect(site_url() . '?/Penyewaan/view/idtrx/'.$id_trx);




 }

    #function hapus data
    public function delete_data_sesi()
    {
      $id_transaksi = $this->uri->segment('4');
      $id_transaksi_detil = $this->uri->segment('6');
      $this->M_penyewaan->delete_data_sesi($id_transaksi, $id_transaksi_detil);
    }


    

     public function ubah_status_in_sewa(){

         #input text form
        $id_transaksi = $this->uri->segment('4');
        $status_transaksi = "Check-In";

        #form to array
        $simpan_data=array(
            'status_transaksi' => $status_transaksi, 
        );
      
        #send to model
        $this->M_penyewaan->ubah_status($id_transaksi, $simpan_data);
     }

     public function ubah_status_selesai(){

         #input text form
        $id_transaksi = $this->uri->segment('4');
        $status_transaksi = "Selesai";

        #form to array
        $simpan_data=array(
            'status_transaksi' => $status_transaksi, 
        );
      
        #send to model
        $this->M_penyewaan->ubah_status($id_transaksi, $simpan_data);
     }


     function cetak(){


      $data = array(
        'get_data_utama_untuk_cetak' => $this->M_penyewaan->get_data_utama_untuk_cetak(), 
        'get_data_detail_untuk_cetak' => $this->M_penyewaan->get_data_detail_untuk_cetak(),
        );


      $this->load->view('v_penyewaan_cetak_nota',$data);


        } 





}

?>