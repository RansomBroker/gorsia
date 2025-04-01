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

  <title>Gorsia - Modal</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Akuntansi /</span> Perubahan Modal</h4>


              <div class="row">
                <?php
                echo form_open_multipart(site_url().'?/Modal/insert_data'); 
                ?>
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Isi data modal</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <form>
                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Periode</label>
                          <input type="text" class="form-control" id="periode" name="periode" placeholder="Contoh : 202301 untuk periode bulan Januari tahun 2023" required />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Kode Akuntansi</label>
                          <select class="form-select" id="id_kode_akuntansi" name="id_kode_akuntansi" aria-label="Default select example" required>
                            <option selected>- - - Pilih - - -</option>
                            <?php foreach($get_all_kode_akuntansi_modal as $row) {  
                              $id_kode_akuntansi_cb = $row->id_kode_akuntansi;
                              $nama_akun_cb = $row->nama_akun;
                              print "<option value='$id_kode_akuntansi_cb'>$nama_akun_cb</option>";
                            } ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Sampai Tanggal</label>
                          <input type="date" class="form-control" id="sampai_dengan_tanggal" name="sampai_dengan_tanggal" placeholder="" required />
                        </div>
                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Uraian</label>
                          <input type="text" class="form-control" id="uraian" name="uraian" placeholder="Isi uraian" required />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Debet</label>
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon13">Rp.</span>
                            <input type="text" class="form-control" id="debet" name="debet" placeholder="0" aria-label="Recipient's username" aria-describedby="basic-addon13" required>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Kredit</label>
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon13">Rp.</span>
                            <input type="text" class="form-control" id="kredit" name="kredit" placeholder="0" aria-label="Recipient's username" aria-describedby="basic-addon13" required>
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

                <h5 class="card-header">Data Perubahan Modal</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Periode</th>
                        <th>Kode Akuntansi</th>
                        <th>Sampai Tanggal</th>
                        <th>Uraian</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                     <?php $no=0;
                     foreach($get_all_modal as $row) {    
                      $no++; 

                      $id_perubahan_modal = $row->id_perubahan_modal;
                      $periode = $row->periode;
                      $id_kode_akuntansi= $row->id_kode_akuntansi;
                      $sampai_dengan_tanggal= $row->sampai_dengan_tanggal;
                      $uraian= $row->uraian;
                      $debet= $row->debet;
                      $kredit= $row->kredit;

                      #kode akuntansi
                      $rows_kode = $this->db->query("SELECT * FROM kode_akuntansi where id_kode_akuntansi='".$id_kode_akuntansi."'")->row_array();
                      $kode_akun=$rows_kode['kode_akun'];
                      $nama_akun=$rows_kode['nama_akun'];


                      echo '<tr>
                      <td>'.$periode.'</td>
                      <td>'.$kode_akun.' - '.$nama_akun.'</td>
                      <td>'.date("d/m/Y", strtotime($sampai_dengan_tanggal)).'</td>
                      <td>'.$uraian.'</td>
                      <td>Rp. '.number_format($debet).'</td>
                      <td>Rp. '.number_format($kredit).'</td>
                      <td align="left">';
                      if ($akses_update=="Aktif"){


                        echo '<a data-bs-toggle="modal" data-bs-target="#modal-update-data'.$id_perubahan_modal.'"><i class="bx bx-edit-alt me-2"></i>Edit</a>'; echo '&nbsp;&nbsp;' ;}
                        if ($akses_delete=="Aktif"){
                          echo '<a onclick="return konfirm_hapus()" href="'.site_url().'?/Modal/delete_data/id/'.$id_perubahan_modal.'"><i class="bx bx-trash me-2"></i> Delete</a>';}
                          echo '</td><tr>';

                          echo form_open_multipart(site_url().'?/Modal/update_data'); 
                          echo '<div class="modal fade" id="modal-update-data'.$id_perubahan_modal.'" tabindex="-1" aria-hidden="true" style="display: none;">

                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Edit Perubahan Modal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">

                                <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Periode</label>
                                <input type="hidden" id="id_perubahan_modal" name="id_perubahan_modal" class="form-control" placeholder="" value="'.$id_perubahan_modal.'" required="" />

                                <input type="text" class="form-control" id="periode" name="periode" placeholder="Contoh : 202301 untuk periode bulan Januari tahun 2023" value="'.$periode.'" required />
                                </div>

                                <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Kode Akuntansi</label>
                                <select class="form-select" id="id_kode_akuntansi" name="id_kode_akuntansi" aria-label="Default select example" required>
                                <option value="'.$id_kode_akuntansi.'">'.$nama_akun.'</option>
                                <option>- - - Pilih - - -</option>';
                                foreach($get_all_kode_akuntansi_modal as $row) {  
                                  $id_kode_akuntansi_cb = $row->id_kode_akuntansi;
                                  $nama_akun_cb = $row->nama_akun;
                                  print "<option value='$id_kode_akuntansi_cb'>$nama_akun_cb</option>";
                                }
                                echo '</select>
                                </div>


                                <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="sampai_dengan_tanggal" name="sampai_dengan_tanggal" placeholder="" value="'.$sampai_dengan_tanggal.'" required />
                                </div>
                                <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Uraian</label>
                                <input type="text" class="form-control" id="uraian" name="uraian" placeholder="Isi uraian" value="'.$uraian.'" required />
                                </div>
                                <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Debet</label>
                                <div class="input-group">
                                <span class="input-group-text" id="basic-addon13">Rp.</span>
                                <input type="text" class="form-control" id="debet" name="debet" placeholder="0" value="'.$debet.'" required>
                                </div>
                                </div>
                                <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Kredit</label>
                                <div class="input-group">
                                <span class="input-group-text" id="basic-addon13">Rp.</span>
                                <input type="text" class="form-control" id="kredit" name="kredit" placeholder="0" value="'.$kredit.'" required>
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
