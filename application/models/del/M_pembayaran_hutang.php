<?php


class M_pembayaran_hutang extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data combo box
   public function get_all_data_suplier()
  {
    $table= "suplier";


    $this->db->order_by("nama_suplier", "asc");
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

  #function untuk data tabel
  public function get_all_pembayaran_hutang()
  {
    $table= "pembayaran_hutang";


    $this->db->order_by("id_pembayaran_hutang", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }

  public function get_all_penerimaan_barang()
  {
    $table= "penerimaan_barang";


    $this->db->order_by("id_penerimaan_barang", "desc");
    $query = $this->db->get($table);
    return $query->result();
  }


  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    $this->db->insert('pembayaran_hutang',$simpan_data);

   $this->session->set_flashdata('msg', 'Data Berhasil Tersimpan !!');
   redirect(site_url() . '?/PembayaranHutang');
  }


   function update_data($id_pembayaran_hutang, $update_data)
  {
    $this->db->where('id_pembayaran_hutang', $id_pembayaran_hutang);
    $this->db->update('pembayaran_hutang', $update_data);

    $this->session->set_flashdata('msg', 'Data Berhasil Di Update !!');
     redirect(site_url() . '?/PembayaranHutang/riwayat');
  }

  function delete_data($id_pembayaran_hutang)
  {
    $this->db->where('id_pembayaran_hutang', $id_pembayaran_hutang);
    $this->db->delete('pembayaran_hutang');

    $this->session->set_flashdata('msg', 'Data Berhasil Dihapus !!');
     redirect(site_url() . '?/PembayaranHutang/riwayat');
  }



}


 ?>





