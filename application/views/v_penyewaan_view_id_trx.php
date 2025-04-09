<?php
include_once 'v_user_config.php';

// Ambil id_transaksi dari URI (misalnya segment ke-4)
$id_trx = $this->uri->segment(4);

// Cek data penyewaan yang di-hold di session
$session_data = $this->session->userdata('data_penyewaan_hold');
// Ambil data transaksi dari database berdasarkan id_transaksi
$db_data = $this->db->query("SELECT * FROM transaksi_sewa WHERE id_transaksi='" . $id_trx . "'")->row_array();

// Tentukan sumber data: jika data database ada, gunakan itu; jika tidak, gunakan data dari session
$rows_lapangan_disewa = !empty($db_data) ? $db_data : $session_data;

// Tangkap nilai id_lapangan dan id_kategori_olahraga dari URL (misalnya segment ke-6 dan ke-8)
$id_lapangan_uri = $this->uri->segment(6);
$id_kategori_olahraga_uri = $this->uri->segment(8);

// Untuk id_lapangan: gunakan nilai dari URL jika ada; jika tidak, gunakan data transaksi
if (!empty($id_lapangan_uri)) {
    $id_lapangan = $id_lapangan_uri;
} else {
    $id_lapangan = $rows_lapangan_disewa['id_lapangan'];
}

// Untuk id_kategori_olahraga: gunakan nilai dari URL jika ada; jika tidak, gunakan data transaksi
if (!empty($id_kategori_olahraga_uri)) {
    $id_kategori_olahraga = $id_kategori_olahraga_uri;
} else {
    $id_kategori_olahraga = $rows_lapangan_disewa['id_kategori_olahraga'];
}

// Ambil data tanggal sewa dari tabel transaksi_sewa_tanggal (jika tersedia)
$tanggal_sewa = $this->db
    ->query("SELECT tanggal FROM transaksi_sewa_tanggal WHERE id_transaksi='" . $id_trx . "'")
    ->result_array();

if (empty($tanggal_sewa) && !empty($rows_lapangan_disewa['tanggal'])) {
    $tanggal_sewa = $rows_lapangan_disewa['tanggal'];
}

if (!empty($rows_lapangan_disewa['tanggal'])) {
    $tanggal_view = $rows_lapangan_disewa['tanggal_awal'];
} else {
    $tanggal_view = null;
}

$nama_pelanggan_view = $rows_lapangan_disewa['nama_pelanggan'];
$id_member_view = $rows_lapangan_disewa['id_member'];
$diskon = $rows_lapangan_disewa['diskon'];
$no_telepon_view = $rows_lapangan_disewa['no_telepon'];
$status_transaksi_view = $rows_lapangan_disewa['status_transaksi'];
$diskon_harga_view = $rows_lapangan_disewa['diskon'];
$total_harga_view = $rows_lapangan_disewa['total'];
$jenis_bayar_view = $rows_lapangan_disewa['jenis_bayar'];
$metode_bayar = $rows_lapangan_disewa['metode_bayar'];

// Ambil data lapangan berdasarkan $id_lapangan
$rows_lapangan = $this->db->query("SELECT * FROM lapangan WHERE id_lapangan='" . $id_lapangan . "'")->row_array();
$nama_lapangan = $rows_lapangan['nama_lapangan'];
$ukuran_lapangan = $rows_lapangan['ukuran_lapangan'];
$maksimal_kapasitas_orang = $rows_lapangan['maksimal_kapasitas_orang'];

// Ambil data kategori berdasarkan $id_kategori_olahraga
$rows_kategori = $this->db
    ->query("SELECT * FROM kategori_olahraga WHERE id_kategori_olahraga='" . $id_kategori_olahraga . "'")
    ->row_array();
$kategori_olahraga = $rows_kategori['kategori_olahraga'];

// Tentukan gambar lapangan berdasarkan kategori olahraga
if ($kategori_olahraga == 'Futsal') {
    $img_lapangan = '1.jpg';
} elseif ($kategori_olahraga == 'Badminton') {
    $img_lapangan = '2.jpg';
} else {
    $img_lapangan = 'no_image.jpg';
}

// Ambil data harga dan id_satuan dari tabel paket_sewa berdasarkan $id_kategori_olahraga
$rows_harga = $this->db
    ->query("SELECT * FROM paket_sewa WHERE id_kategori_olahraga='" . $id_kategori_olahraga . "'")
    ->row_array();
$harga = $rows_harga['harga'];
$id_satuan = $rows_harga['id_satuan'];

// Ambil data satuan berdasarkan id_satuan
$rows_satuan = $this->db->query("SELECT * FROM satuan_sewa WHERE id_satuan_sewa='" . $id_satuan . "'")->row_array();
$satuan_sewa = $rows_satuan['satuan_sewa'];
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
  <link rel="stylesheet" href="<?= base_url() ?>/assets/backend//vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/backend/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?= base_url() ?>/assets/backend/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?= base_url() ?>/assets/backend/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="<?= base_url() ?>/assets/backend/vendor/libs/apex-charts/apex-charts.css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="<?= base_url() ?>/assets/backend/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url() ?>/assets/backend/js/config.js"></script>

    <link href="<?= base_url() ?>/assets/select2/select2.min.css" rel="stylesheet" />
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
                          <img class="card-img-top" src="assets/images/lapangan/<?= $img_lapangan ?>" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title"><?= $kategori_olahraga ?></h5>
                            <p class="card-text"><?= $nama_lapangan ?></p>
                          </div>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">Ukuran <?= $ukuran_lapangan ?></li>
                            <li class="list-group-item">Maksimal <?= $maksimal_kapasitas_orang ?> Orang</li>
                            <li class="list-group-item">Harga Mulai <b> Rp <?= number_format(
                                $harga
                            ) ?></b> / <?= $satuan_sewa ?></li>
                          </ul>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl">
                  <div id="notifications">
                    <?php echo $this->session->flashdata('msg'); ?>
                  </div>
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Silahkan isi data penyewa</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <?php echo form_open_multipart(
                          site_url() .
                              '?/Penyewaan/update_data_penyewaan/idtrx/' .
                              $id_trx .
                              '/idlap/' .
                              $id_lapangan .
                              '/idkategori/' .
                              $id_kategori_olahraga
                      ); ?>
                      <form>
                        <?php
                        $readonly = '';
                        if ($hak_akses == 'Administrator') {
                            $readonly = 'readonly';
                        }
                        ?>
                        <?php if (!empty($tanggal_sewa)) { ?>
                          <div class="mb-3" id="container-tanggal">
                            <label class="form-label" for="basic-default-company">Tanggal</label>
                            <?php foreach ($tanggal_sewa as $key => $value) { ?>
                              <div class="mt-2">
                                <input type="date" class="form-control" value="<?= $value[
                                    'tanggal'
                                ] ?>" id="tanggal" name="tanggal[]" readonly/>
                              </div>
                            <?php } ?>
                          </div>
                        <?php } else { ?>
                          <div class="mb-3" id="container-tanggal">
                            <label class="form-label" for="basic-default-company">Tanggal</label>
                            <div class="d-flex">
                              <input type="date" class="form-control" id="tanggal" name="tanggal[]" placeholder="" required value="<?php if (
                                  isset($tanggal_view)
                              ) {
                                  echo $tanggal_view;
                              } ?>"  <?php if ($tanggal_view != null) {
    echo 'readonly';
} ?> />
                              <button class="ms-2 btn btn-success" type="button" onclick="tambah_tanggal()">+</button>
                            </div>
                          </div>
                        <?php } ?>


                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Member</label>
                          <select class="form-select select2" id="id_member" name="id_member" aria-label="Default select example" required>
                            <option value="" selected>- - - Pilih - - -</option>
                            <option value='NONMEMBER'>Non Member</option>
                            <?php foreach ($get_all_member as $row) {
                                $selected = isset($id_member_view)
                                    ? ($id_member_view == $row->id_member
                                        ? 'selected'
                                        : '')
                                    : '';
                                print "<option value='$row->id_member' $selected>$row->nama_pelanggan - $row->no_telepon</option>";
                            } ?>
                          </select>
                        </div>

                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Nama Pelanggan</label>
                          <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="" required value="<?php if (
                              isset($tanggal_view)
                          ) {
                              echo $nama_pelanggan_view;
                          } ?>" <?php echo $readonly; ?> />
                        </div>

                         <div class="mb-3">
                          <label class="form-label" for="basic-default-company">No. Telepon</label>
                          <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="" required value="<?php if (
                              isset($tanggal_view)
                          ) {
                              echo $no_telepon_view;
                          } ?>" <?php echo $readonly; ?> />
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Diskon (dalam Rupiah)</label>
                          <input type="number" class="form-control" id="diskon" name="diskon" onchange="newDiskon()" placeholder="Potongan Harga" required value="<?php if (
                              isset($tanggal_view)
                          ) {
                              echo $diskon;
                          } ?>" />
                        </div>
                       
                        <?php if ($tanggal_view == null) { ?>
                          <button type="submit" class="btn btn-primary">Lanjut Pilih Sesi</button>
                        <?php } else { ?>
                          <button type="submit" class="btn btn-primary">Simpan data</button>                          
                        <?php } ?>

                        
                   
                      </form>
                      
                      <?php echo form_close(); ?>
                    </div>
                    <div class="card-footer">
                      <?php echo form_open_multipart(site_url() . '?/Penyewaan/validasi_data_penyewaan'); ?>
                      <form>
                        <?php if ($hak_akses == 'Administrator' && $status_transaksi_view == 'Pengajuan Diskon') { ?>
                          <input type="hidden" id="id_transaksi" name="id_transaksi" class="form-control" placeholder="" value="<?php if (
                              isset($id_trx)
                          ) {
                              echo $id_trx;
                          } ?>" required="">
                          <input type="hidden" class="form-control" id="new_diskon" name="diskon" placeholder="Potongan Harga" required value="<?php if (
                              isset($tanggal_view)
                          ) {
                              echo $diskon;
                          } ?>" />
                          <div class="mb-3" align="center"><button type="submit" class="btn btn-primary">Validasi</button></div>
                        <?php } ?>
                      </form>
                      <?php echo form_close(); ?>

                      <?php echo form_open_multipart(site_url() . '?/Penyewaan/terima_data_penyewaan'); ?>
                      <form>
                        <?php if ($hak_akses == 'Staff' && $status_transaksi_view == 'Validasi') { ?>
                          <input type="hidden" id="id_transaksi" name="id_transaksi" class="form-control" value="<?php if (
                              isset($id_trx)
                          ) {
                              echo $id_trx;
                          } ?>" required="">
                          <div class="mb-3" align="center"><button type="submit" class="btn btn-success">Terima Pembayaran</button></div>
                        <?php } ?>
                      </form>
                      <?php echo form_close(); ?>

                      <?php echo form_open_multipart(
                          site_url() . '?/Penyewaan/ubah_status_cancel/id_trx/' . $id_trx
                      ); ?>
                      <form>
                        <?php if ($hak_akses == 'Administrator' && $status_transaksi_view == 'Pengajuan Diskon') { ?>
                          <input type="hidden" name="nama_pelanggan" value="<?php if (isset($tanggal_view)) {
                              echo $nama_pelanggan_view;
                          } ?>">
                          <div class="mb-3" align="center"><button type="submit" class="btn btn-danger"><span class="fa fa-check"></span> Cancel </button></div>
                          <?php } ?>
                      </form>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>

              </div>


              <!-- Jadwal Sesi -->
              <?php if ($tanggal_view != null) { ?>
                <?php echo form_open_multipart(site_url() . '?/Penyewaan/select_sesi_sewa/id_trx/' . $id_trx, [
                    'id' => 'select_sesi_sewa_form',
                ]); ?>

              <div class="card">

                <h5 class="card-header">Jadwal Sesi Tersedia</h5>

                <div class="d-flex flex-wrap" id="icons-container">

                  <?php
                  $no = 0;
                  foreach ($get_all_jadwal_sesi as $key => $row) {

                      $no++;

                      $id_jadwal_sesi = $row->id_jadwal_sesi;
                      $id_kategori_olahraga = $row->id_kategori_olahraga;
                      $jam_sesi = $row->jam_sesi;

                      #kategori olahraga
                      $rows_kategori_or = $this->db
                          ->query(
                              "SELECT * FROM kategori_olahraga where id_kategori_olahraga='" .
                                  $id_kategori_olahraga .
                                  "'"
                          )
                          ->row_array();
                      $kategori_olahraga = $rows_kategori_or['kategori_olahraga'];

                      #baca apa sesi ini ada pada transaksi

                      $rows_cek = $this->db
                          ->query(
                              "SELECT * FROM transaksi_sewa_detil 
                      JOIN transaksi_sewa ON transaksi_sewa_detil.id_transaksi=transaksi_sewa.id_transaksi 
                      where transaksi_sewa_detil.id_jadwal_sesi='" .
                                  $id_jadwal_sesi .
                                  "' 
                      AND transaksi_sewa.status_transaksi != 'Cancel'
                      AND transaksi_sewa.tanggal='" .
                                  $tanggal_view .
                                  "'"
                          )
                          ->row_array();
                      $id_transaksi_detil_cek = $rows_cek['id_transaksi_detil'];

                      if (isset($id_transaksi_detil_cek)) {
                          $warna = '#E6B0AA';
                          $harga_new = 'Booked';
                      } else {
                          $warna = '#F2F3F4';
                          $harga_new = 'Rp' . number_format($harga);
                      }
                      ?>



                    <div class="card icon-card cursor-pointer text-center mb-4 mx-2" style="background-color: <?= $warna ?>">
                      <div class="card-body">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="1" name="txt_check_id_jadwal_sesi_<?= $id_jadwal_sesi ?>" id="txt_check_id_jadwal_sesi_<?= $id_jadwal_sesi ?>" <?php if (
    isset($id_transaksi_detil_cek)
) {
    echo 'disabled';
} ?> >
                          <input type="hidden" name="jam_sesi_<?= $key ?>" id="jam_sesi_<?= $key ?>" value="<?= $id_jadwal_sesi ?>">
                        </div>
                        <p class="icon-name text-capitalize text-truncate mb-0"><b class="txt_check_id_jadwal_sesi_<?= $id_jadwal_sesi ?>"><?= $jam_sesi ?></b><br> <?= $harga_new ?></p>
                          <input type="hidden" class="form-control" id="txt_harga_<?= $id_jadwal_sesi ?>" name="txt_harga" placeholder="" required value="<?= $harga ?>" />

                      </div>



                    </div>

                  <?php
                  }
                  ?>


                </div>
                <div class="row mb-3">
                  <div class="col-sm-3">

                  </div>
                  <div class="col-sm-3" align="center">
                    <label class="form-label" for="pembayaran">Jenis Transaksi</label><br>
                    <div class="d-flex justify-content-center gap-3">
                      <div>
                        <input type="radio" id="dp" name="pembayaran" value="dp" required>
                        <label for="dp">DP</label>
                      </div>
                      <div>
                        <input type="radio" id="lunas" name="pembayaran" value="lunas" required>
                        <label for="lunas">Lunas</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3" align="center">
                    <label class="form-label" for="metode_bayar">Metode Pembayaran</label><br>
                    <div class="d-flex justify-content-center gap-3">
                      <div>
                        <input type="radio" id="qris" name="metode_bayar" value="qris" required>
                        <label for="qris">Qris Merchant</label>
                      </div>
                      <div>
                        <input type="radio" id="cash" name="metode_bayar" value="cash" required>
                        <label for="cash">Cash</label>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="diskon" id="diskon" value="<?= $diskon_harga_view ?>">
                  <div class="col-sm-3">

                  </div>
                </div>

                <div class="mb-3" align="center"><button type="button" onclick="konfirmasi()" class="btn btn-primary"><span class="fa fa-check"></span> Pilih </button></div>

              </div>

              <?php echo form_close(); ?>
              <?php } ?>

              <!--/ Jadwal Sesi -->



               <!-- Total Transaksi -->

              <div class="card mt-3">              

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

                     <?php
                     $no = 0;
                     foreach ($get_all_sewa_detil as $row_dt) {
                         $no++;

                         $id_transaksi_detil = $row_dt->id_transaksi_detil;
                         $id_transaksi = $row_dt->id_transaksi;
                         $id_jadwal_sesi = $row_dt->id_jadwal_sesi;
                         $harga = $row_dt->harga;

                         #sesi
                         $rows_sesi = $this->db
                             ->query("SELECT * FROM jadwal_sesi where id_jadwal_sesi='" . $id_jadwal_sesi . "'")
                             ->row_array();
                         $jam_sesi = $rows_sesi['jam_sesi'];

                         echo '<tr>
                      <td>' .
                             $jam_sesi .
                             '</td>
                      <td>' .
                             number_format($harga) .
                             '</td>
                      <td align="left">';

                         if ($akses_delete == 'Aktif') {
                             echo '<a onclick="return konfirm_hapus()" href="' .
                                 site_url() .
                                 '?/Penyewaan/delete_data_sesi/id_trx/' .
                                 $id_transaksi .
                                 '/id_dt/' .
                                 $id_transaksi_detil .
                                 '"><i class="bx bx-trash me-2"></i> Delete</a>';
                         }
                         echo '</td><tr>';
                     }
                     ?>


                      </tbody>

                      <tfoot>
                        <?php if (!empty($get_all_sewa_detil)) {
                            echo '<tr>
                          <th>HARGA</th>
                          <th>Rp. ' .
                                number_format($total_harga_view) .
                                '</th>
                          <th></th>
                          </tr>';
                            echo '<tr>
                          <th>DISKON</th>
                          <th>Rp. ' .
                                number_format($diskon) .
                                '</th>
                          <th></th>
                          </tr>';
                            $dp = 0;
                            if ($jenis_bayar_view == 'dp') {
                                $dp = $total_harga_view / 2;
                                echo '<tr>
                            <th>DP</th>
                            <th>Rp. ' .
                                    number_format($dp) .
                                    '</th>
                            <th></th>
                            </tr>';
                            }
                            $total_harga_view = $total_harga_view - $diskon - $dp;
                        } ?>
                      <tr>
                        <th>TOTAL HARGA</th>
                        <th>Rp. <?= number_format($total_harga_view) ?></th>
                        <th></th>
                      </tr>
                    </tfoot>
                    </table>
                  </div>
                </div>
                <!--/ Total Transaksi -->


                <!-- Status Transaksi -->
              <?php if ($status_transaksi_view != 'Draft') { ?>

              <div class="card mt-3">

                <h5 class="card-header">Status Transaksi : <?= $status_transaksi_view ?></h5>

                <?php if ($status_transaksi_view != 'Cancel' && $status_transaksi_view != 'Selesai') { ?>
              <?php echo form_open_multipart(site_url() . '?/Penyewaan/ubah_status_cancel/id_trx/' . $id_trx); ?>

                  <input type="hidden" name="nama_pelanggan" value="<?php if (isset($tanggal_view)) {
                      echo $nama_pelanggan_view;
                  } ?>">
                  <div class="mb-3" align="center"><button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Cancel </button></div>

              <?php echo form_close(); ?>

              <?php echo form_open_multipart(site_url() . '?/Penyewaan/ubah_status_selesai/id_trx/' . $id_trx); ?>

                   <input type="hidden" name="nama_pelanggan" value="<?php if (isset($tanggal_view)) {
                       echo $nama_pelanggan_view;
                   } ?>">
                  <div class="mb-3" align="center">
                    <?php if ($jenis_bayar_view == 'dp' && $status_transaksi_view == 'Booking') { ?>
                      <a data-bs-toggle="modal" class="btn btn-primary text-white" data-bs-target="#modal-tambah-data">Transaksi Selesai</a>
                    <?php } else { ?>
                      <?php if (
                          $status_transaksi_view != 'Pengajuan Diskon' &&
                          $status_transaksi_view != 'Validasi'
                      ) { ?>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Transaksi Selesai </button>
                      <?php } ?>
                    <?php } ?>
                    
                  </div>

              <?php echo form_close();} ?>


               <?php echo form_open_multipart(site_url() . '?/Penyewaan/cetak/id_trx/' . $id_trx); ?>

                  <div class="mb-3" align="center"><button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Cetak Nota </button></div>

              <?php echo form_close(); ?>


              </div>

              <?php } ?>

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

     <!-- Modal Pelunasan DP -->
     <div class="modal fade" id="modal-tambah-data" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Pelunasan DP</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php echo form_open_multipart(site_url() . '?/Penyewaan/ubah_status_selesai/id_trx/' . $id_trx); ?>
            <div class="modal-body">
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Metode Pembayaran</h5>
                      <small class="text-muted float-end"></small>
                    </div>
                    <div class="card-body">
                      <input type="hidden" name="dp_nama_pelanggan" value="<?php if (isset($tanggal_view)) {
                          echo $nama_pelanggan_view;
                      } ?>">
                      <div class="mb-3">
                        <div class="d-flex justify-content-center gap-3">
                          <div>
                            <input type="radio" id="dp_qris" name="dp_metode_bayar" value="qris" required>
                            <label for="qris">Qris Merchant</label>
                          </div>
                          <div>
                            <input type="radio" id="dp_cash" name="dp_metode_bayar" value="cash" required>
                            <label for="cash">Cash</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Tutup
              </button>
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
      <!--/ Modal Pelunasan DP -->

     <!-- Core JS -->
     <!-- build:js assets/vendor/js/core.js -->
     <script src="<?= base_url() ?>/assets/backend/vendor/libs/jquery/jquery.js"></script>
     <script src="<?= base_url() ?>/assets/backend/vendor/libs/popper/popper.js"></script>
     <script src="<?= base_url() ?>/assets/backend/vendor/js/bootstrap.js"></script>
     <script src="<?= base_url() ?>/assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

     <script src="<?= base_url() ?>/assets/backend/vendor/js/menu.js"></script>
     <!-- endbuild -->

     <!-- Vendors JS -->
     <script src="<?= base_url() ?>/assets/backend/vendor/libs/apex-charts/apexcharts.js"></script>

     <!-- Main JS -->
     <script src="<?= base_url() ?>/assets/backend/js/main.js"></script>

     <!-- Page JS -->
     <script src="<?= base_url() ?>/assets/backend/js/dashboards-analytics.js"></script>
     <script src="<?= base_url() ?>/assets/swal/sweetalert2@11.js"></script>

     <!-- Place this tag in your head or just before your close body tag. -->
     <script async defer src="https://buttons.github.io/buttons.js"></script>
     <script src="<?= base_url() ?>/assets/select2/select2.min.js"></script>

     <script type="text/javascript">
      function konfirm_hapus()
      {
        tanya = confirm("Hapus data ?");
       if (tanya == true) return true;
       else return false;
     }
     
      function konfirmasi(){
        if(document.querySelectorAll('input[name="pembayaran"]:checked').length == 0){
          Swal.fire("Error!", "Silahkan Pilih Jenis Transaksi.", "error");
          return;
        }
        if(document.querySelectorAll('input[name="metode_bayar"]:checked').length == 0){
          Swal.fire("Error!", "Silahkan Pilih Metode Bayar.", "error");
          return;
        }
        Swal.fire({
         title: "Apakah Pesanan Sesuai ?",
         html: `<div>
            <p>Pastikan data yang anda masukkan sudah benar</p>
            <p>Nama : `+document.getElementById("nama_pelanggan").value+`</p>
            <p>No. Telepon : `+document.getElementById("no_telepon").value+`</p>
            <p>Tanggal : `+getTanggal()+`</p>
            <p>Sesi : `+getSesi()+`</p>
            <p>Diskon : `+getDiskon()+`</p>
            <p>Total Bayar : `+getTotal()+`</p>
            <p>Total DP : `+getTotalDP()+`</p>
            <p>Metode Bayar : `+getMetodeBayar()+`</p>
            <p>Jenis Transaksi : `+getJenisBayar()+`</p>
            <p>Lapangan : <?= $kategori_olahraga ?> - <?= $nama_lapangan ?></p>
            </div>`,
         showCancelButton: true,
         confirmButtonText: "Simpan",
         cancelButtonText: "Batal",
       }).then((result) => {
         /* Read more about isConfirmed, isDenied below */
         if (result.isConfirmed) {
             $.ajax({
             url: $('#select_sesi_sewa_form').attr('action'),
             type: 'POST',
             data: $('#select_sesi_sewa_form').serialize(),
             success: function(response) {
               Swal.fire("Saved!", "", "success");
                setTimeout(function() {
                  location.reload();
                }, 1000);
             },
             error: function() {
               Swal.fire("Error!", "There was an error saving the data.", "error");
             }
             });
         }
       });
      }

      function getTanggal() {
        var tanggal = "";
        var dates = document.querySelectorAll('input[type="date"]');
        for (var i = 0; i < dates.length; i++) {
          tanggal += dates[i].value + ", ";
        }
        return tanggal.trim().slice(0, -1);
      }

      function getSesi() {
        var sesi = "";
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
          if (checkboxes[i].checked) {
            sesi += $("."+checkboxes[i].id).html() + ", ";
          }
        }
        return sesi.trim().slice(0, -1);
      }

      function getTotal() {
        var sesi = 0;
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
          if (checkboxes[i].checked) {
            let index = $("#jam_sesi_"+i).val();
            console.log(index,"#jam_sesi_"+i);
            sesi += parseInt($("#txt_harga_"+index).val());
          }
        }
        var dates = document.querySelectorAll('input[type="date"]');
        sesi = (parseInt(sesi) * dates.length) - parseInt($('#diskon').val().replace(/\./g, '').replace(/[^0-9]/g, ''));
        return "Rp. " + sesi.toLocaleString('id-ID');
      }

      function getTotalDP() {
        var sesi = 0;
        let jenis = document.querySelector('input[name="pembayaran"]:checked').value;
        if (jenis == "dp") {
          var checkboxes = document.querySelectorAll('input[type="checkbox"]');
          for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
              let index = $("#jam_sesi_" + i).val();
              sesi += parseInt($("#txt_harga_" + index).val().replace(/\./g, '').replace(/[^0-9]/g, ''));
            }
          }
          var dates = document.querySelectorAll('input[type="date"]');
          sesi = ((parseInt(sesi) * dates.length) - parseInt($('#diskon').val().replace(/\./g, '').replace(/[^0-9]/g, ''))) / 2;
          return "Rp. " + sesi.toLocaleString('id-ID');
        } else {
          return "Rp. 0";
        }
      }

      function getDiskon() {
        let rawDiskon = $('#diskon').val().replace(/\./g, '').replace(/[^0-9]/g, '');
        return "Rp. " + parseInt(rawDiskon).toLocaleString('id-ID');
      }

      function getMetodeBayar() {
        let metode = document.querySelector('input[name="metode_bayar"]:checked').value;
        return metode == "qris" ? "Qris Merchant" : "Cash";
      }

      function getJenisBayar() {
        let jenis = document.querySelector('input[name="pembayaran"]:checked').value;
        return jenis == "dp" ? "DP (50%)" : "Lunas";
      }

      function tambah_tanggal() {
        var container = document.getElementById('container-tanggal');
        var newElement = document.createElement('div');
        newElement.className = 'd-flex mt-2';
        newElement.innerHTML = `
          <input type="date" class="form-control" id="tanggal" name="tanggal[]" placeholder="" required />
          <button class="ms-2 btn btn-danger" type="button" onclick="hapus_tanggal(this)">-</button>
        `;
        container.appendChild(newElement);
      }

      function hapus_tanggal(element) {
        element.parentElement.remove();
      }

      function newDiskon(){
        document.getElementById("new_diskon").value = document.getElementById("diskon").value;
      }
     </script>



<script type="text/javascript">
  $(document).ready(function(){
    $('.select2').select2();
    $('#id_member').change(function(){
      var id=$(this).val();
      if (id != "") {
        $.ajax({
          url : "<?php echo site_url(); ?>?/Penyewaan/get_info_member",
          method : "POST",
          data : {id: id},
          async : false,
              dataType : 'json',
          success: function(data){
            $('#nama_pelanggan').val(data[0].nama_pelanggan);
            $('#no_telepon').val(data[0].no_telepon);
          }
        });
      }
    });
  });
</script>

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
      const hargaInputs = document.querySelectorAll("input[name='diskon']");
      
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
