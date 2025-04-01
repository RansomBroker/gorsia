<?php

require_once APPPATH . '/libraries/SSP.php';



class M_penerimaan_barang extends CI_Model
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


   public function get_all_data_penerimaan()
  {
    $this->db->select('*');
    $this->db->from('penerimaan_barang');
    $this->db->order_by("id_penerimaan_barang", "desc");

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
            'no_penerimaan_barang' => $no
            );

    $table = "penerimaan_barang";
    $query = $this->db->get_where($table,$where);
    return $query->result();
    }


    public function get_all_data_detail_per_doc($nama_barang){
    $no = $this->uri->segment('4');

    
    $this->db->select('*');    
    $this->db->from('penerimaan_barang_detail');
    $this->db->join('barang', 'penerimaan_barang_detail.id_barang = barang.id_barang');
    $this->db->where('penerimaan_barang_detail.no_penerimaan_barang',$no);

    $this->db->order_by("barang.nama_barang", "asc");
    $this->db->like('barang.nama_barang', $nama_barang);
    $query = $this->db->get();
    return $query->result();
    }


 
  
  #function untuk menyimpan data
  public function insert_data_utama($simpan_data, $no_penerimaan_barang)
  {
    $this->db->insert('penerimaan_barang',$simpan_data);

    echo "<script>javascript:window.location='".site_url()."?/PenerimaanBarang/viewer/no/$no_penerimaan_barang#fr_data_detail'</script>";
  }

  public function insert_data_detail($simpan_data, $no_penerimaan_barang)
  {
    $this->db->insert('penerimaan_barang_detail',$simpan_data);

    echo "<script>javascript:window.location='".site_url()."?/PenerimaanBarang/viewer/no/$no_penerimaan_barang#fr_data_detail'</script>";
  }


   function update_data_utama($no_penerimaan_barang, $update_data)
  {
    $this->db->where('no_penerimaan_barang', $no_penerimaan_barang);
    $this->db->update('penerimaan_barang', $update_data);

    echo "<script>alert('Berhasil menyimpan data penerimaan barang')</script>";
    echo "<script>javascript:window.location='".site_url()."?/PenerimaanBarang/viewer/no/$no_penerimaan_barang'</script>";
  }

   function update_total($no_penerimaan_barang, $update_data_utama){
        $this->db->where('no_penerimaan_barang', $no_penerimaan_barang);
        $this->db->update('penerimaan_barang', $update_data_utama);

    }




    function update_ppn_dan_biaya($no_penerimaan_barang, $update_data){
        $this->db->where('no_penerimaan_barang', $no_penerimaan_barang);
        $this->db->update('penerimaan_barang', $update_data);
        echo "<script>javascript:window.location='".site_url()."?/PenerimaanBarang/viewer/no/$no_penerimaan_barang#fr_data_detail'</script>";

    }



     function update_total_pembelian($no_penerimaan_barang, $update_data){
        $this->db->where('no_penerimaan_barang', $no_penerimaan_barang);
        $this->db->update('penerimaan_barang', $update_data);
        echo "<script>javascript:window.location='".site_url()."?/PenerimaanBarang/viewer/no/$no_penerimaan_barang#fr_data_detail'</script>";

    }


    function update_data_detail($no_penerimaan_barang, $id_penerimaan_barang_detail, $update_data)
  {
    $this->db->where('id_penerimaan_barang_detail', $id_penerimaan_barang_detail);
    $this->db->update('penerimaan_barang_detail', $update_data);

    echo "<script>javascript:window.location='".site_url()."?/PenerimaanBarang/viewer/no/$no_penerimaan_barang#fr_data_detail'</script>";
  }

  function delete_data($no_penerimaan_barang)
  {
    #utama
    $this->db->where('no_penerimaan_barang', $no_penerimaan_barang);
    $this->db->delete('penerimaan_barang');

    #detail
    $this->db->where('no_penerimaan_barang', $no_penerimaan_barang);
    $this->db->delete('penerimaan_barang_detail');

    echo "<script>alert('Berhasil menghapus data penerimaan barang')</script>";
    echo "<script>javascript:window.location='".site_url()."?/PenerimaanBarang'</script>";
  }


  function delete_data_detail($no_penerimaan_barang, $id_penerimaan_barang_detail)
  {
    $this->db->where('id_penerimaan_barang_detail', $id_penerimaan_barang_detail);
    $this->db->delete('penerimaan_barang_detail');

    echo "<script>alert('Berhasil menghapus data detail')</script>";
    echo "<script>javascript:window.location='".site_url()."?/PenerimaanBarang/viewer/no/$no_penerimaan_barang#fr_data_detail'</script>";
  }


  #cetak
  

    public function get_data_utama_untuk_cetak(){

    $no = $this->uri->segment('4');

    $where = array(
            'no_penerimaan_barang' => $no
            );

    $table = "penerimaan_barang";
    $query = $this->db->get_where($table,$where);
    return $query->result_array();
    }

    public function get_data_detail_untuk_cetak()
    {

        $no = $this->uri->segment('4');

        $this->db->select('*');    
    $this->db->from('penerimaan_barang_detail');
    $this->db->join('barang', 'penerimaan_barang_detail.id_barang = barang.id_barang');
    $this->db->where('penerimaan_barang_detail.no_penerimaan_barang',$no);

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
        $table = 'penerimaan_barang';
        $primaryKey = 'id_penerimaan_barang';
        $columns = array(
            
            ['db' => 'no_penerimaan_barang', 'field' => 'no_penerimaan_barang', 'dt' => '0'],
            ['db' => 'tanggal', 'field' => 'tanggal', 'dt' => '1'],
            ['db' => 'id_suplier', 'field' => 'id_suplier', 'dt' => '2'],
            ['db' => 'no_po', 'field' => 'no_po', 'dt' => '3'],
            ['db' => 'no_sj', 'field' => 'no_sj', 'dt' => '4'],
            ['db' => 'no_faktur', 'field' => 'no_faktur', 'dt' => '5'],
            ['db' => 'nama_pengirim', 'field' => 'nama_pengirim', 'dt' => '6'],
            ['db' => 'no_polisi_kendaraan', 'field' => 'no_polisi_kendaraan', 'dt' => '7'],
            ['db' => 'nama_penerima', 'field' => 'nama_penerima', 'dt' => '8'],
            ['db' => 'total', 'field' => 'total', 'dt' => '9',
            'formatter' => function( $d, $row ) {
                    return 'Rp. ' . number_format($d);
                }], 

            ['db' => 'id_penerimaan_barang',
                'field' => 'id_penerimaan_barang',
                'dt' => '10',
                'formatter' => function( $d, $row ) {
                     return '<a href="'.site_url().'?/PenerimaanBarang/viewer/no/'.$row['no_penerimaan_barang'].'"><i class="ti-pencil-alt"></i></a>'; 
                    //return '$' . number_format($d);
                }],


            ['db' => 'id_penerimaan_barang',
                'field' => 'id_penerimaan_barang',
                'dt' => '11',
                'formatter' => function( $d, $row ) {
                    return '<a onclick="return konfirm_hapus()" href="'.site_url().'?/PenerimaanBarang/delete_data/no/'.$row['no_penerimaan_barang'].'"><i class="ti-trash"></i></a>&nbsp;';
                    //return '$' . number_format($d);
                }],

        );

       /* $joinQuery = "FROM penerimaan_barang tb_po 
           JOIN suplier tb_spl ON tb_po.id_suplier=tb_spl.id_suplier ";*/
        $extraWhere = "data_tahun = '" . $data_tahun . "'";

        return json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, '', $extraWhere)
        );
   }

    public function get_all_data_pencarian()
  {
    $table= "penerimaan_barang";


    $this->db->order_by("id_penerimaan_barang", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  #untuk pencarian
  public function get_all_data_tahun(){

    $table = "penerimaan_barang";
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

     $table = "penerimaan_barang";
    $this->db->order_by("id_penerimaan_barang", "asc");
    $query = $this->db->get_where($table,$where);
    return $query->result();
    }



}


 ?>





