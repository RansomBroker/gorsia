<?php


class M_supplier extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_supplier()
  {
    $table= "suplier"; #nama_table
    $this->db->order_by("kode_suplier", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }

  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    #nama_table
    $this->db->insert('suplier',$simpan_data); 
    
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


   redirect(site_url() . '?/Supplier');
  }


   function update_data($kode_suplier, $update_data)
  {
    #kondisi_where_id
    $this->db->where('kode_suplier', $kode_suplier); 
    #nama_table
    $this->db->update('suplier', $update_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/Supplier');

  }

  function delete_data($kode_suplier)
  {
    #kondisi_where_id
    $this->db->where('kode_suplier', $kode_suplier); 
    #excecution delete
    $this->db->delete('suplier');
    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/Supplier');
  }



}


 ?>





