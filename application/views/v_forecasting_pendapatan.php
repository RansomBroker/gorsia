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
data-assets-path="<?=base_url()?>assets/backend/"
data-template="vertical-menu-template-free"
>
<head>
  <meta charset="utf-8" />
  <meta
  name="viewport"
  content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
  />

  <title>Gorsia - Member</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?=base_url()?>assets/backend/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"
  />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="<?=base_url()?>assets/backend//vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?=base_url()?>assets/backend/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/backend/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/backend/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?=base_url()?>assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="<?=base_url()?>assets/backend/vendor/libs/apex-charts/apex-charts.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css" />

  <!-- Page CSS -->
  <!-- Helpers -->
  <script src="<?=base_url()?>assets/backend/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?=base_url()?>assets/backend/js/config.js"></script>
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
                <div class="text-center">
                  Forecasting Jumlah Pendapatan 6 Bulan Terakhir
                </div>
                <?php echo form_open('Forecasting/pendapatan'); ?>
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="periode">Periode</label>
                    <input type="month" id="periode" name="periode" required class="form-control" value="<?php echo (!empty($periode)?$periode:date('Y-m')); ?>">
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="submit">&nbsp;</label>
                    <button type="submit" id="submit" class="btn btn-primary d-block">Filter</button>
                  </div>
                  </div>
                </div>
                <?php echo form_close(); ?>
              <canvas id="myChart" style="width:100%" height="400"></canvas>
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
     <script src="<?=base_url()?>assets/backend/vendor/libs/jquery/jquery.js"></script>
     <script src="<?=base_url()?>assets/backend/vendor/libs/popper/popper.js"></script>
     <script src="<?=base_url()?>assets/backend/vendor/js/bootstrap.js"></script>
     <script src="<?=base_url()?>assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

     <script src="<?=base_url()?>assets/backend/vendor/js/menu.js"></script>
     <!-- endbuild -->

     <!-- Vendors JS -->
     <script src="<?=base_url()?>assets/backend/vendor/libs/apex-charts/apexcharts.js"></script>

     <!-- Chart JS -->
     <script src="<?=base_url()?>assets/chart/chart.js"></script>

     <!-- Main JS -->
     <script src="<?=base_url()?>assets/backend/js/main.js"></script>
     <!-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> -->

     <!-- Page JS -->
     <script src="<?=base_url()?>assets/backend/js/dashboards-analytics.js"></script>
      <!-- data table -->
    <!-- <script src=" https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
   



     <!-- Place this tag in your head or just before your close body tag. -->
     <script async defer src="https://buttons.github.io/buttons.js"></script>

    

     <script type="text/javascript">
      $(document).ready(function () {
        new DataTable('#tabelmember');

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode(array_values($label)); ?>,
                datasets: [{
                    label: 'Sewa Lapangan',
                    data: <?php echo json_encode(array_values($datasets['sewa'])); ?>,
                    borderWidth: 3
                },
                {
                    label: 'Pendapatan Fitness',
                    data: <?php echo json_encode(array_values($datasets['member'])); ?>,
                    borderWidth: 2
                }]

            },
            options: {
              responsive: false,
              scales: {
                  y: {
                      beginAtZero: true
                  }
              },
              plugins: {
                  title: {
                    display: false,
                    text: 'Chart Title'
                  }
              }
            }
        });
      });
      

    </script>

  </body>
</html>