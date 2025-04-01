<?php

require_once APPPATH . '/libraries/SSP.php';



class M_purchase_order extends CI_Model
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


 public function get_all_data_top()
  {
    $table= "term_of_payment";


    $this->db->order_by("cara_pembayaran", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }
  
  public function get_all_data_barang()
  {
    $this->db->select('*');
    $this->db->from('barang');
    $this->db->order_by("nama_barang", "asc");

    $query = $this->db->get();

    return $query->result();
  }


  public function get_sub_hpp($id){
        $hasil=$this->db->query("SELECT * FROM barang WHERE id_barang='$id'");
        return $hasil->result();

    }


     public function get_all_data_po()
  {
    $this->db->select('*');
    $this->db->from('purchase_order');
    $this->db->order_by("id_purchase_order", "desc");

    $query = $this->db->get();

    return $query->result();
  }



  
    
    
    

  #function untuk viewer
  #menampilkan data per nomor
  public function get_data_doc_per_nomor(){

    $no = $this->uri->segment('4');

    $where = array(
            'no_purchase_order' => $no
            );

    $table = "purchase_order";
    $query = $this->db->get_where($table,$where);
    return $query->result();
    }

    #menampilkan data detail

    public function get_all_data_detail_per_doc($nama_barang){
    $no = $this->uri->segment('4');

    
    $this->db->select('*');    
    $this->db->from('purchase_order_detail');
    $this->db->join('barang', 'purchase_order_detail.id_barang = barang.id_barang');
    $this->db->where('purchase_order_detail.no_purchase_order',$no);

    $this->db->order_by("barang.nama_barang", "asc");
    $this->db->like('barang.nama_barang', $nama_barang);
    $query = $this->db->get();
    return $query->result();
    }


 
  
  #function untuk menyimpan data
  public function insert_data_utama($simpan_data, $no_purchase_order)
  {
    $this->db->insert('purchase_order',$simpan_data);

    echo "<script>javascript:window.location='".site_url()."?/PurchaseOrder/viewer/no/$no_purchase_order#fr_data_detail'</script>";
  }

  public function insert_data_detail($simpan_data, $no_purchase_order)
  {
    $this->db->insert('purchase_order_detail',$simpan_data);

    echo "<script>javascript:window.location='".site_url()."?/PurchaseOrder/viewer/no/$no_purchase_order#fr_data_detail'</script>";
  }


   function update_data_utama($no_purchase_order, $update_data)
  {
    $this->db->where('no_purchase_order', $no_purchase_order);
    $this->db->update('purchase_order', $update_data);

    echo "<script>alert('Berhasil menyimpan data purchase order')</script>";
    echo "<script>javascript:window.location='".site_url()."?/PurchaseOrder/viewer/no/$no_purchase_order'</script>";
  }

   function update_total($no_purchase_order, $update_data_utama){
        $this->db->where('no_purchase_order', $no_purchase_order);
        $this->db->update('purchase_order', $update_data_utama);

    }




    function update_ppn_dan_biaya($no_purchase_order, $update_data){
        $this->db->where('no_purchase_order', $no_purchase_order);
        $this->db->update('purchase_order', $update_data);
        echo "<script>javascript:window.location='".site_url()."?/PurchaseOrder/viewer/no/$no_purchase_order#fr_data_detail'</script>";

    }


    function update_data_detail($no_purchase_order, $id_purchase_order_detail, $update_data)
  {
    $this->db->where('id_purchase_order_detail', $id_purchase_order_detail);
    $this->db->update('purchase_order_detail', $update_data);

    echo "<script>javascript:window.location='".site_url()."?/PurchaseOrder/viewer/no/$no_purchase_order#fr_data_detail'</script>";
  }

  function delete_data($no_purchase_order)
  {
    #utama
    $this->db->where('no_purchase_order', $no_purchase_order);
    $this->db->delete('purchase_order');

    #detail
    $this->db->where('no_purchase_order', $no_purchase_order);
    $this->db->delete('purchase_order_detail');

    echo "<script>alert('Berhasil menghapus data purchase order')</script>";
    echo "<script>javascript:window.location='".site_url()."?/PurchaseOrder'</script>";
  }


  function delete_data_detail($no_purchase_order, $id_purchase_order_detail)
  {
    $this->db->where('id_purchase_order_detail', $id_purchase_order_detail);
    $this->db->delete('purchase_order_detail');

    echo "<script>alert('Berhasil menghapus data detail')</script>";
    echo "<script>javascript:window.location='".site_url()."?/PurchaseOrder/viewer/no/$no_purchase_order#fr_data_detail'</script>";
  }


  #cetak
  

    public function get_data_utama_untuk_cetak(){

    $no = $this->uri->segment('4');

    $where = array(
            'no_purchase_order' => $no
            );

    $table = "purchase_order";
    $query = $this->db->get_where($table,$where);
    return $query->result_array();
    }

    public function get_data_detail_untuk_cetak()
    {

        $no = $this->uri->segment('4');

        $this->db->select('*');    
    $this->db->from('purchase_order_detail');
    $this->db->join('barang', 'purchase_order_detail.id_barang = barang.id_barang');
    $this->db->where('purchase_order_detail.no_purchase_order',$no);

    $this->db->order_by("barang.nama_barang", "asc");
    $query = $this->db->get();
        return $query->result_array();
    }

     #end cetak

    public function get_all_data_pencarian_ssp($data_tahun) {

      $this->load->database();
        $sql_details['host'] = $this->db->hostname;
        $sql_details['user'] = $this->db->username;
        $sql_details['pass'] = $this->db->password;
        $sql_details['db'] = $this->db->database;
        $table = 'purchase_order';
        $primaryKey = 'id_purchase_order';
        $columns = array(
            
            ['db' => 'no_purchase_order', 'field' => 'no_purchase_order', 'dt' => '0'],
            ['db' => 'tanggal', 'field' => 'tanggal', 'dt' => '1'],
            ['db' => 'id_suplier', 'field' => 'id_suplier', 'dt' => '2'],
            ['db' => 'keterangan', 'field' => 'keterangan', 'dt' => '3'],
            ['db' => 'total', 'field' => 'total', 'dt' => '4',
            'formatter' => function( $d, $row ) {
                    return 'Rp. ' . number_format($d);
                }], 



                  ['db' => 'id_purchase_order',
                'field' => 'id_purchase_order',
                'dt' => '5',
                'formatter' => function( $d, $row ) {
                     return '<a href="'.site_url().'?/PurchaseOrder/viewer/no/'.$row['no_purchase_order'].'"><i class="ti-pencil-alt"></i></a>'; 
                    //return '$' . number_format($d);
                }],


            ['db' => 'id_purchase_order',
                'field' => 'id_purchase_order',
                'dt' => '6',
                'formatter' => function( $d, $row ) {
                    return '<a onclick="return konfirm_hapus()" href="'.site_url().'?/PurchaseOrder/delete_data/no/'.$row['no_purchase_order'].'"><i class="ti-trash"></i></a>&nbsp;';
                    //return '$' . number_format($d);
                }],

        );

       /* $joinQuery = "FROM purchase_order tb_po 
           JOIN suplier tb_spl ON tb_po.id_suplier=tb_spl.id_suplier ";*/
        $extraWhere = "data_tahun = '" . $data_tahun . "'";

        return json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, '', $extraWhere)
        );
   }

    public function get_all_data_pencarian()
  {
    $table= "purchase_order";


    $this->db->order_by("id_purchase_order", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  #untuk pencarian
  public function get_all_data_tahun(){

    $table = "purchase_order";
    $this->db->distinct();
    $this->db->select('data_tahun');
    $this->db->order_by("data_tahun", "asc");
    $query = $this->db->get($table);
    return $query->result();
    }


    public function get_all_data_pencarian_filter(){

    $data_tahun = $this->input->post('txt_tahun');

     $where = array(
            'data_tahun' => $data_tahun
    );

     $table = "purchase_order";
    $this->db->order_by("id_purchase_order", "asc");
    $query = $this->db->get_where($table,$where);
    return $query->result();
    }


   function update_total_pembelian($no_purchase_order, $update_data){
        $this->db->where('no_purchase_order', $no_purchase_order);
        $this->db->update('purchase_order', $update_data);
        echo "<script>javascript:window.location='".site_url()."?/PurchaseOrder/viewer/no/$no_purchase_order#fr_data_detail'</script>";

    }



}


 ?>





