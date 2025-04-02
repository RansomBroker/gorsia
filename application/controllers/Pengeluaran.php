<?php
include 'timezone.php';

class Pengeluaran extends CI_Controller
{

   function __construct()
   {
      parent::__construct();
      #memuat pengenalan database
      $this->load->database();

      #memuat pengenalan helper url
      $this->load->helper(array('form', 'url'));

      #memuat pengenalan model
      $this->load->model('M_transaksi_pengeluaran');
      $this->load->model('M_kode_akuntansi');


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
      $status_menu = $rows_hakpengguna['menu_master'];

      #kondisi akses & menu
      if ($hak_akses <> NULL && $status_menu == "Aktif") {
         //   $data = array('get_all_member' => $this->M_member->get_all_member());
         $data = $this->M_transaksi_pengeluaran->getAll();
         $this->load->view('v_transaksi_pengeluaran', ['dataMember' => $data]);
      } else {
         redirect(site_url() . "?/Login");
      }
   } #end function index

   public function create()
   {
      $no_transaksi = "PRCH".date("dmyHis");
      $data = array(
         'no_transaksi' => $no_transaksi,
         'get_all_akun' => $this->M_kode_akuntansi->get_all_akun_by_kode_parent(81),
         'get_all_kode_parent' => $this->M_kode_akuntansi->get_all_akun_by_level(2),
      );
      // var_dump($dariDB);
      // die;

      $this->load->view('v_transaksi_pengeluaran_add', $data);
   }
   public function store()
   {
      //masukkan ke transaksi pengeluaran
      $simpan = $this->M_transaksi_pengeluaran->simpanData();

      if ($simpan) {
         $no_transaksi       = $_POST['no_transaksi'];
         $tanggal            = $_POST['tanggal'];
         $list_sumber_akun   = $_POST['sumber_akun'];
         $list_tujuan_akun   = $_POST['tujuan_akun'];
         $nominal1           = $_POST['nominal1'];
         $nominal2           = $_POST['nominal2'];
         $keterangan         = $_POST['keterangan'];

         $periode            = date("Ym", strtotime($_POST['tanggal']));
         $dari               = $_SESSION['username'];
         $kepada             = 'Pengeluaran';
         $created_at         = date("Y-m-d H:i:s");
         $user_created       = $this->session->username;

         #read max number
         $rows_lastnumb  = $this->db->query("SELECT max(last_numb_perperiode) as max_data FROM jurnal_umum where periode='" . $periode . "'")->row_array();
         $max_data       = doubleval($rows_lastnumb['max_data']);
         $last_numb      = $max_data + 1;
         $no_bukti       = 'JL00'.$last_numb.'-'.$periode;

         //masukkan ke jurnal umum
         $simpan_data_jurnal = array(
            'periode'               => $periode,
            'last_numb_perperiode'  => $last_numb,
            'no_bukti'              => $no_bukti,
            'tanggal'               => $tanggal,
            'no_referensi'          => $no_transaksi,
            'dari'                  => $dari,
            'kepada'                => $kepada,
            'keterangan'            => $keterangan." - ".$no_transaksi,
            'user_created'          => $user_created,
            'created_at'            => $created_at,
         );
         #send to model
         $this->M_transaksi_pengeluaran->insert_data_jurnal($simpan_data_jurnal, $no_bukti);

         #baca aturan
         $query_setting_penjualan = $this->db->query("SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=6")->row_array();

         foreach ($list_sumber_akun as $key => $id) {
            #kode akun
            $rows_kode_akun  = $this->db->query("SELECT * FROM kode_akuntansi where id_kode_akuntansi='" . $id . "'")->row_array();
            $id_kode_akuntansi       = $rows_kode_akun['id_kode_akuntansi'];

            //jurnal umum detail
            $simpan_data_jurnal_detail = array(
               'no_bukti'              => $no_bukti,
               'uraian'                => $rows_kode_akun['nama_akun'],
               'id_kode_akuntansi'     => $id_kode_akuntansi,
               'debet'                 => 0,
               'kredit'                => $nominal1[$key],
               'user_created'          => $user_created,
               'created_at'            => $created_at
            );

            #pengiriman data ke model untuk insert data Debet
            $this->M_transaksi_pengeluaran->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $no_transaksi);
         }

         foreach ($list_tujuan_akun as $key => $id) {
            #kode akun
            $rows_kode_akun  = $this->db->query("SELECT * FROM kode_akuntansi where id_kode_akuntansi='" . $id . "'")->row_array();
            $id_kode_akuntansi       = $rows_kode_akun['id_kode_akuntansi'];

            //jurnal umum detail
            $simpan_data_jurnal_detail = array(
               'no_bukti'              => $no_bukti,
               'uraian'                => $rows_kode_akun['nama_akun'],
               'id_kode_akuntansi'     => $id_kode_akuntansi,
               'debet'                 => $nominal2[$key],
               'kredit'                => 0,
               'user_created'          => $user_created,
               'created_at'            => $created_at
            );

            #pengiriman data ke model untuk insert data Kredit
            $this->M_transaksi_pengeluaran->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $no_transaksi);
         }
      }

      redirect(site_url() . "?/Pengeluaran");
   }

   public function show($id)
   {
      $data = $this->M_transaksi_pengeluaran->editData($id);
      $this->load->view('v_transaksi_pengeluaran_show', ['data' => $data]);
   }
   public function edit($id)
   {
      $pengeluaran = $this->M_transaksi_pengeluaran->editData($id);
      $data = array(
         'data' => $pengeluaran,
         'get_all_akun' => $this->M_kode_akuntansi->get_all_akun_by_kode_parent(81),
         'get_all_kode_parent' => $this->M_kode_akuntansi->get_all_akun_by_level(2),
      );
      $this->load->view('v_transaksi_pengeluaran_edit', $data);
      // var_dump($data->nomor_member);
      // die;
   }
   public function update($id)
   {
      $this->M_transaksi_pengeluaran->updateData($id);
      redirect(base_url('?/Pengeluaran'));
   }
   public function void($id)
   {
      $rows  = $this->db->query("SELECT * FROM transaksi_pengeluaran where id='".$id."'")->row_array();
      $no_transaksi       = $rows['no_transaksi'];
      $rows_jurnal  = $this->db->query("SELECT * FROM jurnal_umum where no_referensi='".$no_transaksi."'")->row_array();
      $no_bukti_jurnal       = $rows_jurnal['no_bukti'];
      $this->M_transaksi_pengeluaran->voidData($no_transaksi, $no_bukti_jurnal);
   }
   public function delete($id)
   {
      $rows  = $this->db->query("SELECT * FROM transaksi_pengeluaran where id='".$id."'")->row_array();
      $no_transaksi       = $rows['no_transaksi'];
      $rows_jurnal  = $this->db->query("SELECT * FROM jurnal_umum where no_referensi='".$no_transaksi."'")->row_array();
      $no_bukti_jurnal       = $rows_jurnal['no_bukti'];
      $this->M_transaksi_pengeluaran->deleteData($no_transaksi, $no_bukti_jurnal);
   }
   public function filter()
   {
      $periode = $this->input->get('periode');
      $tahun   = $this->input->get('tahun');
      $status  = $this->input->get('status');

      $data = [
         'dataMember' => $this->M_transaksi_pengeluaran->get_all_pengeluaran_by_month_year($periode, $tahun, $status),
         'periode'    => $periode,
         'tahun'      => $tahun,
         'status'     => $status
      ];

      $this->load->view('v_transaksi_pengeluaran', $data);
   }

}