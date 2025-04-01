<?php
include 'timezone.php';

class DaftarMemberDetail extends CI_Controller
{

   function __construct()
   {
      parent::__construct();
      #memuat pengenalan database
      $this->load->database();

      #memuat pengenalan helper url
      $this->load->helper(array('form', 'url'));

      #memuat pengenalan model
      $this->load->model('M_daftar_member');
      $this->load->model('M_member_fitnes');
      $this->load->model('M_harga_paket_sewa');
      $this->load->model('M_penyewaan');

      #cek kondisi sesion login
      if ($this->session->userdata('status') != "login") {
         redirect(site_url() . "?/login");
      }
   }

   public function store()
   {

      $idPaket = $_POST['paketID'];
      $dariDB = $this->M_daftar_member->cekkotransaksi();
      $durasiMember = $_POST['durasi_member'];
      $startDate = $_POST['tanggal_mulai'];
      $Expired = date('Y-m-d', strtotime($startDate . ' + ' . $durasiMember . ' days'));

      $dataPaket = $this->M_harga_paket_sewa->get_by_id($idPaket);


      if ($dariDB == null) {
         // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
         $nourut = '000';
      } else {
         // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
         $nourut = substr($dariDB, 9, 4);
      }
      // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
      // $nourut = substr($dariDB, 3, 4);
      // var_dump($nourut);
      // die;
      $kodeMemberSekarang = $nourut + 1;
      $kodeTransaksi = sprintf("TRXFITNES%04s", $kodeMemberSekarang);

      $simpan = $this->M_daftar_member->simpanDataDetail($kodeTransaksi, $dataPaket->harga);

      if ($simpan) {

         #baca aturan
         $query_setting_penjualan = $this->db->query("SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=6")->row_array();
         // var_dump($simpan);
         // die;
         $kode_akun =  $query_setting_penjualan['kode_akun'];
         $periode        = date("Ym", strtotime($startDate));
         $no_bukti       = date("Y", strtotime($startDate));
         $tanggal_now    = date("Y-m-d");
         $kode_jenis_jurnal =  $query_setting_penjualan['kode_jenis_jurnal'];
         $created_at = date("Y-m-d H:i:s");
         $user_created = $this->session->username;

         #read max number
         $rows_lastnumb  = $this->db->query("SELECT max(last_numb_perperiode) as max_data FROM jurnal_umum where periode='" . $periode . "'")->row_array();
         $max_data       = doubleval($rows_lastnumb['max_data']);
         $last_numb      = $max_data + 1;
         $no_bukti       = $kode_jenis_jurnal . '00' . $last_numb . '-' . $periode;


         // var_dump($query_setting_penjualan->kode_jenis_jurnal);
         // die;

         //masukkan ke jurnal umum
         $simpan_data_jurnal = array(
            'periode'               => $periode,
            'last_numb_perperiode'  => $last_numb,
            'kode_jenis_jurnal'     => $kode_jenis_jurnal,
            'no_bukti'              => $no_bukti,
            'tanggal'               => $tanggal_now,
            'no_referensi'          => $kodeTransaksi,
            // 'dari'                  => $dari,
            // 'kepada'                => $kepada,
            // 'keterangan'            => $keterangan,
            'user_created'          => $user_created,
            'created_at'            =>  $created_at,
         );
         #send to model
         $this->M_penyewaan->insert_data_jurnal($simpan_data_jurnal, $no_bukti);
         #kategori or
         $rows_kat = $this->db->query("SELECT * FROM kategori_olahraga where id_kategori_olahraga='3'")->row_array();
         $kategori_olahraga = $rows_kat['kategori_olahraga'];
         #kode akun
         // $kode_akun =  $query_setting_penjualan->kode_akun;
         $rows_kode_akun  = $this->db->query("SELECT * FROM kode_akuntansi where kode_akun='" . $kode_akun . "'")->row_array();
         $id_kode_akuntansi       = $rows_kode_akun['id_kode_akuntansi'];
         $posisi_saldo =  $query_setting_penjualan['posisi_saldo'];

         //ambil harga dari member TRX 

         // $paket_sewa = $this->db->query("SELECT * FROM paket_sewa where id_paket_sewa='3'")->row_array();
         $memberDetail = $this->db->query("SELECT * FROM member_trx where id='" . $simpan['idSimpanDetail'] . "'")->row_array();
         // var_dump($simpan);
         // die;

         if ($memberDetail['metodebayar'] == "qris") {
            $debet = $memberDetail['harga'];
            $kredit = "0";
         } else {
            $debet = "0";
            $kredit = $memberDetail['harga'];
         }
         //jurnal umum detail
         $simpan_data_jurnal_detail = array(
            'no_bukti'              => $no_bukti,
            'uraian'                => $kategori_olahraga,
            'id_kode_akuntansi'     => $id_kode_akuntansi,
            'debet'                 => $debet,
            'kredit'                => $kredit,
            'user_created'          => $user_created,
            'created_at'            => $created_at
         );

         #pengiriman data ke model untuk insert data
         $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $kodeTransaksi);
         redirect(site_url() . "?/DaftarMember");
      }
      // redirect('index.php/barang/index');

   }
}
