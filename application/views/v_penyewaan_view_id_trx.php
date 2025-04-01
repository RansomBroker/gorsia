<?php
include_once 'v_user_config.php';


$id_trx = $this->uri->segment('4');

 #lapangan yg disewa
$rows_lapangan_disewa = $this->db->query("SELECT * FROM transaksi_sewa where id_transaksi='".$id_trx."'")->row_array();
$tanggal_view=$rows_lapangan_disewa['tanggal'];
$nama_pelanggan_view=$rows_lapangan_disewa['nama_pelanggan'];
$id_member_view=$rows_lapangan_disewa['id_member'];
$no_telepon_view=$rows_lapangan_disewa['no_telepon'];
$id_kategori_olahraga=$rows_lapangan_disewa['id_kategori_olahraga'];
$id_lapangan=$rows_lapangan_disewa['id_lapangan'];
$status_transaksi_view=$rows_lapangan_disewa['status_transaksi'];
$total_harga_view=$rows_lapangan_disewa['total'];


#lapangan
$rows_lapangan = $this->db->query("SELECT * FROM lapangan where id_lapangan='".$id_lapangan."'")->row_array();
$nama_lapangan=$rows_lapangan['nama_lapangan'];
$ukuran_lapangan=$rows_lapangan['ukuran_lapangan'];
$maksimal_kapasitas_orang=$rows_lapangan['maksimal_kapasitas_orang'];

#kategori
$rows_kategori = $this->db->query("SELECT * FROM kategori_olahraga where id_kategori_olahraga='".$id_kategori_olahraga."'")->row_array();
$kategori_olahraga=$rows_kategori['kategori_olahraga'];

if($kategori_olahraga=="Futsal"){
  $img_lapangan = "1.jpg";
}
elseif($kategori_olahraga=="Badminton"){
  $img_lapangan = "2.jpg";
}
else{
 $img_lapangan = "no_image.jpg";
}

                      #harga
$rows_harga = $this->db->query("SELECT * FROM paket_sewa where id_kategori_olahraga='".$id_kategori_olahraga."'")->row_array();
$harga=$rows_harga['harga'];
$id_satuan=$rows_harga['id_satuan'];

                      #satuan
$rows_satuan = $this->db->query("SELECT * FROM satuan_sewa where id_satuan_sewa='".$id_satuan."'")->row_array();
$satuan_sewa=$rows_satuan['satuan_sewa'];

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

  <title>Gorsia - Penyewaan</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> Sewa Lapangan</h4>




               <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Lapangan yang dipilih untuk sewa</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <div class="col-md-12 col-lg-12">
                        <h6 class="mt-2 text-muted"><br></h6>
                        <div class="card">
                          <img class="card-img-top" src="assets/images/lapangan/<?= $img_lapangan; ?>" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title"><?= $kategori_olahraga; ?></h5>
                            <p class="card-text"><?= $nama_lapangan; ?></p>
                          </div>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">Ukuran <?= $ukuran_lapangan; ?></li>
                            <li class="list-group-item">Maksimal <?= $maksimal_kapasitas_orang; ?> Orang</li>
                            <li class="list-group-item">Harga Mulai <b> Rp <?= number_format($harga); ?></b> / <?= $satuan_sewa; ?></li>
                          </ul>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Silahkan isi data penyewa</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <?php
                echo form_open_multipart(site_url().'?/Penyewaan/update_data_penyewaan/idtrx/'.$id_trx); 
                ?>
                      <form>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Tanggal</label>
                          <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="" required value="<?php if(isset($tanggal_view)){ echo $tanggal_view; } ?>"  <?php if($tanggal_view<>'0000-00-00'){ echo "readonly"; } ?> />
                        </div>


                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Member</label>
                          <select class="form-select" id="id_member" name="id_member" aria-label="Default select example" required>
                            <?php if(isset($tanggal_view)){
                              print "<option value='$id_member_view' selected>$id_member_view</option>";
                            }?>
                            <option value='NONMEMBER'>Non Member</option>
                            <option>- - - Pilih - - -</option>
                            <?php foreach($get_all_member as $row) {  
                              $id_member_cb = $row->id_member;
                              $nama_pelanggan_cb = $row->nama_pelanggan;
                              print "<option value='$id_member_cb'>$id_member_cb - $nama_pelanggan_cb</option>";
                            } ?>
                          </select>
                        </div>

                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Nama Pelanggan</label>
                          <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="" required value="<?php if(isset($tanggal_view)){ echo $nama_pelanggan_view; } ?>" />
                        </div>

                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">No. Telepon</label>
                          <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="" required value="<?php if(isset($tanggal_view)){ echo $no_telepon_view; } ?>" />
                        </div>
                       
                         <?php if($tanggal_view=='0000-00-00'){ ?>
                        <button type="submit" class="btn btn-primary">Lanjut Pilih Sesi</button>
                      <?php } else { ?>
                        <button type="submit" class="btn btn-primary">Simpan data</button>
                      <?php } ?>

                        
                   
                      </form>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>

              </div>


              <!-- Jadwal Sesi -->
              <?php if($tanggal_view<>'0000-00-00'){ ?>
              <?php echo form_open_multipart(site_url().'?/Penyewaan/select_sesi_sewa/id_trx/'.$id_trx); ?>

              <div class="card">

                <h5 class="card-header">Jadwal Sesi Tersedia</h5>

                <div class="d-flex flex-wrap" id="icons-container">

                  <?php $no=0;
                  foreach($get_all_jadwal_sesi as $row) {    
                    $no++; 

                    $id_jadwal_sesi = $row->id_jadwal_sesi;
                    $id_kategori_olahraga = $row->id_kategori_olahraga;
                    $jam_sesi= $row->jam_sesi;

                      #kategori olahraga
                    $rows_kategori_or = $this->db->query("SELECT * FROM kategori_olahraga where id_kategori_olahraga='".$id_kategori_olahraga."'")->row_array();
                    $kategori_olahraga=$rows_kategori_or['kategori_olahraga'];

                    #baca apa sesi ini ada pada transaksi

                    $rows_cek = $this->db->query("SELECT * FROM transaksi_sewa_detil JOIN transaksi_sewa ON transaksi_sewa_detil.id_transaksi=transaksi_sewa.id_transaksi where transaksi_sewa_detil.id_jadwal_sesi='".$id_jadwal_sesi."' AND transaksi_sewa.tanggal='".$tanggal_view."'")->row_array();
                    $id_transaksi_detil_cek=$rows_cek['id_transaksi_detil'];

                    if(isset($id_transaksi_detil_cek)){
                      $warna = "#E6B0AA";
                      $harga_new = "Booked";
                    }
                    else{
                      $warna = "#F2F3F4";
                      $harga_new = 'Rp'. number_format($harga);

                    }


                    ?>



                    <div class="card icon-card cursor-pointer text-center mb-4 mx-2" style="background-color: <?= $warna; ?>">
                      <div class="card-body">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="1" name="txt_check_id_jadwal_sesi_<?=$id_jadwal_sesi;?>" id="txt_check_id_jadwal_sesi_<?=$id_jadwal_sesi;?>" <?php if(isset($id_transaksi_detil_cek)){ echo "disabled"; } ?> >
                        </div>
                        <p class="icon-name text-capitalize text-truncate mb-0"><b><?= $jam_sesi; ?></b><br> <?= $harga_new; ?></p>
                          <input type="hidden" class="form-control" id="txt_harga" name="txt_harga" placeholder="" required value="<?= $harga ?>" />

                      </div>



                    </div>

                  <?php } ?>


                </div>
                  <div class="mb-3" align="center"><button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Pilih </button></div>

              </div>

              <?php echo form_close(); ?>
              <?php } ?>

              <!--/ Jadwal Sesi -->



               <!-- Total Transaksi -->

              <div class="card">

                <div id="notifications">
                  <?php echo $this->session->flashdata('msg'); ?>
                </div>

                <h5 class="card-header">Total Transaksi</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Sesi</th>
                        <th>Harga</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                     <?php $no=0;
                     foreach($get_all_sewa_detil as $row_dt) {    
                      $no++; 

                      $id_transaksi_detil = $row_dt->id_transaksi_detil;
                      $id_transaksi = $row_dt->id_transaksi;
                      $id_jadwal_sesi = $row_dt->id_jadwal_sesi;
                      $harga= $row_dt->harga;

                      #sesi
                      $rows_sesi= $this->db->query("SELECT * FROM jadwal_sesi where id_jadwal_sesi='".$id_jadwal_sesi."'")->row_array();
                      $jam_sesi=$rows_sesi['jam_sesi'];


                      echo '<tr>
                      <td>'.$jam_sesi.'</td>
                      <td>'.number_format($harga).'</td>
                      <td align="left">';

                        if ($akses_delete=="Aktif"){
                          echo '<a onclick="return konfirm_hapus()" href="'.site_url().'?/Penyewaan/delete_data_sesi/id_trx/'.$id_transaksi.'/id_dt/'.$id_transaksi_detil.'"><i class="bx bx-trash me-2"></i> Delete</a>';}
                          echo '</td><tr>';

                        }
                        ?>



                      </tbody>

                      <tfoot>
                      <tr>
                        <th>TOTAL HARGA</th>
                        <th>Rp. <?= number_format($total_harga_view); ?></th>
                        <th></th>
                      </tr>
                    </tfoot>
                    </table>
                  </div>
                </div>
                <!--/ Total Transaksi -->


                <!-- Status Transaksi -->
              <?php if($status_transaksi_view<>'Draft'){ ?>

              <div class="card">

                <h5 class="card-header">Status Transaksi : <?= $status_transaksi_view; ?></h5>

              <?php echo form_open_multipart(site_url().'?/Penyewaan/ubah_status_in_sewa/id_trx/'.$id_trx); ?>

                  <div class="mb-3" align="center"><button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Check In Sewa </button></div>

              <?php echo form_close(); ?>

               <?php echo form_open_multipart(site_url().'?/Penyewaan/ubah_status_selesai/id_trx/'.$id_trx); ?>

                  <div class="mb-3" align="center"><button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Transaksi Selesai </button></div>

              <?php echo form_close(); ?>


               <?php echo form_open_multipart(site_url().'?/Penyewaan/cetak/id_trx/'.$id_trx); ?>

                  <div class="mb-3" align="center"><button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Cetak Nota </button></div>

              <?php echo form_close(); ?>


              </div>

              <?php } ?>

              <!--/ Jadwal Sesi -->


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



<script type="text/javascript">
  $(document).ready(function(){
    $('#id_member').change(function(){
      var id=$(this).val();
      $.ajax({
        url : "<?php echo site_url();?>?/Penyewaan/get_info_member",
        method : "POST",
        data : {id: id},
        async : false,
            dataType : 'json',
        success: function(data){
         
        $('#nama_pelanggan').val(data[0].nama_pelanggan);
        $('#no_telepon').val(data[0].no_telepon);
          
        }
      });
    });
  });
</script>


   </body>
   </html>
