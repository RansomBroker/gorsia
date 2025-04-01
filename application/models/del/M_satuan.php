<?php


class M_satuan extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_satuan()
  {
    $table= "satuan";


    $this->db->order_by("id_satuan", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    $this->db->insert('satuan',$simpan_data);

   $this->session->set_flashdata('msg', 'Data Berhasil Tersimpan !!');
   redirect(site_url() . '?/Satuan');
  }


   function update_data($id_satuan, $update_data)
  {
    $this->db->where('id_satuan', $id_satuan);
    $this->db->update('satuan', $update_data);

    $this->session->set_flashdata('msg', 'Data Berhasil Di Update !!');
     redirect(site_url() . '?/Satuan');
  }

  function delete_data($id_satuan)
  {
    $this->db->where('id_satuan', $id_satuan);
    $this->db->delete('satuan');

    $this->session->set_flashdata('msg', 'Data Berhasil Dihapus !!');
     redirect(site_url() . '?/Satuan');
  }



}


 ?>





