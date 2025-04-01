<?php


class M_settingpenjualanterhadapakuntansi extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }

  #function untuk memanggil sumber data tabel
  public function get_all_data_akun()
  {
    $table= "kode_akuntansi"; #nama_table
    $this->db->order_by("kode_akun", "asc"); #sortir_data
    $this->db->where("level", "2"); #where kondisi
    $query = $this->db->get($table);
    return $query->result();
  }


  #function untuk data tabel
  public function get_all_setting()
  {
    $table= "setting_penjualan_terhadap_kode_akuntansi"; #nama_table
    $this->db->order_by("id_setting", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }

  public function get_all_data_kode_jenis_jurnal()
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
    $this->db->insert('setting_penjualan_terhadap_kode_akuntansi',$simpan_data); 
    
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


   redirect(site_url() . '?/SettingPenjualanTerhadapAkuntansi');
  }



  function delete_data($id_setting)
  {
    #kondisi_where_id
    $this->db->where('id_setting', $id_setting); 
    #excecution delete
    $this->db->delete('setting_penjualan_terhadap_kode_akuntansi');
    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/SettingPenjualanTerhadapAkuntansi');
  }



}


 ?>





