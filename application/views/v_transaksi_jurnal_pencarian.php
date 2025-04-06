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

  <title>Gorsia - Pencarian Transaksi Jurnal</title>

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
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <link rel="stylesheet" href="assets/backend/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/backend/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/backend/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="assets/backend/vendor/libs/apex-charts/apex-charts.css" />

   <!-- Bootstrap Core CSS -->




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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Akuntansi /</span> Pencarian Transaksi Jurnal</h4>


              <div class="row">
              

               <div class="col-12">
              
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Jurnal Umum</h4>
                                <h6 class="card-subtitle">Cari data jurnal</h6>
                               <hr>


                                <?php   echo '<a href="'.site_url().'?/TransaksiJurnal" class="btn btn-sm btn-outline-primary"><i class="bx bx-book-add"></i> Baru</a>';
                                ?>
                                <br>
                                <br>
                               

                                <div class="table-responsive text-nowrap">
                                    <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable" style="padding: 5px; font-size: 12px; white-space: nowrap;">
                                        <thead>
                                <tr role="row">
                                    <th><b>Jenis Jurnal</b></th>
                                    <th><b>No. Bukti</b></th>
                                    <th><b>Tanggal</b></th>
                                    <th><b>Referensi</b></th>
                                    <th><b>Keterangan</b></th>
                                    <th><b>Edit</b></th>
                                    <th><b>Hapus</b></th>

                                </tr>
                            </thead>
                            <tfoot id="filter-table">
                                <tr role="row">
                                    <th>Jenis Jurnal</th>
                                    <th>No. Bukti</th>
                                    <th>Tanggal</th>
                                    <th>Referensi</th>
                                    <th>Keterangan</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                    
                            </tfoot>
                            <tbody>


                                  <?php foreach($get_all_data_jurnal as $row) {    

                                      $id_jurnal = $row->id_jurnal;
                                      $no_bukti = $row->no_bukti;
                                      $tanggal = $row->tanggal;
                                      $no_referensi = $row->no_referensi;
                                      $keterangan = $row->keterangan;
                                      $kode_jenis_jurnal = $row->kode_jenis_jurnal;

                                      #kode jenis jurnal
                                      $rows_jn = $this->db->query("SELECT * FROM kode_jenis_jurnal WHERE kode_jenis_jurnal='".$kode_jenis_jurnal."'")->row_array();
                                      $deskripsi_jenis_jurnal_view = '-';
                                      if (!empty($rows_jn)) {
                                          $deskripsi_jenis_jurnal_view = $rows_jn['deskripsi'];
                                      }

                                      echo '<tr role="row" >
                                      
                                      <td>'.$kode_jenis_jurnal.' - '.$deskripsi_jenis_jurnal_view.'</td>
                                      <td>'.$no_bukti.'</td>
                                      <td>'.date("d/m/Y", strtotime($tanggal)).'</td>
                                      <td>'.$no_referensi.'</td>
                                      
                                      <td>'.$keterangan.'</td>

                                      <td align="center">';
                                      if ($akses_update=="Aktif"){
                                        echo '<a href="'.site_url().'?/TransaksiJurnal/viewer/no/'.$no_bukti.'"><i class="bx bx-edit-alt"></i></a>' ;}

                                        echo '</td>

                                        <td align="center">';

                                        if ($akses_delete=="Aktif"){
                                          echo '<a onclick="return konfirm_hapus()" href="'.site_url().'?/TransaksiJurnal/delete_data/no/'.$no_bukti.'"><i class="bx bx-trash-alt"></i></a>';}
                                          echo '</td>

                                          </tr>';

                                      } ?>


                            </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                 
                    </div>
               

              </div>

              <!-- Basic Bootstrap Table -->

             

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

     <!-- This is data table -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>

    <!-- This is data table -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="assets_pages/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

    <!-- DATA TABLE SCRIPTS -->
    <script src="assets/exportdataTables/dataTables.buttons.min.js"></script>
    <script src="assets/exportdataTables/buttons.flash.min.js"></script>
    <script src="assets/exportdataTables/jszip.min.js"></script>
    <script src="assets/exportdataTables/pdfmake.min.js"></script>
    <script src="assets/exportdataTables/vfs_fonts.js"></script>
    <script src="assets/exportdataTables/buttons.print.min.js"></script>
    <script src="assets/exportdataTables/buttons.html5.min.js"></script>


<script type="text/javascript" language="JavaScript">
 function konfirm_hapus()
 {
 tanya = confirm("Hapus data jurnal ?");
 if (tanya == true) return true;
 else return false;
 }</script>


  <script type="text/javascript">
 var table_pencarian = $('#myTable').DataTable({
                                            
                                            "processing": false,
                                            "serverSide": false,
                                             dom: 'Bfrtip',
                                            buttons: [
                                            { extend:'copy', footer: true }, 
                                            { extend:'csv', footer: true }, 
                                            { extend:'excel', title: "Jurnal" , footer: true }, 
                                            { extend:'pdf', orientation: 'landscape', title: "Jurnal" , footer: true }, 
                                            
                                             ],


                                        });
</script>


     

   </body>
   </html>
