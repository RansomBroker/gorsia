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

  <title>Gorsia - Akun User</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Akun User</h4>


              <div class="row">
                <?php
                echo form_open_multipart(site_url().'?/AkunUser/insert_data'); 
                ?>
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Isi data akun user</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Hak Akses</label>
                          <select class="form-select" id="hak_akses" name="hak_akses" aria-label="Default select example" required>
                            <option selected>- - - Pilih - - -</option>
                            <?php foreach($get_all_hak_akses as $row) {  
                              $hak_akses_cb = $row->hak_akses;
                              print "<option value='$hak_akses_cb'>$hak_akses_cb</option>";
                            } ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Nama Lengkap</label>
                          <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Isi nama lengkap" required />
                        </div>
                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Username</label>
                          <input type="text" class="form-control" id="username" name="username" placeholder="Isi username" required />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Isi Password" required>
                        </div>
                     
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Status Aktif</label>
                          <br>

                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="radio_status_aktif" id="inlineRadio_aktif" value="Aktif">
                            <label class="form-check-label" for="inlineRadio_aktif">Aktif</label>
                          </div>

                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radio_status_aktif" id="inlineRadio_nonaktif" value="Non Aktif">
                            <label class="form-check-label" for="inlineRadio_nonaktif">Tidak Aktif</label>
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

                <h5 class="card-header">Data Akun User</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Hak Akses</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Foto</th>
                        <th>Status Aktif</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                     <?php $no=0;
                     foreach($get_all_user as $row) {    
                      $no++; 

                      $id_user_dt = $row->id;
                      $nama_lengkap_dt = $row->nama_lengkap;
                      $username_dt= $row->username;
                      $hak_akses_dt= $row->hak_akses;
                      $foto_dt= $row->foto;
                      $status_aktif_dt= $row->status;

                      echo '<tr>
                      <td>'.$hak_akses_dt.'</td>
                      <td>'.$nama_lengkap_dt.'</td>
                      <td>'.$username_dt.'</td>
                      <td><a onclick="return konfirm_reset_pwd()" href="'.site_url().'?/AkunUser/reset_password/id/'.$id_user_dt.'">Reset</a></td>
                      <td><img src="assets/backend/img/avatars/'.$foto_dt.'" width="30px" /></td>
                      <td>'.$status_aktif_dt.'</td>
                      <td align="left">';
                      if ($akses_update=="Aktif"){


                        echo '<a data-bs-toggle="modal" data-bs-target="#modal-update-data'.$id_user_dt.'"><i class="bx bx-edit-alt me-2"></i>Edit</a>'; echo '&nbsp;&nbsp;' ;}
                        if ($akses_delete=="Aktif"){
                          echo '<a onclick="return konfirm_hapus()" href="'.site_url().'?/AkunUser/delete_data/id/'.$id_user_dt.'"><i class="bx bx-trash me-2"></i> Delete</a>';}
                          echo '</td><tr>';

                          echo form_open_multipart(site_url().'?/AkunUser/update_data'); 
                          echo '<div class="modal fade" id="modal-update-data'.$id_user_dt.'" tabindex="-1" aria-hidden="true" style="display: none;">

                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Edit Akun User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">

                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Hak Akses</label>
                                    <input type="hidden" id="id_user" name="id_user" class="form-control" placeholder="" value="'.$id_user_dt.'" required="">
                                     <select class="form-select" id="hak_akses" name="hak_akses" aria-label="Default select example" required>
                                     <option value="'.$hak_akses_dt.'">'.$hak_akses_dt.'</option>
                                     <option>- - - Pilih - - -</option>';
                                     foreach($get_all_hak_akses as $row) {  
                                      $hak_akses_cb = $row->hak_akses;
                                      print "<option value='$hak_akses_cb'>$hak_akses_cb</option>";
                                    } 
                                      echo '</select>
                                  </div>

                                  <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Isi nama lengkap" value="'.$nama_lengkap_dt.'" required />
                                  </div>

                                  <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Isi username"  value="'.$username_dt.'"required />
                                  </div>


                                <div class="mb-3">
                                    <label for="emailBasic" class="form-label">Status Aktif</label>
                                    <select name="status_aktif" id="status_aktif" required="" class="form-select">
                                    <option value="'.$status_aktif_dt.'">'.$status_aktif_dt.'</option>
                                    <option value=""> - - - Pilih - - - </option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                    </select>
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

     <script type="text/javascript">
      function konfirm_reset_pwd()
      {
        tanya = confirm("Yakin reset password akun?");
       if (tanya == true) return true;
       else return false;
     }</script>

     

   </body>
   </html>
