<?php

class M_jurnal_transaksi extends CI_MODEL
{
    function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('transaksi_jurnal');
        $this->db->where('MONTH(tanggal)', date('m'));
        $this->db->order_by('id', 'asc');
        return $this->db->get()->result_array();
    }

    public function get_all_pengeluaran_by_month_year($month, $year, $status)
    {
        $this->db->select('*');
        $this->db->from('transaksi_jurnal');
        $this->db->where('MONTH(tanggal)', $month);
        $this->db->where('YEAR(tanggal)', $year);
        if ($status != '') {
            $this->db->where('status_transaksi', $status);
        }
        $this->db->order_by('tanggal', 'asc');
        return $this->db->get()->result_array();
    }

    public function updateData($id)
    {
        // var_dump($id);
        // die;
        $data = [
            'tanggal' => $_POST['tanggal'],
            'jumlah' => $_POST['jumlah'],
            'keterangan' => $_POST['keterangan'],
            'status_transaksi' => $_POST['status_transaksi'],
            'modified_by' => $this->session->username,
            'modified_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->where('id', $id);

        return $this->db->update('transaksi_jurnal', $data);
    }

    public function simpanData()
    {
        $list_sumber_akun = $_POST['sumber_akun'];
        $list_tujuan_akun = $_POST['tujuan_akun'];
        $nominal1 = $_POST['nominal1'];
        $nominal2 = $_POST['nominal2'];
        $user_created = $this->session->username;
        $created_at = date('Y-m-d H:i:s');

        // var_dump(json_encode($_POST));
        // die;

        $total = 0;
        foreach ($list_sumber_akun as $key => $value) {
            $detail = [
                'no_transaksi' => $_POST['no_transaksi'],
                'id_kode_akun_debet' => null,
                'id_kode_akun_kredit' => $value,
                'nominal' => $nominal1[$key],
            ];

            $simpan_detail = $this->db->set($detail)->get_compiled_insert('transaksi_jurnal_detil');
            $sql_detail = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $simpan_detail);
            $this->db->query($simpan_detail);
        }
        foreach ($list_tujuan_akun as $key => $value) {
            $detail = [
                'no_transaksi' => $_POST['no_transaksi'],
                'id_kode_akun_debet' => $value,
                'id_kode_akun_kredit' => null,
                'nominal' => $nominal2[$key],
            ];
            $total = $total + $nominal2[$key];

            $simpan_detail = $this->db->set($detail)->get_compiled_insert('transaksi_jurnal_detil');
            $sql_detail = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $simpan_detail);
            $this->db->query($simpan_detail);
        }

        $data = [
            'no_transaksi' => $_POST['no_transaksi'],
            'tanggal' => $_POST['tanggal'],
            'jumlah' => $total,
            'status_transaksi' => 'Sukses',
            'keterangan' => $_POST['keterangan'],
            'created_by' => $user_created,
            'created_at' => $created_at,
        ];

        $simpan = $this->db->set($data)->get_compiled_insert('transaksi_jurnal');
        $sql = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $simpan);
        $this->db->query($simpan);
        $getID = $this->db->insert_id();

        $data = ['status' => true, 'idSimpanDetail' => $getID];
        return $data;
    }

    function insert_data_jurnal($simpan_data_jurnal, $no_bukti)
    {
        $this->db->insert('jurnal_umum', $simpan_data_jurnal);
    }

    function insert_data_detail_jurnal($simpan_data_jurnal_detail, $no_bukti, $id_trx)
    {
        $this->db->insert('jurnal_umum_detail', $simpan_data_jurnal_detail);
    }

    public function deleteData($no_transaksi, $no_bukti_jurnal)
    {
        // var_dump($no_bukti_jurnal);
        // die;

        #utama
        $this->db->where('no_bukti', $no_bukti_jurnal);
        $this->db->delete('jurnal_umum');

        #detail
        $this->db->where('no_bukti', $no_bukti_jurnal);
        $this->db->delete('jurnal_umum_detail');

        #utama
        $this->db->where('no_transaksi', $no_transaksi);
        $this->db->delete('transaksi_jurnal');

        #detail
        $this->db->where('no_transaksi', $no_transaksi);
        $this->db->delete('transaksi_jurnal_detil');

        #notifikasi sukses
        $this->session->set_flashdata(
            'msg',
            '<div class="alert alert-success alert-dismissible" role="alert">
        Sukses Hapus Data !! Ini telah sekaligus menghapus data jurnal yang berkaitan dengan Jurnal lain ini..
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
        );
        redirect(site_url() . '?/Pengeluaran');
    }

    public function editData($id)
    {
        $this->db->select('*');
        $this->db->from('transaksi_jurnal');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function voidData($no_transaksi, $no_bukti_jurnal)
    {
        #utama
        $this->db->where('no_bukti', $no_bukti_jurnal);
        $this->db->delete('jurnal_umum');

        #detail
        $this->db->where('no_bukti', $no_bukti_jurnal);
        $this->db->delete('jurnal_umum_detail');

        $data = [
            'status_transaksi' => 'Void',
            'modified_by' => $this->session->username,
            'modified_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->where('no_transaksi', $no_transaksi);
        $this->db->update('transaksi_jurnals', $data);

        #notifikasi sukses
        $this->session->set_flashdata(
            'msg',
            '<div class="alert alert-success alert-dismissible" role="alert">
        Sukses Void Data !! Ini telah sekaligus menghapus data jurnal yang berkaitan dengan Jurnal Lain ini..
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
        );
        redirect(site_url() . '?/Jurnal');
    }
}

?>
