<?php


class M_transaksi_jurnal extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_kode_jenis_jurnal()
  {
    $table= "kode_jenis_jurnal"; #nama_table
    $this->db->order_by("kode_jenis_jurnal", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }


  public function get_data_transaksi_per_id(){

    $no = $this->uri->segment('4');

    $where = array(
            'no_bukti' => $no
            );

    $table = "jurnal_umum";
    $query = $this->db->get_where($table,$where);
    return $query->result();
    }

    public function get_jurnal_detil(){
    $no = $this->uri->segment('4');

    
    $this->db->select('*');    
    $this->db->from('jurnal_umum_detail');
    $this->db->where('jurnal_umum_detail.no_bukti',$no);

    $this->db->like('id_jurnal_detail');
    $query = $this->db->get();
    return $query->result();
    }


public function get_all_data_akun()
  {
    $this->db->select('*');
    $this->db->from('kode_akuntansi');
    $this->db->where("level>", "1");
    $this->db->order_by("kode_akun", "asc");

    $query = $this->db->get();

    return $query->result();
  }

  public function get_all_data_jurnal()
  {
    $table= "jurnal_umum";


    $this->db->order_by("tanggal", "desc");
    $query = $this->db->get($table);
    return $query->result();
  }
  

  #function untuk menyimpan data
  public function insert_data($simpan_data, $no_bukti)
  {
    $this->db->insert('jurnal_umum',$simpan_data);

    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data, Silahkan melanjutkan pengisian detail transaksi jurnal !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


    echo "<script>javascript:window.location='".site_url()."?/TransaksiJurnal/viewer/no/$no_bukti#fr_data_detail'</script>";
  }



   function update_data($no_bukti, $update_data)
  {
    #kondisi_where_id
    $this->db->where('no_bukti', $no_bukti);
    #nama_table
    $this->db->update('jurnal_umum', $update_data);

    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    echo "<script>javascript:window.location='".site_url()."?/TransaksiJurnal/viewer/no/$no_bukti#fr_data_detail'</script>";

  }

  function delete_data($no_bukti)
  {
    #utama
    $this->db->where('no_bukti', $no_bukti);
    $this->db->delete('jurnal_umum');

    #detail
    $this->db->where('no_bukti', $no_bukti);
    $this->db->delete('jurnal_umum_detail');

    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/TransaksiJurnal');
  }


   function insert_data_detail($simpan_data, $no_bukti)
  {
    $this->db->insert('jurnal_umum_detail',$simpan_data);

    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Detil Jurnal !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


    echo "<script>javascript:window.location='".site_url()."?/TransaksiJurnal/viewer/no/$no_bukti#detil_jurnal'</script>";

  }

  function delete_data_detail($no_bukti, $id_jurnal_detail)
  {
    $this->db->where('id_jurnal_detail', $id_jurnal_detail);
    $this->db->delete('jurnal_umum_detail');

     #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Detil Jurnal !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

    echo "<script>javascript:window.location='".site_url()."?/TransaksiJurnal/viewer/no/$no_bukti#detil_jurnal'</script>";

  }






}


 ?>





