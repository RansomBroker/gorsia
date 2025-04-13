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

function tgl_indo($tanggal)
{
    if (!$tanggal || $tanggal === '-') {
        return '-';
    }

    $bulan = [
        1 => 'Januari',
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
        'Desember',
    ];
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}

// Tampung HTML
$html = '';

$nama_member = $nota['nama'];
$tanggal_transaksi = $nota['tanggalMulai'];
$panjang_bulan = $nota['durasiMember'];
$harga = $nota['harga'];
$diskon = $nota['diskon'];
$total_dibayar = $harga - $diskon;
$tanggal_expired = $nota['tanggalSelesai'] ?? '-';
$id_transaksi = $nota['nomorTransaksi'];

$html =
    '<table cellspacing="0">
<tr bgcolor="#ffffff">
  <th width="100%" align="left"></th>

</tr>

<tr bgcolor="#ffffff">
  <th width="90%" align="center"><font size="11"><b>GOR RAMA JAYA</b></font> <br><font size="9"> Jalan. xxxx Sidoarjo <br> Telp. 030 0123 345 <br></font></th>
</tr>

<tr bgcolor="#ffffff">
  <th width="20%" align="left"><font size="9">ID Transaksi</font></th>
  <th width="2%" align="center"><font size="9">:</font></th>
  <th width="20%" align="left"><font size="9">' .
    $id_transaksi .
    '</font></th>   
</tr>

<tr bgcolor="#ffffff">
    <th width="20%" align="left"><font size="9">Tanggal Mulai</font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="20%" align="left"><font size="9">' .
    tgl_indo(date($tanggal_transaksi)) .
    '</font></th>
  </tr>

  
  <tr bgcolor="#ffffff">
    <th width="20%" align="left"><font size="9">Nama Member</font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="20%" align="left"><font size="9">' .
    $nama_member .
    '</font></th>
  </tr>

  <tr bgcolor="#ffffff">
    <th width="20%" align="left"><font size="9">Durasi Paket</font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="20%" align="left"><font size="9">' .
    $panjang_bulan .
    ' Hari' .
    '</font></th>
  </tr>

  <tr bgcolor="#ffffff">
    <th width="20%" align="left"><font size="9">Tanggal Expired</font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="20%" align="left"><font size="9">' .
    tgl_indo(date($tanggal_expired)) .
    '</font></th>
  </tr>

  <tr bgcolor="#ffffff">
    <th width="20%" align="left"><font size="9">Diskon</font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="20%" align="left"><font size="9">0
    </font></th>
  </tr>

  <tr bgcolor="#ffffff">
    <th width="20%" align="left"><font size="9">Total</font></th>
    <th width="2%" align="center"><font size="9">:</font></th>
    <th width="20%" align="left"><font size="9">Ro.' .
    number_format($harga, 0, ',', '.') .
    '</font></th>
  </tr>
';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('nota_member.pdf', 'I');

?>
