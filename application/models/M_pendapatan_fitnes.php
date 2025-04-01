<?php


class M_pendapatan_fitnes extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function getAll()
    {
        $this->db->select('member.nama,member_trx.*');
        $this->db->from('member');
        $this->db->join('member_trx', 'member_trx.memberID =member.id');
        $this->db->order_by('created_at', "asc");
        return $this->db->get()->result_array();
    }
}
