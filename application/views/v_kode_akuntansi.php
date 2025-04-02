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

  <title>Gorsia - Kode Akuntansi</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Akuntansi /</span> Kode Akuntansi</h4>

              <!-- Basic Bootstrap Table -->

              <div id="notifications">
                <?php echo $this->session->flashdata('msg'); ?>
              </div>

              <div class="card">

                <div class="card-header">
                  <h5 class="float-start">
                    Data Kode Akuntansi
                  </h5>
                  <a data-bs-toggle="modal" class="btn btn-primary text-white float-end" data-bs-target="#modal-tambah-data">
                    <i class="bx bx-plus me-2"></i>
                    Tambah
                  </a>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Kode Akun</th>
                        <th>Nama Akun</th>
                        <th>Parent</th>
                        <th>Saldo Normal</th>
                        <th>Pos</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                     <?php $no=0;
                     foreach($get_all_akun as $row) {    
                      $no++; 

                      $id_kode_akuntansi = $row->id_kode_akuntansi;
                      $level = $row->level;
                      $is_parent= $row->is_parent;
                      $kode_parent= $row->kode_parent;
                      $kode_akun= $row->kode_akun;
                      $nama_akun= $row->nama_akun;
                      $saldo_normal= $row->saldo_normal;
                      $pos= $row->pos;


                      echo '<tr>
                      <td>'.$kode_akun.'</td>
                      <td>'.$nama_akun.'</td>
                      <td>'.$kode_parent.'</td>
                      <td>'.$saldo_normal.'</td>
                      <td>'.$pos.'</td>
                      <td align="left">';
                      if ($akses_update=="Aktif"){


                        echo '<a data-bs-toggle="modal" data-bs-target="#modal-update-data'.$id_kode_akuntansi.'"><i class="bx bx-edit-alt me-2"></i>Edit</a>'; echo '&nbsp;&nbsp;' ;}
                        if ($akses_delete=="Aktif"){
                          echo '<a onclick="return konfirm_hapus()" href="'.site_url().'?/KodeAkuntansi/delete_data/id/'.$id_kode_akuntansi.'"><i class="bx bx-trash me-2"></i> Delete</a>';}
                          echo '</td><tr>';

                          echo form_open_multipart(site_url().'?/KodeAkuntansi/update_data'); 
                          echo '<div class="modal fade" id="modal-update-data'.$id_kode_akuntansi.'" tabindex="-1" aria-hidden="true" style="display: none;">

                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Edit Kode Akuntansi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">

                                <input type="hidden" id="id_akun" name="id_akun" class="form-control" placeholder="" value="'.$id_kode_akuntansi.'" required="">

                                <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Level</label>
                                <select class="form-select" id="level" name="level" aria-label="Default select example" required>
                                <option selected value="'.$level.'">'.$level.'</option>
                                <option >- - - Pilih - - -</option>
                                <option value="1"> 1 (Parent) </option>
                                <option value="2"> 2 </option>
                                </select>
                                </div>


                                <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Parent</label>
                                <select class="form-select" id="kode_parent" name="kode_parent" aria-label="Default select example" required>
                                <option selected value="'.$kode_parent.'">'.$kode_parent.'</option>
                                <option >- - - Pilih - - -</option>';
                                foreach($get_all_kode_parent as $row) {  
                                  $kode_akun_parent_cb = $row->kode_akun;
                                  $nama_akun_parent_cb = $row->nama_akun;
                                  print "<option value='$kode_akun_parent_cb'>kode_akun_parent_cb - $nama_akun_parent_cb</option>";
                                  }
                                echo'</select>
                                  </div>

                                  <div class="mb-3">
                                  <label class="form-label" for="basic-default-company">Kode Akun</label>
                                  <input type="text" class="form-control" id="kode_akun" name="kode_akun" placeholder="Isi kode akun" value="'.$kode_akun.'" required />
                                  </div>
                                  <div class="mb-3">
                                  <label class="form-label" for="basic-default-company">Nama Akun</label>
                                  <input type="text" class="form-control" id="nama_akun" name="nama_akun" placeholder="Isi nama akun" value="'.$nama_akun.'" required />
                                  </div>

                                  <div class="mb-3">
                                  <label class="form-label" for="basic-default-fullname">Saldo Normal</label>
                                  <select class="form-select" id="saldo_normal" name="saldo_normal" aria-label="Default select example" required>
                                  <option selected value="'.$saldo_normal.'">'.$saldo_normal.'</option>
                                  <option >- - - Pilih - - -</option>
                                  <option value="Debet"> Debet </option>
                                  <option value="Kredit"> Kredit </option>
                                  </select>
                                  </div>

                                  <div class="mb-3">
                                  <label class="form-label" for="basic-default-fullname">Pos Laporan</label>
                                  <select class="form-select" id="pos" name="pos" aria-label="Default select example" required>
                                  <option selected value="'.$pos.'">'.$pos.'</option>
                                  <option >- - - Pilih - - -</option>
                                  <option value="Neraca"> Neraca </option>
                                  <option value="Laba Rugi"> Laba Rugi </option>
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


                <!-- Modal Tambah Kode Akuntansi -->
                <div class="modal fade" id="modal-tambah-data" tabindex="-1" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Tambah Kode Kode Akuntansi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <?php
                        echo form_open_multipart(site_url().'?/KodeAkuntansi/insert_data'); 
                      ?>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-xl">
                            <div class="card mb-4">
                              <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Isi data kode akuntansi</h5>
                                <small class="text-muted float-end"></small>
                              </div>
                              <div class="card-body">
                                  <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Level</label>
                                    <select class="form-select" id="level" name="level" aria-label="Default select example" required>
                                      <option selected>- - - Pilih - - -</option>
                                      <option value="1"> 1 (Parent) </option>
                                      <option value="2"> 2 </option>
                                    </select>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Parent</label>
                                    <select class="form-select" id="kode_parent" name="kode_parent" aria-label="Default select example" required>
                                      <option selected>- - - Pilih - - -</option>
                                      <?php foreach($get_all_kode_parent as $row) {  
                                        $kode_akun_parent_cb = $row->kode_akun;
                                        $nama_akun_parent_cb = $row->nama_akun;
                                        print "<option value='$kode_akun_parent_cb'>$kode_akun_parent_cb - $nama_akun_parent_cb</option>";
                                      } ?>
                                    </select>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Kode Akun</label>
                                    <input type="text" class="form-control" id="kode_akun" name="kode_akun" placeholder="Isi kode akun" required />
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Nama Akun</label>
                                    <input type="text" class="form-control" id="nama_akun" name="nama_akun" placeholder="Isi nama akun" required />
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Saldo Normal</label>
                                    <select class="form-select" id="saldo_normal" name="saldo_normal" aria-label="Default select example" required>
                                      <option selected>- - - Pilih - - -</option>
                                      <option value="Debet"> Debet </option>
                                      <option value="Kredit"> Kredit </option>
                                    </select>
                                  </div>

                              <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Pos Laporan</label>
                                    <select class="form-select" id="pos" name="pos" aria-label="Default select example" required>
                                      <option selected>- - - Pilih - - -</option>
                                      <option value="Neraca"> Neraca </option>
                                      <option value="Laba Rugi"> Laba Rugi </option>
                                    </select>
                                  </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                          Tutup
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                      </div>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>
                <!--/ Modal Tambah Kode Akuntansi -->
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
