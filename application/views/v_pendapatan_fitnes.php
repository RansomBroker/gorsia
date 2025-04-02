<?php
include_once 'v_user_config.php';
?>

<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="<?=base_url()?>/assets/backend/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta
  name="viewport"
  content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
  />

  <title>Gorsia - Rekap Pembayaran</title>

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
      <div class="layout-page">
        <?php include_once 'v_navbar.php'; ?>
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
              <h5 class="card-header">Data Pendapatan Fitnes</h5>
              <div id="notifications">
                <?php echo $this->session->flashdata('msg'); ?>
              </div>              
              <div class="table-responsive text-nowrap p-3">
              <?php
                // Inisialisasi nilai default jika belum ada (bulan dan tahun berjalan)
                if (!isset($periode) || empty($periode)) {
                    $periode = date('m'); // Format '01', '02', dst.
                }
                if (!isset($tahun) || empty($tahun)) {
                    $tahun = date('Y');
                }
              ?>
              <form action="<?=site_url()?>/PendapatanFitnes/filter"  method="GET">
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
                                  $selected = ($periode == $num) ? 'selected' : '';
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
                                  $selected = ($tahun == $i) ? 'selected' : '';
                                  echo "<option value='$i' $selected>$i</option>";
                              }
                              ?>
                          </select>
                      </div>
                      <div class="col-md-4 d-flex gap-3 align-items-end justify-content-end">
                          <button type="submit" class="btn btn-primary" id="filter_btn">Filter</button>
                          <a href="<?= site_url() ?>?/PendapatanFitnes" class="btn btn-secondary" id="reset_btn">Reset</a>
                      </div>
                  </div>
              </form>
                <table class="table table-hover mt-3 mb-3" id="tabelmember">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>Metode bayar</th>
                      <th>Total bayar</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php $no = 1; ?>
                    <?php foreach ($dataPendapatan as $key => $value) { ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $value['created_at'] ?></td>
                        <td><?= $value['nama'] ?></td>
                        <td><?= $value['metodebayar'] ?></td>
                        <td><?= $value['harga'] * ($value['durasiMember']/30) ?></td>
                      </tr>
                    <?php $no++;
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <footer class="content-footer footer bg-footer-theme">
            <?php include_once 'v_footer.php'; ?>
          </footer>
          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  </div>
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

  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

     <script type="text/javascript">
      function konfirm_hapus()
      {
        tanya = confirm("Hapus data ?");
       if (tanya == true) return true;
       else return false;
     }</script>


  <script type="text/javascript">
    $(document).ready(function() {
      new DataTable('#tabelmember');
    });
  </script>

</body>

</html>