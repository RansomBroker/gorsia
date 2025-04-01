<?php

require_once APPPATH . '/libraries/SSP.php';

/**
 *
  Copyright © 2018 All Rights Reserved by Shinobi Software Indonesia | www.shinobi-software.com
  E-mail : info@shinobi-software.com
  This is product licensed to : 
  UD. Pangan Jaya
*/

class M_retur_pembelian extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data combo box
   public function get_all_data_supplier()
  {
    $table= "tb_supplier";


    $this->db->order_by("nama_supplier", "desc");
    $query = $this->db->get($table);
    return $query->result();
  }




  public function get_all_data_barang()
  {
    $this->db->select('*');
    $this->db->from('tb_bahan_baku');
    $this->db->order_by("nama_bahan_baku", "asc");

    $query = $this->db->get();

    return $query->result();
  }


   #untuk harga text box
    public function get_sub_hpp($id, $no_pmb){

       if($no_pmb==""){
        $hasil=$this->db->query("SELECT 0 as harga_beli FROM tb_bahan_baku WHERE id_bahan_baku='$id'");
        return $hasil->result();
      }

      elseif($no_pmb<>""){

        #info id barang
        $rows_barang = $this->db->query("SELECT * FROM tb_bahan_baku where id_bahan_baku='$id'")->row_array();
            $id_bahan_baku = $rows_barang['id_bahan_baku'];

        $hasil=$this->db->query("SELECT harga as harga_beli FROM tb_penerimaan_bahan_baku_detail WHERE id_bahan_baku='$id_bahan_baku' AND no_bukti_penerimaan_barang='".$no_pmb."'");
        return $hasil->result();
      }

    }
    #end harga text box

    #untuk nested combobox
    public function get_sub_nopmb($id){
        $hasil=$this->db->query("SELECT * FROM tb_penerimaan_bahan_baku WHERE id_supplier='$id'");
        return $hasil->result();
    }
    #end nested combobox



  #function untuk viewer
  #menampilkan data per nomor
  public function get_data_doc_per_nomor(){   

    $no = $this->uri->segment('4');

    $where = array(
            'no_retur_pembelian' => $no  
            );

    $table = "tb_retur_pembelian";
    $query = $this->db->get_where($table,$where);
    return $query->result();
    }

    #menampilkan data detail

    public function get_all_data_detail_per_doc(){
    $no = $this->uri->segment('4');

     $where = array(
            'no_retur_pembelian' => $no
            );

    $table = "tb_retur_pembelian_detail";

    $this->db->order_by("id_retur_pembelian_detail", "desc");
    $query = $this->db->get_where($table, $where);
    return $query->result();
    }


 
  
  #function untuk menyimpan data
  public function insert_data_utama($simpan_data, $no_retur_pembelian)
  {
    $this->db->insert('tb_retur_pembelian',$simpan_data);

   echo "<script>alert('Berhasil menyimpan data retur pembelian')</script>";
    echo "<script>javascript:window.location='".site_url()."?/ReturPembelian/viewer/no/$no_retur_pembelian#fr_data_detail'</script>";
  }

  public function insert_data_detail($simpan_data, $no_retur_pembelian, $periode)
  {
    $this->db->insert('tb_retur_pembelian_detail',$simpan_data);


    #insert stok barang=============================================================
    #mengambil id yg baru saja tersimpan
          $rows_last_id = $this->db->query("SELECT max(id_retur_pembelian_detail) as last_id FROM tb_retur_pembelian_detail where no_retur_pembelian='".$no_retur_pembelian."'")->row_array();
          $last_id = $rows_last_id['last_id'];



    #script update ke tb_stok_barang
   $this->db->query('UPDATE tb_retur_pembelian_detail tpd 
                    JOIN tb_bahan_baku tsb ON tsb.id_bahan_baku = tpd.id_bahan_baku 
                    SET tsb.stok = tsb.stok - tpd.quantity
                    WHERE tsb.id_bahan_baku IS NOT NULL AND tpd.id_retur_pembelian_detail='.$last_id.'');
            
    
    #echo "<script>alert('Berhasil menyimpan data persediaan awal detail')</script>";
    echo "<script>javascript:window.location='".site_url()."?/ReturPembelian/viewer/no/$no_retur_pembelian#fr_data_detail'</script>";
  }


   function update_data_utama($no_retur_pembelian, $update_data)
  {
    $this->db->where('no_retur_pembelian', $no_retur_pembelian);
    $this->db->update('tb_retur_pembelian', $update_data);

    echo "<script>alert('Berhasil mengubah data retur pembelian')</script>";
    echo "<script>javascript:window.location='".site_url()."?/ReturPembelian/viewer/no/$no_retur_pembelian'</script>";
  }

   function update_total($no_retur_pembelian, $update_data_utama){
        $this->db->where('no_retur_pembelian', $no_retur_pembelian);
        $this->db->update('tb_retur_pembelian', $update_data_utama);

    }

    function update_data_detail($no_retur_pembelian, $id_retur_pembelian_detail, $update_data)
  {
    $this->db->where('id_retur_pembelian_detail', $id_retur_pembelian_detail);
    $this->db->update('tb_retur_pembelian_detail', $update_data);

    echo "<script>javascript:window.location='".site_url()."?/ReturPembelian/viewer/no/$no_retur_pembelian#fr_data_detail'</script>";
  }

  function delete_data($no_retur_pembelian)
  {
    #utama
    $this->db->where('no_retur_pembelian', $no_retur_pembelian);
    $this->db->delete('tb_retur_pembelian');

    #detail
    $this->db->where('no_retur_pembelian', $no_retur_pembelian);
    $this->db->delete('tb_retur_pembelian_detail');

    echo "<script>alert('Berhasil menghapus data retur pembelian')</script>";
    echo "<script>javascript:window.location='".site_url()."?/ReturPembelian'</script>";
  }


  function delete_data_detail($no_retur_pembelian, $id_retur_pembelian_detail)
  {
    $this->db->where('id_retur_pembelian_detail', $id_retur_pembelian_detail);
    $this->db->delete('tb_retur_pembelian_detail');

    echo "<script>alert('Berhasil menghapus data detail')</script>";
    echo "<script>javascript:window.location='".site_url()."?/ReturPembelian/viewer/no/$no_retur_pembelian#fr_data_detail'</script>";
  }


  #cetak
  public function get_data_info_perusahaan(){

    $id_perusahaan = "1";

    $where = array(
            'id_perusahaan' => $id_perusahaan
            );

    $table = "tb_info_perusahaan";
    $query = $this->db->get_where($table,$where);
    return $query->result_array();
    }


    public function get_data_utama_untuk_cetak(){

    $no = $this->uri->segment('4');

    $where = array(
            'no_retur_pembelian' => $no
            );

    $table = "tb_retur_pembelian";
    $query = $this->db->get_where($table,$where);
    return $query->result_array();
    }

    public function get_data_detail_untuk_cetak()
    {

        $no = $this->uri->segment('4');

        $where = array(
            'no_retur_pembelian' => $no
            );

        $table = "tb_retur_pembelian_detail";

        $query = $this->db->get_where($table,$where);
        return $query->result_array();
    }

     #end cetak

    public function get_all_data_pencarian()
  {
    $table= "tb_retur_pembelian";


    $this->db->order_by("id_retur_pembelian", "desc");
    $query = $this->db->get($table);
    return $query->result();
  }


  #untuk pencarian
  public function get_all_data_tahun(){

    $table = "tb_retur_pembelian";
    $this->db->distinct();
    $this->db->select('data_tahun');
    $this->db->order_by("data_tahun", "asc");
    $query = $this->db->get($table);
    return $query->result();
    }


     public function get_all_data_pencarian_ssp($data_tahun) {

      $this->load->database();
        $sql_details['host'] = $this->db->hostname;
        $sql_details['user'] = $this->db->username;
        $sql_details['pass'] = $this->db->password;
        $sql_details['db'] = $this->db->database;
        $table = 'tb_retur_pembelian';
        $primaryKey = 'id_retur_pembelian';
        $columns = array(
            
            ['db' => 'no_retur_pembelian', 'field' => 'no_retur_pembelian', 'dt' => '0'],
            ['db' => 'tanggal', 'field' => 'tanggal', 'dt' => '1'],
            ['db' => 'tb_spl.nama_supplier', 'field' => 'nama_supplier', 'dt' => '2'],
            ['db' => 'tb_rp.keterangan', 'field' => 'keterangan', 'dt' => '3'],
            ['db' => 'total', 'field' => 'total', 'dt' => '4',
            'formatter' => function( $d, $row ) {
                    return 'Rp. ' . number_format($d);
                }], 

            ['db' => 'id_retur_pembelian',
                'field' => 'id_retur_pembelian',
                'dt' => '5',
                'formatter' => function( $d, $row ) {
                    return '<a href="'.site_url().'?/ReturPembelian/viewer/no/'.$row['no_retur_pembelian'].'"><i class="ti-pencil-alt"></i></a>';
                    //return '$' . number_format($d);
                }],

            ['db' => 'id_retur_pembelian',
                'field' => 'id_retur_pembelian',
                'dt' => '6',
                'formatter' => function( $d, $row ) {
                    return '<a onclick="return konfirm_hapus()" href="'.site_url().'?/ReturPembelian/delete_data/no/'.$row['no_retur_pembelian'].'"><i class="ti-trash"></i></a>';
                    //return '$' . number_format($d);
                }],
        );

        $joinQuery = "FROM tb_retur_pembelian tb_rp 
           JOIN tb_supplier tb_spl ON tb_rp.id_supplier = tb_spl.id_supplier";
        $extraWhere = "tb_rp.data_tahun = '" . $data_tahun . "'";

        return json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
        );
   }



    public function get_all_data_pencarian_filter(){

    $data_tahun = $this->input->post('txt_tahun');

     $where = array(
            'data_tahun' => $data_tahun
    );

     $table = "tb_retur_pembelian";
    $this->db->order_by("id_retur_pembelian", "desc");
    $query = $this->db->get_where($table,$where);
    return $query->result();
    }



}


 ?>





