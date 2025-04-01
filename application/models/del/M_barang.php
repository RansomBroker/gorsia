<?php


class M_barang extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_barang()
  {
    $table= "barang";


    $this->db->order_by("id_barang", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  public function get_all_kategori_barang()
  {
    $this->db->select('*');
    $this->db->from('kategori_barang');
    $this->db->order_by("id_kategori_barang", "asc");

    $query = $this->db->get();

    return $query->result();
  }

  public function get_all_satuan()
  {
    $this->db->select('*');
    $this->db->from('satuan');
    $this->db->order_by("id_satuan", "asc");

    $query = $this->db->get();

    return $query->result();
  }


  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    $this->db->insert('barang',$simpan_data);

   $this->session->set_flashdata('msg', 'Data Berhasil Tersimpan !!');
   redirect(site_url() . '?/Barang');
  }


   function update_data($id_barang, $update_data)
  {
    $this->db->where('id_barang', $id_barang);
    $this->db->update('barang', $update_data);

    $this->session->set_flashdata('msg', 'Data Berhasil Di Update !!');
     redirect(site_url() . '?/Barang');
  }

  function delete_data($id_barang)
  {
    $this->db->where('id_barang', $id_barang);
    $this->db->delete('barang');

    $this->session->set_flashdata('msg', 'Data Berhasil Dihapus !!');
     redirect(site_url() . '?/Barang');
  }



}


 ?>





