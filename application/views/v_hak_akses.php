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

  <title>Gorsia - Hak Akses</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengguna /</span> Hak Akses</h4>


              <div class="row">
                <?php
                echo form_open_multipart(site_url().'?/HakAkses/insert_data'); 
                ?>
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Isi data hak akses (previledge)</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <form>
                       
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Hak Akses</label>
                          <input type="text" class="form-control" id="hak_akses" name="hak_akses" placeholder="Isi hak akses" required />
                        </div>


                        <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="CreateCheck" name="CreateCheck" value="1">
                        <label class="form-check-label" for="CreateCheck">Create</label>
                       </div>

                       <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="ReadCheck" name="ReadCheck"  value="1">
                        <label class="form-check-label" for="ReadCheck">Read</label>
                       </div>

                       <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="UpdateCheck" name="UpdateCheck" value="1">
                        <label class="form-check-label" for="UpdateCheck">Update</label>
                       </div>

                       <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="DeleteCheck" name="DeleteCheck" value="1">
                        <label class="form-check-label" for="DeleteCheck">Delete</label>
                       </div>

                       <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="PrintCheck" name="PrintCheck" value="1">
                        <label class="form-check-label" for="PrintCheck">Print</label>
                       </div>


                         
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Menu Master</label>
                          <br>
                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="radio_menu_master" id="inlineRadiomaster_aktif" value="Aktif">
                            <label class="form-check-label" for="inlineRadiomaster_aktif">Aktif</label>
                          </div>

                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radio_menu_master" id="inlineRadiomaster_tidakaktif" value="Non Aktif">
                            <label class="form-check-label" for="inlineRadiomaster_tidakaktif">Tidak Aktif</label>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Menu Pengguna</label>
                          <br>

                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="radio_menu_pengguna" id="inlineRadiopengguna_aktif" value="Aktif">
                            <label class="form-check-label" for="inlineRadiopengguna_aktif">Aktif</label>
                          </div>

                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radio_menu_pengguna" id="inlineRadiopengguna_tidakaktif" value="Non Aktif">
                            <label class="form-check-label" for="inlineRadiopengguna_tidakaktif">Tidak Aktif</label>
                          </div>

                        </div>


                         <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Menu Operasional</label>
                          <br>

                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="radio_menu_operasional" id="inlineRadiooperasional_aktif" value="Aktif">
                            <label class="form-check-label" for="inlineRadiooperasional_aktif">Aktif</label>
                          </div>

                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radio_menu_operasional" id="inlineRadiooperasional_tidakaktif" value="Non Aktif">
                            <label class="form-check-label" for="inlineRadiooperasional_tidakaktif">Tidak Aktif</label>
                          </div>
                        </div>


                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Menu Akuntansi</label>
                          <br>

                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="radio_menu_akuntansi" id="inlineRadioakuntansi_aktif" value="Aktif">
                            <label class="form-check-label" for="inlineRadioakuntansi_aktif">Aktif</label>
                          </div>

                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radio_menu_akuntansi" id="inlineRadioakuntansi_tidakaktif" value="Non Aktif">
                            <label class="form-check-label" for="inlineRadioakuntansi_tidakaktif">Tidak Aktif</label>
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

                <h5 class="card-header">Data Hak Akses</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Hak Akses</th>
                        <th>Fungsi Opsi</th>
                        <th>Menu Master</th>
                        <th>Menu Pengguna</th>
                        <th>Menu Operasional</th>
                        <th>Menu Akuntansi</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                     <?php $no=0;
                     foreach($get_all_hak_akses as $row) {    
                      $no++; 

                      $id_dt = $row->id;
                      $hak_akses_dt = $row->hak_akses;
                      $akses_create_check = $row->akses_create;
                      $akses_read_check = $row->akses_read;
                      $akses_update_check = $row->akses_update;
                      $akses_delete_check = $row->akses_delete;
                      $akses_cetak_check = $row->akses_cetak;
                      $menu_master_dt = $row->menu_master;
                      $menu_pengguna_dt = $row->menu_pengguna;
                      $menu_operasional_dt = $row->menu_operasional;
                      $menu_akuntansi_dt = $row->menu_akuntansi;

                      if($akses_create_check=="Aktif"){
                        $akses_create_dt = "<i class='bx bx-check'></i>";
                      }
                      else{
                        $akses_create_dt = "<i class='bx bx-x'></i>";
                      }

                      if($akses_read_check=="Aktif"){
                        $akses_read_dt = "<i class='bx bx-check'></i>";
                      }
                      else{
                        $akses_read_dt = "<i class='bx bx-x'></i>";
                      }

                      if($akses_update_check=="Aktif"){
                        $akses_update_dt = "<i class='bx bx-check'></i>";
                      }
                      else{
                        $akses_update_dt = "<i class='bx bx-x'></i>";
                      }

                      if($akses_delete_check=="Aktif"){
                        $akses_delete_dt = "<i class='bx bx-check'></i>";
                      }
                      else{
                        $akses_delete_dt = "<i class='bx bx-x'></i>";
                      }

                      if($akses_cetak_check=="Aktif"){
                        $akses_cetak_dt = "<i class='bx bx-check'></i>";
                      }
                      else{
                        $akses_cetak_dt = "<i class='bx bx-x'></i>";
                      }





                      echo '<tr>
                      <td>'.$hak_akses_dt.'</td>
                      <td>Create &nbsp;: '.$akses_create_dt.' <br>Read &nbsp;&nbsp;&nbsp; : '.$akses_read_dt.' <br>Update : '.$akses_update_dt.' <br>Delete &nbsp;: '.$akses_delete_dt.' <br>Print &nbsp;&nbsp;&nbsp;&nbsp; : '.$akses_cetak_dt.'</td>
                      <td>'.$menu_master_dt.'</td>
                      <td>'.$menu_pengguna_dt.'</td>
                      <td>'.$menu_operasional_dt.'</td>
                      <td>'.$menu_akuntansi_dt.'</td>
                      <td align="left">';
                      if ($akses_update=="Aktif"){


                        echo '<a data-bs-toggle="modal" data-bs-target="#modal-update-data'.$id_dt.'"><i class="bx bx-edit-alt me-2"></i>Edit</a>'; echo '&nbsp;&nbsp;' ;}
                        if ($akses_delete=="Aktif"){
                          echo '<a onclick="return konfirm_hapus()" href="'.site_url().'?/HakAkses/delete_data/id/'.$id_dt.'"><i class="bx bx-trash me-2"></i> Delete</a>';}
                          echo '</td><tr>';

                          echo form_open_multipart(site_url().'?/HakAkses/update_data'); 
                          echo '<div class="modal fade" id="modal-update-data'.$id_dt.'" tabindex="-1" aria-hidden="true" style="display: none;">

                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Edit Hak Akses</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">

                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Hak Akses</label>
                                    <input type="hidden" id="id_hak_akses" name="id_hak_akses" class="form-control" placeholder="" value="'.$id_dt.'" required="">
                                    <input type="text" id="hak_akses" name="hak_akses" class="form-control" placeholder="" value="'.$hak_akses_dt.'" required="" readonly="">
                                     
                                  </div>

                                  <div class="form-check form-switch mb-2">
                                  <input class="form-check-input" type="checkbox" id="CreateCheck" name="CreateCheck" value="1" '; if ($akses_create_check=="Aktif"){ echo 'checked'; } echo '>
                                  <label class="form-check-label" for="CreateCheck">Create</label>
                                  </div>

                                  <div class="form-check form-switch mb-2">
                                  <input class="form-check-input" type="checkbox" id="ReadCheck" name="ReadCheck"  value="1" '; if ($akses_read_check=="Aktif"){ echo 'checked'; } echo '>
                                  <label class="form-check-label" for="ReadCheck">Read</label>
                                  </div>

                                  <div class="form-check form-switch mb-2">
                                  <input class="form-check-input" type="checkbox" id="UpdateCheck" name="UpdateCheck" value="1" '; if ($akses_update_check=="Aktif"){ echo 'checked'; } echo '>
                                  <label class="form-check-label" for="UpdateCheck">Update</label>
                                  </div>

                                  <div class="form-check form-switch mb-2">
                                  <input class="form-check-input" type="checkbox" id="DeleteCheck" name="DeleteCheck" value="1" '; if ($akses_delete_check=="Aktif"){ echo 'checked'; } echo '>
                                  <label class="form-check-label" for="DeleteCheck">Delete</label>
                                  </div>

                                  <div class="form-check form-switch mb-2">
                                  <input class="form-check-input" type="checkbox" id="PrintCheck" name="PrintCheck" value="1" '; if ($akses_cetak_check=="Aktif"){ echo 'checked'; } echo '>
                                  <label class="form-check-label" for="PrintCheck">Print</label>
                                  </div>


                                   <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Menu Master</label>
                          <br>
                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="radio_menu_master" id="inlineRadiomaster_aktif" value="Aktif" '; if ($menu_master_dt=="Aktif"){ echo 'checked'; } echo ' >
                            <label class="form-check-label" for="inlineRadiomaster_aktif">Aktif</label>
                          </div>

                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radio_menu_master" id="inlineRadiomaster_tidakaktif" value="Non Aktif">
                            <label class="form-check-label" for="inlineRadiomaster_tidakaktif">Tidak Aktif</label>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Menu Pengguna</label>
                          <br>

                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="radio_menu_pengguna" id="inlineRadiopengguna_aktif" value="Aktif" '; if ($menu_pengguna_dt=="Aktif"){ echo 'checked'; } echo ' >
                            <label class="form-check-label" for="inlineRadiopengguna_aktif">Aktif</label>
                          </div>

                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radio_menu_pengguna" id="inlineRadiopengguna_tidakaktif" value="Non Aktif">
                            <label class="form-check-label" for="inlineRadiopengguna_tidakaktif">Tidak Aktif</label>
                          </div>

                        </div>


                         <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Menu Operasional</label>
                          <br>

                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="radio_menu_operasional" id="inlineRadiooperasional_aktif" value="Aktif" '; if ($menu_operasional_dt=="Aktif"){ echo 'checked'; } echo ' >
                            <label class="form-check-label" for="inlineRadiooperasional_aktif">Aktif</label>
                          </div>

                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radio_menu_operasional" id="inlineRadiooperasional_tidakaktif" value="Non Aktif">
                            <label class="form-check-label" for="inlineRadiooperasional_tidakaktif">Tidak Aktif</label>
                          </div>
                        </div>


                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Menu Akuntansi</label>
                          <br>

                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="radio_menu_akuntansi" id="inlineRadioakuntansi_aktif" value="Aktif" '; if ($menu_akuntansi_dt=="Aktif"){ echo 'checked'; } echo ' >
                            <label class="form-check-label" for="inlineRadioakuntansi_aktif">Aktif</label>
                          </div>

                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radio_menu_akuntansi" id="inlineRadioakuntansi_tidakaktif" value="Non Aktif">
                            <label class="form-check-label" for="inlineRadioakuntansi_tidakaktif">Tidak Aktif</label>
                          </div>

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
