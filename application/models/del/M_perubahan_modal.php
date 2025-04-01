<?php


class M_perubahan_modal extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_akun_modal()
  {
    $table= "akun_perkiraan";

    $this->db->where("kode_parent", "21");
    $this->db->order_by("kode_akun", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    $this->db->insert('perubahan_modal',$simpan_data);

   $this->session->set_flashdata('msg', 'Data Berhasil Tersimpan !!');
   redirect(site_url() . '?/PerubahanModal');
  }


   function update_data($id_perubahan_modal, $update_data)
  {
    $this->db->where('id_perubahan_modal', $id_perubahan_modal);
    $this->db->update('perubahan_modal', $update_data);

    $this->session->set_flashdata('msg', 'Data Berhasil Di Update !!');
     redirect(site_url() . '?/PerubahanModal');
  }



}


 ?>





