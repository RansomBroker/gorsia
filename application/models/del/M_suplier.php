<?php


class M_suplier extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_suplier()
  {
    $table= "suplier";


    $this->db->order_by("id_suplier", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    $this->db->insert('suplier',$simpan_data);

   $this->session->set_flashdata('msg', 'Data Berhasil Tersimpan !!');
   redirect(site_url() . '?/Suplier');
  }


   function update_data($id_suplier, $update_data)
  {
    $this->db->where('id_suplier', $id_suplier);
    $this->db->update('suplier', $update_data);

    $this->session->set_flashdata('msg', 'Data Berhasil Di Update !!');
     redirect(site_url() . '?/Suplier');
  }

  function delete_data($id_suplier)
  {
    $this->db->where('id_suplier', $id_suplier);
    $this->db->delete('suplier');

    $this->session->set_flashdata('msg', 'Data Berhasil Dihapus !!');
     redirect(site_url() . '?/Suplier');
  }



}


 ?>





