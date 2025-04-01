<?php


class M_pendapatan_fitnes extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function getAll($bulan = null, $tahun = null)
    {
        $this->db->select('member.nama, member_trx.*');
        $this->db->from('member');
        $this->db->join('member_trx', 'member_trx.memberID = member.id');
        
        // Jika bulan bukan 'all', tambahkan filter bulan
        if ($bulan != null && $bulan != 'all') {
            $this->db->where('MONTH(member_trx.created_at)', $bulan);
        }
    
        // Jika tahun bukan 'all', tambahkan filter tahun
        if ($tahun != null && $tahun != 'all') {
            $this->db->where('YEAR(member_trx.created_at)', $tahun);
        }
    
        $this->db->order_by('member_trx.created_at', "asc");
        return $this->db->get()->result_array();
    }
    
}
