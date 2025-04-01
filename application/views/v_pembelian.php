<?php
include_once 'v_user_config.php';
?>

<?php if(isset($get_data_transaksi_per_id)){
 foreach($get_data_transaksi_per_id as $row) {
  $no_pembelian_view                        = $row->no_pembelian;
  $kode_jenis_jurnal_view                   = $row->kode_jenis_jurnal;
  $no_bukti_jurnal_view                   = $row->no_bukti_jurnal;
  $tanggal_view                             = $row->tanggal;
  $nota_pembelian_view                      = $row->nota_pembelian;
  $kode_suplier_view                        = $row->kode_suplier;
  $cara_bayar_view                          = $row->cara_bayar;
  $id_kode_akun_beban_debet_view            = $row->id_kode_akun_beban_debet;
  $id_kode_akun_pembayaran_kas_kredit_view  = $row->id_kode_akun_pembayaran_kas_kredit;
  $id_kode_akun_hutang_bertambah_kredit_view   = $row->id_kode_akun_hutang_bertambah_kredit;


  #kode suplier
  $rows_spl = $this->db->query("SELECT * FROM suplier where kode_suplier='".$kode_suplier_view."'")->row_array();
  $nama_suplier_view=$rows_spl['nama_suplier'];

  #kode jenis jurnal
  $rows_jn = $this->db->query("SELECT * FROM kode_jenis_jurnal where kode_jenis_jurnal='".$kode_jenis_jurnal_view."'")->row_array();
  $deskripsi_jenis_jurnal_view=$rows_jn['deskripsi'];

  #kode akun beban
  $rows_beban = $this->db->query("SELECT * FROM kode_akuntansi where id_kode_akuntansi='".$id_kode_akun_beban_debet_view."'")->row_array();
  $kode_akun_beban_debet_view=$rows_beban['kode_akun'];
  $nama_akun_beban_debet_view=$rows_beban['nama_akun'];

  #kode pembayaran
  $rows_pembayaran = $this->db->query("SELECT * FROM kode_akuntansi where id_kode_akuntansi='".$id_kode_akun_pembayaran_kas_kredit_view."'")->row_array();
  $kode_akun_pembayaran_kas_kredit_view=$rows_pembayaran['kode_akun'];
  $nama_akun_pembayaran_kas_kredit_view=$rows_pembayaran['nama_akun'];


   #kode pembayaran
  $rows_hutang = $this->db->query("SELECT * FROM kode_akuntansi where id_kode_akuntansi='".$id_kode_akun_hutang_bertambah_kredit_view."'")->row_array();
  $kode_akun_hutang_bertambah_kredit_view=$rows_hutang['kode_akun'];
  $nama_akun_hutang_bertambah_kredit_view=$rows_hutang['nama_akun'];

 
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

  <title>Gorsia - Pembelian</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Pembelian</h4>

               <?php if(!isset($no_pembelian_view)) { ?>


                                    <?php if ($akses_read=="Aktif") {
                                    echo '<a href="'.site_url().'?/Pembelian/pencarian"><button class="btn btn-sm btn-outline-primary"><i class="bx bx-search-alt-2"></i> Pencarian</button></a><br><br>'; } ?>

                                <?php } ?>



                                 <?php if(isset($no_pembelian_view)) { ?>

                                <?php if ($akses_create=="Aktif") {
                                    echo '<a href="'.site_url().'?/Pembelian" class="btn btn-sm btn-outline-primary"><i class="bx bx-book-add"></i> Baru</a>'; } ?>

                                <?php if ($akses_read=="Aktif") {
                                    echo '<a href="'.site_url().'?/Pembelian/pencarian"><button class="btn btn-sm btn-outline-primary"><i class="bx bx-search-alt-2"></i> Pencarian</button></a>'; } ?>

                                   

                                <?php if ($akses_delete=="Aktif") {
                                    echo '<a onclick="return konfirm_hapus()" href="'.site_url().'?/Pembelian/delete_data/no/'.$no_pembelian_view.'" class="btn btn-sm btn-outline-danger"><i class="bx bx-trash-alt"></i> Hapus</a>'; } ?>

                                    <br>
                                    <br>

                                <?php } ?>


              <div class="row">
                <?php

                if(isset($no_pembelian_view)) {
                  echo form_open_multipart(site_url().'?/Pembelian/update_data');
                }
                else { 
                  echo form_open_multipart(site_url().'?/Pembelian/insert_data');
                } 
                ?>


                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Isi data pembelian</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <form>

                         <?php if(isset($no_pembelian_view)){ ?>


                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">No. Pembelian</label>
                          <input class="form-control" type="text" id="no_pembelian" name="no_pembelian" placeholder=""  value="<?php if(isset($no_pembelian_view)){ echo $no_pembelian_view; } ?>" readonly />
                        </div>

                        <?php  } ?>


                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Tanggal</label>
                          <input class="form-control" type="date" id="tanggal" name="tanggal" placeholder=""  value="<?php if(isset($no_pembelian_view)){ echo $tanggal_view; } ?>" />
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Suplier</label>
                          <select class="form-select" id="kode_suplier" name="kode_suplier" aria-label="Default select example" <?php if(isset($no_pembelian_view)){ echo 'disabled'; } ?> required>
                                    <?php if(isset($no_pembelian_view)){ print "<option value='$kode_suplier_view'>$nama_suplier_view</option>"; } ?>
                            <option>- - - Pilih - - -</option>
                            <?php foreach($get_all_kode_suplier as $row) {  
                              $kode_suplier_cb = $row->kode_suplier;
                              $nama_suplier_cb = $row->nama_suplier;
                              print "<option value='$kode_suplier_cb'>$nama_suplier_cb</option>";
                            } ?>
                          </select>
                        </div>
                        
                       
                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Nota Pembelian</label>
                          <input class="form-control" type="text" id="nota_pembelian" name="nota_pembelian" placeholder="Nota Pembelian"  value="<?php if(isset($no_pembelian_view)){ echo $nota_pembelian_view; } ?>" autocomplete="off" />
                        </div>

                         <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Cara Bayar</label>
                          <select class="form-select" id="cara_bayar" name="cara_bayar" aria-label="Default select example" <?php if(isset($no_pembelian_view)){ echo 'disabled'; } ?> required>
                                    <?php if(isset($no_pembelian_view)){ print "<option value='$cara_bayar_view'>$cara_bayar_view</option>"; } ?>
                            <option>- - - Pilih - - -</option>
                            <option value="Cash"> Cash </option>
                            <option value="Transfer"> Transfer </option>
                            <option value="Hutang"> Hutang </option>
                            
                          </select>
                        </div>


                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Kode Jurnal</label>
                          <select class="form-select" id="kode_jenis_jurnal" name="kode_jenis_jurnal" aria-label="Default select example" <?php if(isset($no_pembelian_view)){ echo 'disabled'; } ?> required>
                                    <?php if(isset($no_pembelian_view)){ print "<option value='$kode_suplier_view'>$nama_suplier_view</option>"; } ?>
                            <option>- - - Pilih - - -</option>
                            <?php foreach($get_all_kode_jenis_jurnal as $row_j) {  
                              $kode_jenis_jurnal_cb = $row_j->kode_jenis_jurnal;
                              $deskripsi_cb = $row_j->deskripsi;
                              print "<option value='$kode_jenis_jurnal_cb'>$kode_jenis_jurnal_cb - $deskripsi_cb</option>";
                            } ?>
                          </select>
                        </div>

                          <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Akun Beban (Debet)</label>
                          <select class="form-select" id="id_kode_akun_beban_debet" name="id_kode_akun_beban_debet" aria-label="Default select example" <?php if(isset($no_pembelian_view)){ echo 'disabled'; } ?> required>
                                    <?php if(isset($no_pembelian_view)){ print "<option value='$id_kode_akun_beban_debet_view'>$kode_akun_beban_debet_view - $nama_akun_beban_debet_view</option>"; } ?>
                            <option>- - - Pilih - - -</option>
                            <?php foreach($get_all_kode_akun_beban as $row_b) {  
                              $id_kode_akuntansi_akun_beban_cb = $row_b->id_kode_akuntansi;
                              $kode_akun_beban_cb = $row_b->kode_akun;
                              $nama_akun_beban_cb = $row_b->nama_akun;
                              print "<option value='$id_kode_akuntansi_akun_beban_cb'>$kode_akun_beban_cb - $nama_akun_beban_cb</option>";
                            } ?>
                          </select>
                        </div>

                    <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Akun Pembayaran Dengan Kas / Bank (Kredit)</label>
                          <select class="form-select" id="id_kode_akun_pembayaran_kas_kredit" name="id_kode_akun_pembayaran_kas_kredit" aria-label="Default select example" <?php if(isset($no_pembelian_view)){ echo 'disabled'; } ?>>
                                    <?php if(isset($no_pembelian_view)){ print "<option value='$id_kode_akun_pembayaran_kas_kredit_view'>$kode_akun_pembayaran_kas_kredit_view - $nama_akun_pembayaran_kas_kredit_view</option>"; } ?>
                            <option>- - - Pilih - - -</option>
                            <?php foreach($get_all_kode_akun_kas as $row_k) {  
                              $id_kode_akuntansi_akun_kas_cb = $row_k->id_kode_akuntansi;
                              $kode_akun_kas_cb = $row_k->kode_akun;
                              $nama_akun_kas_cb = $row_k->nama_akun;
                              print "<option value='$id_kode_akuntansi_akun_kas_cb'>$kode_akun_kas_cb - $nama_akun_kas_cb</option>";
                            } ?>
                          </select>
                        </div>


                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Akun Pembayaran Dengan Hutang Bertambah (Kredit)</label>
                          <select class="form-select" id="id_kode_akun_hutang_bertambah_kredit" name="id_kode_akun_hutang_bertambah_kredit" aria-label="Default select example" <?php if(isset($no_pembelian_view)){ echo 'disabled'; } ?>>
                                    <?php if(isset($no_pembelian_view)){ print "<option value='$id_kode_akun_hutang_bertambah_kredit_view'>$kode_akun_hutang_bertambah_kredit_view - $nama_akun_hutang_bertambah_kredit_view</option>"; } ?>
                            <option>- - - Pilih - - -</option>
                            <?php foreach($get_all_kode_akun_hutang as $row_h) {  
                              $id_kode_akuntansi_akun_hutang_cb = $row_h->id_kode_akuntansi;
                              $kode_akun_hutang_cb = $row_h->kode_akun;
                              $nama_akun_hutang_cb = $row_h->nama_akun;
                              print "<option value='$id_kode_akuntansi_akun_hutang_cb'>$kode_akun_hutang_cb - $nama_akun_hutang_cb</option>";
                            } ?>
                          </select>
                          *Bila pembelian merupakan hutang (lawan debet yaitu akun beban)
                        </div>


                        <?php if(isset($no_pembelian_view)){ ?>


                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">No. Bukti Jurnal</label>
                          <input class="form-control" type="text" id="no_bukti_jurnal" name="no_bukti_jurnal" placeholder=""  value="<?php if(isset($no_pembelian_view)){ echo $no_bukti_jurnal_view; } ?>" readonly />
                        </div>

                        <?php  } ?>


                        <?php 
                        if(isset($no_pembelian_view)) { ?>
                          <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Simpan Perubahan</button>
                        <?php echo '&nbsp;&nbsp;<a href="'.site_url().'?/TransaksiJurnal"><button class="btn btn-danger">Batal</button></a>'; }  ?>

                        <?php if(!isset($no_pembelian_view)) {  ?>
                        <button type="submit" class="btn btn-primary">Lanjut >></button>
                      <?php } ?>

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

                <h5 class="card-header">Detil Pembelian</h5>
                <div class="table-responsive text-nowrap" id="detil_jurnal">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">


                       <?php echo form_open_multipart(site_url().'?/Pembelian/insert_data_detail'); ?>

                                        <tr role="row">
                                            <td colspan="2">
                                                <input class="form-control" type="hidden" id="no_pembelian" name="no_pembelian" placeholder="" value="<?php if(isset($no_pembelian_view)){ echo $no_pembelian_view; } ?>" readonly="" />
                                                <input class="form-control" type="hidden" id="no_bukti_jurnal" name="no_bukti_jurnal" placeholder="" value="<?php if(isset($no_pembelian_view)){ echo $no_bukti_jurnal_view; } ?>" readonly="" />


                                                <select class="form-select form-control-sm" name="kode_barang" id="kode_barang" required=""  >
                                                <option value="">- - - - - - - - - - Daftar Barang - - - - - - - - - - </option>
                                                <?php foreach($get_all_data_barang as $row) {
                                                    $kode_barang = $row->kode_barang;
                                                    $nama_barang = $row->nama_barang;
                                                    $satuan = $row->satuan;

                                                    print "<option value='$kode_barang'>$nama_barang - $satuan</option>";
                                                     } ?>
                                                </select>

                                                </td>


                                            <td>
                                             <div class="input-group input-group-sm">
                                             <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="0" autocomplete="off" onchange="callSubtotal()">
                                             </div>
                                            </td>

                                          

                                            <td>
                                             <div class="input-group input-group-sm">


                                                <input type="text" class="form-control" name="harga_beli" id="harga_beli" placeholder="0" autocomplete="off" onchange="callSubtotal()">
                                                </div>
                                            </td>


                                             <td>
                                             <div class="input-group input-group-sm">


                                                <input type="text" class="form-control" name="subtotal" id="subtotal" placeholder="0" autocomplete="off" readonly>
                                                </div>
                                            </td>


                                           

                                            <td><button type="submit" class="btn  btn-sm  btn-primary" ><i class="bx bx-plus"></i></button></td>
                                        </tr>




                                         <?php echo form_close(); ?>


                    <?php if(isset($no_pembelian_view)) { ?>

                     <?php 
                     $no=0;
                     $total=0;
                     foreach($get_pembelian_detil as $row) {    

                      $no++; 

                      $id_pembelian_detail = $row->id_pembelian_detail;
                      $kode_barang= $row->kode_barang;
                      $jumlah= $row->jumlah;
                      $harga_beli= $row->harga_beli;
                      $subtotal= $row->subtotal;

                      #barang
                      $rows_barang = $this->db->query("SELECT * FROM barang where kode_barang='".$kode_barang."'")->row_array();
                      $kode_barang_dt=$rows_barang['kode_barang'];
                      $nama_barang_dt=$rows_barang['nama_barang'];
                      $satuan_dt=$rows_barang['satuan'];


                      $user_created = $row->user_created;
                      $created_at = date("d F Y H:i:s", strtotime($row->created_at));

                      $user_modified = $row->user_modified;
                      $modified_at = date("d F Y H:i:s", strtotime($row->modified_at));

                      $total = $total + $subtotal;

                     
                      echo '<tr>
                      <td class="sorting_1">'.$no.'.</td>
                                                <td align="center">'.$nama_barang_dt.' - '.$satuan.'</td>
                                                <td align="center">'.$jumlah.' </td>
                                                <td align="right">'.number_format($harga_beli).'</td>
                                                <td align="right">'.number_format($subtotal).'</td>
                       <td align="center">';
                       echo '<a onclick="return konfirm_hapus_detail()" href="'.site_url().'?/Pembelian/delete_data_detail/no/'.$no_pembelian_view.'/id/'.$id_pembelian_detail.'"><i class="ti-trash"></i>Hapus</a>';
                       echo '</td><tr>';


                        }
                        ?>

                      <?php } #end iset?>


                      <?php if(isset($no_pembelian_view)) {  ?>
                                         <tr role="row">
                                            <td style="background-color: #F2F3F4" colspan="2" align="right"><b></b></th>
                                            <td style="background-color: #F2F3F4" colspan="1" align="left"><b></b></th>
                                              <td style="background-color: #F2F3F4" colspan="1" align="right"><b>Total :</b></th>
                                            <td style="background-color: #F2F3F4" colspan="1" align="left"><b><?= number_format($total); ?></b></th>
                                            <td style="background-color: #F2F3F4" colspan="1" align="left"></th>
                                         </tr>

                                     <?php }  ?>



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


<script type="text/javascript" language="JavaScript">
 function konfirm_hapus()
 {
 tanya = confirm("Yakin Hapus data pembelian ? Ini otomatis menghapus data jurnal terkait");
 if (tanya == true) return true;
 else return false;
 }</script>


     <script type="text/javascript" language="JavaScript">
 function konfirm_hapus_detail()
 {
 tanya = confirm("Hapus data detail pembelian ? Anda harus melakukann hapus manual pada  no. bukti jurnal terkait");
 if (tanya == true) return true;
 else return false;
 }</script>


 <script>
function callSubtotal(){


document.getElementById("subtotal").value = (document.getElementById("jumlah").value * document.getElementById("harga_beli").value);

}
</script> 

  
     

   </body>
   </html>
