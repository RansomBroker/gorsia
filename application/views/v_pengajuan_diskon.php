<?php
include_once 'v_user_config.php';
?>


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

  <title>Gorsia - Pengajuan Diskon</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Pengajuan Diskon</h4>


              <div class="row">
              

               <div class="col-12">
                    <div id="notifications">
                      <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Pengajuan Diskon</h4>
                                <h6 class="card-subtitle">Cari data penyewaan</h6>
                               <hr>
                               

                                <div class="table-responsive text-nowrap">
                                    <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable" style="padding: 5px; font-size: 12px; white-space: nowrap;">
                                        <thead>
                                <tr role="row">
                                  <th>ID. Trx</th>
                                  <th>Tanggal</th>
                                  <th>Pelanggan</th>
                                  <th>Telpon</th>
                                  <th>ID. Member</th>
                                  <th>Olahraga</th>
                                  <th>Lapangan</th>
                                  <th>Lama Sewa</th>
                                  <th>Harga</th>
                                  <th>Diskon</th>
                                  <th>Total</th>
                                  <th>Status</th>
                                  <th>Validasi</th>

                                </tr>
                            </thead>
                            <tfoot id="filter-table">
                                <tr role="row">
                                   <th>ID. Trx</th>
                                  <th>Tanggal</th>
                                  <th>Pelanggan</th>
                                  <th>Telpon</th>
                                  <th>ID. Member</th>
                                  <th>Olahraga</th>
                                  <th>Lapangan</th>
                                  <th>Lama Sewa</th>
                                  <th>Harga</th>
                                  <th>Diskon</th>
                                  <th>Total</th>
                                  <th>Status</th>
                                 <th>Validasi</th>

                                    
                            </tfoot>
                            <tbody>


                                  <?php foreach($get_all_pengajuan_diskon as $row) {    

                                      $id_transaksi = $row->id_transaksi;
                      $tanggal = $row->tanggal;
                      $nama_pelanggan= $row->nama_pelanggan;
                      $no_telepon= $row->no_telepon;
                      $member= $row->member;
                      $id_member= $row->id_member;
                      $id_kategori_olahraga= $row->id_kategori_olahraga;
                      $id_paket_sewa= $row->id_paket_sewa;
                      $id_lapangan= $row->id_lapangan;
                      $lama_sewa= $row->lama_sewa;
                      $harga= $row->harga;
                      $diskon= $row->diskon;
                      $total= $row->total;
                      $status_transaksi= $row->status_transaksi;
                      $created_by= $row->created_by;

                      #kategori olahraga
                      $rows_kategori_or = $this->db->query("SELECT * FROM kategori_olahraga where id_kategori_olahraga='".$id_kategori_olahraga."'")->row_array();
                      $kategori_olahraga=$rows_kategori_or['kategori_olahraga'];

                      #paket sewa
                      $rows_paket = $this->db->query("SELECT * FROM paket_sewa where id_paket_sewa='".$id_paket_sewa."'")->row_array();
                      $id_satuan=($rows_paket) ? $rows_paket['id_satuan'] : 0;

                      #satuan
                      $rows_satuan = $this->db->query("SELECT * FROM satuan_sewa where id_satuan_sewa='".$id_satuan."'")->row_array();
                      $satuan_sewa=($rows_satuan) ? $rows_satuan['satuan_sewa'] : '';

                      #lapangan
                      $rows_lapangan = $this->db->query("SELECT * FROM lapangan where id_lapangan='".$id_lapangan."'")->row_array();
                      $nama_lapangan=$rows_lapangan['nama_lapangan'];

                                      echo '<tr role="row" >
                                      <td>'.$id_transaksi.'</td>
                      <td>'.date("d/m/Y", strtotime($tanggal)).'</td>
                      <td>'.$nama_pelanggan.'</td>
                      <td>'.$no_telepon.'</td>
                      <td>'.$id_member.'</td>
                      <td>'.$kategori_olahraga.'</td>
                      <td>'.$nama_lapangan.'</td>
                      <td>'.$lama_sewa.' '.$satuan_sewa.'</td>
                      <td>'.number_format($harga).'</td>
                      <td>'.number_format($diskon).'</td>
                      <td>'.number_format($total).'</td>
                      <td>'.$status_transaksi.'</td>
                      <td align="center">';
                      if ($akses_update=="Aktif"){
                        echo '<a data-bs-toggle="modal" class="btn btn-primary text-white" data-bs-target="#modal-update-data'.$id_transaksi.'">Validasi</a>';}
                        
                        echo form_open_multipart(site_url().'?/Penyewaan/validasi_data_penyewaan'); 
                          echo '<div class="modal fade" id="modal-update-data'.$id_transaksi.'" tabindex="-1" aria-hidden="true" style="display: none;">

                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Validasi - Pengajuan Diskon</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">

                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Diskon</label>
                                    <input type="hidden" id="id_transaksi" name="id_transaksi" class="form-control" placeholder="" value="'.$id_transaksi.'" required="">
                                    <input type="number" class="form-control" id="diskon" name="diskon" placeholder="Potongan Harga" required value="'.$diskon.'" />
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

                        echo '</td>
                          </tr>';

                        }  ?>


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
                                            { extend:'excel', title: "Laporan Pengajuan Diskon" , footer: true }, 
                                            { extend:'pdf', orientation: 'landscape', title: "Laporan Pengajuan Diskon" , footer: true }, 
                                            
                                             ],

                                        });
</script>


     

   </body>
   </html>
