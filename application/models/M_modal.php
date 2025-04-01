<?php


class M_modal extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }

  #function untuk memanggil sumber data tabel
  public function get_all_kode_akuntansi_modal()
  {
    $table= "kode_akuntansi"; #nama_table
    $this->db->order_by("kode_akun", "asc"); #sortir_data
    $this->db->where("kode_parent", "21"); #where kondisi
    $query = $this->db->get($table);
    return $query->result();
  }


  #function untuk data tabel
  public function get_all_modal()
  {
    $table= "perubahan_modal"; #nama_table
    $this->db->order_by("id_perubahan_modal", "desc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }

  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    #nama_table
    $this->db->insert('perubahan_modal',$simpan_data); 
    
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


   redirect(site_url() . '?/Modal');
  }


   function update_data($id_perubahan_modal, $update_data)
  {
    #kondisi_where_id
    $this->db->where('id_perubahan_modal', $id_perubahan_modal); 
    #nama_table
    $this->db->update('perubahan_modal', $update_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/Modal');

  }

  function delete_data($id_perubahan_modal)
  {
    #kondisi_where_id
    $this->db->where('id_perubahan_modal', $id_perubahan_modal); 
    #excecution delete
    $this->db->delete('perubahan_modal');
    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/Modal');
  }



}


 ?>





