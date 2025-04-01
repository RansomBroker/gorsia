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

  <title>Gorsia - Setting Penjualan Terhadap Akuntansi</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Akuntansi /</span> Setting Penjualan Terhadap Akuntansi</h4>


              <div class="row">
                <?php
                echo form_open_multipart(site_url().'?/SettingPenjualanTerhadapAkuntansi/insert_data'); 
                ?>
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Isi data setting</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Kode Akuntansi</label>
                          <select class="form-select" id="kode_akun" name="kode_akun" aria-label="Default select example" required>
                            <option selected>- - - Pilih - - -</option>
                            <?php foreach($get_all_data_akun as $row) {  
                              $kode_akun_cb = $row->kode_akun;
                              $nama_akun_cb = $row->nama_akun;
                              print "<option value='$kode_akun_cb'>$kode_akun_cb - $nama_akun_cb</option>";
                            } ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Posisi Saldo</label>
                         <select class="form-select" id="posisi_saldo" name="posisi_saldo" aria-label="Default select example" required>
                            <option>- - - Pilih - - -</option>
                            <option value="Debet">Debet</option>
                            <option value="Kredit">Kredit</option>
                          </select>
                        </div>
                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Kode Jenis Jurnal</label>
                          <select class="form-select" id="kode_jenis_jurnal" name="kode_jenis_jurnal" aria-label="Default select example" required>
                            <option selected>- - - Pilih - - -</option>
                            <?php foreach($get_all_data_kode_jenis_jurnal as $row) {  
                              $kode_jenis_jurnal_cb = $row->kode_jenis_jurnal;
                              $deskripsi_cb = $row->deskripsi;
                              print "<option value='$kode_jenis_jurnal_cb'>$kode_jenis_jurnal_cb - $deskripsi_cb</option>";
                            } ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Deskripsi</label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Isi deksripsi" aria-label="" aria-describedby="basic-addon13" required>
                          </div>
                        </div>
                     

                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
                <?php echo form_close(); ?>

              </div>

              <!-- Basic Bootstrap Table -->

              <div class="card">

                <div id="notifications">
                  <?php echo $this->session->flashdata('msg'); ?>
                </div>

                <h5 class="card-header">Data Lapangan</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>ID Setting</th>
                        <th>Kode Akun</th>
                        <th>Nama Akun</th>
                        <th>Posisi Saldo</th>
                        <th>Kode Jenis Jurnal</th>
                        <th>Deskripsi</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                     <?php $no=0;
                     foreach($get_all_setting as $row) {    
                      $no++; 

                      $id_setting = $row->id_setting;
                      $kode_akun = $row->kode_akun;
                      $nama_akun= $row->nama_akun;
                      $posisi_saldo= $row->posisi_saldo;
                      $kode_jenis_jurnal= $row->kode_jenis_jurnal;
                      $deskripsi= $row->deskripsi;

                      
                      echo '<tr>
                      <td>'.$id_setting.'</td>
                      <td>'.$kode_akun.'</td>
                      <td>'.$nama_akun.'</td>
                      <td>'.$kode_jenis_jurnal.'</td>
                      <td>'.$posisi_saldo.'</td>
                      <td>'.$deskripsi.'</td>
                      <td align="left">';

                          echo '<a onclick="return konfirm_hapus()" href="'.site_url().'?/SettingPenjualanTerhadapAkuntansi/delete_data/id/'.$id_setting.'"><i class="bx bx-trash me-2"></i> Delete</a>';
                          echo '</td><tr>';
                         

                        }
                        ?>



                      </tbody>
                    </table>
                  </div>
                </div>
                <!--/ Basic Bootstrap Table -->

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

     <!-- Page JS -->
     <script src="assets/backend/js/dashboards-analytics.js"></script>

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
