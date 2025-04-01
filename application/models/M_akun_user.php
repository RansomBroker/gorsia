<?php


class M_akun_user extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }

  #function untuk memanggil sumber data hak akses
  public function get_all_hak_akses()
  {
    $table= "hak_akses"; #nama_table
    $this->db->order_by("hak_akses", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }


  #function untuk data tabel
  public function get_all_user()
  {
    $table= "user"; #nama_table
    $this->db->order_by("nama_lengkap", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }

  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    #nama_table
    $this->db->insert('user',$simpan_data); 
    
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


   redirect(site_url() . '?/AkunUser');
  }


   function update_data($id_user, $update_data)
  {
    #kondisi_where_id
    $this->db->where('id', $id_user); 
    #nama_table
    $this->db->update('user', $update_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/AkunUser');

  }

  function delete_data($id_user)
  {
    #kondisi_where_id
    $this->db->where('id', $id_user); 
    #excecution delete
    $this->db->delete('user');
    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/AkunUser');
  }


  function reset_password($id_user, $simpan_data)
  {
    #kondisi_where_id
    $this->db->where('id', $id_user); 
    #nama_table
    $this->db->update('user', $simpan_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Reset Password = 1234 !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/AkunUser');

  }



}


 ?>





