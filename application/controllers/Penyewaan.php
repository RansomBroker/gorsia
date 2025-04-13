<?php
include 'timezone.php';
ini_set('display_errors', 'off');

class Penyewaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        $this->load->library('Pdf');

        #memuat pengenalan helper url
        $this->load->helper(['form', 'url']);

        #memuat pengenalan model
        $this->load->model('M_penyewaan');

        #cek kondisi sesion login
        if ($this->session->userdata('status') != 'login') {
            redirect(site_url() . '?/login');
        }
    }

    #menampilkan halaman utama controller
    public function index()
    {
        #cek hak akses
        $rows = $this->db->query("SELECT * FROM user where username='" . $this->session->username . "'")->row_array();
        $hak_akses = $rows['hak_akses'];

        #cek akses menu
        $rows_hakpengguna = $this->db
            ->query("SELECT * FROM hak_akses where hak_akses='" . $hak_akses . "'")
            ->row_array();
        $status_menu = $rows_hakpengguna['menu_master'] == 'Aktif' || $rows_hakpengguna['menu_operasional'] == 'Aktif';

        #kondisi akses & menu
        if ($hak_akses != null && $status_menu) {
            $data = [
                'get_all_jadwal_sesi' => $this->M_penyewaan->get_all_jadwal_sesi(),
                'get_all_kategori' => $this->M_penyewaan->get_all_kategori(),
                'get_all_lapangan' => $this->M_penyewaan->get_all_lapangan(),
            ];
            $this->load->view('v_penyewaan', $data);
        } else {
            redirect(site_url() . '?/Login');
        }
    } #end function index
    #menampilkan halaman utama controller
    public function view()
    {
        #cek hak akses
        $rows = $this->db->query("SELECT * FROM user where username='" . $this->session->username . "'")->row_array();
        $hak_akses = $rows['hak_akses'];

        #cek akses menu
        $rows_hakpengguna = $this->db
            ->query("SELECT * FROM hak_akses where hak_akses='" . $hak_akses . "'")
            ->row_array();
        $status_menu = $rows_hakpengguna['menu_master'];

        #kondisi akses & menu
        if ($hak_akses != null && $status_menu == 'Aktif') {
            $data = [
                'get_all_jadwal_sesi' => $this->M_penyewaan->get_all_jadwal_sesi(),
                'get_all_kategori' => $this->M_penyewaan->get_all_kategori(),
                'get_all_lapangan' => $this->M_penyewaan->get_all_lapangan(),
                'get_all_member' => $this->M_penyewaan->get_all_member(),
                'get_all_sewa_detil' => $this->M_penyewaan->get_all_sewa_detil(),
                'hak_akses' => $hak_akses,
            ];

            $this->load->view('v_penyewaan_view_id_trx', $data);
        } else {
            redirect(site_url() . '?/Login');
        }
    } #end function index
    #function insert data
    public function insert_data_pilih_lapangan()
    {
        $id_lapangan = $this->input->post('id_lapangan');
        $id_transaksi = 'TRX' . date('dmyHis');
        $id_kategori_olahraga = $this->input->post('id_kategori_olahraga');

        // Cek data penyewaan yang di-hold di session
        $session_data = $this->session->userdata('data_penyewaan_hold');

        // Cek apakah data sesi ada
        if (!empty($session_data)) {
            if ($session_data['id_transaksi'] != $id_lapangan) {
                $this->session->unset_userdata('data_penyewaan_hold');
            }
        }

        // Redirect dengan parameter tambahan id_lapangan
        redirect(
            site_url() .
                '?/Penyewaan/view/idtrx/' .
                $id_transaksi .
                '/idlap/' .
                $id_lapangan .
                '/idkategori/' .
                $id_kategori_olahraga
        );
    }

    #untuk menapilkan info member
    function get_info_member()
    {
        $id = $this->input->post('id');
        $data = $this->M_penyewaan->get_info_member($id);
        echo json_encode($data);
    }

    public function update_data_penyewaan()
    {
        // Ambil id transaksi dari URI (misalnya segment ke-4)
        $id_transaksi = $this->uri->segment(4);
        $id_lapangan = $this->uri->segment(6);
        $id_kategori_olahraga = $this->uri->segment(8);

        // Ambil data dari form
        $tanggal = $this->input->post('tanggal');
        $nama_pelanggan = $this->input->post('nama_pelanggan');
        $no_telepon = $this->input->post('no_telepon');
        $id_member = $this->input->post('id_member');
        $diskon = $this->input->post('diskon');

        // Tentukan status member
        $member = $id_member == 'NONMEMBER' ? 'Tidak' : 'Ya';

        $formatted_tanggal_array = array_map(function ($date) {
            return ['tanggal' => $date];
        }, $tanggal);

        // Siapkan data penyewaan yang akan ditahan (hold)
        $data_penyewaan_hold = [
            'id_transaksi' => $id_transaksi,
            'id_lapangan' => $id_lapangan,
            'id_kategori_olahraga' => $id_kategori_olahraga,
            'tanggal' => $formatted_tanggal_array,
            'tanggal_awal' => $tanggal[0],
            'tanggal_unformated' => $tanggal,
            'nama_pelanggan' => $nama_pelanggan,
            'no_telepon' => $no_telepon,
            'id_member' => $id_member,
            'member' => $member,
            'diskon' => $diskon,
        ];

        // Simpan data ke session dengan key 'data_penyewaan_hold'
        $this->session->set_userdata('data_penyewaan_hold', $data_penyewaan_hold);

        // Redirect ke halaman konfirmasi untuk validasi atau penentuan venue
        redirect(
            site_url() .
                '?/Penyewaan/view/idtrx/' .
                $id_transaksi .
                '/idlap/' .
                $id_lapangan .
                '/idkategori/' .
                $id_kategori_olahraga
        );
    }

    function validasi_data_penyewaan()
    {
        #input text form
        $id_transaksi = $this->input->post('id_transaksi');
        $diskon = $this->input->post('diskon');

        #form to array
        $simpan_data = [
            'diskon' => $diskon,
            'status_transaksi' => 'Validasi',
        ];

        #send to model
        $this->M_penyewaan->validasi_data_penyewaan($id_transaksi, $simpan_data);
    }

    function terima_data_penyewaan()
    {
        #input text form
        $id_transaksi = $this->input->post('id_transaksi');

        #masukan transaksi ke jurnal
        #baca aturan
        $rows = $this->db
            ->query("SELECT * FROM transaksi_sewa where id_transaksi='" . $id_transaksi . "'")
            ->row_array();
        $bayar = $rows['metode_bayar'];
        $jenis = $rows['jenis_bayar'];
        $id_lapangan = $rows['id_lapangan'];
        $nama_pelanggan = $rows['nama_pelanggan'];
        $diskon = $rows['diskon'];

        #baca sumary total detil
        $rows_total = $this->db
            ->query(
                "SELECT SUM(harga) as total_harga FROM transaksi_sewa_detil where id_transaksi='" . $id_transaksi . "'"
            )
            ->row_array();
        $total_harga = $rows_total['total_harga'];

        #id lapangan
        $rows_lap = $this->db->query("SELECT * FROM lapangan where id_lapangan='" . $id_lapangan . "'")->row_array();
        $nama_lapangan = $rows_lap['nama_lapangan'];

        if ($bayar == 'qris') {
            $query_setting_penjualan = $this->db->query(
                'SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=5'
            );
        } else {
            $query_setting_penjualan = $this->db->query(
                'SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=6'
            );
        }

        foreach ($query_setting_penjualan->result() as $row_s) {
            $kode_akun = $row_s->kode_akun;

            #kode akun
            $rows_kode_akun = $this->db
                ->query("SELECT * FROM kode_akuntansi where kode_akun='" . $kode_akun . "'")
                ->row_array();
            $id_kode_akuntansi = $rows_kode_akun['id_kode_akuntansi'];

            $posisi_saldo = $row_s->posisi_saldo;

            if ($posisi_saldo == 'Debet') {
                $debet = $total_harga;
                $kredit = '0';
            } else {
                $debet = '0';
                $kredit = $total_harga;
            }

            $tanggal = date('Y-m-d');
            $no_bukti = date('Y', strtotime($tanggal));
            $periode = date('Ym', strtotime($tanggal));
            $tanggal_now = date('dmY', strtotime($tanggal));
            $kode_jenis_jurnal = $row_s->kode_jenis_jurnal;

            #read max number
            $rows_lastnumb = $this->db
                ->query(
                    "SELECT max(last_numb_perperiode) as max_data FROM jurnal_umum where periode='" . $periode . "'"
                )
                ->row_array();
            $max_data = doubleval($rows_lastnumb['max_data']);
            $last_numb = $max_data + 1;

            $no_bukti = $kode_jenis_jurnal . '00' . $last_numb . '-' . $periode;

            #form input
            $tanggal_now = $tanggal;
            $no_referensi = $id_transaksi;
            $dari = $nama_pelanggan;
            $kepada = $_SESSION['username'];
            $keterangan = 'Hasil Sewa Lapangan ' . $nama_lapangan . ' - ' . $id_transaksi;
            $user_created = $this->session->username;
            $created_at = date('Y-m-d H:i:s');

            #detail
            $uraian = $row_s->nama_akun;

            #variabel array
            $simpan_data_jurnal = [
                'periode' => $periode,
                'last_numb_perperiode' => $last_numb,
                'kode_jenis_jurnal' => $kode_jenis_jurnal,
                'no_bukti' => $no_bukti,
                'tanggal' => $tanggal_now,
                'no_referensi' => $no_referensi,
                'dari' => $dari,
                'kepada' => $kepada,
                'keterangan' => $keterangan,
                'user_created' => $user_created,
                'created_at' => $created_at,
            ];

            #send to model
            $this->M_penyewaan->insert_data_jurnal($simpan_data_jurnal, $no_bukti);

            if ($jenis == 'dp') {
                $debet = $debet / 2;
                $diskon = $diskon / 2;
            }

            $simpan_data_jurnal_detail = [
                'no_bukti' => $no_bukti,
                'uraian' => $uraian,
                'id_kode_akuntansi' => $id_kode_akuntansi,
                'debet' => $debet - $diskon,
                'kredit' => $kredit,
                'user_created' => $user_created,
                'created_at' => $created_at,
            ];

            #pengiriman data ke model untuk insert data
            $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_transaksi);

            if (!empty($diskon)) {
                $simpan_data_jurnal_detail = [
                    'no_bukti' => $no_bukti,
                    'uraian' => 'Biaya Potongan Sewa',
                    'id_kode_akuntansi' => $id_kode_akuntansi,
                    'debet' => $diskon,
                    'kredit' => $kredit,
                    'user_created' => $user_created,
                    'created_at' => $created_at,
                ];

                #pengiriman data ke model untuk insert data
                $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_transaksi);
            }

            $simpan_data_jurnal_detail = [
                'no_bukti' => $no_bukti,
                'uraian' => 'Piutang Sewa Lapangan',
                'id_kode_akuntansi' => $id_kode_akuntansi,
                'debet' => 0,
                'kredit' => $debet,
                'user_created' => $user_created,
                'created_at' => $created_at,
            ];

            #pengiriman data ke model untuk insert data
            $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_transaksi);
        }

        #form to array
        $simpan_data = [
            'status_transaksi' => 'Booking',
        ];

        #send to model
        $this->M_penyewaan->terima_data_penyewaan($id_transaksi, $simpan_data);

        redirect(site_url() . '?/Penyewaan/view/idtrx/' . $id_transaksi);
    }

    function select_sesi_sewa()
    {
        $id_trx = $this->uri->segment('4');

        // === Cek dan proses session jika ada ===
        $session_data = $this->session->userdata('data_penyewaan_hold');
        $session_data['diskon'] = str_replace('.', '', $session_data['diskon']);

        if (!empty($session_data)) {
            $id_kategori_olahraga = $session_data['id_kategori_olahraga'];
            $id_lapangan = $session_data['id_lapangan'];

            // Simpan transaksi baru dari session (insert_data_pilih_lapangan)
            $id_transaksi = $session_data['id_transaksi'];
            $status_transaksi = 'Draft';

            $simpan_data = [
                'id_kategori_olahraga' => $id_kategori_olahraga,
                'id_lapangan' => $id_lapangan,
                'id_transaksi' => $id_transaksi,
                'status_transaksi' => $status_transaksi,
            ];

            $this->M_penyewaan->insert_data_pilih_lapangan($simpan_data, $id_transaksi);

            $tanggal_unformated = $session_data['tanggal_unformated'];

            // Update data tanggal
            $this->M_penyewaan->update_data_tanggal($id_transaksi, $tanggal_unformated);

            // Data penyewaan lain
            $simpan_data = [
                'tanggal' => $session_data['tanggal_awal'],
                'nama_pelanggan' => $session_data['nama_pelanggan'],
                'no_telepon' => $session_data['no_telepon'],
                'id_member' => $session_data['id_member'],
                'member' => $session_data['member'],
                'diskon' => $session_data['diskon'],
            ];

            if ($simpan_data['diskon'] > 0) {
                $simpan_data['status_transaksi'] = 'Pengajuan Diskon';
            } else {
                $simpan_data['status_transaksi'] = 'Draft';
            }

            // Update data penyewaan
            $this->M_penyewaan->update_data_penyewaan($id_transaksi, $simpan_data);

            // Hapus session setelah selesai digunakan
            $this->session->unset_userdata('data_penyewaan_hold');
        }

        #lapangan yg disewa
        $rows_lapangan_disewa = $this->db
            ->query("SELECT * FROM transaksi_sewa where id_transaksi='" . $id_trx . "'")
            ->row_array();
        $id_kategori_olahraga = $rows_lapangan_disewa['id_kategori_olahraga'];
        $tanggal = $rows_lapangan_disewa['tanggal'];
        $nama_pelanggan = $rows_lapangan_disewa['nama_pelanggan'];
        $id_lapangan = $rows_lapangan_disewa['id_lapangan'];

        #paket sewa
        $rows_paket_sewa = $this->db
            ->query("SELECT * FROM paket_sewa where id_kategori_olahraga='" . $id_kategori_olahraga . "'")
            ->row_array();
        $id_paket_sewa = $rows_paket_sewa['id_paket_sewa'];

        #kategori or
        $rows_kat = $this->db
            ->query("SELECT * FROM kategori_olahraga where id_kategori_olahraga='" . $id_kategori_olahraga . "'")
            ->row_array();
        $kategori_olahraga = $rows_kat['kategori_olahraga'];

        #id lapangan
        $rows_lap = $this->db->query("SELECT * FROM lapangan where id_lapangan='" . $id_lapangan . "'")->row_array();
        $nama_lapangan = $rows_lap['nama_lapangan'];

        $query_sesi = $this->db->query(
            "SELECT * FROM jadwal_sesi WHERE id_kategori_olahraga ='" .
                $id_kategori_olahraga .
                "' ORDER BY id_jadwal_sesi ASC "
        );

        foreach ($query_sesi->result() as $row) {
            $id_jadwal_sesi = $row->id_jadwal_sesi;

            $checklist_check = $this->input->post('txt_check_id_jadwal_sesi_' . $id_jadwal_sesi);

            if ($checklist_check == '1') {
                $harga = $this->input->post('txt_harga');

                $simpan_data_sesi = [
                    'id_transaksi' => $id_trx,
                    'id_jadwal_sesi' => $id_jadwal_sesi,
                    'harga' => $harga,
                ];

                $this->M_penyewaan->insert_sesi_ke_transaksi($simpan_data_sesi);
            }
        }

        #baca sumary total detil
        $rows_total = $this->db
            ->query("SELECT SUM(harga) as total_harga FROM transaksi_sewa_detil where id_transaksi='" . $id_trx . "'")
            ->row_array();
        $total_harga = $rows_total['total_harga'];

        $rows_lama_sewa = $this->db
            ->query(
                "SELECT count(id_transaksi_detil) as lama_sewa FROM transaksi_sewa_detil where id_transaksi='" .
                    $id_trx .
                    "'"
            )
            ->row_array();
        $lama_sewa = $rows_lama_sewa['lama_sewa'];

        #update total harga
        $diskon = str_replace('.', '', $this->input->post('diskon'));
        $update_data_total = [
            'id_paket_sewa' => $id_paket_sewa,
            'lama_sewa' => $lama_sewa,
            'harga' => $harga,
            'total' => $total_harga,
            'jenis_bayar' => $this->input->post('pembayaran'),
            'metode_bayar' => $this->input->post('metode_bayar'),
            'status_transaksi' => $diskon > 0 ? 'Pengajuan Diskon' : 'Booking',
        ];

        $this->M_penyewaan->update_total_harga($id_trx, $update_data_total);

        #masukan transaksi ke jurnal
        #baca aturan
        #jika ada diskon, transaksi jurnal saat terima pembayaran
        if ($diskon == 0) {
            $bayar = $this->input->post('metode_bayar');
            $jenis = $this->input->post('pembayaran');
            if ($bayar == 'qris') {
                $query_setting_penjualan = $this->db->query(
                    'SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=5'
                );
            } else {
                $query_setting_penjualan = $this->db->query(
                    'SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=6'
                );
            }

            foreach ($query_setting_penjualan->result() as $row_s) {
                $kode_akun = $row_s->kode_akun;

                #kode akun
                $rows_kode_akun = $this->db
                    ->query("SELECT * FROM kode_akuntansi where kode_akun='" . $kode_akun . "'")
                    ->row_array();
                $id_kode_akuntansi = $rows_kode_akun['id_kode_akuntansi'];

                $posisi_saldo = $row_s->posisi_saldo;

                if ($posisi_saldo == 'Debet') {
                    $debet = $total_harga;
                    $kredit = '0';
                } else {
                    $debet = '0';
                    $kredit = $total_harga;
                }

                $no_bukti = date('Y', strtotime($tanggal));
                $periode = date('Ym', strtotime($tanggal));
                $tanggal_now = date('dmY', strtotime($tanggal));
                $kode_jenis_jurnal = $row_s->kode_jenis_jurnal;

                #read max number
                $rows_lastnumb = $this->db
                    ->query(
                        "SELECT max(last_numb_perperiode) as max_data FROM jurnal_umum where periode='" . $periode . "'"
                    )
                    ->row_array();
                $max_data = doubleval($rows_lastnumb['max_data']);
                $last_numb = $max_data + 1;

                $no_bukti = $kode_jenis_jurnal . '00' . $last_numb . '-' . $periode;

                #form input
                $tanggal_now = $tanggal;
                $no_referensi = $id_trx;
                $dari = $nama_pelanggan;
                $kepada = $_SESSION['username'];
                $keterangan = 'Hasil Sewa Lapangan ' . $nama_lapangan . ' - ' . $id_trx;
                $user_created = $this->session->username;
                $created_at = date('Y-m-d H:i:s');

                #detail
                $uraian = $row_s->nama_akun;

                #variabel array
                $simpan_data_jurnal = [
                    'periode' => $periode,
                    'last_numb_perperiode' => $last_numb,
                    'kode_jenis_jurnal' => $kode_jenis_jurnal,
                    'no_bukti' => $no_bukti,
                    'tanggal' => $tanggal_now,
                    'no_referensi' => $no_referensi,
                    'dari' => $dari,
                    'kepada' => $kepada,
                    'keterangan' => $keterangan,
                    'user_created' => $user_created,
                    'created_at' => $created_at,
                ];

                #send to model
                $this->M_penyewaan->insert_data_jurnal($simpan_data_jurnal, $no_bukti);

                if ($jenis == 'dp') {
                    $debet = $debet / 2;
                    $diskon = $diskon / 2;
                }

                $simpan_data_jurnal_detail = [
                    'no_bukti' => $no_bukti,
                    'uraian' => $uraian,
                    'id_kode_akuntansi' => $id_kode_akuntansi,
                    'debet' => $debet - $diskon,
                    'kredit' => $kredit,
                    'user_created' => $user_created,
                    'created_at' => $created_at,
                ];

                #pengiriman data ke model untuk insert data
                $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx);

                if (!empty($diskon)) {
                    $simpan_data_jurnal_detail = [
                        'no_bukti' => $no_bukti,
                        'uraian' => 'Biaya Potongan Sewa',
                        'id_kode_akuntansi' => $id_kode_akuntansi,
                        'debet' => $diskon,
                        'kredit' => $kredit,
                        'user_created' => $user_created,
                        'created_at' => $created_at,
                    ];

                    #pengiriman data ke model untuk insert data
                    $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx);
                }

                $simpan_data_jurnal_detail = [
                    'no_bukti' => $no_bukti,
                    'uraian' => 'Piutang Sewa Lapangan',
                    'id_kode_akuntansi' => $id_kode_akuntansi,
                    'debet' => 0,
                    'kredit' => $debet,
                    'user_created' => $user_created,
                    'created_at' => $created_at,
                ];

                #pengiriman data ke model untuk insert data
                $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx);
            }
        }

        redirect(site_url() . '?/Penyewaan/view/idtrx/' . $id_trx);
    }

    #function hapus data
    public function delete_data_sesi()
    {
        $id_transaksi = $this->uri->segment('4');
        $id_transaksi_detil = $this->uri->segment('6');
        $this->M_penyewaan->delete_data_sesi($id_transaksi, $id_transaksi_detil);
    }

    public function ubah_status_in_sewa()
    {
        #input text form
        $id_transaksi = $this->uri->segment('4');
        $status_transaksi = 'Check-In';

        #form to array
        $simpan_data = [
            'status_transaksi' => $status_transaksi,
        ];

        #send to model
        $this->M_penyewaan->ubah_status($id_transaksi, $simpan_data);
    }

    public function ubah_status_cancel()
    {
        #input text form
        $id_transaksi = $this->uri->segment('4');
        $status_transaksi = 'Cancel';

        #form to array
        $simpan_data = [
            'status_transaksi' => $status_transaksi,
        ];

        #baca sumary total detil
        $rows_total = $this->db
            ->query(
                "SELECT SUM(harga) as total_harga FROM transaksi_sewa_detil where id_transaksi='" . $id_transaksi . "'"
            )
            ->row_array();
        $rows_data = $this->db
            ->query("SELECT * FROM transaksi_sewa where id_transaksi='" . $id_transaksi . "'")
            ->row_array();

        $total_harga = $rows_total['total_harga'];
        $jenis = $rows_data['jenis_bayar'];
        $diskon = $rows_data['diskon'];
        $bayar = $rows_data['metode_bayar'];
        $tanggal = $rows_data['tanggal'];
        $id_trx = $id_transaksi;
        $nama_pelanggan = $this->input->post('nama_pelanggan');

        $query_setting_penjualan = $this->db->query(
            'SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=7'
        );

        foreach ($query_setting_penjualan->result() as $row_s) {
            $kode_akun = $row_s->kode_akun;

            #kode akun
            $rows_kode_akun = $this->db
                ->query("SELECT * FROM kode_akuntansi where kode_akun='" . $kode_akun . "'")
                ->row_array();
            $id_kode_akuntansi = $rows_kode_akun['id_kode_akuntansi'];

            $posisi_saldo = $row_s->posisi_saldo;

            if ($posisi_saldo == 'Debet') {
                $debet = $total_harga;
                $kredit = '0';
            } else {
                $debet = '0';
                $kredit = $total_harga;
            }

            $no_bukti = date('Y', strtotime($tanggal));
            $periode = date('Ym', strtotime($tanggal));
            $tanggal_now = date('dmY', strtotime($tanggal));
            $kode_jenis_jurnal = $row_s->kode_jenis_jurnal;

            #read max number
            $rows_lastnumb = $this->db
                ->query(
                    "SELECT max(last_numb_perperiode) as max_data FROM jurnal_umum where periode='" . $periode . "'"
                )
                ->row_array();
            $max_data = doubleval($rows_lastnumb['max_data']);
            $last_numb = $max_data + 1;

            $no_bukti = $kode_jenis_jurnal . '00' . $last_numb . '-' . $periode;

            #form input
            $tanggal_now = $tanggal;
            $no_referensi = $id_trx;
            $dari = $nama_pelanggan;
            $kepada = $_SESSION['username'];
            $keterangan = 'Pembatalan Sewa Lapangan ' . $nama_lapangan . ' - ' . $id_trx;
            $user_created = $this->session->username;
            $created_at = date('Y-m-d H:i:s');

            #detail
            $uraian = $row_s->nama_akun;

            #variabel array
            $simpan_data_jurnal = [
                'periode' => $periode,
                'last_numb_perperiode' => $last_numb,
                'kode_jenis_jurnal' => $kode_jenis_jurnal,
                'no_bukti' => $no_bukti,
                'tanggal' => $tanggal_now,
                'no_referensi' => $no_referensi,
                'dari' => $dari,
                'kepada' => $kepada,
                'keterangan' => $keterangan,
                'user_created' => $user_created,
                'created_at' => $created_at,
            ];

            #send to model
            $this->M_penyewaan->insert_data_jurnal($simpan_data_jurnal, $no_bukti);

            if ($jenis == 'dp') {
                $total_harga = $total_harga / 2;
                $diskon = $diskon / 2;
            }

            $simpan_data_jurnal_detail = [
                'no_bukti' => $no_bukti,
                'uraian' => 'Piutang Sewa Lapangan',
                'id_kode_akuntansi' => $id_kode_akuntansi,
                'debet' => $total_harga,
                'kredit' => 0,
                'user_created' => $user_created,
                'created_at' => $created_at,
            ];

            #pengiriman data ke model untuk insert data
            $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx);

            if ($jenis == 'lunas') {
                $total_harga = $total_harga / 2;
            }

            $simpan_data_jurnal_detail = [
                'no_bukti' => $no_bukti,
                'uraian' => 'Pendapatan Cancel Sewa Lapangan',
                'id_kode_akuntansi' => $id_kode_akuntansi,
                'debet' => 0,
                'kredit' => $total_harga - $diskon / 2,
                'user_created' => $user_created,
                'created_at' => $created_at,
            ];

            #pengiriman data ke model untuk insert data
            $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx);

            if ($jenis == 'lunas') {
                if ($bayar == 'qris') {
                    $setting = $this->db
                        ->query('SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=5')
                        ->row_array();
                } else {
                    $setting = $this->db
                        ->query('SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=6')
                        ->row_array();
                }

                $simpan_data_jurnal_detail = [
                    'no_bukti' => $no_bukti,
                    'uraian' => $setting['nama_akun'],
                    'id_kode_akuntansi' => $id_kode_akuntansi,
                    'debet' => 0,
                    'kredit' => $total_harga - $diskon / 2,
                    'user_created' => $user_created,
                    'created_at' => $created_at,
                ];

                #pengiriman data ke model untuk insert data
                $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx);
            }

            if (!empty($diskon)) {
                $simpan_data_jurnal_detail = [
                    'no_bukti' => $no_bukti,
                    'uraian' => 'Biaya Potongan Sewa',
                    'id_kode_akuntansi' => $id_kode_akuntansi,
                    'debet' => 0,
                    'kredit' => $diskon,
                    'user_created' => $user_created,
                    'created_at' => $created_at,
                ];

                #pengiriman data ke model untuk insert data
                $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx);
            }
        }

        #send to model
        $this->M_penyewaan->ubah_status($id_transaksi, $simpan_data);
    }

    public function ubah_status_selesai()
    {
        #input text form
        $id_transaksi = $this->uri->segment('4');
        $status_transaksi = 'Selesai';

        #form to array
        $simpan_data = [
            'status_transaksi' => $status_transaksi,
        ];

        #baca sumary total detil
        $rows_total = $this->db
            ->query(
                "SELECT SUM(harga) as total_harga FROM transaksi_sewa_detil where id_transaksi='" . $id_transaksi . "'"
            )
            ->row_array();
        $rows_data = $this->db
            ->query("SELECT * FROM transaksi_sewa where id_transaksi='" . $id_transaksi . "'")
            ->row_array();

        $total_harga = $rows_total['total_harga'];
        $jenis = $rows_data['jenis_bayar'];
        $diskon = $rows_data['diskon'];
        $bayar = $rows_data['metode_bayar'];
        $tanggal = $rows_data['tanggal'];
        $id_trx = $id_transaksi;
        $nama_pelanggan =
            $jenis == 'dp' ? $this->input->post('dp_nama_pelanggan') : $this->input->post('nama_pelanggan');

        $query_setting_penjualan = $this->db->query(
            'SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=1'
        );

        foreach ($query_setting_penjualan->result() as $row_s) {
            $kode_akun = $row_s->kode_akun;

            #kode akun
            $rows_kode_akun = $this->db
                ->query("SELECT * FROM kode_akuntansi where kode_akun='" . $kode_akun . "'")
                ->row_array();
            $id_kode_akuntansi = $rows_kode_akun['id_kode_akuntansi'];

            $posisi_saldo = $row_s->posisi_saldo;

            if ($posisi_saldo == 'Debet') {
                $debet = $total_harga;
                $kredit = '0';
            } else {
                $debet = '0';
                $kredit = $total_harga;
            }

            $no_bukti = date('Y', strtotime($tanggal));
            $periode = date('Ym', strtotime($tanggal));
            $tanggal_now = date('dmY', strtotime($tanggal));
            $kode_jenis_jurnal = $row_s->kode_jenis_jurnal;

            #read max number
            $rows_lastnumb = $this->db
                ->query(
                    "SELECT max(last_numb_perperiode) as max_data FROM jurnal_umum where periode='" . $periode . "'"
                )
                ->row_array();
            $max_data = doubleval($rows_lastnumb['max_data']);
            $last_numb = $max_data + 1;

            $no_bukti = $kode_jenis_jurnal . '00' . $last_numb . '-' . $periode;

            #form input
            $tanggal_now = $tanggal;
            $no_referensi = $id_trx;
            $dari = $nama_pelanggan;
            $kepada = $_SESSION['username'];
            $keterangan = 'Pendapatan Sewa Lapangan ' . $nama_lapangan . ' - ' . $id_trx;
            $user_created = $this->session->username;
            $created_at = date('Y-m-d H:i:s');

            #detail
            $uraian = $row_s->nama_akun;

            #variabel array
            $simpan_data_jurnal = [
                'periode' => $periode,
                'last_numb_perperiode' => $last_numb,
                'kode_jenis_jurnal' => $kode_jenis_jurnal,
                'no_bukti' => $no_bukti,
                'tanggal' => $tanggal_now,
                'no_referensi' => $no_referensi,
                'dari' => $dari,
                'kepada' => $kepada,
                'keterangan' => $keterangan,
                'user_created' => $user_created,
                'created_at' => $created_at,
            ];

            #send to model
            $this->M_penyewaan->insert_data_jurnal($simpan_data_jurnal, $no_bukti);

            if ($jenis == 'dp') {
                $total_harga = $total_harga / 2;
                $diskon = $diskon / 2;
            }

            $simpan_data_jurnal_detail = [
                'no_bukti' => $no_bukti,
                'uraian' => 'Piutang Sewa Lapangan',
                'id_kode_akuntansi' => $id_kode_akuntansi,
                'debet' => $total_harga,
                'kredit' => 0,
                'user_created' => $user_created,
                'created_at' => $created_at,
            ];

            #pengiriman data ke model untuk insert data
            $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx);

            if ($jenis == 'dp') {
                $total_harga = $total_harga * 2;
            }

            $simpan_data_jurnal_detail = [
                'no_bukti' => $no_bukti,
                'uraian' => 'Pendapatan Sewa Lapangan',
                'id_kode_akuntansi' => $id_kode_akuntansi,
                'debet' => 0,
                'kredit' => $total_harga,
                'user_created' => $user_created,
                'created_at' => $created_at,
            ];

            #pengiriman data ke model untuk insert data
            $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx);

            if ($jenis != 'lunas') {
                $bayar = $this->input->post('dp_metode_bayar');
                if ($bayar == 'qris') {
                    $setting = $this->db
                        ->query('SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=5')
                        ->row_array();
                } else {
                    $setting = $this->db
                        ->query('SELECT * FROM setting_penjualan_terhadap_kode_akuntansi where id_setting=6')
                        ->row_array();
                }

                if ($jenis == 'dp') {
                    $total_harga = $total_harga / 2;
                }

                $simpan_data_jurnal_detail = [
                    'no_bukti' => $no_bukti,
                    'uraian' => $setting['nama_akun'],
                    'id_kode_akuntansi' => $id_kode_akuntansi,
                    'debet' => $total_harga - $diskon,
                    'kredit' => 0,
                    'user_created' => $user_created,
                    'created_at' => $created_at,
                ];

                #pengiriman data ke model untuk insert data
                $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx);
            }

            if ($jenis != 'lunas' && !empty($diskon)) {
                $simpan_data_jurnal_detail = [
                    'no_bukti' => $no_bukti,
                    'uraian' => 'Biaya Potongan Sewa',
                    'id_kode_akuntansi' => $id_kode_akuntansi,
                    'debet' => $diskon,
                    'kredit' => 0,
                    'user_created' => $user_created,
                    'created_at' => $created_at,
                ];

                #pengiriman data ke model untuk insert data
                $this->M_penyewaan->insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx);
            }
        }

        #send to model
        $this->M_penyewaan->ubah_status($id_transaksi, $simpan_data);
    }

    function cetak()
    {
        $data = [
            'get_data_utama_untuk_cetak' => $this->M_penyewaan->get_data_utama_untuk_cetak(),
            'get_data_detail_untuk_cetak' => $this->M_penyewaan->get_data_detail_untuk_cetak(),
        ];

        $this->load->view('v_penyewaan_cetak_nota', $data);
    }
}

?>
