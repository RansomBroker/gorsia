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
    $table= "barang"; #nama_table
    $this->db->order_by("nama_barang", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }

  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    #nama_table
    $this->db->insert('barang',$simpan_data); 
    
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


   redirect(site_url() . '?/Barang');
  }


   function update_data($kode_barang, $update_data)
  {
    #kondisi_where_id
    $this->db->where('kode_barang', $kode_barang); 
    #nama_table
    $this->db->update('barang', $update_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/Barang');

  }

  function delete_data($kode_barang)
  {
    #kondisi_where_id
    $this->db->where('kode_barang', $kode_barang); 
    #excecution delete
    $this->db->delete('barang');
    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/Barang');
  }



}


 ?>





