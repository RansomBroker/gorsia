<?php


class M_term_of_payment extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  $this->load->database();
  }


  #function untuk data tabel
  public function get_all_term_of_payment()
  {
    $table= "term_of_payment";


    $this->db->order_by("id_term_of_payment", "asc");
    $query = $this->db->get($table);
    return $query->result();
  }


  
  #function untuk menyimpan data
  public function insert_data($simpan_data)
  {
    $this->db->insert('term_of_payment',$simpan_data);

   $this->session->set_flashdata('msg', 'Data Berhasil Tersimpan !!');
   redirect(site_url() . '?/TermOfPayment');
  }


   function update_data($id_term_of_payment, $update_data)
  {
    $this->db->where('id_term_of_payment', $id_term_of_payment);
    $this->db->update('term_of_payment', $update_data);

    $this->session->set_flashdata('msg', 'Data Berhasil Di Update !!');
     redirect(site_url() . '?/TermOfPayment');
  }

  function delete_data($id_term_of_payment)
  {
    $this->db->where('id_term_of_payment', $id_term_of_payment);
    $this->db->delete('term_of_payment');

    $this->session->set_flashdata('msg', 'Data Berhasil Dihapus !!');
     redirect(site_url() . '?/TermOfPayment');
  }



}


 ?>





