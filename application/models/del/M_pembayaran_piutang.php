<?php


class M_pembayaran_piutang extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data combo box
   public function get_all_data_pelanggan()
  {
    $table= "pelanggan";


    $this->db->order_by("nama_pelanggan", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }
    public function get_all_metode_pembayaran()
  {
    $table= "metode_pembayaran";


    $this->db->order_by("nama_metode_pembayaran", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  public function get_all_transaksi_penjualan()
  {
    $table= "penjualan_invoice";


    $this->db->order_by("id_invoice", "desc");
    $query = $this->db->get($table);
    return $query->result();
  }

  #function untuk data tabel
  public function get_all_pembayaran_piutang()
  {
    $table= "pembayaran_piutang";


    $this->db->order_by("id_pembayaran_piutang", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    $this->db->insert('pembayaran_piutang',$simpan_data);

   $this->session->set_flashdata('msg', 'Data Berhasil Tersimpan !!');
   redirect(site_url() . '?/PembayaranPiutang');
  }


   function update_data($id_pembayaran_piutang, $update_data)
  {
    $this->db->where('id_pembayaran_piutang', $id_pembayaran_piutang);
    $this->db->update('pembayaran_piutang', $update_data);

    $this->session->set_flashdata('msg', 'Data Berhasil Di Update !!');
     redirect(site_url() . '?/PembayaranPiutang/riwayat');
  }

  function delete_data($id_pembayaran_piutang)
  {
    $this->db->where('id_pembayaran_piutang', $id_pembayaran_piutang);
    $this->db->delete('pembayaran_piutang');

    $this->session->set_flashdata('msg', 'Data Berhasil Dihapus !!');
     redirect(site_url() . '?/PembayaranPiutang');
  }



}


 ?>





