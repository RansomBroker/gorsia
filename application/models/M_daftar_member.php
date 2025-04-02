<?php


class M_daftar_member extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function getAllMember()
    {
        $this->db->select('*');
        $this->db->from('member');
        // $this->db->join('paket_sewa', 'paket_sewa.id_paket_sewa = member.paketID');
        $this->db->order_by('id', "asc");
        return $this->db->get()->result_array();
    }

    public function simpanData()
    {
        // $durasiMember = $_POST['durasi_member'];
        // $startDate = $_POST['tanggal_mulai'];
        // $Expired = date('Y-m-d', strtotime($startDate . ' + ' . $durasiMember . ' days'));
        // var_dump($end);
        // die;
        $data = [
            'kodeMember' => $_POST['kodeMember'],
            'nama' => $_POST['nama'],
            'nope' => $_POST['nope'],
            'email' => $_POST['email'],
            'alamat' => $_POST['alamat'],
            'jk' => $_POST['jk'],
            // 'paketID' => $_POST['paketID'],
            // 'metode_bayar' => $_POST['metode_bayar'],
            // 'durasi_member' => $_POST['durasi_member'],
            // 'tanggal_mulai' => $_POST['tanggal_mulai'],
            // 'expired' => $Expired,
            'created_at' => date('Y-m-d'),
        ];


        $simpan = $this->db->set($data)->get_compiled_insert('member');
        $sql = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $simpan);
        $this->db->query($simpan);
        $data = ['status' => true, 'IdSimpan' => $this->db->insert_id()];
        return $data;
    }
    
    public function simpanDataDetail($kodeTransaksi, $hargaPaket)
    {
        $durasiMember = $_POST['durasi_member'];
        $startDate = $_POST['tanggal_mulai'];
        $Expired = date('Y-m-d', strtotime($startDate . ' + ' . $durasiMember . ' days'));


        // $idtransaksi = $this->db->insert_id();
        // var_dump($durasiMember);
        // die;
        $idmember = $_POST['idSimpan'];
        $data = [
            'nomorTransaksi' => $kodeTransaksi,
            'memberID' => $_POST['idSimpan'],
            'paketID' => $_POST['paketID'],
            'harga' => $hargaPaket,
            'metodebayar' => $_POST['metode_bayar'],
            'durasiMember' => $durasiMember,
            'tanggalMulai' => $startDate,
            'tanggalSelesai' => $Expired,
            'created_at' => date('Y-m-d'),
        ];
        $simpan = $this->db->set($data)->get_compiled_insert('member_trx');
        $sql = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $simpan);
        $this->db->query($simpan);
        $getID = $this->db->insert_id();

        $updateExpiredMember = $this->db->where('id', $idmember)->update('member', ['expired_member' => $Expired]);

        // var_dump($getID);
        // die;
        $data = ['status' => true, 'idSimpanDetail' => $getID];
        return $data;
    }


    public function updateData($id)
    {

        $durasiMember = $_POST['durasi_member'];
        $startDate = $_POST['tanggal_mulai'];
        $Expired = date('Y-m-d', strtotime($startDate . ' + ' . $durasiMember . ' days'));


        // $idtransaksi = $this->db->insert_id();
        // var_dump($durasiMember);
        // die;
        $data = [
            'nomorTransaksi' => $kodeTransaksi,
            'memberID' => $_POST['idSimpan'],
            'paketID' => $_POST['paketID'],
            'harga' => $hargaPaket,
            'metodebayar' => $_POST['metode_bayar'],
            'durasiMember' => $durasiMember,
            'tanggalMulai' => $startDate,
            'tanggalSelesai' => $Expired,
            'created_at' => date('Y-m-d'),
        ];
        $simpan = $this->db->set($data)->get_compiled_insert('member_trx');
        $sql = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $simpan);
        $this->db->query($simpan);
        // $dataexpired = $_POST['tglExpired'];

        return $this->db->where('id', $id)->update('member', ['expired_member' => $Expired]);
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('id', $id);
        $this->db->delete($tabel);
    }

    public function historiData($id)
    {
        $this->db->select('*');
        $this->db->from('member');
        // $this->db->join('pelanggan', 'pelanggan.id = member.idPelanggan');
        $this->db->where('id', $id);
        return $this->db->get()->row();
        // var_dump($id);
        // die;
    }
    public function histori($id)
    {
        $this->db->select('*');
        $this->db->from('member_trx');
        $this->db->where('memberID', $id);
        $this->db->order_by('id', "asc");
        return $this->db->get()->result_array();
    }

    public function cekkodemember()
    {
        $query = $this->db->query("SELECT MAX(kodeMember) as kodemember from member");
        $hasil = $query->row();
        // var_dump($hasil);
        // die;
        return $hasil->kodemember;
    }
    public function cekkotransaksi()
    {
        $query = $this->db->query("SELECT MAX(nomorTransaksi) as kodeTransaksi from member_trx");
        $hasil = $query->row();
        // var_dump($hasil);
        // die;cekkotransaksi
        return $hasil->kodeTransaksi;
    }

    public function cekidtransaksi()
    {
        $query = $this->db->query("SELECT MAX(id) as kodeTransaksi from member_trx");
        $hasil = $query->row();
        // var_dump($hasil);
        // die;cekkotransaksi
        return $hasil->kodeTransaksi;
    }
}
