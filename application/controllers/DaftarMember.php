<?php
include 'timezone.php';

class DaftarMember extends CI_Controller
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
      $this->load->model('M_daftar_member');
      $this->load->model('M_harga_paket_sewa');
      $this->load->model('M_penyewaan');


      #cek kondisi sesion login
      if ($this->session->userdata('status') != "login") {
         redirect(site_url() . "?/login");
      }
   }


   #menampilkan halaman utama controller
   public function index()
   {
      #cek hak akses
      $rows = $this->db->query("SELECT * FROM user where username='" . $this->session->username . "'")->row_array();
      $hak_akses = $rows['hak_akses'];

      #cek akses menu
      $rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses where hak_akses='" . $hak_akses . "'")->row_array();
      $status_menu = $rows_hakpengguna['menu_master'] == 'Aktif' || $rows_hakpengguna['menu_operasional'] == 'Aktif';

      #kondisi akses & menu
      if ($hak_akses <> NULL && $status_menu) {

         $data = $this->M_daftar_member->getAllMember();
         // var_dump($data);
         // die;
         $this->load->view('v_daftar_member', ['data' => $data]);
      } else {
         redirect(site_url() . "?/Login");
      }
   } #end function index

   public function create()
   {
      $dariDB = $this->M_daftar_member->cekkodemember();

      // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
      $nourut = substr($dariDB, 3, 4);

      $kodeMemberSekarang = $nourut + 1;
      // $aggotaAll = $this->M_member_fitnes->getAll();
      $paketFitnes = $this->M_member_fitnes->getPaketFitnes();
      // var_dump($paketFitnes);
      // die;
      $this->load->view('v_daftar_member_add', ['kodemember' => $kodeMemberSekarang, 'paketSewa' => $paketFitnes]);
   }
   public function store()
   {

      // var_dump($nama);
      // die;
      //add the header here

      $simpan = $this->M_daftar_member->simpanData();
      if ($simpan) {
         header('Content-Type: application/json');
         echo json_encode($simpan);
      }
      // redirect(site_url() . "?/DaftarMember");
      // redirect('index.php/barang/index');

   }

   public function show($id)
   {
      $datamember = $this->M_daftar_member->historiData($id);
      $datahistori = $this->M_daftar_member->histori($id);
      // var_dump($datahistori);
      // die;
      $this->load->view('v_daftar_member_histori', ['dataMember' => $datamember, 'datahistori' => $datahistori]);
   }
   public function update($id)
   {
      // var_dump($_POST['paketID']);
      // die;
      // $this->M_daftar_member->updateData($id);
      $idPaket = $_POST['paketID'];
      $dariDB = $this->M_daftar_member->cekkotransaksi();
      $durasiMember = $_POST['durasi_member'];
      $startDate = $_POST['tanggal_mulai'];
      $Expired = date('Y-m-d', strtotime($startDate . ' + ' . $durasiMember . ' days'));

      $dataPaket = $this->M_harga_paket_sewa->get_by_id($idPaket);


      if ($dariDB == null) {
         // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
         $nourut = 'TRXFITNES000';
      } else {
         // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
         $nourut = substr($dariDB, 9, 4);
      }
      // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
      // $nourut = substr($dariDB, 3, 4);
      // var_dump($nourut);
      // die;
      $kodeMemberSekarang = $nourut + 1;
      $kodeTransaksi = sprintf("TRXFITPP%04s", $kodeMemberSekarang);

      $simpan = $this->M_daftar_member->simpanDataDetail($kodeTransaksi, $dataPaket->harga);
      
      if ($simpan) {

         #baca aturan
         if($_POST['metode_bayar'] == "qris"){
            $query_setting_penjualan = $this->db->query("SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=5")->row_array();
         }else{
            $query_setting_penjualan = $this->db->query("SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=6")->row_array();
         }

         $totalDurasi = $durasiMember / 30;
         for ($i = 0; $i < $totalDurasi; $i++) {
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

            //ambil harga dari member TRX 

            // $paket_sewa = $this->db->query("SELECT * FROM paket_sewa where id_paket_sewa='3'")->row_array();
            $memberDetail = $this->db->query("SELECT * FROM member_trx where id='" . $simpan['idSimpanDetail'] . "'")->row_array();
            $member = $this->db->query("SELECT * FROM member where id='" . $memberDetail['memberID'] . "'")->row_array();
            // var_dump($simpan);
            // var_dump($memberDetail);
            // exit;
            // die;

            //masukkan ke jurnal umum
            $simpan_data_jurnal = array(
               'periode'               => $periode,
               'last_numb_perperiode'  => $last_numb,
               'kode_jenis_jurnal'     => $kode_jenis_jurnal,
               'no_bukti'              => $no_bukti,
               'tanggal'               => date('Y-m-d', strtotime($tanggal_now . " + $i month")),
               'no_referensi'          => $kodeTransaksi,
               'dari'                  => $member['nama'],
               'kepada'                => $_SESSION['username'],
               'keterangan'            => 'Pendapatan Fitness dari ' . $member['nama']. ' '.$no_bukti,
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


            // if ($memberDetail['metodebayar'] == "qris") {
            //    $debet = $memberDetail['harga'];
            //    $kredit = "0";
            // } else {
            //    $debet = "0";
            //    $kredit = $memberDetail['harga'];
            // }

            $harga = $memberDetail['harga'];
            if ($totalDurasi > 1) {
               $potongan = ($harga * 0.1);
               $harga = $harga - $potongan; // Potongan 10% jika pembayaran lebih dari 1 bulan

               $simpan_data_jurnal_detail = array(
                  'no_bukti'              => $no_bukti,
                  'uraian'                => 'Biaya potongan fitness',
                  'id_kode_akuntansi'     => $id_kode_akuntansi,
                  'debet'                 => $potongan,
                  'kredit'                => 0,
                  'user_created'          => $user_created,
                  'created_at'            => $created_at
               );

               #pengiriman data ke model untuk insert data Debet
               $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $kodeTransaksi);
            }
            //jurnal umum detail
            $simpan_data_jurnal_detail = array(
               'no_bukti'              => $no_bukti,
               'uraian'                => $rows_kode_akun['nama_akun'],
               'id_kode_akuntansi'     => $id_kode_akuntansi,
               'debet'                 => $harga,
               'kredit'                => 0,
               'user_created'          => $user_created,
               'created_at'            => $created_at
            );

            #pengiriman data ke model untuk insert data Debet
            $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $kodeTransaksi);

            $simpan_data_jurnal_detail = array(
               'no_bukti'              => $no_bukti,
               'uraian'                => 'Pendapatan Fitness',
               'id_kode_akuntansi'     => $id_kode_akuntansi,
               'debet'                 => 0,
               'kredit'                => $memberDetail['harga'],
               'user_created'          => $user_created,
               'created_at'            => $created_at
            );

            #pengiriman data ke model untuk insert data Kredit
            $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $kodeTransaksi);
         }
         redirect(site_url() . "?/DaftarMember");
      }

      redirect(site_url() . "?/DaftarMember");
   }
   public function perpanjangMember($id)
   {
      $paketFitnes = $this->M_member_fitnes->getPaketFitnes();
      $this->load->view('v_daftar_member_perpanjang', ['idMember' => $id, 'paketSewa' => $paketFitnes]);
   }
}