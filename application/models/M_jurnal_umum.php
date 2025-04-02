<?php


class M_jurnal_umum extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }

  public function get_all_jurnal()
  {
    $this->db->select('*');
    $this->db->from('jurnal_umum');
    $this->db->join('jurnal_umum_detail', 'jurnal_umum.no_bukti = jurnal_umum_detail.no_bukti');
    $this->db->join('kode_akuntansi', 'kode_akuntansi.id_kode_akuntansi = jurnal_umum_detail.id_kode_akuntansi');
    $this->db->where('jurnal_umum.user_created', $this->session->username);
    $this->db->order_by('tanggal', 'asc');

    $query = $this->db->get();

    return $query->result();
  }

  public function get_all_jurnal_filter($tanggal_awal, $tanggal_akhir)
  {
    $this->db->select('*');
    $this->db->from('jurnal_umum');
    $this->db->join('jurnal_umum_detail', 'jurnal_umum.no_bukti = jurnal_umum_detail.no_bukti');
    $this->db->join('kode_akuntansi', 'kode_akuntansi.id_kode_akuntansi = jurnal_umum_detail.id_kode_akuntansi');
    $this->db->where('jurnal_umum.user_created', $this->session->username);
    $this->db->where('tanggal >=', $tanggal_awal);
    $this->db->where('tanggal <=', $tanggal_akhir);
    $this->db->order_by('tanggal', 'asc');

    $query = $this->db->get();

    return $query->result();
  }

  public function get_all_jurnal_filter_by_month_year($month, $year)
  {
    $this->db->select('*');
    $this->db->from('jurnal_umum');
    $this->db->join('jurnal_umum_detail', 'jurnal_umum.no_bukti = jurnal_umum_detail.no_bukti');
    $this->db->join('kode_akuntansi', 'kode_akuntansi.id_kode_akuntansi = jurnal_umum_detail.id_kode_akuntansi');
    $this->db->where('jurnal_umum.user_created', $this->session->username);
    $this->db->where('MONTH(tanggal)', $month);
    $this->db->where('YEAR(tanggal)', $year);
    $this->db->order_by('tanggal', 'asc');

    $query = $this->db->get();

    return $query->result();
  }

}