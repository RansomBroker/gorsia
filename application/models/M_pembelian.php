<?php


class M_pembelian extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_kode_suplier()
  {
    $table= "suplier"; #nama_table
    $this->db->order_by("nama_suplier", "asc"); #sortir_data
    $query = $this->db->get($table);
    return $query->result();
  }


  

  public function get_all_kode_akun_beban()
  {
    $table= "kode_akuntansi";

    $this->db->where("level>", "1");
    $this->db->where("kode_parent", "81");
    $this->db->order_by("kode_akun", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }

  public function get_all_kode_akun_kas()
  {
    $table= "kode_akuntansi";

    $this->db->where("level>", "1");
    $this->db->where("kode_parent", "11");
    $this->db->or_where("kode_parent", "12");
    $this->db->order_by("kode_akun", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }

  public function get_all_kode_akun_hutang()
  {
    $table= "kode_akuntansi";

    $this->db->where("level>", "1");
    $this->db->where("kode_parent", "15");
    $this->db->order_by("kode_akun", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }

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
            'no_pembelian' => $no
            );

    $table = "pembelian";
    $query = $this->db->get_where($table,$where);
    return $query->result();
    }

    public function get_pembelian_detil(){
    $no = $this->uri->segment('4');

    
    $this->db->select('*');    
    $this->db->from('pembelian_detail');
    $this->db->where('pembelian_detail.no_pembelian',$no);

    $this->db->like('id_pembelian_detail');
    $query = $this->db->get();
    return $query->result();
    }


public function get_all_data_barang()
  {
    $this->db->select('*');
    $this->db->from('barang');
    $this->db->where("status_aktif", "1");
    $this->db->order_by("nama_barang", "asc");

    $query = $this->db->get();

    return $query->result();
  }

  public function get_all_data_pembelian()
  {
    $table= "pembelian";


    $this->db->order_by("tanggal", "desc");
    $query = $this->db->get($table);
    return $query->result();
  }
  

  #function untuk menyimpan data
  public function insert_data($simpan_data_beli, $simpan_jurnal, $no_pembelian)
  {
    $this->db->insert('pembelian',$simpan_data_beli);
    $this->db->insert('jurnal_umum',$simpan_jurnal);


    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data, Silahkan melanjutkan pengisian detail pembelian !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


    echo "<script>javascript:window.location='".site_url()."?/Pembelian/viewer/no/$no_pembelian#data_detail'</script>";
  }



   function update_data($no_pembelian, $update_data)
  {
    #kondisi_where_id
    $this->db->where('no_pembelian', $no_pembelian);
    #nama_table
    $this->db->update('pembelian', $update_data);

    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    echo "<script>javascript:window.location='".site_url()."?/Pembelian/viewer/no/$no_bukti#fr_data_detail'</script>";

  }

  function delete_data($no_pembelian, $no_bukti_jurnal)
  {
    #utama
    $this->db->where('no_pembelian', $no_pembelian);
    $this->db->delete('pembelian');

    #detail
    $this->db->where('no_pembelian', $no_pembelian);
    $this->db->delete('pembelian_detail');

    #utama
    $this->db->where('no_bukti', $no_bukti_jurnal);
    $this->db->delete('jurnal_umum');

    #detail
    $this->db->where('no_bukti', $no_bukti_jurnal);
    $this->db->delete('jurnal_umum_detail');

    #notifikasi sukses
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Data !! Ini telah sekaligus menghapus data jurnal yang berkaitan dengan pembelian ini..
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    redirect(site_url() . '?/Pembelian');
  }

   function insert_data_detail_jurnal($simpan_data)
  {
    $this->db->insert('jurnal_umum_detail',$simpan_data);
  }


   function insert_data_detail($simpan_data, $update_data_total, $no_pembelian, $no_bukti_jurnal)
  {
    $this->db->insert('pembelian_detail',$simpan_data);

     #kondisi_where_id
    $this->db->where('no_pembelian', $no_pembelian);
    #nama_table
    $this->db->update('pembelian', $update_data_total);


    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Pembelian Barang !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


    echo "<script>javascript:window.location='".site_url()."?/Pembelian/viewer/no/$no_pembelian#detil_jurnal'</script>";

  }

  function delete_data_detail($no_pembelian, $id_pembelian_detail)
  {
    $this->db->where('id_pembelian_detail', $id_pembelian_detail);
    $this->db->delete('pembelian_detail');

    #baca total sebelumnya
    $rows_read_total  = $this->db->query("SELECT SUM(subtotal) as subtotal FROM pembelian_detail where no_pembelian='".$no_pembelian."'")->row_array();
    $subtotal       = doubleval($rows_read_total['subtotal']);


    $update_data_total=array(
      'total'          => $subtotal,
    );

         #kondisi_where_id
    $this->db->where('no_pembelian', $no_pembelian);
    #nama_table
    $this->db->update('pembelian', $update_data_total);

     #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Hapus Detil Barang !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

    echo "<script>javascript:window.location='".site_url()."?/Pembelian/viewer/no/$no_pembelian#detil_jurnal'</script>";

  }






}


 ?>





