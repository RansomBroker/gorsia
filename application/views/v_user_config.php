<?php
$rows = $this->db->query("SELECT * FROM user where username='".$this->session->username."'")->row_array();
$id_user=$rows['id'];
$hak_akses=$rows['hak_akses'];
$user_nama_lengkap=$rows['nama_lengkap'];
$user_foto=$rows['foto'];

#hakpengguna
$rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses where hak_akses='".$hak_akses."'")->row_array();
$akses_read=$rows_hakpengguna['akses_read'];
$akses_create=$rows_hakpengguna['akses_create'];
$akses_update=$rows_hakpengguna['akses_update'];
$akses_delete=$rows_hakpengguna['akses_delete'];
$akses_cetak=$rows_hakpengguna['akses_cetak'];

#menu 
$menu_master = $rows_hakpengguna['menu_master'];
$menu_operasional = $rows_hakpengguna['menu_operasional'];
$menu_akuntansi = $rows_hakpengguna['menu_akuntansi'];



?>
