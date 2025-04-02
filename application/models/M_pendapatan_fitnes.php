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
        $this->db->where('MONTH(member_trx.created_at)', date('m'));
        $this->db->order_by('member_trx.created_at', "asc");
        return $this->db->get()->result_array();
    }

    public function get_all_pendapatan_fitness_by_month_year($month, $year)
    {
        $this->db->select('member.nama,member_trx.*');
        $this->db->from('member');
        $this->db->join('member_trx', 'member_trx.memberID =member.id');
        $this->db->where('MONTH(member_trx.created_at)', $month);
        $this->db->where('YEAR(member_trx.created_at)', $year);
        $this->db->order_by('member_trx.created_at', "asc");
        return $this->db->get()->result_array();
    }
}
