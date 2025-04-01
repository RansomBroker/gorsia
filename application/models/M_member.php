<?php


class M_member extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_member()
  {
    $table= "member_pelanggan"; #nama_table
    $this->db->where("id_member<>", "NONMEMBER"); #sortir_data
    $this->db->order_by("nama_pelanggan", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }

  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    #nama_table
    $this->db->insert('member_pelanggan',$simpan_data); 
    
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


   redirect(site_url() . '?/Member');
  }


   function update_data($id_member, $update_data)
  {
    #kondisi_where_id
    $this->db->where('id_member', $id_member); 
    #nama_table
    $this->db->update('member_pelanggan', $update_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/Member');

  }

  function delete_data($id_member)
  {
    #kondisi_where_id
    $this->db->where('id_member', $kode_barang); 
    #excecution delete
    $this->db->delete('member_pelanggan');
    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/Member');
  }



}


 ?>





