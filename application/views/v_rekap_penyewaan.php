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

  <title>Gorsia - Rekap Penyewaan</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?=base_url()?>/assets/backend/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"
  />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/backend//vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
    <link href="<?=base_url()?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="<?=base_url()?>/assets/backend/vendor/libs/apex-charts/apex-charts.css" />

   <!-- Bootstrap Core CSS -->




  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="<?=base_url()?>/assets/backend/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?=base_url()?>/assets/backend/js/config.js"></script>
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Rekap Penyewaan</h4>


              <div class="row">
              

               <div class="col-12">
              
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Rekap Penyewaan</h4>
                                <h6 class="card-subtitle">Cari data penyewaan</h6>
                               <hr>
                               

                                <div class="table-responsive text-nowrap">
                                <?php
                                // Jika variabel filter belum ada (misalnya, saat halaman pertama kali dimuat), set default-nya.
                                if (!isset($periode) || empty($periode)) {
                                  $periode = date('m'); // Format 2 digit: '01', '02', dst.
                                }
                                if (!isset($tahun) || empty($tahun)) {
                                  $tahun = date('Y');
                                }
                              ?>
                              <form action="<?=site_url()?>/RekapPenyewaan/filter"  method="GET">
                                  <div class="row mb-3">
                                      <div class="col-md-2">
                                          <label for="periode" class="form-label">Periode (Bulan)</label>
                                          <select class="form-control" id="periode" name="periode" required>
                                              <option value="">Pilih Bulan</option>
                                              <?php 
                                              $months = [
                                                  '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                                  '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                                  '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                              ];
                                              foreach ($months as $num => $name) {
                                                  $selected = ($periode == $num) ? 'selected' : '';
                                                  echo "<option value='$num' $selected>$name</option>";
                                              }
                                              ?>
                                          </select>
                                      </div>
                                      <div class="col-md-2">
                                          <label for="tahun" class="form-label">Tahun</label>
                                          <select class="form-control" id="tahun" name="tahun" required>
                                              <option value="">Pilih Tahun</option>
                                              <?php 
                                              $currentYear = date('Y');
                                              for ($i = $currentYear; $i >= $currentYear - 2; $i--) {
                                                  $selected = ($tahun == $i) ? 'selected' : '';
                                                  echo "<option value='$i' $selected>$i</option>";
                                              }
                                              ?>
                                          </select>
                                      </div>
                                      <div class="col-md-4">
                                          <label for="status" class="form-label">Status</label>
                                          <select class="form-control" id="status" name="status">
                                              <option value="">Semua Status</option>
                                              <?php 
                                                  $selectedSukses = (!empty($status) && $status == 'Sukses') ? 'selected' : '';
                                                  $selectedVoid = (!empty($status) && $status == 'Void') ? 'selected' : '';
                                                  echo "<option value='Sukses' $selectedSukses>Sukses</option>";
                                                  echo "<option value='Void' $selectedVoid>Void</option>";
                                              ?>
                                          </select>
                                      </div>
                                      <div class="col-md-4 d-flex gap-3 align-items-end justify-content-end">
                                          <button type="submit" class="btn btn-primary" id="filter_btn">Filter</button>
                                          <a href="<?=site_url()?>/RekapPenyewaan" class="btn btn-secondary" id="reset_btn">Reset</a>
                                      </div>
                                  </div>
                              </form>
                                    <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable" style="padding: 5px; font-size: 12px; white-space: nowrap;">
                                        <thead>
                                            <tr role="row">
                                                <th>ID. Trx</th>
                                                <th>Tanggal</th>
                                                <th>Pelanggan</th>
                                                <th>Lapangan</th>
                                                <th>Jumlah Sesi</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Detail</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr role="row">
                                                <th>ID. Trx</th>
                                                <th>Tanggal</th>
                                                <th>Pelanggan</th>
                                                <th>Lapangan</th>
                                                <th>Jumlah Sesi</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Detail</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach($get_all_rekap_penyewaan as $row) {    
                                                $id_transaksi        = $row->id_transaksi;
                                                $tanggal             = $row->tanggal;
                                                $nama_pelanggan      = $row->nama_pelanggan;
                                                $lama_sewa           = $row->lama_sewa;
                                                $total               = $row->total - $row->diskon;
                                                $status_transaksi    = $row->status_transaksi;

                                                // Get lapangan name
                                                $id_lapangan = $row->id_lapangan;
                                                $rows_lapangan = $this->db->query("SELECT nama_lapangan FROM lapangan WHERE id_lapangan='$id_lapangan'")->row_array();
                                                $nama_lapangan = $rows_lapangan ? $rows_lapangan['nama_lapangan'] : '-';

                                                // Get satuan sewa
                                                $id_paket_sewa = $row->id_paket_sewa;
                                                $rows_paket = $this->db->query("SELECT id_satuan FROM paket_sewa WHERE id_paket_sewa='$id_paket_sewa'")->row_array();
                                                $id_satuan = $rows_paket ? $rows_paket['id_satuan'] : 0;

                                                $rows_satuan = $this->db->query("SELECT satuan_sewa FROM satuan_sewa WHERE id_satuan_sewa='$id_satuan'")->row_array();
                                                $satuan_sewa = $rows_satuan ? $rows_satuan['satuan_sewa'] : '';

                                                echo '<tr role="row">
                                                    <td>'.$id_transaksi.'</td>
                                                    <td>'.date("d/m/Y", strtotime($tanggal)).'</td>
                                                    <td>'.$nama_pelanggan.'</td>
                                                    <td>'.$nama_lapangan.'</td>
                                                    <td>'.$lama_sewa.' '.$satuan_sewa.'</td>
                                                    <td>'.number_format($total).'</td>
                                                    <td>'.$status_transaksi.'</td>
                                                    <td align="center">
                                                        <a href="'.site_url().'?/Penyewaan/view/idtrx/'.$id_transaksi.'">
                                                            <i class="bx bx-detail"></i>
                                                        </a>
                                                    </td>
                                                    <td align="center">
                                                        <a onclick="return konfirm_hapus()" href="'.site_url().'?/RekapPenyewaan/delete_data/id/'.$id_transaksi.'">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </a>
                                                    </td>
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
     <script src="<?=base_url()?>/assets/backend/vendor/libs/jquery/jquery.js"></script>
     <script src="<?=base_url()?>/assets/backend/vendor/libs/popper/popper.js"></script>
     <script src="<?=base_url()?>/assets/backend/vendor/js/bootstrap.js"></script>
     <script src="<?=base_url()?>/assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

     <script src="<?=base_url()?>/assets/backend/vendor/js/menu.js"></script>
     <!-- endbuild -->

     <!-- Vendors JS -->
     <script src="<?=base_url()?>/assets/backend/vendor/libs/apex-charts/apexcharts.js"></script>

     <!-- Main JS -->
     <script src="<?=base_url()?>/assets/backend/js/main.js"></script>

     <!-- Page JS -->
     <script src="<?=base_url()?>/assets/backend/js/dashboards-analytics.js"></script>

     <!-- Place this tag in your head or just before your close body tag. -->
     <script async defer src="https://buttons.github.io/buttons.js"></script>

     <!-- This is data table -->
    <script src="<?=base_url()?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>

    <!-- This is data table -->
    <script src="<?=base_url()?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="<?=base_url()?>/assets_pages/bundles/datatablescripts.bundle.js"></script>
    <script src="<?=base_url()?>/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

    <!-- DATA TABLE SCRIPTS -->
    <script src="<?=base_url()?>/assets/exportdataTables/dataTables.buttons.min.js"></script>
    <script src="<?=base_url()?>/assets/exportdataTables/buttons.flash.min.js"></script>
    <script src="<?=base_url()?>/assets/exportdataTables/jszip.min.js"></script>
    <script src="<?=base_url()?>/assets/exportdataTables/pdfmake.min.js"></script>
    <script src="<?=base_url()?>/assets/exportdataTables/vfs_fonts.js"></script>
    <script src="<?=base_url()?>/assets/exportdataTables/buttons.print.min.js"></script>
    <script src="<?=base_url()?>/assets/exportdataTables/buttons.html5.min.js"></script>


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
                                            { extend:'excel', title: "Laporan Rekap Penyewaan" , footer: true }, 
                                            { extend:'pdf', orientation: 'landscape', title: "Laporan Rekap Penyewaan" , footer: true }, 
                                            
                                             ],

                                        });
</script>


     

   </body>
   </html>
