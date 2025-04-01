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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span>Daftar Member</h4>
              <div class="card" >
                    <h5 class="card-header">Data Member</h5>
                <div id="notifications">
                  <?php echo $this->session->flashdata('msg'); ?>
                </div>
                <div class="table-responsive text-nowrap p-3">
			 <a href="<?= site_url() ?>?/DaftarMember/create" class="btn btn-primary" style="float: right;">
                              <span class="tf-icons bx bx-plus-medical"></span>&nbsp; Tambah
</a><br><br><br>
				<table class="table table-hover mt-3 mb-3" id="tabelmember">
					<thead>
						<tr>
						<!-- <th>No</th> -->
						<th>Nomor Member</th>
						<th>Nama </th>
						<th>Jenis Kelamin</th>
						<!-- <th>Jenis Bayar</th> -->
						<!-- <th>Metode Bayar</th>
						<th>Tanggal Mulai</th>
						<th>Expired Member</th> -->
            <th>Expired Member</th>
            <!-- <th>Status Member</th> -->
						<th>Aksi</th>
						</tr>
					</thead>
					<tbody class="table-border-bottom-0">
         <?php $no = 1; ?>
         <?php foreach ($data as $key => $value) { ?>
          <tr>
            <!-- <td><?= $no ?></td> -->
            <td><?= $value['kodeMember'] ?></td>
            <td><?= $value['nama'] ?></td>
            <td><?= $value['jk'] == 'P' ? 'Perempuan' : 'Laki-Laki' ?></td>
            <!-- <td><?= $value['metode_bayar'] ?></td>
            <td><?= $value['tanggal_mulai'] ?></td>
            <td><?= $value['expired']; ?></td> -->
            <td><?= isset($value['expired_member']) ? $value['expired_member'] : '-'; ?></td>
            <!-- <td>
            <?php if ($value['expired_member'] == date('Y-m-d')) { ?>
                                <span class="badge bg-danger">Expired</span>
                               <?php } else {  ?> <span class="badge bg-success"> <?= date('Y-m-d') ?>Aktif</span><?php } ?>
            </td> -->
            <td>
              <a  href="<?php echo base_url() . "?/DaftarMember/perpanjangMember/$value[id]" ?>"><span class="badge bg-info">Perpanjang</span> </a>
              <a  href="<?php echo base_url() . "?/DaftarMember/show/$value[id]" ?>"><span class="badge bg-primary">Histori</span> </a>
          </td>
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
      $(document).ready(function () {
        new DataTable('#tabelmember');
      });
    </script>

  </body>
</html>