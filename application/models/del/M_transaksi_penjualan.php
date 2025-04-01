<?php

require_once APPPATH . '/libraries/SSP.php';



class M_transaksi_penjualan extends CI_Model
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
  public function get_all_data_term_of_payment()
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


  public function get_all_data_penjualan()
  {
    $this->db->select('*');
    $this->db->from('penjualan_invoice');
    $this->db->order_by("id_invoice", "desc");

    $query = $this->db->get();

    return $query->result();
  }


  

  public function get_sub_hpp($id){
        $hasil=$this->db->query("SELECT * FROM barang WHERE id_barang='$id'");
        return $hasil->result();

    }
    
    
    

  #function untuk viewer
  #menampilkan data per nomor
  public function get_data_doc_per_nomor(){

    $no = $this->uri->segment('4');

    $where = array(
            'no_invoice' => $no
            );

    $table = "penjualan_invoice";
    $query = $this->db->get_where($table,$where);
    return $query->result();
    }

    #menampilkan data detail

    /*public function get_all_data_detail_per_doc(){
    $no = $this->uri->segment('4');

     $where = array(
            'no_invoice' => $no
            );

    $table = "penjualan_invoice_detail";

    $this->db->order_by("no_invoice", "asc");
    $query = $this->db->get_where($table, $where);
    return $query->result();
    }*/


    public function get_all_data_detail_per_doc($nama_barang){
    $no = $this->uri->segment('4');

    
    $this->db->select('*');    
    $this->db->from('penjualan_invoice_detail');
    $this->db->join('barang', 'penjualan_invoice_detail.id_barang = barang.id_barang');
    $this->db->where('penjualan_invoice_detail.no_invoice',$no);

    $this->db->order_by("barang.nama_barang", "asc");
    $this->db->like('barang.nama_barang', $nama_barang);
    $query = $this->db->get();
    return $query->result();
    }


 
  
  #function untuk menyimpan data
  public function insert_data_utama($simpan_data, $no_invoice)
  {
    $this->db->insert('penjualan_invoice',$simpan_data);

   echo "<script>alert('Berhasil menyimpan data transaksi penjualan')</script>";
    echo "<script>javascript:window.location='".site_url()."?/TransaksiPenjualan/viewer/no/$no_invoice#fr_data_detail'</script>";
  }

  public function insert_data_detail($simpan_data, $no_invoice)
  {
    $this->db->insert('penjualan_invoice_detail',$simpan_data);

    echo "<script>javascript:window.location='".site_url()."?/TransaksiPenjualan/viewer/no/$no_invoice#fr_data_detail'</script>";
  }


   function update_data_utama($no_invoice, $update_data)
  {
    $this->db->where('no_invoice', $no_invoice);
    $this->db->update('penjualan_invoice', $update_data);

    echo "<script>alert('Berhasil menyimpan data purchase order')</script>";
    echo "<script>javascript:window.location='".site_url()."?/TransaksiPenjualan/viewer/no/$no_invoice'</script>";
  }

   function update_total($no_invoice, $update_data_utama){
        $this->db->where('no_invoice', $no_invoice);
        $this->db->update('penjualan_invoice', $update_data_utama);

    }




    function update_ppn_dan_biaya($no_invoice, $update_data){
        $this->db->where('no_invoice', $no_invoice);
        $this->db->update('penjualan_invoice', $update_data);
        echo "<script>javascript:window.location='".site_url()."?/TransaksiPenjualan/viewer/no/$no_invoice#fr_data_detail'</script>";

    }


    function update_data_detail($no_invoice, $id_invoice_detail, $update_data)
  {
    $this->db->where('id_invoice_detail', $id_invoice_detail);
    $this->db->update('penjualan_invoice_detail', $update_data);

    echo "<script>javascript:window.location='".site_url()."?/TransaksiPenjualan/viewer/no/$no_invoice#fr_data_detail'</script>";
  }

  function delete_data($no_invoice)
  {
    #utama
    $this->db->where('no_invoice', $no_invoice);
    $this->db->delete('penjualan_invoice');

    #detail
    $this->db->where('no_invoice', $no_invoice);
    $this->db->delete('penjualan_invoice_detail');

    echo "<script>alert('Berhasil menghapus data purchase order')</script>";
    echo "<script>javascript:window.location='".site_url()."?/TransaksiPenjualan'</script>";
  }


  function delete_data_detail($no_invoice, $no_invoice)
  {
    $this->db->where('no_invoice', $no_invoice);
    $this->db->delete('penjualan_invoice_detail');

    echo "<script>alert('Berhasil menghapus data detail')</script>";
    echo "<script>javascript:window.location='".site_url()."?/TransaksiPenjualan/viewer/no/$no_invoice#fr_data_detail'</script>";
  }


  #cetak
  

    public function get_data_utama_untuk_cetak(){

    $no = $this->uri->segment('4');

    $where = array(
            'no_invoice' => $no
            );

    $table = "penjualan_invoice";
    $query = $this->db->get_where($table,$where);
    return $query->result_array();
    }

    public function get_data_detail_untuk_cetak()
    {

        $no = $this->uri->segment('4');

        $this->db->select('*');    
    $this->db->from('penjualan_invoice_detail');
    $this->db->join('barang', 'penjualan_invoice_detail.id_barang = barang.id_barang');
    $this->db->where('penjualan_invoice_detail.no_invoice',$no);

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
        $table = 'penjualan_invoice';
        $primaryKey = 'id_penjualan_invoice';
        $columns = array(
            
            ['db' => 'no_invoice', 'field' => 'no_invoice', 'dt' => '0'],
            ['db' => 'tanggal', 'field' => 'tanggal', 'dt' => '1'],
            ['db' => 'id_pelanggan', 'field' => 'id_pelanggan', 'dt' => '2'],
            ['db' => 'term_of_payment', 'field' => 'term_of_payment', 'dt' => '3'],
            ['db' => 'tanggal_jatuh_tempo', 'field' => 'tanggal_jatuh_tempo', 'dt' => '4'],
            ['db' => 'no_po_pelanggan', 'field' => 'no_po_pelanggan', 'dt' => '5'],
            ['db' => 'tanggal_po_pelanggan', 'field' => 'tanggal_po_pelanggan', 'dt' => '6'],
            ['db' => 'keterangan', 'field' => 'keterangan', 'dt' => '5'],
            ['db' => 'total', 'field' => 'total', 'dt' => '7',
            'formatter' => function( $d, $row ) {
                    return 'Rp. ' . number_format($d);
                }], 



                  ['db' => 'id_penjualan_invoice',
                'field' => 'id_penjualan_invoice',
                'dt' => '8',
                'formatter' => function( $d, $row ) {
                     return '<a href="'.site_url().'?/TransaksiPenjualan/viewer/no/'.$row['no_invoice'].'"><i class="ti-pencil-alt"></i></a>'; 
                    //return '$' . number_format($d);
                }],


            ['db' => 'id_penjualan_invoice',
                'field' => 'id_penjualan_invoice',
                'dt' => '9',
                'formatter' => function( $d, $row ) {
                    return '<a onclick="return konfirm_hapus()" href="'.site_url().'?/TransaksiPenjualan/delete_data/no/'.$row['no_invoice'].'"><i class="ti-trash"></i></a>&nbsp;';
                    //return '$' . number_format($d);
                }],

        );

       /* $joinQuery = "FROM penjualan_invoice tb_po 
           JOIN pelanggan tb_spl ON tb_po.id_pelanggan=tb_spl.id_pelanggan ";*/
        $extraWhere = "data_tahun = '" . $data_tahun . "'";

        return json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, '', $extraWhere)
        );
   }

    public function get_all_data_pencarian()
  {
    $table= "penjualan_invoice";


    $this->db->order_by("id_penjualan_invoice", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  #untuk pencarian
  /*public function get_all_data_tahun(){

    $table = "penjualan_invoice";
    $this->db->distinct();
    $this->db->select('data_tahun');
    $this->db->order_by("data_tahun", "asc");
    $query = $this->db->get($table);
    return $query->result();
    }*/


    public function get_all_data_pencarian_filter(){

    $data_tahun = $this->input->post('txt_tahun');

     $where = array(
            'data_tahun' => $data_tahun
    );

     $table = "penjualan_invoice";
    $this->db->order_by("id_penjualan_invoice", "asc");
    $query = $this->db->get_where($table,$where);
    return $query->result();
    }




   function update_total_penjualan($no_invoice, $update_data){
        $this->db->where('no_invoice', $no_invoice);
        $this->db->update('penjualan_invoice', $update_data);
        echo "<script>javascript:window.location='".site_url()."?/TransaksiPenjualan/viewer/no/$no_invoice#fr_data_detail'</script>";

    }


}


 ?>





