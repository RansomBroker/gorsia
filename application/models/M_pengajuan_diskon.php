<?php


class M_pengajuan_diskon extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }

  #function untuk data tabel
  public function get_all_pengajuan_diskon()
  {
    $table= "transaksi_sewa"; #nama_table
    $this->db->order_by("tanggal", "desc"); #sortir_data
    $this->db->where("status_transaksi", 'Pengajuan Diskon'); #where kondisi
    $query = $this->db->get($table);
    return $query->result();
  }
}


 ?>





