<?php


class M_kategori_olahraga extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_kategori_olahraga()
  {
    $table= "kategori_olahraga"; #nama_table
    $this->db->order_by("id_kategori_olahraga", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }

  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    #nama_table
    $this->db->insert('kategori_olahraga',$simpan_data); 
    
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


   redirect(site_url() . '?/KategoriOlahraga');
  }


   function update_data($id_kategori_olahraga, $update_data)
  {
    #kondisi_where_id
    $this->db->where('id_kategori_olahraga', $id_kategori_olahraga); 
    #nama_table
    $this->db->update('kategori_olahraga', $update_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/KategoriOlahraga');

  }

  function delete_data($id_kategori_olahraga)
  {
    #kondisi_where_id
    $this->db->where('id_kategori_olahraga', $id_kategori_olahraga); 
    #excecution delete
    $this->db->delete('kategori_olahraga');
    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/KategoriOlahraga');
  }



}


 ?>





