<?php

require_once APPPATH . '/libraries/SSP.php';



class M_jurnal_umum extends CI_Model
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




  public function get_all_data_akun()
  {
    $this->db->select('*');
    $this->db->from('akun_perkiraan');
    $this->db->where("level>", "1");
    $this->db->order_by("kode_akun", "asc");

    $query = $this->db->get();

    return $query->result();
  }
    
    

  #function untuk viewer
  #menampilkan data per nomor
  public function get_data_doc_per_nomor(){

    $no = $this->uri->segment('4');

    $where = array(
            'no_bukti' => $no
            );

    $table = "jurnal_umum";
    $query = $this->db->get_where($table,$where);
    return $query->result();
    }

    #menampilkan data detail

    /*public function get_all_data_detail_per_doc(){
    $no = $this->uri->segment('4');

     $where = array(
            'no_bukti' => $no
            );

    $table = "jurnal_umum_detail";

    $this->db->order_by("id_jurnal_detail", "asc");
    $query = $this->db->get_where($table, $where);
    return $query->result();
    }*/


    public function get_all_data_jurnal()
  {
    $table= "jurnal_umum";


    $this->db->order_by("tanggal", "desc");
    $query = $this->db->get($table);
    return $query->result();
  }


    public function get_all_data_detail_per_doc($nama_barang){
    $no = $this->uri->segment('4');

    
    $this->db->select('*');    
    $this->db->from('jurnal_umum_detail');
    $this->db->where('jurnal_umum_detail.no_bukti',$no);

    $this->db->like('id_jurnal_detail', $nama_barang);
    $query = $this->db->get();
    return $query->result();
    }


 
  
  #function untuk menyimpan data
  public function insert_data_utama($simpan_data, $no_bukti)
  {
    $this->db->insert('jurnal_umum',$simpan_data);

   echo "<script>alert('Silahkan melanjutkan pengisian detail transaksi jurnal')</script>";
    echo "<script>javascript:window.location='".site_url()."?/JurnalUmum/viewer/no/$no_bukti#fr_data_detail'</script>";
  }

  public function insert_data_detail($simpan_data, $no_bukti)
  {
    $this->db->insert('jurnal_umum_detail',$simpan_data);

    echo "<script>javascript:window.location='".site_url()."?/JurnalUmum/viewer/no/$no_bukti#fr_data_detail'</script>";
  }


   function update_data_utama($no_bukti, $update_data)
  {
    $this->db->where('no_bukti', $no_bukti);
    $this->db->update('jurnal_umum', $update_data);

    echo "<script>alert('Berhasil menyimpan data jurnal umum')</script>";
    echo "<script>javascript:window.location='".site_url()."?/JurnalUmum/viewer/no/$no_bukti'</script>";
  }

   function update_total($no_bukti, $update_data_utama){
        $this->db->where('no_bukti', $no_bukti);
        $this->db->update('jurnal_umum', $update_data_utama);

    }




    function update_ppn_dan_biaya($no_bukti, $update_data){
        $this->db->where('no_bukti', $no_bukti);
        $this->db->update('jurnal_umum', $update_data);
        echo "<script>javascript:window.location='".site_url()."?/JurnalUmum/viewer/no/$no_bukti#fr_data_detail'</script>";

    }


    function update_data_detail($no_bukti, $id_jurnal_detail, $update_data)
  {
    $this->db->where('id_jurnal_detail', $id_jurnal_detail);
    $this->db->update('jurnal_umum_detail', $update_data);

    echo "<script>javascript:window.location='".site_url()."?/JurnalUmum/viewer/no/$no_bukti#fr_data_detail'</script>";
  }

  function delete_data($no_bukti)
  {
    #utama
    $this->db->where('no_bukti', $no_bukti);
    $this->db->delete('jurnal_umum');

    #detail
    $this->db->where('no_bukti', $no_bukti);
    $this->db->delete('jurnal_umum_detail');

    echo "<script>alert('Berhasil menghapus data penerimaan barang')</script>";
    echo "<script>javascript:window.location='".site_url()."?/JurnalUmum'</script>";
  }


  function delete_data_detail($no_bukti, $id_jurnal_detail)
  {
    $this->db->where('id_jurnal_detail', $id_jurnal_detail);
    $this->db->delete('jurnal_umum_detail');

    echo "<script>alert('Berhasil menghapus data detail')</script>";
    echo "<script>javascript:window.location='".site_url()."?/JurnalUmum/viewer/no/$no_bukti#fr_data_detail'</script>";
  }


  #cetak
  

    public function get_data_utama_untuk_cetak(){

    $no = $this->uri->segment('4');

    $where = array(
            'no_bukti' => $no
            );

    $table = "jurnal_umum";
    $query = $this->db->get_where($table,$where);
    return $query->result_array();
    }

    public function get_data_detail_untuk_cetak()
    {

        $no = $this->uri->segment('4');

        $this->db->select('*');    
    $this->db->from('jurnal_umum_detail');
    $this->db->where('jurnal_umum_detail.no_bukti',$no);

    $this->db->order_by("id_jurnal_detail", "asc");
    $query = $this->db->get();
        return $query->result_array();
    }

     #end cetak

    public function get_all_data_pencarian_ssp($no_bukti) {

      $this->load->database();
        $sql_details['host'] = $this->db->hostname;
        $sql_details['user'] = $this->db->username;
        $sql_details['pass'] = $this->db->password;
        $sql_details['db'] = $this->db->database;
        $table = 'jurnal_umum';
        $primaryKey = 'id_jurnal';
        $columns = array(
            
            ['db' => 'no_bukti', 'field' => 'no_bukti', 'dt' => '0'],
            ['db' => 'tanggal', 'field' => 'tanggal', 'dt' => '1'],
            ['db' => 'kode_jenis_jurnal', 'field' => 'kode_jenis_jurnal', 'dt' => '2'],
            ['db' => 'tanggal', 'field' => 'tanggal', 'dt' => '3'],
            ['db' => 'no_refernsi', 'field' => 'no_refernsi', 'dt' => '4'],
            ['db' => 'dari', 'field' => 'dari', 'dt' => '5'],
            ['db' => 'kepada', 'field' => 'kepada', 'dt' => '6'],
            ['db' => 'keterangan', 'field' => 'keterangan', 'dt' => '7'],
            ['db' => 'total', 'field' => 'total', 'dt' => '8',
            'formatter' => function( $d, $row ) {
                    return 'Rp. ' . number_format($d);
                }], 



                  ['db' => 'id_jurnal',
                'field' => 'id_jurnal',
                'dt' => '9',
                'formatter' => function( $d, $row ) {
                     return '<a href="'.site_url().'?/JurnalUmum/viewer/no/'.$row['no_bukti'].'"><i class="ti-pencil-alt"></i></a>'; 
                    //return '$' . number_format($d);
                }],


            ['db' => 'id_jurnal',
                'field' => 'id_jurnal',
                'dt' => '10',
                'formatter' => function( $d, $row ) {
                    return '<a onclick="return konfirm_hapus()" href="'.site_url().'?/JurnalUmum/delete_data/no/'.$row['no_bukti'].'"><i class="ti-trash"></i></a>&nbsp;';
                    //return '$' . number_format($d);
                }],

        );

       /* $joinQuery = "FROM jurnal_umum tb_po 
           JOIN suplier tb_spl ON tb_po.id_suplier=tb_spl.id_suplier ";*/
        $extraWhere = "no_bukti = '" . $no_bukti . "'";

        return json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, '', $extraWhere)
        );
   }

    public function get_all_data_pencarian()
  {
    $table= "jurnal_umum";


    $this->db->order_by("id_jurnal", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  #untuk pencarian
  public function get_all_no_bukti(){

    $table = "jurnal_umum";
    $this->db->distinct();
    $this->db->select('no_bukti');
    $this->db->order_by("no_bukti", "asc");
    $query = $this->db->get($table);
    return $query->result();
    }


    public function get_all_data_pencarian_filter(){

    $no_bukti = $this->input->post('txt_tahun');

     $where = array(
            'no_bukti' => $no_bukti
    );

     $table = "jurnal_umum";
    $this->db->order_by("id_jurnal", "asc");
    $query = $this->db->get_where($table,$where);
    return $query->result();
    }



}


 ?>





