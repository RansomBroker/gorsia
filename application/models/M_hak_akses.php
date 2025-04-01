<?php


class M_hak_akses extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }

  
  #function untuk data tabel
  public function get_all_hak_akses()
  {
    $table= "hak_akses"; #nama_table
    $this->db->order_by("id", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }

  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    #nama_table
    $this->db->insert('hak_akses',$simpan_data); 
    
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


   redirect(site_url() . '?/HakAkses');
  }


   function update_data($id_hak_akses, $update_data)
  {
    #kondisi_where_id
    $this->db->where('id', $id_hak_akses); 
    #nama_table
    $this->db->update('hak_akses', $update_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/HakAkses');

  }

  function delete_data($id_hak_akses)
  {
    #kondisi_where_id
    $this->db->where('id', $id_hak_akses); 
    #excecution delete
    $this->db->delete('hak_akses');
    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/HakAkses');
  }



}


 ?>





