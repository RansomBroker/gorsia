<?php


class M_metode_pembayaran extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_metode_pembayaran()
  {
    $table= "metode_pembayaran";


    $this->db->order_by("id_metode_pembayaran", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    $this->db->insert('metode_pembayaran',$simpan_data);

   $this->session->set_flashdata('msg', 'Data Berhasil Tersimpan !!');
   redirect(site_url() . '?/MetodePembayaran');
  }


   function update_data($id_metode_pembayaran, $update_data)
  {
    $this->db->where('id_metode_pembayaran', $id_metode_pembayaran);
    $this->db->update('metode_pembayaran', $update_data);

    $this->session->set_flashdata('msg', 'Data Berhasil Di Update !!');
     redirect(site_url() . '?/MetodePembayaran');
  }

  function delete_data($id_metode_pembayaran)
  {
    $this->db->where('id_metode_pembayaran', $id_metode_pembayaran);
    $this->db->delete('metode_pembayaran');

    $this->session->set_flashdata('msg', 'Data Berhasil Dihapus !!');
     redirect(site_url() . '?/MetodePembayaran');
  }



}


 ?>





