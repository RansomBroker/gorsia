<?php


class M_lapangan extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }

  #function untuk memanggil sumber data tabel
  public function get_all_kategori()
  {
    $table= "kategori_olahraga"; #nama_table
    $this->db->order_by("kategori_olahraga", "asc"); #sortir_data
    $this->db->where("memiliki_lapangan", "1"); #where kondisi
    $query = $this->db->get($table);
    return $query->result();
  }


  #function untuk data tabel
  public function get_all_lapangan()
  {
    $table= "lapangan"; #nama_table
    $this->db->order_by("id_lapangan", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }

  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    #nama_table
    $this->db->insert('lapangan',$simpan_data); 
    
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


   redirect(site_url() . '?/Lapangan');
  }


   function update_data($id_lapangan, $update_data)
  {
    #kondisi_where_id
    $this->db->where('id_lapangan', $id_lapangan); 
    #nama_table
    $this->db->update('lapangan', $update_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/Lapangan');

  }

  function delete_data($id_lapangan)
  {
    #kondisi_where_id
    $this->db->where('id_lapangan', $id_lapangan); 
    #excecution delete
    $this->db->delete('lapangan');
    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/Lapangan');
  }



}


 ?>





