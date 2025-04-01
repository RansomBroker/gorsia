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
  public function get_all_rekap_penyewaan($bulan = null, $tahun = null)
  {
      $table = "transaksi_sewa"; // nama tabel
      
      // Jika parameter bulan bukan "all", tambahkan filter berdasarkan bulan
      if($bulan != 'all'){
          $this->db->where('MONTH(tanggal)', $bulan);
      }

      // Jika parameter tahun bukan "all", tambahkan filter berdasarkan tahun
      if($tahun != 'all'){
          $this->db->where('YEAR(tanggal)', $tahun);
      }

      $this->db->order_by("tanggal", "desc"); // sortir data
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





