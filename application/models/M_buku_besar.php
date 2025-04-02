<?php


class M_buku_besar extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }

   #function untuk data tabel
  public function get_all_buku_besar($param_id_akun,$param_periode)
  {

    $this->db->select('*');    
    $this->db->from('jurnal_umum');
    $this->db->join('jurnal_umum_detail', 'jurnal_umum.no_bukti = jurnal_umum_detail.no_bukti');
    $this->db->where('jurnal_umum_detail.id_kode_akuntansi',$param_id_akun);
    $this->db->where("jurnal_umum.periode", $param_periode);
    $this->db->order_by("id_jurnal", "asc");
    $query = $this->db->get();
    return $query->result();
  }



  public function get_all_data_akun()
  {
    $table= "kode_akuntansi";

    $this->db->where("level>", "1");
    $this->db->order_by("kode_akun", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }

  public function get_all_data_buku()
  {
    $this->db->select('*');
    $this->db->from('jurnal_umum_detail');
    $this->db->join('jurnal_umum', 'jurnal_umum.no_bukti = jurnal_umum_detail.no_bukti');
    $this->db->join('kode_akuntansi', 'kode_akuntansi.id_kode_akuntansi = jurnal_umum_detail.id_kode_akuntansi');
    $this->db->order_by('jurnal_umum_detail.id_kode_akuntansi, jurnal_umum.tanggal');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_all_data_buku_by_date($param_id_akun,$start_date,$end_date)
  {
    $this->db->select('*');
    $this->db->from('jurnal_umum_detail');
    $this->db->join('jurnal_umum', 'jurnal_umum.no_bukti = jurnal_umum_detail.no_bukti');
    $this->db->join('kode_akuntansi', 'kode_akuntansi.id_kode_akuntansi = jurnal_umum_detail.id_kode_akuntansi');
    if (!in_array('all', $param_id_akun)) {
      $this->db->where_in('jurnal_umum_detail.id_kode_akuntansi', $param_id_akun);
    }
    $this->db->where('jurnal_umum.tanggal >=', $start_date);
    $this->db->where('jurnal_umum.tanggal <=', $end_date);
    $this->db->order_by('jurnal_umum_detail.id_kode_akuntansi, jurnal_umum.tanggal');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_all_data_buku_by_month_year($param_id_akun, $month, $year)
  {
    $this->db->select('*');
    $this->db->from('jurnal_umum_detail');
    $this->db->join('jurnal_umum', 'jurnal_umum.no_bukti = jurnal_umum_detail.no_bukti');
    $this->db->join('kode_akuntansi', 'kode_akuntansi.id_kode_akuntansi = jurnal_umum_detail.id_kode_akuntansi');
    if (!in_array('all', $param_id_akun)) {
      $this->db->where_in('jurnal_umum_detail.id_kode_akuntansi', $param_id_akun);
    }
    $this->db->where('MONTH(jurnal_umum.tanggal)', $month);
    $this->db->where('YEAR(jurnal_umum.tanggal)', $year);
    $this->db->order_by('jurnal_umum_detail.id_kode_akuntansi, jurnal_umum.tanggal');
    $query = $this->db->get();
    return $query->result();
  }

}


 ?>





