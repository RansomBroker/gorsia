<?php


class M_my_profile extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }



   function update_data($username, $simpan_data)
  {
    #kondisi_where_id
    $this->db->where('username', $username); 
    #nama_table
    $this->db->update('user', $simpan_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/Login/logout');

  }


}


 ?>





