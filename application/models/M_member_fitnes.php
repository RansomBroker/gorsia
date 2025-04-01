<?php


class M_member_fitnes extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->order_by('id', "asc");
        return $this->db->get()->result_array();
    }

    public function simpanData()
    {
        $data = array(
            'nomor_member' => $_POST['kode_pelanggan'],
            'nama_pelanggan' => $_POST['nama_pelanggan'],
            'no_telepon' => $_POST['no_telepon'],
            'email' => $_POST['email'],
            'alamat' => $_POST['alamat'],
            'usia' => $_POST['usia'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            // 'status' => $_POST['member'],
        );

        $simpan = $this->db->set($data)->get_compiled_insert('pelanggan');
        $sql = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $simpan);
        $this->db->query($simpan);
    }

    public function editData($id)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
    public function updateData($id)
    {
        // var_dump($id);
        // die;
        $data = array(
            'nomor_member' => $_POST['kode_pelanggan'],
            'nama_pelanggan' => $_POST['nama_pelanggan'],
            'no_telepon' => $_POST['no_telepon'],
            'email' => $_POST['email'],
            'alamat' => $_POST['alamat'],
            'usia' => $_POST['usia'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            // 'status' => $_POST['member'],
        );

        $this->db->where('id', $id);

        return $this->db->update('pelanggan', $data);;
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('id', $id);
        $this->db->delete($tabel);
    }

    public function cekkodemember()
    {
        $query = $this->db->query("SELECT MAX(nomor_member) as kodeanggota from pelanggan");
        $hasil = $query->row();
        // var_dump($hasil);
        // die;
        return $hasil->kodeanggota;
    }
    public function getPaketFitnes()
    {
        // $this->db->select('*');
        // $this->db->from('paket_sewa');
        // // $this->db->join('kategori_olahraga', 'kategori_olahraga.id_kategori_olahraga =paket_sewa.id_kategori_olahraga');
        // // $this->db->join('satuan_sewa', 'satuan_sewa.id_satuan_sewa  =paket_sewa.id_satuan');
        // // $this->db->order_by('id_kategori_olahraga', "asc");
        // return $this->db->get()->result_array();
        $this->db->select('paket_sewa.*,kategori_olahraga.kategori_olahraga as namaKategori');
        $this->db->from('paket_sewa');
        $this->db->join('kategori_olahraga', 'kategori_olahraga.id_kategori_olahraga =paket_sewa.id_kategori_olahraga');
        $this->db->order_by('id_kategori_olahraga', "asc");
        return $this->db->get()->result_array();
    }
}
