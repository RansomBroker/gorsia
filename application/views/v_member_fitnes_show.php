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
data-assets-path="assets/backend/"
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
  <link rel="icon" type="image/x-icon" href="assets/backend/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"
  />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="assets/backend//vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="assets/backend/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/backend/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/backend/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="assets/backend/vendor/libs/apex-charts/apex-charts.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css" />

  <!-- Page CSS -->
  <!-- Helpers -->
  <script src="assets/backend/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/backend/js/config.js"></script>
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Pelanggan Fitnes</h4>
              <div class="card" >
                    <h5 class="card-header">Detail Data Pelanggan</h5>
                <div id="notifications">
                  <?php echo $this->session->flashdata('msg'); ?>
                </div>
                <div class="row">
                <div class="col-xl">
                  <div class="card mb-12">
                    
                  <div class="card-body">
                <div class="row">
                    <div class="col-md-6" >
                        <h4><u><b>ID Pelanggan</b></u></h4>
                        <h5><?= $data->nomor_member ?></h5>
                    </div>
                    <div class="col-md-6" >
                        <h4><u><b>Nama Pelanggan</b></u></h4>
                        <h5><?= $data->nama_pelanggan ?></h5>
                    </div>
                    <div class="col-md-6" >
                        <h4><u><b>Jenis Kelamin</b></u></h4>
                        <h5><?= $data->jenis_kelamin ?></h5>
                    </div>
                    <div class="col-md-6" >
                        <h4><u><b>Nomor Telepon</b></u></h4>
                        <h5><?= $data->no_telepon ?></h5>
                    </div>
                    <div class="col-md-6" >
                        <h4><u><b>Email</b></u></h4>
                        <h5><?= $data->email ?></h5>
                    </div>
                    <div class="col-md-6" >
                        <h4><u><b>usia</b></u></h4>
                        <h5><?= $data->usia ?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7" >
                        <h4><u><b>Alamat</b></u></h4>
                        <h5><?= $data->alamat ?></h5>
                    </div>
                    <div class="col-md-5" >
                        <a href="<?= site_url(); ?>?/MemberFitnes" class="btn btn-success">
                            <span class="tf-icons bx bx-arrow-back"></span>&nbsp; Kembali
                        </a>
                    </div>
                </div>

                
            </div>
                  </div>
                </div>

              </div>
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
     <script src="assets/backend/vendor/libs/jquery/jquery.js"></script>
     <script src="assets/backend/vendor/libs/popper/popper.js"></script>
     <script src="assets/backend/vendor/js/bootstrap.js"></script>
     <script src="assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

     <script src="assets/backend/vendor/js/menu.js"></script>
     <!-- endbuild -->

     <!-- Vendors JS -->
     <script src="assets/backend/vendor/libs/apex-charts/apexcharts.js"></script>

     <!-- Main JS -->
     <script src="assets/backend/js/main.js"></script>
     <!-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> -->

     <!-- Page JS -->
     <script src="assets/backend/js/dashboards-analytics.js"></script>
      <!-- data table -->
    <!-- <script src=" https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
   



     <!-- Place this tag in your head or just before your close body tag. -->
     <script async defer src="https://buttons.github.io/buttons.js"></script>

    

     <script type="text/javascript">
         $(document).ready(function() {
             new DataTable('#tabelmember');
         });
     </script>

  </body>
</html>