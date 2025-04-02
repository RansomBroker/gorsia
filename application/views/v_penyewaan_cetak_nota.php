<?php


$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Cetak Nota | GORSIA');
$pdf->SetHeaderMargin(0);
$pdf->SetTopMargin(10);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(true);
$pdf->SetAuthor('');
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage();
$i=0;



function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }
 
  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }         
    return $hasil;
  }


  function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  
 
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}


foreach ($get_data_utama_untuk_cetak as $row_utama) {

  $id_transaksi       = $row_utama['id_transaksi'];
  $tanggal    = $row_utama['tanggal'];
  $nama_pelanggan    = $row_utama['nama_pelanggan'];
  $no_telepon      = $row_utama['no_telepon'];
  $member     = $row_utama['member'];
  $id_member     = $row_utama['id_member'];
  $id_kategori_olahraga      = $row_utama['id_kategori_olahraga'];
  $id_paket_sewa        = $row_utama['id_paket_sewa'];
  $id_lapangan       = $row_utama['id_lapangan'];
  $lama_sewa        = $row_utama['lama_sewa'];
  $harga         = $row_utama['harga'];
  $total      = $row_utama['total'];
  $status_transaksi    = $row_utama['status_transaksi'];
  $created_by    = $row_utama['created_by'];
  $jenis_bayar    = $row_utama['jenis_bayar'];

  $rows_kategori = $this->db->query("SELECT * FROM kategori_olahraga where id_kategori_olahraga='".$id_kategori_olahraga."'")->row_array();
$kategori_olahraga=$rows_kategori['kategori_olahraga'];

  #lapangan
$rows_lapangan = $this->db->query("SELECT * FROM lapangan where id_lapangan='".$id_lapangan."'")->row_array();
$nama_lapangan=$rows_lapangan['nama_lapangan'];

$rows_harga = $this->db->query("SELECT * FROM paket_sewa where id_kategori_olahraga='".$id_kategori_olahraga."'")->row_array();
$id_satuan=$rows_harga['id_satuan'];

                      #satuan
$rows_satuan = $this->db->query("SELECT * FROM satuan_sewa where id_satuan_sewa='".$id_satuan."'")->row_array();
$satuan_sewa=$rows_satuan['satuan_sewa'];



  $html='<table cellspacing="0">
  <tr bgcolor="#ffffff">
    <th width="100%" align="left"></th>

  </tr>

  <tr bgcolor="#ffffff">
    <th width="90%" align="center"><font size="11"><b>GOR RAMA JAYA</b></font> <br><font size="9"> Jalan. xxxx Sidoarjo <br> Telp. 030 0123 345 <br></font></th>
  </tr>

  <tr bgcolor="#ffffff">
    <th width="12%" align="left"><font size="9">No. Rental</font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="20%" align="left"><font size="9">'.$id_transaksi.'</font></th>
    <th width="20%" align="left"><font size="9"></font></th>
    <th width="15%" align="left"><font size="9"><b>Status Member</b></font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="41%" align="left"><font size="9">'.$member.'</font></th>
  </tr>';
  

  $html.='<tr bgcolor="#ffffff">
    <th width="12%" align="left"><font size="9">Tanggal Rental</font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="20%" align="left"><font size="9">'.tgl_indo(date($tanggal)).'</font></th>
    <th width="20%" align="left"><font size="9"></font></th>
    <th width="15%" align="left"><font size="9"><b>Kasir </b></font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="41%" align="left"><font size="9">'.$created_by.' </font></th>
  </tr>

  <tr bgcolor="#ffffff">
    <th width="12%" align="left"><font size="9">Pelanggan</font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="20%" align="left"><font size="9">'.$nama_pelanggan.'</font></th>
    <th width="20%" align="left"><font size="9"></font></th>
    <th width="15%" align="left"><font size="9"><b>Transaksi </b></font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="41%" align="left"><font size="9">'.$status_transaksi.' </font></th>
  </tr>

  <tr bgcolor="#ffffff">
    <th width="12%" align="left"><font size="9">No. Telpon</font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="20%" align="left"><font size="9">'.$no_telepon.'</font></th>
    <th width="20%" align="left"><font size="9"></font></th>
    <th width="15%" align="left"><font size="9"><b> </b></font></th>
    <th width="2%" align="center"><font size="9"></font></th>
    <th width="41%" align="left"><font size="9"></font></th>
  </tr>

  <tr bgcolor="#ffffff">
    <th width="100%" align="left"><font size="9">--------------------------------------------------------------------------------------------------------------------------------------------</font></th>
  </tr>

  <tr bgcolor="#ffffff">
    <th width="12%" align="left"><font size="9">Lapangan</font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="20%" align="left"><font size="9">'.$nama_lapangan.'</font></th>
    <th width="20%" align="left"><font size="9"></font></th>
    <th width="15%" align="left"><font size="9"><b>Olahraga </b></font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="41%" align="left"><font size="9">'.$kategori_olahraga.' </font></th>
  </tr>

  <tr bgcolor="#ffffff">
    <th width="12%" align="left"><font size="9">Harga Sewa</font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="20%" align="left"><font size="9">'.number_format($harga).' / '.$satuan_sewa.'</font></th>
    <th width="20%" align="left"><font size="9"></font></th>
    <th width="15%" align="left"><font size="9"><b>Lama Sewa </b></font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="41%" align="left"><font size="9">'.$lama_sewa.' '.$satuan_sewa.' </font></th>
  </tr>

  
  <tr bgcolor="#ffffff">
    <th width="100%" align="left"></th>
  </tr>
</table> 
<br>'; }



$html.='<table cellspacing="0" bgcolor="#ffffff" cellpadding="0" border="1">
            <tr bgcolor="#E5E7E9">
              <th width="5%" align="center"><font size="9"><b>No.</b></font></th>
              <th width="30%" align="center"><font size="9"><b>Sesi</b></font></th>
              <th width="20%" align="right"><font size="9"><b>Harga&nbsp;&nbsp;</b></font></th>
              <th width="23%" align="right"><font size="9"><b>Subtotal&nbsp;&nbsp;</b></font></th>
            </tr>';

            $total_harga= 0;
      foreach ($get_data_detail_untuk_cetak as $row) 
        {
          $i++;

          $id_transaksi_detil = $row['id_transaksi_detil'];         
          $id_jadwal_sesi = $row['id_jadwal_sesi'];         
          $harga = $row['harga'];     

          #sesi
          $rows_sesi= $this->db->query("SELECT * FROM jadwal_sesi where id_jadwal_sesi='".$id_jadwal_sesi."'")->row_array();
          $jam_sesi=$rows_sesi['jam_sesi'];

          
          $total_harga=$total_harga+$harga;

          $html.='<tr bgcolor="#ffffff">
              <td align="center"><font size="9">'.$i.'</font></td>
              <td align="center"><font size="9">&nbsp;'.$jam_sesi.'</font></td>
              <td align="right"><font size="9">&nbsp;1 x '.number_format($harga,0,",",",").'&nbsp;&nbsp;</font></td>
              <td align="right"><font size="9">&nbsp;'.number_format($harga,0,",",",").'&nbsp;&nbsp;</font></td>
              
            </tr>';
        }
        
        $dp = 0;
        if ($jenis_bayar == 'dp') {
          $dp = $total_harga/2;
          $html.='<tr bgcolor="#ffffff">
            <td align="center"><font size="9"></font></td>
            <td align="center"><font size="9">&nbsp;</font></td>
            <td align="right"><font size="9">&nbsp;<b>Total DP&nbsp;&nbsp;</b></font></td>
            <td align="right"><font size="9"><b>&nbsp;'.number_format($dp,0,",",",").'&nbsp;&nbsp;</b></font></td>
            
          </tr>';
        }

        $html.='<tr bgcolor="#ffffff">
              <td align="center"><font size="9"></font></td>
              <td align="center"><font size="9">&nbsp;</font></td>
              <td align="right"><font size="9">&nbsp;<b>Subtotal&nbsp;&nbsp;</b></font></td>
              <td align="right"><font size="9"><b>&nbsp;'.number_format($total_harga-$dp,0,",",",").'&nbsp;&nbsp;</b></font></td>
              
            </tr>';

      $html.='</table>';



$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('nota.pdf', 'I');
?>