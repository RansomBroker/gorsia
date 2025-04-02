<?php


class M_penyewaan extends CI_Model
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

 #function untuk memanggil sumber data lapangan
  public function get_all_lapangan()
  {
    $table= "lapangan"; #nama_table
    $this->db->order_by("nama_lapangan", "asc"); #sortir_data
    $this->db->where("status_aktif", "1"); #where kondisi
    $query = $this->db->get($table);
    return $query->result();
  }

  public function get_all_member()
  {
    $table= "member_pelanggan"; #nama_table
    $this->db->order_by("nama_pelanggan", "asc"); #sortir_data
    $this->db->where("id_member<>", "NONMEMBER"); #where kondisi
    // $this->db->where("status", "1"); #where kondisi
    $query = $this->db->get($table);
    return $query->result();
  }



  #function untuk data tabel
  public function get_all_jadwal_sesi()
  {

    $id_trx = $this->uri->segment('4');
     #lapangan yg disewa
    $rows_lapangan_disewa = $this->db->query("SELECT * FROM transaksi_sewa where id_transaksi='".$id_trx."'")->row_array();
    $id_kategori_olahraga=$rows_lapangan_disewa['id_kategori_olahraga'];

    $table= "jadwal_sesi"; #nama_table
    $this->db->order_by("id_jadwal_sesi", "asc"); #sortir_data
    $this->db->where("id_kategori_olahraga", $id_kategori_olahraga); #where kondisi

    $query = $this->db->get($table);
    return $query->result();
  }


  #function untuk data tabel
  public function get_all_sewa_detil()
  {

    $id_trx = $this->uri->segment('4');

    $table= "transaksi_sewa_detil"; #nama_table
    $this->db->order_by("id_transaksi_detil", "asc"); #sortir_data
    $this->db->where("id_transaksi", $id_trx); #where kondisi

    $query = $this->db->get($table);
    return $query->result();
  }

  public function get_info_member($id){
        $hasil=$this->db->query("SELECT * FROM member_pelanggan WHERE id_member='$id'");
        return $hasil->result();

    }

  
  #function untuk menyimpan data
  public function insert_data_pilih_lapangan($simpan_data, $id_transaksi)
  {
    #nama_table
    $this->db->insert('transaksi_sewa',$simpan_data); 
    
    #notifikasi sukses
    /*$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');*/


   redirect(site_url() . '?/Penyewaan/view/idtrx/'.$id_transaksi);
  }


   function update_data_penyewaan($id_transaksi, $simpan_data)
  {
    #kondisi_where_id
    $this->db->where('id_transaksi', $id_transaksi); 
    #nama_table
    $this->db->update('transaksi_sewa', $simpan_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    
   redirect(site_url() . '?/Penyewaan/view/idtrx/'.$id_transaksi);

  }

   function update_data_tanggal($id_transaksi, $list_tanggal)
  {
    # Delete existing records
    $this->db->where('id_transaksi', $id_transaksi);
    $this->db->delete('transaksi_sewa_tanggal');

    # Insert new records
    foreach ($list_tanggal as $tanggal) {
      $data = array(
        'id_transaksi' => $id_transaksi,
        'tanggal' => $tanggal
      );
      $this->db->insert('transaksi_sewa_tanggal', $data);
    }

  }

  function validasi_data_penyewaan($id_transaksi, $simpan_data)
  {
    #kondisi_where_id
    $this->db->where('id_transaksi', $id_transaksi); 
    #nama_table
    $this->db->update('transaksi_sewa', $simpan_data); 
    #notifikasi sukses
    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Pengajuan diskon berhasil di Validasi !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    
   redirect(site_url() . '?/PengajuanDiskon');

  }

  function terima_data_penyewaan($id_transaksi, $simpan_data)
  {
    #kondisi_where_id
    $this->db->where('id_transaksi', $id_transaksi); 
    #nama_table
    $this->db->update('transaksi_sewa', $simpan_data); 
  }

  function insert_sesi_ke_transaksi($simpan_data_sesi)
 {
   $this->db->insert('transaksi_sewa_detil',$simpan_data_sesi);
    //redirect(site_url() . '?/Penyewaan/view_sesi/idtrx/'.$id_transaksi);

 }

  function update_total_harga($id_trx, $update_data_total)
  {
    #kondisi_where_id
    $this->db->where('id_transaksi', $id_trx); 
    #nama_table
    $this->db->update('transaksi_sewa', $update_data_total); 
    #notifikasi sukses
    /*$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Ubah Data !!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');*/
   //redirect(site_url() . '?/Penyewaan/view/idtrx/'.$id_trx);

  }

  function delete_data_sesi($id_transaksi, $id_transaksi_detil)
  {
    #kondisi_where_id
    $this->db->where('id_transaksi_detil', $id_transaksi_detil); 
    #excecution delete
    $this->db->delete('transaksi_sewa_detil');


    #baca sumary total detil
        $rows_total  = $this->db->query("SELECT SUM(harga) as total_harga FROM transaksi_sewa_detil where id_transaksi='".$id_transaksi."'")->row_array();
        $total_harga=$rows_total['total_harga'];

        $rows_lama_sewa  = $this->db->query("SELECT count(id_transaksi_detil) as lama_sewa FROM transaksi_sewa_detil where id_transaksi='".$id_transaksi."'")->row_array();
        $lama_sewa=$rows_lama_sewa['lama_sewa'];


        #update total harga
         $update_data_total=array(
                    'lama_sewa' => $lama_sewa,
                    'total' => $total_harga,
                );

        #kondisi_where_id
    $this->db->where('id_transaksi', $id_transaksi); 
    #nama_table
    $this->db->update('transaksi_sewa', $update_data_total);

     
    redirect(site_url() . '?/Penyewaan/view/idtrx/'.$id_transaksi);

  }


   function ubah_status($id_transaksi, $simpan_data)
  {
    #kondisi_where_id
    $this->db->where('id_transaksi', $id_transaksi); 
    #nama_table
    $this->db->update('transaksi_sewa', $simpan_data); 
   redirect(site_url() . '?/Penyewaan/view/idtrx/'.$id_transaksi);

  }


  public function get_data_utama_untuk_cetak(){
  
        $id = $this->uri->segment('4');

  
        $where = array(
                'id_transaksi' => $id
                );
  
        $table = "transaksi_sewa";
        $query = $this->db->get_where($table,$where);
        return $query->result_array();
    }



    public function get_data_detail_untuk_cetak(){
  
        $id = $this->uri->segment('4');

            $where = array(
                'id_transaksi' => $id
                );
  
            $table = "transaksi_sewa_detil";

            $this->db->order_by("id_transaksi_detil", "asc");
  
            $query = $this->db->get_where($table,$where);
            return $query->result_array();
    }  



    function insert_data_jurnal($simpan_data_jurnal, $no_bukti)
  {
    $this->db->insert('jurnal_umum',$simpan_data_jurnal);

  }


   function insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx)
  {
    $this->db->insert('jurnal_umum_detail',$simpan_data_jurnal_detail);

    #notifikasi sukses
    /*$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible" role="alert">
    Sukses Simpan Data Sewa dan Jurnal !!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');*/


  }



}


 ?>





