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
    $this->db->where('jurnal_umum_detail.id_akun_perkiraan',$param_id_akun);
    $this->db->where("jurnal_umum.periode", $param_periode);
    $this->db->order_by("id_jurnal", "asc");
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





