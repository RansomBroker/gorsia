<?php


class M_neraca extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel

   public function get_all_parent_akun_neraca()
  {
     $this->db->select('*');    
    $this->db->from('akun_perkiraan');
    $this->db->where("pos", "NERACA");
    $this->db->where("is_parent", "1");
    $this->db->order_by("kode_akun", "asc");
    $query = $this->db->get();
    return $query->result();
  }


  public function get_all_data_akun()
  {
    $table= "akun_perkiraan";

    $this->db->where("level>", "1");
    $this->db->order_by("kode_akun", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  

}


 ?>





