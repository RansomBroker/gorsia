<?php
include_once 'v_user_config.php';
?>

<?php if(isset($get_data_transaksi_per_id)){
 foreach($get_data_transaksi_per_id as $row) {
  $id_jurnal_view                           = $row->id_jurnal;
  $no_bukti_view                            = $row->no_bukti;
  $kode_jenis_jurnal_view                   = $row->kode_jenis_jurnal;
  $tanggal_view                             = $row->tanggal;
  $no_referensi_view                        = $row->no_referensi;
  $dari_view                                = $row->dari;
  $kepada_view                              = $row->kepada;
  $keterangan_view                          = $row->keterangan;

  #kode jenis jurnal
  $rows_jn = $this->db->query("SELECT * FROM kode_jenis_jurnal where kode_jenis_jurnal='".$kode_jenis_jurnal_view."'")->row_array();
  $deskripsi_jenis_jurnal_view=$rows_jn['deskripsi'];

 
  }
}

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

  <title>Gorsia - Transaksi Jurnal</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Akuntansi /</span> Transaksi Jurnal</h4>

               <?php if(!isset($no_bukti_view)) { ?>


                                    <?php if ($akses_read=="Aktif") {
                                    echo '<a href="'.site_url().'?/TransaksiJurnal/pencarian"><button class="btn btn-sm btn-outline-primary"><i class="bx bx-search-alt-2"></i> Pencarian</button></a><br><br>'; } ?>

                                <?php } ?>



                                 <?php if(isset($no_bukti_view)) { ?>

                                <?php if ($akses_create=="Aktif") {
                                    echo '<a href="'.site_url().'?/TransaksiJurnal" class="btn btn-sm btn-outline-primary"><i class="bx bx-book-add"></i> Baru</a>'; } ?>

                                <?php if ($akses_read=="Aktif") {
                                    echo '<a href="'.site_url().'?/TransaksiJurnal/pencarian"><button class="btn btn-sm btn-outline-primary"><i class="bx bx-search-alt-2"></i> Pencarian</button></a>'; } ?>

                                   

                                <?php if ($akses_delete=="Aktif") {
                                    echo '<a onclick="return konfirm_hapus()" href="'.site_url().'?/TransaksiJurnal/delete_data/no/'.$no_bukti_view.'" class="btn btn-sm btn-outline-danger"><i class="bx bx-trash-alt"></i> Hapus</a>'; } ?>

                                    <br>
                                    <br>

                                <?php } ?>


              <div class="row">
                <?php

                if(isset($no_bukti_view)) {
                  echo form_open_multipart(site_url().'?/TransaksiJurnal/update_data');
                }
                else { 
                  echo form_open_multipart(site_url().'?/TransaksiJurnal/insert_data');
                } 
                ?>


                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Isi data jurnal</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <form>

                         <?php if(isset($no_bukti_view)){ ?>


                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">No. Bukti</label>
                          <input class="form-control" type="text" id="no_bukti" name="no_bukti" placeholder=""  value="<?php if(isset($no_bukti_view)){ echo $no_bukti_view; } ?>" readonly />
                        </div>

                        <?php  } ?>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Jenis Jurnal</label>
                          <select class="form-select" id="kode_jenis_jurnal" name="kode_jenis_jurnal" aria-label="Default select example" <?php if(isset($no_bukti_view)){ echo 'disabled'; } ?> required>
                                    <?php if(isset($no_bukti_view)){ print "<option value='$kode_jenis_jurnal_view'>$kode_jenis_jurnal_view - $deskripsi_jenis_jurnal_view</option>"; } ?>
                            <option>- - - Pilih - - -</option>
                            <?php foreach($get_all_kode_jenis_jurnal as $row) {  
                              $kode_jenis_jurnal_cb = $row->kode_jenis_jurnal;
                              $deskripsi_cb = $row->deskripsi;
                              print "<option value='$kode_jenis_jurnal_cb'>$kode_jenis_jurnal_cb - $deskripsi_cb</option>";
                            } ?>
                          </select>
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Tanggal</label>
                          <input class="form-control" type="date" id="tanggal" name="tanggal" placeholder=""  value="<?php if(isset($no_bukti_view)){ echo $tanggal_view; } ?>" />
                        </div>
                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">No. Referensi</label>
                          <input class="form-control" type="text" id="no_referensi" name="no_referensi" placeholder="No. Referensi"  value="<?php if(isset($no_bukti_view)){ echo $no_referensi_view; } ?>" autocomplete="off" />
                        </div>
                         <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Dari</label>
                          <input class="form-control" type="text" id="dari" name="dari" placeholder="Dari"  value="<?php if(isset($no_bukti_view)){ echo $dari_view; } ?>" autocomplete="off" />
                        </div>

                          <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Kepada</label>
                          <input class="form-control" type="text" id="kepada" name="kepada" placeholder="Kepada"  value="<?php if(isset($no_bukti_view)){ echo $kepada_view; } ?>" autocomplete="off" />
                        </div>

                     <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Keterangan</label>
                          <input class="form-control" type="text" id="keterangan" name="keterangan" placeholder="Isi Keterangan"  value="<?php if(isset($no_bukti_view)){ echo $keterangan_view; } ?>" autocomplete="off" />
                        </div>

                        <?php 
                        if(isset($no_bukti_view)) { ?>
                          <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Simpan Perubahan</button>
                        <?php echo '&nbsp;&nbsp;<a href="'.site_url().'?/TransaksiJurnal"><button class="btn btn-danger">Batal</button></a>'; }  ?>

                        <?php if(!isset($no_bukti_view)) {  ?>
                        <button type="submit" class="btn btn-primary">Lanjut >></button>
                      <?php } ?>

                      </form>
                    </div>
                  </div>
                </div>
                <?php echo form_close(); ?>

              </div>

              <!-- Basic Bootstrap Table -->

              <div class="card <?= isset($no_bukti_view) ? '':'d-none'?>">

                <div id="notifications">
                  <?php echo $this->session->flashdata('msg'); ?>
                </div>

                <div class="card-header">
                  <h5 class="float-start">Detil Jurnal</h5>
                  <a class="btn btn-primary text-white float-end" data-bs-toggle="modal" data-bs-target="#modal-akun">
                    <i class="bx bx-plus me-2"></i>
                    Tambah Akun
                  </a>
                </div>
                <?php echo form_open_multipart(site_url().'?/TransaksiJurnal/insert_data_detail_array'); ?>
                <div class="card-body">
                  <input class="form-control" type="hidden" name="no_bukti" placeholder=""  value="<?php if(isset($no_bukti_view)){ echo $no_bukti_view; } ?>" readonly />
                  <table id="container_akun" class="table table-responsive">

                  </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                  <button type="submit" id="button_submit" disabled class="btn btn-primary" onclick="kirim_form()">
                    <i class="bx bx-save"></i> Simpan
                  </button>
                </div>
                <?php echo form_close(); ?>
                <?php
                if(false) {
                  ?>
                  <div class="table-responsive text-nowrap" id="detil_jurnal">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>No. Perkiraan</th>
                          <th>Uraian</th>
                          <th>Debet</th>
                          <th>Kredit</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <?php echo form_open_multipart(site_url().'?/TransaksiJurnal/insert_data_detail'); ?>
                          <tr role="row">
                              <td colspan="2">
                                <input class="form-control" type="hidden" id="no_bukti" name="no_bukti" placeholder="" value="<?php if(isset($no_bukti_view)){ echo $no_bukti_view; } ?>" readonly="" />
                                <select class="form-control form-control-sm" name="id_kode_akuntansi" id="id_kode_akuntansi" required=""  >
                                <option value="">- - - - - - - - - - Daftar Akun - - - - - - - - - - </option>
                                <?php foreach($get_all_data_akun as $row) {
                                    $id_kode_akuntansi = $row->id_kode_akuntansi;
                                    $kode_akun = $row->kode_akun;
                                    $nama_akun = $row->nama_akun;

                                    print "<option value='$id_kode_akuntansi'>$kode_akun - $nama_akun</option>";
                                      } ?>
                                </select>
                              </td>
                              <td>
                                <div class="input-group input-group-sm">
                                  <input type="text" class="form-control" name="uraian" id="uraian" placeholder="Uraian" autocomplete="off"  required="">
                                </div>
                              </td>
                              <td>
                                <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="debet" id="debet" placeholder="Debet" autocomplete="off">
                                </div>
                              </td>
                              <td>
                                <div class="input-group input-group-sm">
                                  <input type="text" class="form-control" name="kredit" id="kredit" placeholder="Kredit" autocomplete="off">
                                </div>
                              </td>
                              <td><button type="submit" class="btn  btn-sm  btn-primary" ><i class="bx bx-plus"></i></button></td>
                          </tr>
                        <?php echo form_close(); ?>
                        <?php if(isset($no_bukti_view)) { ?>

                        <?php 
                        $no=0;
                        $total_debet=0;
                        $total_kredit=0;
                        foreach($get_jurnal_detil as $row) {    

                          $no++; 

                          $id_jurnal_detail = $row->id_jurnal_detail;
                          $id_kode_akuntansi= $row->id_kode_akuntansi;
                          $uraian= $row->uraian;
                          $debet= $row->debet;
                          $kredit= $row->kredit;

                                          #akun
                          $rows_akun = $this->db->query("SELECT * FROM kode_akuntansi where id_kode_akuntansi='".$id_kode_akuntansi."'")->row_array();
                          $kode_akun=$rows_akun['kode_akun'];
                          $nama_akun_dt=$rows_akun['nama_akun'];


                          $user_created = $row->user_created;
                          $created_at = date("d F Y H:i:s", strtotime($row->created_at));

                          $user_modified = $row->user_modified;
                          $modified_at = date("d F Y H:i:s", strtotime($row->modified_at));

                          $total_debet = doubleval($total_debet + $debet);
                          $total_kredit = doubleval($total_kredit + $kredit);



                          $selisih = doubleval($total_debet-$total_kredit);

                          if($selisih<>0){

                          $status_balance = "Tidak Balance";

                        }

                        else{
                          $status_balance = "Balance";
                        }


                          echo '<tr>
                          <td class="sorting_1">'.$no.'.</td>
                                                    <td align="center">'.$kode_akun.' - '.$nama_akun_dt.'</td>
                                                    <td align="center">'.$uraian.' </td>
                                                    <td align="right">'.number_format($debet).'</td>
                                                    <td align="right">'.number_format($kredit).'</td>
                          <td align="center">';
                          echo '<a onclick="return konfirm_hapus_detail()" href="'.site_url().'?/TransaksiJurnal/delete_data_detail/no/'.$no_bukti_view.'/id/'.$id_jurnal_detail.'"><i class="ti-trash"></i>Hapus</a>';
                          echo '</td><tr>';


                            }
                            ?>

                          <?php } #end iset?>


                          <?php if(isset($no_bukti_view)) { if($total_debet>0 || $total_kredit>0){ ?>
                                            <tr role="row">
                                                <td style="background-color: #F2F3F4" colspan="2" align="right"><b>Jurnal :</b></th>
                                                <td style="background-color: #F2F3F4" colspan="1" align="left"><b><?= $status_balance; ?></b></th>
                                                  <td style="background-color: #F2F3F4" colspan="1" align="right"><b>Selisih :</b></th>
                                                <td style="background-color: #F2F3F4" colspan="1" align="left"><b><?= number_format($selisih); ?></b></th>
                                                <td style="background-color: #F2F3F4" colspan="1" align="left"></th>
                                            </tr>

                                        <?php } } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <?php
                }
                ?>
                <!--/ Basic Bootstrap Table -->

              </div>
              
              <!-- Modal Tambah Kode Akuntansi -->
              <div class="modal fade" id="modal-akun" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel1">Pilih Kode Akuntansi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-xl">
                          <div class="mb-3">
                            <table class="table table-responsive">
                              <thead>
                                <tr>
                                  <th>
                                    <input type="checkbox" class="form-check-input" id="">
                                  </th>
                                  <th>Kode Akun</th>
                                  <th>Nama Akun</th>
                                  <th>Kategori</th>
                                </tr>
                              </thead>
                              <tbody class="table-border-bottom-0">
                                <?php
                                $no=0;
                                foreach($get_all_data_akun as $row) {    
                                  $no++; 
                                  $id_kode_akuntansi = $row->id_kode_akuntansi;
                                  echo '<tr>
                                  <td>
                                    <input type="checkbox" class="form-check-input" name="kode_akun" value="'.$id_kode_akuntansi.'" id="'.$id_kode_akuntansi.'">
                                  </td>
                                  <td>'.$row->kode_akun.'</td>
                                  <td>'.$row->nama_akun.'</td>
                                  <td>'.$row->pos.'</td>';
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                      </button>
                      <button type="button" onclick="generate_form()" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Modal Tambah Kode Akuntansi -->

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


<script type="text/javascript" language="JavaScript">
  var kode_akun= <?=json_encode($get_all_data_akun)?>;
 function konfirm_hapus()
 {
  tanya = confirm("Hapus data jurnal ?");
  if (tanya == true) return true;
  else return false;
 }
 
 function konfirm_hapus_detail()
 {
  tanya = confirm("Hapus data detail jurnal ?");
  if (tanya == true) return true;
  else return false;
 }

 function generate_form()
 {
  $("#container_akun").html(`
    <tr class="border-2 border-top-0 border-start-0 border-end-0">
      <td>Kode Akun</td>
      <td>Nama Akun</td>
      <td>Uraian</td>
      <td>Debit</td>
      <td>Kredit</td>
    </tr>
  `);
  $("input:checkbox[name=kode_akun]:checked").each(function(){
    console.log($(this).val());
    let akun = kode_akun.find(x => x.id_kode_akuntansi == $(this).val());
    $("#container_akun").append(`
      <tr style="height: 75px">
        <td>${akun.kode_akun}</td>
        <td>${akun.nama_akun}</td>
        <td class="px-2"><input type="text" name="uraian[`+$(this).val()+`]" class="form-control"></td>
        <td class="px-2"><input type="text" name="debet[`+$(this).val()+`]" onkeyup="hitung_debet()" class="form-control"></td>
        <td class="px-2"><input type="text" name="kredit[`+$(this).val()+`]" onkeyup="hitung_kredit()" class="form-control"></td>
      </tr>
    `);
  });
  $("#container_akun").append(`
    <tr style="height: 75px">
      <td colspan="3">
        <span id="status_akuntansi">Balance</span>
      </td>
      <td>
        Rp. <span id="total_debet">0</span>
      </td>
      <td>
        Rp. <span id="total_kredit">0</span>
      </td>
    </tr>
  `);
  $('#modal-akun').modal('hide');
 }

 function hitung_debet(){
  let total_debet = 0;
  $(document).find("input[name^='debet']").each(function(){
    let val = $(this).val();
    if(val == "") val = 0;
    total_debet += parseInt(val);
  });
  $(document).find("#total_debet").html(total_debet);
  hitung_selisih();
 }

  function hitung_kredit(){
    let total_kredit = 0;
    $(document).find("input[name^='kredit']").each(function(){
      let val = $(this).val();
      if(val == "") val = 0;
      total_kredit += parseInt(val);
    });
    $(document).find("#total_kredit").html(total_kredit);
    hitung_selisih();
  }

  function hitung_selisih(){
    let total_debet = parseInt($(document).find("#total_debet").html());
    let total_kredit = parseInt($(document).find("#total_kredit").html());
    let selisih = total_debet - total_kredit;
    if(selisih == 0){
      $(document).find("#status_akuntansi").html("Balance");
      $(document).find("#button_submit").prop("disabled", false);
    }else{
      $(document).find("#status_akuntansi").html("Selisih");
      $(document).find("#button_submit").prop("disabled", true);
    }
  }

  function kirim_form() {
    let form = document.getElementById("form_akun");
    let formData = new FormData(form);
    $.ajax({
      url: form.action,
      type: form.method,
      data: formData,
      success: function(response){
        console.log(response);
      },
      error: function(xhr, status, error){
        console.log(xhr.responseText);
      },
      cache: false,
      contentType: false,
      processData: false
    });
  }
 </script>

  
     

   </body>
   </html>
