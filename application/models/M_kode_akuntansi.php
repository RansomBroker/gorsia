<?php


class M_kode_akuntansi extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_akun()
  {
    $table= "kode_akuntansi"; #nama_table
    $this->db->order_by("kode_akun", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }


  public function get_all_kode_parent()
  {
    $table= "kode_akuntansi"; #nama_table
    $this->db->order_by("kode_akun", "asc"); #sortir_data
    $this->db->where("is_parent", "1"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }

  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    #nama_table
    $this->db->insert('kode_akuntansi',$simpan_data); 
    
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


   redirect(site_url() . '?/KodeAkuntansi');
  }


   function update_data($id_kode_akuntansi, $update_data)
  {
    #kondisi_where_id
    $this->db->where('id_kode_akuntansi', $id_kode_akuntansi); 
    #nama_table
    $this->db->update('kode_akuntansi', $update_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/KodeAkuntansi');

  }

  function delete_data($id_kode_akuntansi)
  {
    #kondisi_where_id
    $this->db->where('id_kode_akuntansi', $id_kode_akuntansi); 
    #excecution delete
    $this->db->delete('kode_akuntansi');
    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/KodeAkuntansi');
  }





}


 ?>





