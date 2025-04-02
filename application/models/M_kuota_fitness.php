<?php


class M_kuota_fitness extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('kuota_fitness');
        $this->db->order_by('id', "asc");
        return $this->db->get()->result_array();
    }

    public function get_kuota()
    {
        $this->db->select('*');
        $this->db->from('kuota_fitness');
        $this->db->order_by('id', "desc");
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    public function simpanData()
    {
        $data = array(
            'kuota' => $_POST['kuota'],
            'user_create' => $this->session->username,
            'created_at' => date("Y-m-d H:i:s"),
        );

        $simpan = $this->db->set($data)->get_compiled_insert('kuota_fitness');
        $sql = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $simpan);
        $this->db->query($simpan);
    }

    public function editData($id)
    {
        $this->db->select('*');
        $this->db->from('kuota_fitness');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
    public function updateData($id)
    {
        // var_dump($id);
        // die;
        $data = array(
            'kuota' => $_POST['kuota'],
        );

        $this->db->where('id', $id);

        return $this->db->update('kuota_fitness', $data);;
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('id', $id);
        $this->db->delete($tabel);
    }

}
