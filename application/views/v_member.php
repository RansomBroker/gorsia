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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Member</h4>


              <div class="row">
                <?php
                echo form_open_multipart(site_url() . '?/Member/insert_data');
                ?>
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Isi data member</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <form>

                         <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Nama Pelanggan</label>
                          <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Isi nama pelanggan" required />
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">No. Telepon</label>
                          <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Isi no. telepon" required />
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">E-mail</label>
                          <input type="text" class="form-control" id="email" name="email" placeholder="Isi email" />
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Alamat</label>
                          <input type="number" class="form-control" id="alamat" name="alamat" placeholder="Isi alamat" />
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Usia</label>
                          <input type="number" class="form-control" id="usia" name="usia" placeholder="Isi usia" />
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Jenis Kelamin</label>
                          <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" aria-label="Default select example" required>
                            <option selected>- - - Pilih - - -</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                          </select>
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

                <h5 class="card-header">Data Barang</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>ID Member</th>
                        <th>Nama Pelanggan</th>
                        <th>No. Telepon</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Usia</th>
                        <th>L/P</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                     <?php $no = 0;
                      foreach ($get_all_member as $row) {
                        $no++;

                        $id_member = $row->id_member;
                        $nama_pelanggan = $row->nama_pelanggan;
                        $no_telepon = $row->no_telepon;
                        $email = $row->email;
                        $alamat = $row->alamat;
                        $usia = $row->usia;
                        $jenis_kelamin = $row->jenis_kelamin;

                        echo '<tr>
                      <td>' . $id_member . '</td>
                      <td>' . $nama_pelanggan . '</td>
                      <td>' . $no_telepon . '</td>
                      <td>' . $email . '</td>
                      <td>' . $alamat . '</td>
                      <td>' . $usia . '</td>
                      <td>' . $jenis_kelamin . '</td>
                      <td align="left">';
                        if ($akses_update == "Aktif") {


                          echo '<a data-bs-toggle="modal" data-bs-target="#modal-update-data' . $id_member . '"><i class="bx bx-edit-alt me-2"></i>Edit</a>';
                          echo '&nbsp;&nbsp;';
                        }
                        if ($akses_delete == "Aktif") {
                          echo '<a onclick="return konfirm_hapus()" href="' . site_url() . '?/Barang/delete_data/id/' . $id_member . '"><i class="bx bx-trash me-2"></i> Delete</a>';
                        }
                        echo '</td><tr>';

                        echo form_open_multipart(site_url() . '?/Member/update_data');
                        echo '<div class="modal fade" id="modal-update-data' . $id_member . '" tabindex="-1" aria-hidden="true" style="display: none;">

                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Edit Member</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">ID Member</label>
                                    <input type="text" id="id_member" name="id_member" class="form-control" placeholder="Isi ID Member" value="' . $id_member . '" required="" readonly>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Nama Pelanggan</label>
                                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" placeholder="Isi Nama Pelanggan" value="' . $nama_pelanggan . '" required="">
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">No. Telepon</label>
                                    <input type="text" id="no_telepon" name="no_telepon" class="form-control" placeholder="Isi Telepon" value="' . $no_telepon . '" required="">
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">E-mail</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Isi E-mail" value="' . $email . '" required="">
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Alamat</label>
                                    <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Isi Alamat" value="' . $alamat . '" required="">
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Usia</label>
                                    <input type="text" id="usia" name="usia" class="form-control" placeholder="Isi Usia" value="' . $usia . '" required="">
                                  </div>
                                </div>

                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="emailBasic" class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" required="" class="form-select">
                                    <option value="' . $jenis_kelamin . '">' . $jenis_kelamin . '</option>
                                    <option value=""> - - - Pilih - - - </option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                    </select>
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