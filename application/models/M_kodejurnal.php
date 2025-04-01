<?php


class M_kodejurnal extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_kode_jurnal()
  {
    $table= "kode_jenis_jurnal"; #nama_table
    $this->db->order_by("kode_jenis_jurnal", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }

  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    #nama_table
    $this->db->insert('kode_jenis_jurnal',$simpan_data); 
    
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


   redirect(site_url() . '?/KodeJurnal');
  }


   function update_data($kode_jenis_jurnal, $update_data)
  {
    #kondisi_where_id
    $this->db->where('kode_jenis_jurnal', $kode_jenis_jurnal); 
    #nama_table
    $this->db->update('kode_jenis_jurnal', $update_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/KodeJurnal');

  }

  function delete_data($kode_jenis_jurnal)
  {
    #kondisi_where_id
    $this->db->where('kode_jenis_jurnal', $kode_jenis_jurnal); 
    #excecution delete
    $this->db->delete('kode_jenis_jurnal');
    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/KodeJurnal');
  }



}


 ?>





