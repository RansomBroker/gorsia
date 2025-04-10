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

  <title>Gorsia - Harga Paket Sewa</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Harga Paket Sewa</h4>


              <div class="row">
                <?php
                echo form_open_multipart(site_url().'?/HargaPaketSewa/insert_data'); 
                ?>
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Isi data harga paket sewa</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Kategori Olahraga</label>
                          <select class="form-select" id="id_kategori_olahraga" name="id_kategori_olahraga" aria-label="Default select example" required>
                            <option selected>- - - Pilih - - -</option>
                            <?php foreach($get_all_kategori as $row) {  
                              $id_kategori_olahraga_cb = $row->id_kategori_olahraga;
                              $kategori_olahraga_cb = $row->kategori_olahraga;
                              print "<option value='$id_kategori_olahraga_cb'>$kategori_olahraga_cb</option>";
                            } ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Satuan</label>
                          <select class="form-select" id="id_satuan" name="id_satuan" aria-label="Default select example" required>
                            <option selected>- - - Pilih - - -</option>
                            <?php foreach($get_all_satuan as $row) {  
                              $id_satuan_sewa_cb = $row->id_satuan_sewa;
                              $satuan_sewa_cb = $row->satuan_sewa;
                              print "<option value='$id_satuan_sewa_cb'>$satuan_sewa_cb</option>";
                            } ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Harga</label>
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon13">Rp.</span>
                            <input type="text" class="form-control" id="harga" name="harga" placeholder="0" required>
                          </div>
                        </div>
                        

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Info</label>
                          <input type="text" class="form-control" id="info" name="info" placeholder="Isi informasi paket" />
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

                <h5 class="card-header">Data Harga Paket Sewa</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Kategori Olahraga</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Info</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                     <?php $no=0;
                     foreach($get_all_paket_sewa as $row) {    
                      $no++; 

                      $id_paket_sewa = $row->id_paket_sewa;
                      $id_kategori_olahraga = $row->id_kategori_olahraga;
                      $id_satuan= $row->id_satuan;
                      $harga= $row->harga;
                      $info= $row->info;

                      #kategori olahraga
                      $rows_kategori_or = $this->db->query("SELECT * FROM kategori_olahraga where id_kategori_olahraga='".$id_kategori_olahraga."'")->row_array();
                      $kategori_olahraga=$rows_kategori_or['kategori_olahraga'];

                      #satuan
                      $rows_satuan = $this->db->query("SELECT * FROM satuan_sewa where id_satuan_sewa='".$id_satuan."'")->row_array();
                      $satuan_sewa=$rows_satuan['satuan_sewa'];

                     

                      echo '<tr>
                      <td>'.$kategori_olahraga.'</td>
                      <td>'.$satuan_sewa.'</td>
                      <td>'.number_format($harga).'</td>
                      <td>'.$info.'</td>
                      <td align="left">';
                      if ($akses_update=="Aktif"){


                        echo '<a data-bs-toggle="modal" data-bs-target="#modal-update-data'.$id_paket_sewa.'"><i class="bx bx-edit-alt me-2"></i>Edit</a>'; echo '&nbsp;&nbsp;' ;}
                        if ($akses_delete=="Aktif"){
                          echo '<a onclick="return konfirm_hapus()" href="'.site_url().'?/HargaPaketSewa/delete_data/id/'.$id_paket_sewa.'"><i class="bx bx-trash me-2"></i> Delete</a>';}
                          echo '</td><tr>';

                          echo form_open_multipart(site_url().'?/HargaPaketSewa/update_data'); 
                          echo '<div class="modal fade" id="modal-update-data'.$id_paket_sewa.'" tabindex="-1" aria-hidden="true" style="display: none;">

                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Edit Harga Paket Sewa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">

                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Kategori Olahraga</label>
                                    <input type="hidden" id="id_paket_sewa" name="id_paket_sewa" class="form-control" placeholder="" value="'.$id_paket_sewa.'" required="">
                                     <select class="form-select" id="id_kategori_olahraga" name="id_kategori_olahraga" aria-label="Default select example" required>
                                     <option value="'.$id_kategori_olahraga.'">'.$kategori_olahraga.'</option>
                                     <option>- - - Pilih - - -</option>';
                                                      foreach($get_all_kategori as $row_k) {  
                                                       $id_kategori_olahraga_cb= $row_k->id_kategori_olahraga;
                                                       $kategori_olahraga_cb= $row_k->kategori_olahraga;
                                                       print "<option value='$id_kategori_olahraga_cb'>$kategori_olahraga_cb</option>";
                                                     } 
                                      echo '</select>
                                  </div>


                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Satuan</label>
                                     <select class="form-select" id="id_satuan" name="id_satuan" aria-label="Default select example" required>
                                     <option value="'.$id_satuan.'">'.$satuan_sewa.'</option>
                                     <option>- - - Pilih - - -</option>';
                                                      foreach($get_all_satuan as $row_s) {  
                                                       $id_satuan_sewa_cb= $row_s->id_satuan_sewa;
                                                       $satuan_sewa_cb= $row_s->satuan_sewa;
                                                       print "<option value='$id_satuan_sewa_cb'>$satuan_sewa_cb</option>";
                                                     } 
                                      echo '</select>
                                  </div>

                             

                                  <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Harga</label>
                                    <div class="input-group">
                                    <span class="input-group-text" id="basic-addon13">Rp.</span>
                                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Jumlah Maksimal" aria-label="Recipients username" aria-describedby="basic-addon13" value="'.$harga.'" required>
                                  </div>
                                </div>


                                <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Info</label>
                                <input type="text" class="form-control" id="info" name="info" placeholder="Isi informasi paket"  value="'.$info.'"  />
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

  <script>
    // Fungsi untuk memformat angka dengan menambahkan titik sebagai pemisah ribuan
    function formatNumber(input) {
      // Hapus semua titik dan karakter non-angka
      let number_string = input.replace(/\./g, '').replace(/[^0-9]/g, '');
      if (number_string === "") return "";
      // Tambahkan titik sebagai pemisah ribuan
      return number_string.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Fungsi untuk menginisialisasi format untuk semua input dengan name "harga"
    function initHargaInputs() {
      // Ambil semua elemen input dengan name "harga"
      const hargaInputs = document.querySelectorAll("input[name='harga']");
      
      hargaInputs.forEach(function(hargaInput) {
        // Format nilai awal (saat memuat halaman) jika ada nilai
        if (hargaInput.value) {
          hargaInput.value = formatNumber(hargaInput.value);
        }

        // Tambahkan event listener untuk format saat mengetik
        hargaInput.addEventListener("input", function(e) {
          let cursorPosition = hargaInput.selectionStart;
          hargaInput.value = formatNumber(hargaInput.value);
          hargaInput.selectionStart = hargaInput.selectionEnd = cursorPosition;
        });
      });
    }

    // Saat halaman sudah termuat, inisialisasi input harga
    document.addEventListener("DOMContentLoaded", function() {
      initHargaInputs();

      // Event listener untuk setiap form agar saat submit nilai harga bersih dari titik
      document.querySelectorAll("form").forEach(function(formElement) {
        formElement.addEventListener("submit", function(e) {
          formElement.querySelectorAll("input[name='harga']").forEach(function(hargaInput) {
            hargaInput.value = hargaInput.value.replace(/\./g, '');
          });
        });
      });
    });
  </script>




   </body>
   </html>
