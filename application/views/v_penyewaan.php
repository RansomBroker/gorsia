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

  <title>Gorsia - Sewa Lapangan</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Sewa Lapangan</h4>


              <div class="row mb-5">
               

                 <?php 
                     foreach($get_all_lapangan as $row_lp) {    

                      $id_lapangan = $row_lp->id_lapangan;
                      $id_kategori_olahraga = $row_lp->id_kategori_olahraga;
                      $nama_lapangan = $row_lp->nama_lapangan;
                      $ukuran_lapangan = $row_lp->ukuran_lapangan;
                      $maksimal_kapasitas_orang = $row_lp->maksimal_kapasitas_orang;

                      #kategori
                      $rows_kategori = $this->db->query("SELECT * FROM kategori_olahraga where id_kategori_olahraga='".$id_kategori_olahraga."'")->row_array();
                      $kategori_olahraga=$rows_kategori['kategori_olahraga'];

                      if($kategori_olahraga=="Futsal"){
                        $img_lapangan = "1.jpg";
                      }
                      elseif($kategori_olahraga=="Badminton"){
                        $img_lapangan = "2.jpg";
                      }
                      else{
                         $img_lapangan = "no_image.jpg";
                      }

                      #harga
                      $rows_harga = $this->db->query("SELECT * FROM paket_sewa where id_kategori_olahraga='".$id_kategori_olahraga."'")->row_array();
                      $harga=$rows_harga['harga'];
                      $id_satuan=$rows_harga['id_satuan'];

                      #satuan
                      $rows_satuan = $this->db->query("SELECT * FROM satuan_sewa where id_satuan_sewa='".$id_satuan."'")->row_array();
                      $satuan_sewa=$rows_satuan['satuan_sewa'];


                      ?>

 
                       

                <div class="col-md-6 col-lg-4">
                  <h6 class="mt-2 text-muted"><br></h6>
                  <div class="card">
                    <img class="card-img-top" src="assets/images/lapangan/<?= $img_lapangan; ?>" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title"><?= $kategori_olahraga; ?></h5>
                      <p class="card-text"><?= $nama_lapangan; ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Ukuran <?= $ukuran_lapangan; ?></li>
                      <li class="list-group-item">Maksimal <?= $maksimal_kapasitas_orang; ?> Orang</li>
                      <li class="list-group-item">Harga Mulai <b> Rp <?= number_format($harga); ?></b> / <?= $satuan_sewa; ?></li>
                    </ul>
                    <div class="card-body">
                      <?php
                echo form_open_multipart(site_url().'?/Penyewaan/insert_data_pilih_lapangan'); 
                ?>
                <form>
                          <input type="hidden" class="form-control" id="id_lapangan" name="id_lapangan" placeholder="" value="<?= $id_lapangan; ?>" required />
                          <input type="hidden" class="form-control" id="id_kategori_olahraga" name="id_kategori_olahraga" placeholder="" value="<?= $id_kategori_olahraga; ?>" required />


                      <button type="submit" class="btn btn-primary">Sewa</button>
               </form>

                       <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>

              

               


              <?php } ?>





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
