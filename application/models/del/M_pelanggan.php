<?php


class M_pelanggan extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_pelanggan()
  {
    $table= "pelanggan";


    $this->db->order_by("id_pelanggan", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    $this->db->insert('pelanggan',$simpan_data);

   $this->session->set_flashdata('msg', 'Data Berhasil Tersimpan !!');
   redirect(site_url() . '?/Pelanggan');
  }


   function update_data($id_pelanggan, $update_data)
  {
    $this->db->where('id_pelanggan', $id_pelanggan);
    $this->db->update('pelanggan', $update_data);

    $this->session->set_flashdata('msg', 'Data Berhasil Di Update !!');
     redirect(site_url() . '?/Pelanggan');
  }

  function delete_data($id_pelanggan)
  {
    $this->db->where('id_pelanggan', $id_pelanggan);
    $this->db->delete('pelanggan');

    $this->session->set_flashdata('msg', 'Data Berhasil Dihapus !!');
     redirect(site_url() . '?/Pelanggan');
  }



}


 ?>





