<?php


class M_rekap_penyewaan extends CI_Model
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
  public function get_all_rekap_penyewaan()
  {
    $table= "transaksi_sewa"; #nama_table
    $this->db->order_by("tanggal", "desc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }

 

  function delete_data($id_transaksi)
  {
    #kondisi_where_id
    $this->db->where('id_transaksi', $id_transaksi); 
    #excecution delete
    $this->db->delete('transaksi_sewa');

    #kondisi_where_id
    $this->db->where('id_transaksi', $id_transaksi); 
    #excecution delete
    $this->db->delete('transaksi_sewa_detil');

    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/RekapPenyewaan');
  }



}


 ?>





