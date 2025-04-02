<?php
include_once 'v_user_config.php';
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

  <title>Gorsia - Jurnal Umum</title>

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
  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/vendor/libs/apex-charts/apex-charts.css" />

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Laporan /</span> Jurnal Umum</h4>


              <div class="card">

                <div id="notifications">
                  <?php echo $this->session->flashdata('msg'); ?>
                </div>

                <div class="card-header">
                  <h5 class="float-start">Jurnal Umum</h5>
                  <a class="btn btn-primary text-white float-end" href="<?= site_url(); ?>?/TransaksiJurnal">
                    <i class="bx bx-plus me-2"></i>
                    Tambah
                  </a>
                </div>

                <div class="card-body">
                  <form action="<?=site_url()?>/JurnalUmum/filter" method="GET">
                    <div class="row mb-3">
                        <div class="col-md-4">
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
                        <div class="col-md-4">
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
                      <div class="col-md-4 d-flex gap-3 align-items-end justify-content-end">
                        <button type="submit" class="btn btn-primary" id="filter_btn">Filter</button>
                        <a href="<?=site_url()?>/JurnalUmum" class="btn btn-secondary" id="reset_btn">Reset</a>
                      </div>
                    </div>
                  </form>
                  <table class="table table-responsive table-borderless">
                    <thead class="border-top-0 border-start-0 border-end-0 border-2 border-dark">
                      <tr>
                        <th>Tanggal</th>
                        <th style="width: 250px;">Akun</th>
                        <th style="width: 250px;">Keterangan</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $totalDebet = 0;
                      $totalKredit = 0;
                      $tempTanggal = "";
                      $noBukti = "";
                      $class = "";
                      foreach($jurnal as $isi) {
                        if ($noBukti != $isi->no_bukti) {
                          $noBukti = $isi->no_bukti;
                          $class = "border-top";
                        } else{
                          $class = "border-top-0";
                        }
                        $tanggal = "";
                        if($tempTanggal != $isi->tanggal) {
                          $tanggal = $isi->tanggal;
                        }
                        $tempTanggal = $isi->tanggal;
                        $debet = number_format($isi->debet,2,',','.');
                        $kredit = number_format($isi->kredit,2,',','.');
                        echo <<<HTML
                        <tr class="{$class}">
                          <td>{$tanggal}</td>
                          <td>{$isi->uraian}</td>
                          <td>{$isi->keterangan}</td>
                          <td>Rp. <span class="float-end">{$debet}</span></td>
                          <td>Rp. <span class="float-end">{$kredit}</span></td>
                        </tr>
                        HTML;
                        $totalDebet += $isi->debet;
                        $totalKredit += $isi->kredit;
                      }
                    ?>
                    <tr class="fw-bold border-2 border-bottom-0 border-start-0 border-end-0 border-dark">
                      <td colspan="2">Total</td>
                      <td>
                        <?php
                          if ($totalDebet == $totalKredit) {
                            echo "Balance";
                          } else {
                            echo "Selisih";
                          }
                        ?>
                      </td>
                      <td>Rp. <span class="float-end"><?= number_format($totalDebet,2,',','.') ?></span></td>
                      <td>Rp. <span class="float-end"><?= number_format($totalKredit,2,',','.') ?></span></td>
                    </tr>
                    </tbody>
                  </table>
                </div>

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

     <script type="text/javascript">
      function konfirm_hapus()
      {
        tanya = confirm("Hapus data ?");
       if (tanya == true) return true;
       else return false;
     }</script>

   </body>
   </html>
