<?php


class M_harga_paket_sewa extends CI_Model
{

  function __construct()
  {
    parent::__construct();

    $this->load->database();
  }

  #function untuk memanggil sumber data kategori
  public function get_all_kategori()
  {
    $table = "kategori_olahraga"; #nama_table
    $this->db->order_by("kategori_olahraga", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->row();
  }


  #function untuk memanggil sumber data satuan
  public function get_all_satuan()
  {
    $table = "satuan_sewa"; #nama_table
    $this->db->order_by("id_satuan_sewa", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }
  public function get_by_id($id)
  {
    $table = "paket_sewa"; #nama_table
    $this->db->where("id_paket_sewa", $id);
    $query = $this->db->get($table);
    return $query->row();
  }

  #function untuk data tabel
  public function get_all_paket_sewa()
  {
    $table = "paket_sewa"; #nama_table
    $this->db->order_by("id_paket_sewa", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }


  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    #nama_table
    $this->db->insert('paket_sewa', $simpan_data);

    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


    redirect(site_url() . '?/HargaPaketSewa');
  }


  function update_data($id_paket_sewa, $update_data)
  {
    #kondisi_where_id
    $this->db->where('id_paket_sewa', $id_paket_sewa);
    #nama_table
    $this->db->update('paket_sewa', $update_data);
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/HargaPaketSewa');
  }

  function delete_data($id_paket_sewa)
  {
    #kondisi_where_id
    $this->db->where('id_paket_sewa', $id_paket_sewa);
    #excecution delete
    $this->db->delete('paket_sewa');
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/HargaPaketSewa');
  }
}
