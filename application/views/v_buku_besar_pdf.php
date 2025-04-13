<?php
ob_start();
// Start capturing output
?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        font-size: 10px;
    }
    th, td {
        border: 1px solid #000;
        padding: 5px;
        vertical-align: top;
    }
    th {
        background-color: #f2f2f2;
    }
    .right {
        text-align: right;
    }
</style>

<h3 style="text-align: center;">Laporan Buku Besar</h3>
<p style="text-align: center;">Periode: <?= $periode ?>/<?= $tahun ?></p>

<table>
    <thead>
        <tr>
            <th style="width: 80px;"><b>Tanggal</b></th>
            <th style="width: 200px;"><b>Uraian</b></th>
            <th style="width: 80px;"><b>Debet</b></th>
            <th style="width: 80px;"><b>Kredit</b></th>
            <th style="width: 100px;"><b>Saldo</b></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $temp = '';
    $temp2 = '';
    $temp3 = '';
    $grand_total_saldo_awal = 0;
    $row_color = '#ffffff'; // Start with white row color

    foreach ($get_all_buku_besar as $row) {
        $temp2 = $row->id_kode_akuntansi;
        $saldo_normal = $row->saldo_normal;

        if ($temp != $row->id_kode_akuntansi) {
            $total_saldo_awal = 0;

            echo "<tr style='background-color: $row_color;'><td colspan='5'><b>({$row->kode_akun}) {$row->nama_akun}</b></td></tr>";

            // Saldo awal
            $first_periode = date('Y-m-01', strtotime("$tahun-$periode-01"));
            $query_saldo_awal = $this->db
                ->query(
                    "
                    SELECT SUM(debet) as total_debet, SUM(kredit) as total_kredit 
                    FROM jurnal_umum 
                    INNER JOIN jurnal_umum_detail ON jurnal_umum.no_bukti = jurnal_umum_detail.no_bukti 
                    WHERE id_kode_akuntansi = '$temp2' 
                    AND jurnal_umum.tanggal < '$first_periode'
                    GROUP BY id_kode_akuntansi
                "
                )
                ->row_array();

            $saldo_awal_debet = $query_saldo_awal ? $query_saldo_awal['total_debet'] : 0;
            $saldo_awal_kredit = $query_saldo_awal ? $query_saldo_awal['total_kredit'] : 0;

            if ($saldo_normal == 'Debet') {
                $total_saldo_awal += $saldo_awal_debet;
            } elseif ($saldo_normal == 'Kredit') {
                $total_saldo_awal += $saldo_awal_kredit;
            }

            $tanggal_awal = date('01-m-Y', strtotime("$tahun-$periode-01"));
            echo "<tr style='background-color: $row_color;'>
                        <td>$tanggal_awal</td>
                        <td>Saldo Awal</td>
                        <td></td>
                        <td></td>
                        <td class='right'>Rp. " .
                number_format($total_saldo_awal, 2, ',', '.') .
                "</td>
                      </tr>";
        }

        if ($temp3 != $row->no_bukti) {
            $tanggal = date('d-m-Y', strtotime($row->tanggal));
            $debet = number_format($row->debet, 2, ',', '.');
            $kredit = number_format($row->kredit, 2, ',', '.');
            $total_saldo_awal += $row->debet - $row->kredit;
            $saldo = number_format($total_saldo_awal, 2, ',', '.');

            echo "<tr style='background-color: $row_color;'>
                        <td>$tanggal</td>
                        <td>{$row->keterangan}</td>
                        <td class='right'>Rp. $debet</td>
                        <td class='right'>Rp. $kredit</td>
                        <td class='right'>Rp. $saldo</td>
                      </tr>";

            $temp3 = $row->no_bukti;
        }

        $temp = $row->id_kode_akuntansi;

        // Toggle row color for next row (white or light grey)
        $row_color = $row_color === '#ffffff' ? '#f9f9f9' : '#ffffff';
    }
    ?>
    </tbody>
</table>
