<?php
include_once 'v_user_config.php';
?>


<?php 

if ($this->uri->segment('2')=="filterpencarian" && false){

$param_id_akun = $this->input->post('txt_id_akun');
$param_tahun = $this->input->post('txt_tahun');
$param_bulan = $this->input->post('txt_periode');
$param_periode = $param_tahun.$param_bulan;

$rows_akun_pr = $this->db->query("SELECT * FROM kode_akuntansi where id_kode_akuntansi='".$param_id_akun."'")->row_array();
$param_kode_akun=$rows_akun_pr['kode_akun'];
$param_nama_akun=$rows_akun_pr['nama_akun'];

#saldo awal akun
$rows_saldo_awal = $this->db->query("SELECT sum(debet) as jumlah_debet, SUM(kredit) as jumlah_kredit FROM jurnal_umum INNER JOIN jurnal_umum_detail ON jurnal_umum.no_bukti=jurnal_umum_detail.no_bukti where id_kode_akuntansi='".$param_id_akun."' AND jurnal_umum.periode<'".$param_periode."' GROUP BY id_kode_akuntansi")->row_array();
$jumlah_debet=$rows_saldo_awal['jumlah_debet'];
$jumlah_kredit=$rows_saldo_awal['jumlah_kredit'];
$saldo_awal = $jumlah_debet - $jumlah_kredit;

#mutasi
$rows_mutasi = $this->db->query("SELECT sum(debet) as jumlah_debet, SUM(kredit) as jumlah_kredit FROM jurnal_umum INNER JOIN jurnal_umum_detail ON jurnal_umum.no_bukti=jurnal_umum_detail.no_bukti where id_kode_akuntansi='".$param_id_akun."' AND jurnal_umum.periode='".$param_periode."' GROUP BY id_kode_akuntansi")->row_array();
$mutasi_jumlah_debet=$rows_mutasi['jumlah_debet'];
$mutasi_jumlah_kredit=$rows_mutasi['jumlah_kredit'];
$mutasi_saldo = $mutasi_jumlah_debet - $mutasi_jumlah_kredit;

$saldo_akhir = $saldo_awal + $mutasi_saldo;

}

else {
    if(empty($param_id_akun)) $param_id_akun = ['all'];
    $param_tahun ="";
    $param_bulan ="";
    $param_periode ="";

    $saldo_awal= 0 ;
    $mutasi_saldo = 0;
    $saldo_akhir = 0;

}


?>

<!DOCTYPE html>

<!-- beautify ignore:start -->
<html
lang="en"
class="light-style layout-menu-fixed"
dir="ltr"
data-theme="theme-default"
data-assets-path="<?=base_url()?>/assets/backend/"
data-template="vertical-menu-template-free"
>
<head>
  <meta charset="utf-8" />
  <meta
  name="viewport"
  content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
  />

  <title>Gorsia - Buku Besar</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?=base_url()?>/assets/backend/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"
  />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/backend//vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
    <link href="<?=base_url()?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/vendor/libs/apex-charts/apex-charts.css" />

   <!-- Bootstrap Core CSS -->
   <link href="<?=base_url()?>/assets/select2/select2.min.css" rel="stylesheet" />
   <link href="<?=base_url()?>/assets/select2/select2-bootstrap-5-theme.min.css" rel="stylesheet" />



  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="<?=base_url()?>/assets/backend/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?=base_url()?>/assets/backend/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <?php include_once 'v_sidebar.php'; ?>

        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <?php include_once 'v_navbar.php'; ?>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Akuntansi /</span> Buku Besar</h4>


              <div class="row">
              

               <div class="col-12">
              
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Buku Besar</h4>
                                <h6 class="card-subtitle">berdasarkan kode akuntansi</h6>
                               <hr>


                               <div class="row">
                                    <div class="col-sm-12">
                                        <?php echo form_open_multipart(site_url().'?/BukuBesar/filterpencarian'); ?>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label for="txt_id_akun" class="form-label">Kode Akuntansi</label>
                                                    <select multiple class="form-select" style="width: 100%" name="txt_id_akun[]" id="txt_id_akun" required=""  >
                                                        <option value="all" <?=in_array('all',$param_id_akun)?'selected':''?>> Semua </option>
                                                        <?php foreach($get_all_data_akun as $row) {  
                                                            $id_kode_akuntansi_cb= $row->id_kode_akuntansi;
                                                            $kode_akun_cb = $row->kode_akun;
                                                            $nama_akun_cb = $row->nama_akun;
                                                            $selected = in_array($row->id_kode_akuntansi,$param_id_akun) ? 'selected' : '';
                                                            print "<option value='$id_kode_akuntansi_cb' $selected>$kode_akun_cb - $nama_akun_cb</option>";
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="periode" class="form-label">Periode (Bulan)</label>
                                                    <select class="form-control" id="periode" name="periode" required>
                                                        <option value="">Pilih Bulan</option>
                                                        <?php 
                                                        $months = [
                                                            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                                            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                                            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                                        ];
                                                        foreach ($months as $num => $name) {
                                                            $selected = (!empty($periode) && $periode == $num) ? 'selected' : '';
                                                            echo "<option value='$num' $selected>$name</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="tahun" class="form-label">Tahun</label>
                                                    <select class="form-control" id="tahun" name="tahun" required>
                                                    <option value="">Pilih Tahun</option>
                                                    <?php 
                                                    $currentYear = date('Y');
                                                    for ($i = $currentYear; $i >= $currentYear - 2; $i--) {
                                                        $selected = (!empty($tahun) && $tahun == $i) ? 'selected' : '';
                                                        echo "<option value='$i' $selected>$i</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 d-flex gap-3 align-items-end justify-content-end">
                                                    <button type="submit" class="btn btn-primary" id="filter_btn"><i class="bx bx-search-alt-2"></i> Filter</button>
                                                    <a href="<?=site_url()?>/BukuBesar" class="btn btn-secondary" id="reset_btn">Reset</a>
                                                </div>
                                            </div>
                                        <?php echo form_close(); ?>

                                    </div>
                                </div>

                                <br>
                                <br>


                                <h6 class="card-subtitle">Detail Mutasi Debet &amp; Kredit</h6>
                                <br>                              

                                <div class="table-responsive text-nowrap">
                                    <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable" style="padding: 5px; font-size: 12px; white-space: nowrap;">
                                        <thead>
                                          <tr role="row">
                                            <th style="width: 100px;"><b>Tanggal</b></th>
                                            <th style="width: 200px;"><b>Uraian</b></th>
                                            <!-- <th style="width: 100px;"><b>Nomor</b></th> -->
                                            <th style="width: 50px;"><b>Debet</b></th>
                                            <th style="width: 50px;"><b>Kredit</b></th>
                                            <th style="width: 50px;"><b>Saldo</b></th>
                                          </tr>
                                        </thead>
                                                        
                                        <tbody>
                                        <?php
                                        $temp='';
                                        $temp2='';
                                        $temp3='';
                                        $grand_total_saldo_awal = 0;        
                                        foreach($get_all_buku_besar as $row) {

                                            $temp2 = $row->id_kode_akuntansi;
                                            $param_periode = $tahun . $periode;  
                                            $saldo_normal = $row->saldo_normal;                                   
                                            
                                            if($temp != $row->id_kode_akuntansi) {
                                                $total_saldo_awal = 0;   
                                                echo "<tr><td colspan='5'><b>(".$row->kode_akun.") ".$row->nama_akun."</b></td></tr>";

                                                #saldo awal
                                                $first_periode = date('Y-m-01', strtotime("$tahun-$periode-01"));
                                                $query_saldo_awal = $this->db->query("
                                                    SELECT sum(debet) as total_debet, sum(kredit) as total_kredit 
                                                    FROM jurnal_umum 
                                                    INNER JOIN jurnal_umum_detail ON jurnal_umum.no_bukti=jurnal_umum_detail.no_bukti 
                                                    WHERE id_kode_akuntansi='" . $temp2 . "' 
                                                    AND jurnal_umum.tanggal < '" . $first_periode . "'
                                                    GROUP BY id_kode_akuntansi
                                                ")->row_array();
                                                $saldo_awal_debet = ($query_saldo_awal) ? $query_saldo_awal['total_debet'] : 0;
                                                $saldo_awal_kredit = ($query_saldo_awal) ? $query_saldo_awal['total_kredit'] : 0;
                                                
                                                if ($saldo_normal == "Debet") {
                                                    $total_saldo_awal = $total_saldo_awal + $saldo_awal_debet;
                                                } elseif ($saldo_normal == "Kredit") {
                                                    $total_saldo_awal = $total_saldo_awal + $saldo_awal_kredit;
                                                }
                                                
                                                $tanggal_awal = date('01-m-Y', strtotime("$tahun-$periode-01"));
                                                $grand_total_saldo_awal = $grand_total_saldo_awal + $total_saldo_awal;
                                                echo "<tr>";
                                                echo "<td>".$tanggal_awal."</td>";
                                                echo "<td>Saldo Awal</td>";
                                                // echo "<td></td>";
                                                echo "<td></td>";
                                                echo "<td></td>";
                                                echo "<td>Rp. <span class='float-end'>".number_format($total_saldo_awal,2,',','.')."</span></td>";
                                                echo "</tr>";
                                            }
                                            
                                            if($temp3 != $row->no_bukti) {
                                                $tanggal = date("d-m-Y", strtotime($row->tanggal));
                                                $debet = number_format($row->debet,2,',','.');
                                                $kredit = number_format($row->kredit,2,',','.');
                                                $total_saldo_awal = $total_saldo_awal + $row->debet-$row->kredit;
                                                $saldo = number_format($total_saldo_awal,2,',','.');
                                                
                                                echo "<tr>";
                                                echo "<td>".$tanggal."</td>";
                                                echo "<td>".$row->keterangan."</td>";
                                                // echo "<td>".$row->no_bukti."</td>";
                                                echo "<td>Rp. <span class='float-end'>".$debet."</span></td>";
                                                echo "<td>Rp. <span class='float-end'>".$kredit."</span></td>";
                                                echo "<td>Rp. <span class='float-end'>".$saldo."</span></td>";
                                                echo "</tr>";

                                                $temp3 = $row->no_bukti;
                                            }
                                            $temp = $row->id_kode_akuntansi;
                                            
                                            // if($temp != $row->id_kode_akuntansi) {
                                            //     echo "<tr>";
                                            //     echo "<td colspan='3'><b class='float-end'>Saldo Akhir</b></td>";
                                            //     echo "<td><b>Rp. <span class='float-end'>".(($saldo_normal == "Debet") ? number_format($total_saldo_awal,2,',','.') : 0)."</span></b></td>";
                                            //     echo "<td><b>Rp. <span class='float-end'>".(($saldo_normal == "Kredit") ? number_format($total_saldo_awal,2,',','.') : 0)."</span></b></td>";
                                            //     echo "</tr>";
                                            // } 
                                        }
                                        // echo "<tr>";
                                        // echo "<td colspan='3'><b class='float-end'>Saldo Akhir</b></td>";
                                        // echo "<td><b>Rp. <span class='float-end'>".(($saldo_normal == "Debet") ? number_format($grand_total_saldo_awal,2,',','.') : 0)."</span></b></td>";
                                        // echo "<td><b>Rp. <span class='float-end'>".(($saldo_normal == "Kredit") ? number_format($grand_total_saldo_awal,2,',','.') : 0)."</span></b></td>";
                                        // echo "</tr>";
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                    <br>

                                    <br>



                                    <div class="form-group row d-none">
                                        <label class="col-4 col-form-label"><font style="font-size: 14px"></font></label>
                                        <label class="col-5 col-form-label" align="right"><b>Saldo Awal</b></label>
                                        <div class="col-2" align="left">
                                            <input type="text" name="txt_saldo_awal" id="txt_saldo_awal" value="<?= number_format($saldo_awal); ?>" readonly>

                                        </div>
                                    </div>

                                   <div class="form-group row d-none">
                                        <label class="col-4 col-form-label"><font style="font-size: 14px"></font></label>
                                        <label class="col-5 col-form-label" align="right"><b>Saldo Akhir</b></label>
                                        <div class="col-2" align="left">
                                            <input type="text" name="txt_saldo_akhir" id="txt_saldo_akhir" value="<?= number_format($saldo_akhir); ?>" readonly>

                                        </div>
                                    </div>



                            </div>
                        </div>
                 
                    </div>
               

              </div>

              <!-- Basic Bootstrap Table -->

             

              </div>


              <!-- / Content -->

              <!-- Footer -->
              <footer class="content-footer footer bg-footer-theme">
               <!-- Footer -->
               <?php include_once 'v_footer.php'; ?>
               <!-- / Footer -->
             </footer>
             <!-- / Footer -->

             <div class="content-backdrop fade"></div>
           </div>
           <!-- Content wrapper -->
         </div>
         <!-- / Layout page -->
       </div>

       <!-- Overlay -->
       <div class="layout-overlay layout-menu-toggle"></div>
     </div>
     <!-- / Layout wrapper -->



     <!-- Core JS -->
     <!-- build:js assets/vendor/js/core.js -->
     <script src="<?=base_url()?>/assets/backend/vendor/libs/jquery/jquery.js"></script>
     <script src="<?=base_url()?>/assets/backend/vendor/libs/popper/popper.js"></script>
     <script src="<?=base_url()?>/assets/backend/vendor/js/bootstrap.js"></script>
     <script src="<?=base_url()?>/assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

     <script src="<?=base_url()?>/assets/backend/vendor/js/menu.js"></script>
     <!-- endbuild -->

     <!-- Vendors JS -->
     <script src="<?=base_url()?>/assets/backend/vendor/libs/apex-charts/apexcharts.js"></script>

     <!-- Main JS -->
     <script src="<?=base_url()?>/assets/backend/js/main.js"></script>

     <!-- Page JS -->
     <script src="<?=base_url()?>/assets/backend/js/dashboards-analytics.js"></script>

     <!-- Place this tag in your head or just before your close body tag. -->
     <script async defer src="https://buttons.github.io/buttons.js"></script>

     <!-- This is data table -->
    <script src="<?=base_url()?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>

    <!-- This is data table -->
    <script src="<?=base_url()?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="<?=base_url()?>/assets_pages/bundles/datatablescripts.bundle.js"></script>
<script src="<?=base_url()?>/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?=base_url()?>/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?=base_url()?>/assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

    <!-- DATA TABLE SCRIPTS -->
    <script src="<?=base_url()?>/assets/exportdataTables/dataTables.buttons.min.js"></script>
    <script src="<?=base_url()?>/assets/exportdataTables/buttons.flash.min.js"></script>
    <script src="<?=base_url()?>/assets/exportdataTables/jszip.min.js"></script>
    <script src="<?=base_url()?>/assets/exportdataTables/pdfmake.min.js"></script>
    <script src="<?=base_url()?>/assets/exportdataTables/vfs_fonts.js"></script>
    <script src="<?=base_url()?>/assets/exportdataTables/buttons.print.min.js"></script>
    <script src="<?=base_url()?>/assets/exportdataTables/buttons.html5.min.js"></script>
    <script src="<?=base_url()?>/assets/select2/select2.full.min.js"></script>


<script type="text/javascript" language="JavaScript">
 function konfirm_hapus()
 {
 tanya = confirm("Hapus data jurnal ?");
 if (tanya == true) return true;
 else return false;
 }
 $(document).ready(function() {
    $('#txt_id_akun').select2({
        theme: 'bootstrap-5'
    });
});
 </script>



     

   </body>
   </html>
