<?php

require_once APPPATH . '/libraries/SSP.php';

/**
 *
  Copyright © 2018 All Rights Reserved by Shinobi Software Indonesia | www.shinobi-software.com
  E-mail : info@shinobi-software.com
  This is product licensed to :
  UD. Pangan Jaya
 */
class M_daftarmenu extends CI_Model {

    public function get_data() {
        $this->load->database();
        $sql_details['host'] = $this->db->hostname;
        $sql_details['user'] = $this->db->username;
        $sql_details['pass'] = $this->db->password;
        $sql_details['db'] = $this->db->database;
        $table = 'tb_menu';
        $primaryKey = 'id_menu';
        $columns = array(

            ['db' => 'id_menu',
                'field' => 'id_menu',
                'dt' => '0',
                'formatter' => function( $d, $row ) {
                    return '<a class="btn btn-default btn-sm" href="' . site_url() . '?/DaftarMenu/update/' . $d . '" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                            <button class="btn btn-default btn-sm" onclick="delete_data(\'' . $d . '\')"  title="Delete"><i class="fa fa-remove"></i></button>&nbsp;
                            ;
                            ';
                }],

            ['db' => 'nama_menu', 'field' => 'nama_menu', 'dt' => '1'],
            ['db' => 'kategori', 'field' => 'kategori', 'dt' => '2'],
            ['db' => 'satuan', 'field' => 'satuan', 'dt' => '3'],
            ['db' => 'harga_jual', 'harga_jual' => 'foto', 'dt' => '4',
                'formatter' => function( $d, $row ) {
                    return 'Rp.' . number_format($d);
                }],
            ['db' => 'foto', 'field' => 'foto', 'dt' => '5',
                'formatter' => function( $d, $row ) {
                    return '<img src="' . base_url() . 'assets/images/' . urlencode($d) . '" width="100">';
                    //return '$' . number_format($d);
                }]
        );
        //$joinQuery = "FROM tb_menu ba";
        return json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, '')
        );
    }

   

    public function check_duplicate_id($kode_barang) {
        $this->db->where('kode_barang', $kode_barang);
        $result = $this->db->get('tb_barang')->num_rows();
        return $result;
    }

  

    public function insert_data($data, $detail_satuan, $detail_diskon, $data_satuan,$detail_satuan_stok) {
        $response = [];
        $this->db->insert('tb_barang', $data);
        if ($this->db->affected_rows() > 0) {
            $id_menu = $this->db->insert_id();
            
            $data_satuan['id_menu'] = $id_menu;
            $data_satuan['diskon_persen'] = isset($data_satuan['diskon_rupiah']) ? (($data_satuan['diskon_rupiah'] / $data['harga_jual']) * 100) : 0;
            $this->db->insert('tb_diskon_barang', $data_satuan);
            
            if (isset($detail_satuan['id_satuan'])) {
                $i = 0;
                foreach ($detail_satuan['id_satuan'] as $row) {
                    $data = [
                        'id_menu' => $id_menu,
                        'id_satuan' => $detail_satuan['id_satuan'][$i],
                        'barcode' => $detail_satuan['barcode_satuan'][$i],
                        'hpp' => $detail_satuan['hpp'][$i],
                        'harga_beli' => $detail_satuan['harga_beli'][$i],
                        'harga_jual' => $detail_satuan['harga_jual'][$i],
                        'konversi' => $detail_satuan['konversi'][$i],
                        'batas_min' => $detail_satuan['batas_min'][$i],
                        'batas_max' => $detail_satuan['batas_max'][$i],
                        'stok_minimum' => $detail_satuan_stok['stok_minimum'][$i],
                        'stok_maksimum' => $detail_satuan_stok['stok_maksimum'][$i],
                    ];
                    $this->db->insert('tb_satuan_barang', $data);


                    $data = [
                        'id_menu' => $id_menu,
                        'id_satuan' => isset($detail_satuan['id_satuan'][$i]) ? $detail_satuan['id_satuan'][$i] : 0,
                        'konversi' => isset($detail_satuan['konversi'][$i]) ? $detail_satuan['konversi'][$i] : 0,
                        'awal_diskon' => isset($detail_diskon['awal_diskon'][$i]) ? $detail_diskon['awal_diskon'][$i] : date('Y-m-d 00:00:00'),
                        'akhir_diskon' => isset($detail_diskon['akhir_diskon'][$i]) ? $detail_diskon['akhir_diskon'][$i] : date('Y-m-d 00:00:00'),
                        'kelipatan' => isset($detail_diskon['kelipatan_diskon'][$i]) ? $detail_diskon['kelipatan_diskon'][$i] : 0,
                        'diskon_persen' => isset($detail_diskon['diskon_rupiah_diskon'][$i]) ? (($detail_diskon['diskon_rupiah_diskon'][$i] / $detail_satuan['harga_jual'][$i]) * 100) : 0,
                        'diskon_rupiah' => isset($detail_diskon['diskon_rupiah_diskon'][$i]) ? $detail_diskon['diskon_rupiah_diskon'][$i] : 0
                    ];
                    $this->db->insert('tb_diskon_barang', $data);
                    $i++;
                }
            }
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }
        return $response;
    }

    public function update_data($data, $detail_satuan, $detail_diskon, $data_satuan,$detail_satuan_stok) {
        $response = [];
        $this->db->where('id_menu', $data['id_menu']);
        $this->db->update('tb_barang', $data);
        if ($this->db->affected_rows() > 0) {
            $id_menu = $data['id_menu'];
            $this->db->where('id_menu', $id_menu);
            $this->db->delete('tb_satuan_barang');
            $this->db->where('id_menu', $id_menu);
            $this->db->delete('tb_diskon_barang');
            
            $data_satuan['id_menu'] = $id_menu;
            $data_satuan['diskon_persen'] = $data_satuan['diskon_rupiah'] != 0 ? (($data_satuan['diskon_rupiah'] / $data['harga_jual']) * 100) : 0;
            $this->db->insert('tb_diskon_barang', $data_satuan);
            
            if (isset($detail_satuan['id_satuan'])) {
                $i = 0;
                foreach ($detail_satuan['id_satuan'] as $row) {
                    $data = [
                        'id_menu' => $id_menu,
                        'id_satuan' => $detail_satuan['id_satuan'][$i],
                        'barcode' => $detail_satuan['barcode_satuan'][$i],
                        'hpp' => $detail_satuan['hpp'][$i],
                        'harga_beli' => $detail_satuan['harga_beli'][$i],
                        'harga_jual' => $detail_satuan['harga_jual'][$i],
                        'konversi' => $detail_satuan['konversi'][$i],
                        'batas_min' => $detail_satuan['batas_min'][$i],
                        'batas_max' => $detail_satuan['batas_max'][$i],
                        'stok_minimum' => $detail_satuan_stok['stok_minimum'][$i],
                        'stok_maksimum' => $detail_satuan_stok['stok_maksimum'][$i],
                    ];
                    $this->db->insert('tb_satuan_barang', $data);


                    $data = [
                        'id_menu' => $id_menu,
                        'id_satuan' => isset($detail_satuan['id_satuan'][$i]) ? $detail_satuan['id_satuan'][$i] : 0,
                        'konversi' => isset($detail_satuan['konversi'][$i]) ? $detail_satuan['konversi'][$i] : 0,
                        'awal_diskon' => isset($detail_diskon['awal_diskon'][$i]) ? $detail_diskon['awal_diskon'][$i] : date('Y-m-d 00:00:00'),
                        'akhir_diskon' => isset($detail_diskon['akhir_diskon'][$i]) ? $detail_diskon['akhir_diskon'][$i] : date('Y-m-d 59:59:59'),
                        'kelipatan' => isset($detail_diskon['kelipatan_diskon'][$i]) ? $detail_diskon['kelipatan_diskon'][$i] : 0,
                        'diskon_persen' => isset($detail_diskon['diskon_rupiah_diskon'][$i]) ? (($detail_diskon['diskon_rupiah_diskon'][$i] / $detail_satuan['harga_jual'][$i]) * 100) : 0,
                        'diskon_rupiah' => isset($detail_diskon['diskon_rupiah_diskon'][$i]) ? $detail_diskon['diskon_rupiah_diskon'][$i] : 0
                    ];
                    $this->db->insert('tb_diskon_barang', $data);
                    $i++;
                }
            }
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }
        return $response;
    }

    public function delete_data($id_menu) {
        $this->db->where('id_menu', $id_menu);
        $this->db->delete('tb_diskon_barang');
        $this->db->where('id_menu', $id_menu);
        $this->db->delete('tb_satuan_barang');
        $this->db->where('id_menu', $id_menu);
        $this->db->delete('tb_barang');
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    public function get_data_barang($id_menu) {
        $this->db->where('id_menu', $id_menu);
        $result = $this->db->get('tb_barang')->row_array();
        return $result;
    }

    public function get_data_groupbarang() {
        $result = $this->db->get('tb_group_barang')->result_array();
        return $result;
    }

    public function get_data_subgroupbarang() {
        $result = $this->db->get('tb_sub_group_barang')->result_array();
        return $result;
    }

    public function get_data_merek() {
        $result = $this->db->get('tb_merek')->result_array();
        return $result;
    }

    public function get_data_satuan() {
        $result = $this->db->get('tb_satuan')->result_array();
        return $result;
    }

    public function get_data_satuan_barang($id_menu) {
        $this->db->where('id_menu', $id_menu);
        $this->db->from('tb_satuan_barang');
        $this->db->order_by('konversi', 'desc');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_data_diskon_barang($id_menu) {
        $this->db->where('id_menu', $id_menu);
        $this->db->where('id_satuan IS NOT NULL');
        $this->db->from('tb_diskon_barang');
        $this->db->order_by('konversi', 'desc');
        $result = $this->db->get()->result_array();
        return $result;
    }
    
    public function get_data_diskon_barang_utama($id_menu) {
        $this->db->where('id_menu', $id_menu);
        $this->db->where('id_satuan IS NULL');
        $this->db->from('tb_diskon_barang');
        $this->db->order_by('konversi', 'desc');
        $result = $this->db->get()->row_array();
        return $result;
    }
    
    public function get_detail_satuan($barcode){
        $query = "SELECT tsb.*,sat.satuan,tdb.kelipatan,tdb.diskon_persen,tdb.diskon_rupiah FROM tb_satuan_barang tsb 
                    LEFT JOIN tb_satuan sat ON sat.id_satuan = tsb.id_satuan
                    LEFT JOIN tb_diskon_barang tdb ON tdb.id_menu = tsb.id_menu AND tdb.id_satuan = tsb.id_satuan 
                                                    AND NOW() BETWEEN tdb.awal_diskon AND tdb.akhir_diskon
                    WHERE tsb.barcode = '".$barcode."'
            ";
        $result = $this->db->query($query);
        return $result->row_array();
    }

}
