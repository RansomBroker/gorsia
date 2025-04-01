<?php


class M_daftar_akun extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_daftar_akun()
  {
    $table= "akun_perkiraan";


    $this->db->order_by("id_akun", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    $this->db->insert('akun_perkiraan',$simpan_data);

   $this->session->set_flashdata('msg', 'Data Berhasil Tersimpan !!');
   redirect(site_url() . '?/DaftarAkun');
  }


   function update_data($id_akun, $update_data)
  {
    $this->db->where('id_akun', $id_akun);
    $this->db->update('akun_perkiraan', $update_data);

    $this->session->set_flashdata('msg', 'Data Berhasil Di Update !!');
     redirect(site_url() . '?/DaftarAkun');
  }

  function delete_data($id_akun)
  {
    $this->db->where('id_akun', $id_akun);
    $this->db->delete('akun_perkiraan');

    $this->session->set_flashdata('msg', 'Data Berhasil Dihapus !!');
     redirect(site_url() . '?/DaftarAkun');
  }



}


 ?>





