<?php


class M_member_pelanggan extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('member_pelanggan');
        $this->db->order_by('id', "asc");
        return $this->db->get()->result_array();
    }

    public function simpanData()
    {
        $data = array(
            'id_member' => $_POST['id_member'],
            'nama_pelanggan' => $_POST['nama_pelanggan'],
            'no_telepon' => $_POST['no_telepon'],
            // 'status' => $_POST['status'],
        );

        $simpan = $this->db->set($data)->get_compiled_insert('member_pelanggan');
        $sql = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $simpan);
        $this->db->query($simpan);
    }

    public function editData($id)
    {
        $this->db->select('*');
        $this->db->from('member_pelanggan');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
    public function updateData($id)
    {
        // var_dump($id);
        // die;
        $data = array(
            'nama_pelanggan' => $_POST['nama_pelanggan'],
            'no_telepon' => $_POST['no_telepon'],
            // 'status' => $_POST['status'],
        );

        $this->db->where('id', $id);

        return $this->db->update('member_pelanggan', $data);;
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('id', $id);
        $this->db->delete($tabel);
    }

    public function cekkodemember()
    {
        $query = $this->db->query("SELECT MAX(id_member) as id_member from member_pelanggan WHERE id_member<>'NONMEMBER'");
        $hasil = $query->row();
        // var_dump($hasil);
        // die;
        return $hasil->id_member;
    }
}
