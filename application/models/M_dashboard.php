<?php


class M_dashboard extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_minimum_stok()
  {
    $table= "barang";

    $this->db->where("stok<", "5");
    $this->db->order_by("nama_barang", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  

}


 ?>





