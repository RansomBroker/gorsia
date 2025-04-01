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

  <title>Gorsia - Supplier</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Supplier</h4>


              <div class="row">
                <?php
                echo form_open_multipart(site_url().'?/KategoriOlahraga/insert_data'); 
                ?>
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Isi data supplier</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Kode Suplier</label>
                          <input type="text" class="form-control" id="kode_suplier" name="kode_suplier" placeholder="Isi kode supplier" required />
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Nama Suplier</label>
                          <input type="text" class="form-control" id="nama_suplier" name="nama_suplier" placeholder="Isi nama supplier" required />
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Alamat</label>
                          <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Isi alamat" required />
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Telepon</label>
                          <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Isi telepon" required />
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">E-mail</label>
                          <input type="text" class="form-control" id="email" name="email" placeholder="Isi email" required />
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

                <h5 class="card-header">Data Supplier</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Kode</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                     <?php $no=0;
                     foreach($get_all_supplier as $row) {    
                      $no++; 

                      $kode_suplier = $row->kode_suplier;
                      $nama_suplier= $row->nama_suplier;
                      $alamat= $row->alamat;
                      $telepon= $row->telepon;
                      $email= $row->email;

                      echo '<tr>
                      <td>'.$kode_suplier.'</td>
                      <td>'.$nama_suplier.'</td>
                      <td align="left">';
                      if ($akses_update=="Aktif"){


                        echo '<a data-bs-toggle="modal" data-bs-target="#modal-update-data'.$kode_suplier.'"><i class="bx bx-edit-alt me-2"></i>Edit</a>'; echo '&nbsp;&nbsp;' ;}
                        if ($akses_delete=="Aktif"){
                          echo '<a onclick="return konfirm_hapus()" href="'.site_url().'?/Supplier/delete_data/id/'.$kode_suplier.'"><i class="bx bx-trash me-2"></i> Delete</a>';}
                          echo '</td><tr>';

                          echo form_open_multipart(site_url().'?/Supplier/update_data'); 
                          echo '<div class="modal fade" id="modal-update-data'.$kode_suplier.'" tabindex="-1" aria-hidden="true" style="display: none;">

                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Edit Supplier</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Kategori Olahraga</label>
                                    <input type="hidden" id="kode_suplier" name="kode_suplier" class="form-control" placeholder="Isi Kode" value="'.$kode_suplier.'" required="">
                                    <input type="text" id="nama_suplier" name="nama_suplier" class="form-control" placeholder="Isi Nama Supplier" value="'.$nama_suplier.'" required="">
                                  </div>
                                </div>

                                <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Alamat</label>
                          <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Isi alamat" value="'.$alamat.'" required />
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Telepon</label>
                          <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Isi telepon" value="'.$telepon.'" required />
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">E-mail</label>
                          <input type="text" class="form-control" id="email" name="email" placeholder="Isi email" value="'.$email.'" required />
                        </div>
                                

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Tutup
                                </button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                              </div>
                            </div>
                          </div>
                        </div>';
                          echo form_close(); 


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
