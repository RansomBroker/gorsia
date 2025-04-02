<?php
include_once 'v_user_config.php';
?>

<!DOCTYPE html>

<html>

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
            <?php include_once 'v_sidebar.php'; ?>
            <div class="layout-page">
                <?php include_once 'v_navbar.php'; ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">
                            <span class="text-muted fw-light">Pendaftaran Data /</span> Member
                            Fitnes
                        </h4>
                        <div class="card">
                            <h5 class="card-header">Form Daftar Member</h5>
                            <div id="notifications">
                                <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                            <div class="row">
                                <div class="col-xl">
                                    <div class="card mb-12">
                                        <div class="card-body" id="cardformmember" style="display: show">
                                            <form method="post" id="formmember">
                                                <!-- <form method="post" action="<?= base_url() ?>?/DaftarMember/store"> -->
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="basic-default-fullname">kode
                                                                Member</label>
                                                            <input type="text" class="form-control" id="kodeMember"
                                                                name="kodeMember"
                                                                value="MBR<?php echo sprintf("%04s", $kodemember) ?>"
                                                                readonly />

                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="basic-default-fullname">Nama</label>
                                                            <input type="text" class="form-control" id="nama"
                                                                name="nama" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="basic-default-fullname">Nomor
                                                                Telepon</label>
                                                            <input type="text" class="form-control" id="nope"
                                                                name="nope" />
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="basic-default-fullname">Jenis
                                                                Kelamin</label>
                                                            <select class="form-select" id="jk" name="jk"
                                                                aria-label="Default select example" required>
                                                                <option selected>- - - Pilih - - -</option>
                                                                <option value="L">Laki-Laki</option>
                                                                <option value="P">Perempaun</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="basic-default-fullname">Email</label>
                                                            <input type="text" class="form-control" id="email"
                                                                name="email" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="basic-default-fullname">Alamat</label>
                                                            <input type="text" class="form-control" id="alamat"
                                                                name="alamat" />
                                                        </div>
                                                        <!-- end row -->
                                                    </div>
                                                </div>
                                                <button type="button" id="dataMember" class="btn btn-primary">Submit
                                                </button>
                                            </form>
                                        </div>
                                        <div class="card-body" id="carddetailmember" style="display: none;">
                                            <form method="post" action="<?= base_url() ?>?/DaftarMemberDetail/store">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="basic-default-company">Pilih
                                                                Paket</label>
                                                            <select class="form-select" id="paketID" name="paketID"
                                                                aria-label="Default select example" required>
                                                                <!-- <option>- - - Pilih - - -</option> -->
                                                                <?php foreach ($paketSewa as $key => $value) { if($value['id_paket_sewa'] == 3) {?>
                                                                <option selected value="<?= $value['id_paket_sewa'] ?>">
                                                                    <?= $value['namaKategori'] ?></option>
                                                                <?php } } ?>
                                                            </select>
                                                        </div>
                                                        <div id="pemayaranqris">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-fullname">Metode
                                                                    Bayar</label><br>
                                                                <input class="radiopilih" type="radio" id="qrismerchant"
                                                                    name="metode_bayar" value="qris">
                                                                <label for="vehicle1"> Qris Merchant</label><br>
                                                                <input class="radiopilih" type="radio"
                                                                    id="qrispendapatan" name="metode_bayar"
                                                                    value="cash">
                                                                <label for="qrispendapatan"> Cash</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="basic-default-fullname">Durasi Member</label>
                                                            <select class="form-select" id="durasi_member"
                                                                name="durasi_member" aria-label="Default select example"
                                                                required>
                                                                <option selected>- - - Pilih - - -</option>
                                                                <option value="30">1 Bulan</option>
                                                                <option value="60">2 Bulan</option>
                                                                <option value="90">3 Bulan</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-6" id="totalbayarAll" style="display: show;">
                                                            <label class="form-label"
                                                                for="basic-default-fullname">Tanggal Mulai</label>
                                                            <input type="date" class="form-control" id="tanggal_mulai"
                                                                name="tanggal_mulai" />
                                                            <input type="hidden" class="form-control" id="idSimpan"
                                                                name="idSimpan" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="content-footer footer bg-footer-theme">
                        <?php include_once 'v_footer.php'; ?>
                    </footer>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
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
    <!-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> -->

    <!-- Page JS -->
    <script src="assets/backend/js/dashboards-analytics.js"></script>
    <!-- data table -->
    <!-- <script src=" https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>




    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>



    <script type="text/javascript">
    $(document).ready(function() {
        new DataTable('#tabelmember');
    });
    $('#jenisBayar').on('change', function() {
        var data = this.value
        if (data == 'tunai') {
            //  alert( "ini tunai" );
            $("#pemayaranlangsung").show();
            $("#pemayaranqris").hide();
            $("#totalbayarAll").hide();
        } else {
            $("#pemayaranlangsung").hide();
            $("#pemayaranqris").show();
            $("#totalbayar").hide();
        }
    });
    $(".radiopilih").click(function() {
        $("#totalbayarAll").show();
    });
    $("#dataMember").click(function(e) {
        // alert("tes")
        const data = $("#formmember").serialize();
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>?/DaftarMember/store",
            data: data,
            dataType: "json",
            success: function(response, textStatus, jqXHR) {
                console.log(response.status);
                if (response.status == true) {
                    $("#cardformmember").hide();
                    $("#carddetailmember").show();
                    $("#idSimpan").val(response.IdSimpan);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.table(jqXHR)
            }
        });
    });
    </script>

</body>

</html>