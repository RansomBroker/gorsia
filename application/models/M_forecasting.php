<?php


class M_forecasting extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function get_pendapatan_sewa($id)
    {
        $this->db->select('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(total - diskon) as pendapatan');
        $this->db->from('transaksi_sewa');
        $this->db->group_by(['YEAR(tanggal)', 'MONTH(tanggal)']);
        $periode = date('Y-m');
        $this->db->where('MONTH(tanggal) between '.DateTime::createFromFormat('Y-m', $periode)->modify('-2 months')->format('m').' and '.DateTime::createFromFormat('Y-m', $periode)->format('m'));
        $this->db->where('id_kategori_olahraga', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pendapatan_sewa_filter($id,$periode)
    {
        // var_dump(DateTime::createFromFormat('Y-m', $periode)->modify('-3 months')->format('m'));exit;
        $this->db->select('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(total - diskon) as pendapatan');
        $this->db->from('transaksi_sewa');
        $this->db->group_by(['YEAR(tanggal)', 'MONTH(tanggal)']);
        $this->db->where('MONTH(tanggal) between '.DateTime::createFromFormat('Y-m', $periode)->modify('-2 months')->format('m').' and '.DateTime::createFromFormat('Y-m', $periode)->format('m'));
        $this->db->where('id_kategori_olahraga', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pendapatan_sewa_all($periode = null)
    {
        if($periode == null) {
            $periode = date('Y-m');
        }
        $this->db->select('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(total - diskon) as pendapatan');
        $this->db->from('transaksi_sewa');
        $this->db->group_by(['YEAR(tanggal)', 'MONTH(tanggal)']);
        $this->db->where('MONTH(tanggal) between '.DateTime::createFromFormat('Y-m', $periode)->modify('-2 months')->format('m').' and '.DateTime::createFromFormat('Y-m', $periode)->format('m'));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pendapatan_member($periode = null)
    {
        if($periode == null) {
            $periode = date('Y-m');
        }
        $this->db->select('YEAR(tanggalMulai) as year, MONTH(tanggalMulai) as month, SUM(harga) as pendapatan');
        $this->db->from('member_trx');
        $this->db->group_by(['YEAR(tanggalMulai)', 'MONTH(tanggalMulai)']);
        $this->db->where('MONTH(tanggalMulai) between '.DateTime::createFromFormat('Y-m', $periode)->modify('-2 months')->format('m').' and '.DateTime::createFromFormat('Y-m', $periode)->format('m'));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pendapatan_sewa_by_interval($periode, $interval, $id_kategori_olahraga)
    { 
        $endDate = DateTime::createFromFormat('Y-m', $periode)->format('Y-m-01'); 
        
        $currentDate = new DateTime($endDate);
        $currentDate->modify('-6 months');
        $year = $currentDate->format('Y');
        $month = $currentDate->format('m');
        $startDate = DateTime::createFromFormat('Y-m', $year.'-'.$month)->format('Y-m-01'); 

        $this->db->select('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(total - diskon) as pendapatan');
        $this->db->from('transaksi_sewa');
        $this->db->where('tanggal >=', $startDate);
        $this->db->where('tanggal <', $endDate);
        if ($id_kategori_olahraga > 0) {
            $this->db->where('id_kategori_olahraga', $id_kategori_olahraga);
        }
        $this->db->group_by(['YEAR(tanggal)', 'MONTH(tanggal)']);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pendapatan_member_by_interval($interval)
    {
        $this->db->select('YEAR(tanggalMulai) as year, MONTH(tanggalMulai) as month, SUM(harga) as pendapatan');
        $this->db->from('member_trx');
        $this->db->group_by(['YEAR(tanggalMulai)', 'MONTH(tanggalMulai)']);
        $this->db->where('tanggalMulai >=', "DATE_SUB(CURDATE(), INTERVAL $interval MONTH)", false);
        $query = $this->db->get();
        return $query->result();
    }
}
