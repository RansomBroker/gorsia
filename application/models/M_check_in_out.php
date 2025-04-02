<?php


class M_check_in_out extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('check_in_out');
        $this->db->where('DATE(checkIn)', date('Y-m-d'));
        $this->db->where('checkOut', NULL);
        $this->db->order_by('checkIn', "asc");
        return $this->db->get()->result_array();
    }

    public function get_all_member()
    {
        $table= "member"; #nama_table
        $this->db->order_by("nama", "asc"); #sortir_data
        $query = $this->db->get($table);
        return $query->result();
    }

    #function untuk data tabel
    public function get_total_check_in()
    {
        $this->db->from('check_in_out');
        $this->db->where('checkOut', NULL);
        $this->db->where('DATE(checkIn)', date('Y-m-d'));
        $count = $this->db->count_all_results();
    return $count;
    }

    public function get_by_kode_member($kodeMember)
    {
        $table = "check_in_out"; #nama_table
        $this->db->where("kodeMember", $kodeMember);
        $this->db->where('checkOut', NULL);
        $query = $this->db->get($table);
        return $query->row();
    }

    public function simpanData()
    {
        $data = array(
            'kodeMember' => $_POST['kodeMember'],
            'nama' => $_POST['nama'],
            'no_telepon' => $_POST['no_telepon'],
            'checkIn' => date("Y-m-d H:i:s", strtotime($_POST['checkIn'])),
        );

        $simpan = $this->db->set($data)->get_compiled_insert('check_in_out');
        $sql = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $simpan);
        $this->db->query($simpan);
    }

    public function editData($id)
    {
        $this->db->select('*');
        $this->db->from('check_in_out');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
    public function updateData($id)
    {
        // var_dump($id);
        // die;
        $data = array(
            'checkOut' => date("Y-m-d H:i:s", strtotime($_POST['checkOut'])),
        );

        $this->db->where('id', $id);

        return $this->db->update('check_in_out', $data);;
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('id', $id);
        $this->db->delete($tabel);
    }
}
