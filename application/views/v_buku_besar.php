<?php
include_once 'v_user_config.php'; ?>


<?php if ($this->uri->segment('2') == 'filterpencarian') {
    $param_id_akun = $this->input->post('txt_id_akun');
    $param_tahun = $this->input->post('txt_tahun');
    $param_bulan = $this->input->post('txt_periode');
    $param_periode = $param_tahun . $param_bulan;

    $rows_akun_pr = $this->db
        ->query("SELECT * FROM kode_akuntansi where id_kode_akuntansi='" . $param_id_akun . "'")
        ->row_array();
    $param_kode_akun = $rows_akun_pr['kode_akun'];
    $param_nama_akun = $rows_akun_pr['nama_akun'];

    #saldo awal akun
    $rows_saldo_awal = $this->db
        ->query(
            "SELECT sum(debet) as jumlah_debet, SUM(kredit) as jumlah_kredit FROM jurnal_umum INNER JOIN jurnal_umum_detail ON jurnal_umum.no_bukti=jurnal_umum_detail.no_bukti where id_kode_akuntansi='" .
                $param_id_akun .
                "' AND jurnal_umum.periode<'" .
                $param_periode .
                "' GROUP BY id_kode_akuntansi"
        )
        ->row_array();
    $jumlah_debet = $rows_saldo_awal['jumlah_debet'];
    $jumlah_kredit = $rows_saldo_awal['jumlah_kredit'];
    $saldo_awal = $jumlah_debet - $jumlah_kredit;

    #mutasi
    $rows_mutasi = $this->db
        ->query(
            "SELECT sum(debet) as jumlah_debet, SUM(kredit) as jumlah_kredit FROM jurnal_umum INNER JOIN jurnal_umum_detail ON jurnal_umum.no_bukti=jurnal_umum_detail.no_bukti where id_kode_akuntansi='" .
                $param_id_akun .
                "' AND jurnal_umum.periode='" .
                $param_periode .
                "' GROUP BY id_kode_akuntansi"
        )
        ->row_array();
    $mutasi_jumlah_debet = $rows_mutasi['jumlah_debet'];
    $mutasi_jumlah_kredit = $rows_mutasi['jumlah_kredit'];
    $mutasi_saldo = $mutasi_jumlah_debet - $mutasi_jumlah_kredit;

    $saldo_akhir = $saldo_awal + $mutasi_saldo;
} else {
    $param_id_akun = '';
    $param_tahun = '';
    $param_bulan = '';
    $param_periode = '';

    $saldo_awal = 0;
    $mutasi_saldo = 0;
    $saldo_akhir = 0;
} ?>

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

  <title>Gorsia - Buku Besar</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Akuntansi /</span> Buku Besar</h4>


              <div class="row">
              

               <div class="col-12">
              
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Buku Besar</h4>
                                <h6 class="card-subtitle">berdasarkan kode akuntansi</h6>
                               <hr>


                               <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <?php echo form_open_multipart(site_url() . '?/BukuBesar/filterpencarian'); ?>


                                        <div class="form-group row">
                                            <label class="col-4 col-form-label" for="basic-default-fullname">Kode Akuntansi</font></label>
                                            <div class="col-8">


                                                <select class="form-select" style="width: 100%" name="txt_id_akun" id="txt_id_akun" required=""  >
                                                    <?php if ($this->uri->segment('2') == 'filterpencarian') {
                                                        print "<option value='$param_id_akun'>$param_kode_akun - $param_nama_akun</option>";
                                                    } ?>

                                                    <option value=""> - - - - Pilih - - - - </option>
                                                    <?php foreach ($get_all_data_akun as $row) {
                                                        $id_kode_akuntansi_cb = $row->id_kode_akuntansi;
                                                        $kode_akun_cb = $row->kode_akun;
                                                        $nama_akun_cb = $row->nama_akun;
                                                        print "<option value='$id_kode_akuntansi_cb'>$kode_akun_cb - $nama_akun_cb</option>";
                                                    } ?>
                                                </select>

                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">Tahun</label>
                                            <div class="col-8">


                                                <select class="form-select" style="width: 100%" name="txt_tahun" id="txt_tahun" required=""  >
                                                    <?php if ($this->uri->segment('2') == 'filterpencarian') {
                                                        print "<option value='$param_tahun'>$param_tahun</option>";
                                                    } ?>
                                                    <option value=""> - - - - Pilih Tahun - - - - </option>
                                                    <?php for ($i = 2023; $i <= date('Y'); $i++) {
                                                        print "<option value='$i'>$i</option>";
                                                    } ?>
                                                </select>

                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">Periode</label>
                                            <div class="col-8">


                                                <select class="form-select" style="width: 100%" name="txt_periode" id="txt_periode" required=""  >
                                                    <?php if ($this->uri->segment('2') == 'filterpencarian') {
                                                        print "<option value='$param_bulan'>$param_bulan</option>";
                                                    } ?>
                                                    <option value=""> - - - - Pilih Periode - - - - </option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                             <label class="col-4 col-form-label"></label>
                                            <div class="col-sm-8" align="left">
                                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bx bx-search-alt-2"></i> Filter </button>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <br>
                                <br>


                                <h6 class="card-subtitle">Detail Mutasi Debet &amp; Kredit</h6>
                                <br>


                                  <div class="form-group row">
                                            <label class="col-4 col-form-label"><font style="font-size: 14px"></font></label>
                                            <label class="col-5 col-form-label" align="right"><b>Saldo Awal</b></label>
                                            <div class="col-2" align="left">
                                                <input type="text" name="txt_saldo_awal" id="txt_saldo_awal" value="<?= number_format(
                                                    $saldo_awal
                                                ) ?>" readonly>

                                            </div>
                                        </div>

                               

                                <div class="table-responsive text-nowrap">
                                    <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable" style="padding: 5px; font-size: 12px; white-space: nowrap;">
                                        <thead>
                                          <tr role="row">
                                           <th class="sorting_asc" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5px;"><b>No.</b></th>
                                           <th style="width: 50px;"><b>Akun Perkiraan</b></th>
                                           <th style="width: 50px;"><b>Tanggal</b></th>
                                           <th style="width: 200px;"><b>Uraian</b></th>
                                           <th style="width: 50px;"><b>Debet</b></th>
                                           <th style="width: 50px;"><b>Kredit</b></th>
                                           <th style="width: 50px;"><b>Jurnal</b></th>
                                          </tr>
                            </thead>
                           
                            <?php if ($this->uri->segment('2') == 'filterpencarian') {
                                $no = 0;
                                foreach ($get_all_buku_besar as $row) {
                                    $no++;

                                    $id_jurnal = $row->id_jurnal;
                                    $periode = $row->periode;
                                    $no_bukti = $row->no_bukti;
                                    $tanggal = $row->tanggal;
                                    $no_referensi = $row->no_referensi;
                                    $dari = $row->dari;
                                    $kepada = $row->kepada;
                                    $keterangan = $row->keterangan;

                                    $id_akun_perkiraan = $row->id_kode_akuntansi;
                                    $uraian = $row->uraian;
                                    $debet = $row->debet;
                                    $kredit = $row->kredit;

                                    $rows_akun = $this->db
                                        ->query(
                                            "SELECT * FROM kode_akuntansi where id_kode_akuntansi='" .
                                                $id_akun_perkiraan .
                                                "'"
                                        )
                                        ->row_array();
                                    $kode_akun = $rows_akun['kode_akun'];
                                    $nama_akun = $rows_akun['nama_akun'];
                                    $saldo_normal = $rows_akun['saldo_normal'];

                                    if ($no % 2 == 0) {
                                        $class_baris = "class='odd gradeX'";
                                    } else {
                                        $class_baris = "class='even gradeC'";
                                    }

                                    echo '<tr role="row" ' .
                                        $class_baris .
                                        '>
                                                <td class="sorting_1">' .
                                        $no .
                                        '</td>
                                                <td>' .
                                        $kode_akun .
                                        ' - ' .
                                        $nama_akun .
                                        '</td>
                                                <td>' .
                                        date('d/m/Y', strtotime($tanggal)) .
                                        '</td>
                                                <td>' .
                                        $uraian .
                                        '</td>
                                                <td>' .
                                        number_format($debet) .
                                        '</td>
                                                <td>' .
                                        number_format($kredit) .
                                        '</td>
                                                <td><a href="' .
                                        site_url() .
                                        '?/TransaksiJurnal/viewer/no/' .
                                        $no_bukti .
                                        '" target="_blank"><i class="bx bx-folder-open"></i> Buka </a></td>
                                                
                                               
                                        </tr>';
                                }
                            } ?>

                                        </tbody>
                                    </table>
                                </div>
                                    <br>

                                    <br>



                                   <div class="form-group row">
                                            <label class="col-4 col-form-label"><font style="font-size: 14px"></font></label>
                                            <label class="col-5 col-form-label" align="right"><b>Saldo Akhir</b></label>
                                            <div class="col-2" align="left">
                                                <input type="text" name="txt_saldo_akhir" id="txt_saldo_akhir" value="<?= number_format(
                                                    $saldo_akhir
                                                ) ?>" readonly>

                                            </div>
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



     

   </body>
   </html>
