<?php
include_once 'v_user_config.php'; ?>

<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/backend/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Gorsia - Member</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/backend/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/backend//vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/backend/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/backend/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/backend/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="assets/backend/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css" />

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
                <div class="card">
                    <h5 class="card-header">Perpanjang Member</h5>
                    <div id="notifications">
                    <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                    <div class="row">
                    <div class="col-xl">
                        <div class="card mb-12">
                        <div class="card-body">
                            <!-- Form perpanjangan member -->
                            <form id="formperpanjang" method="post" action="<?= base_url() ?>?/DaftarMember/update/<?= $idMember ?>">
                            <div class="row">
                                <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="paketID">Pilih Paket</label>
                                    <select class="form-select" id="paketID" name="paketID" required>
                                    <!-- Asumsikan paket dengan id 3; tambahkan data-harga untuk mendapatkan harga paket -->
                                    <?php foreach ($paketSewa as $key => $value): ?>
                                        <?php if ($value['id_paket_sewa'] == 3): ?>
                                        <option selected value="<?= $value['id_paket_sewa'] ?>" data-harga="<?= $value[
    'harga'
] ?>">
                                            <?= $value['namaKategori'] ?>
                                        </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div id="pemayaranqris">
                                    <div class="mb-3">
                                    <label class="form-label" for="metode_bayar">Metode Bayar</label><br>
                                    <input class="radiopilih" type="radio" id="qrismerchant" name="metode_bayar" value="qris" required>
                                    <label for="qrismerchant"> Qris Merchant</label><br>
                                    <input class="radiopilih" type="radio" id="qrispendapatan" name="metode_bayar" value="cash">
                                    <label for="qrispendapatan"> Cash</label>
                                    </div>
                                </div>
                                </div>
                                <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="durasi_member">Durasi Member</label>
                                    <select class="form-select" id="durasi_member" name="durasi_member" required>
                                    <option selected>- - - Pilih - - -</option>
                                    <!-- Nilai dalam hari -->
                                    <option value="30">1 Bulan (30 hari)</option>
                                    <option value="60">2 Bulan (60 hari)</option>
                                    <option value="90">3 Bulan (90 hari)</option>
                                    </select>
                                </div>
                                <div class="mb-3" id="totalbayarAll">
                                    <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required />
                                    <input type="hidden" class="form-control" id="idSimpan" name="idSimpan" value="<?= $idMember ?>" readonly />
                                </div>
                                </div>
                            </div>
                            <!-- Tombol submit untuk trigger modal konfirmasi -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <?php include_once 'v_footer.php'; ?>
                <div class="content-backdrop fade"></div>
            </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

        <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Form final submit; action akan terupdate dengan parameter id member melalui JavaScript -->
        <form id="finalSubmitForm" method="post" action="<?= base_url() ?>?/DaftarMember/update/<?= $idMember ?>">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Perpanjangan Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
            <!-- Detail konfirmasi -->
            <p><strong>Durasi Pembayaran:</strong> <span id="popup_durasi"></span></p>
            <p><strong>Tanggal Expired:</strong> <span id="popup_expired"></span></p>
            <p><strong>Diskon:</strong> <span id="popup_diskon"></span></p>
            <p><strong>Total Bayar:</strong> <span id="popup_totalbayar"></span></p>
            <!-- Hidden input untuk diteruskan ke controller -->
            <input type="hidden" name="paketID" id="paketID_final">
            <input type="hidden" name="metode_bayar" id="metode_bayar_final">
            <input type="hidden" name="durasi_member" id="durasi_member_final">
            <input type="hidden" name="tanggal_mulai" id="tanggal_mulai_final">
            <input type="hidden" name="idSimpan" id="idSimpan_final">
            <input type="hidden" name="tanggal_expired" id="tanggal_expired_final">
            <input type="hidden" name="diskon" id="diskon_final">
            <input type="hidden" name="total_bayar" id="total_bayar_final">
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-success">Konfirmasi & Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
        </form>
    </div>
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
    </script>

    <script>
    // Form perpanjangan di halaman perpanjang member
    $("#formperpanjang").submit(function(e) {
        e.preventDefault(); // cegah submit langsung
        
        const durasiValue = $("#durasi_member").val();
        const tanggalMulaiVal = $("#tanggal_mulai").val();
        if (!tanggalMulaiVal) {
        alert("Tanggal Mulai harus diisi");
        return;
        }
        const tanggalMulai = new Date(tanggalMulaiVal);
        // Karena pilihan durasi berupa hari (30, 60, 90)
        const durasiHari = parseInt(durasiValue);
        const tanggalExpired = new Date(tanggalMulai);
        tanggalExpired.setDate(tanggalMulai.getDate() + durasiHari);
        const expiredStr = tanggalExpired.toISOString().split('T')[0];

        // Ambil harga paket dari select option (dengan data-harga)
        const selectedPaket = $("#paketID option:selected");
        const harga = parseInt(selectedPaket.data("harga")) || 0;

        // Tidak ada diskon
        const diskon = 0;
        const total = harga - diskon;

        // Tampilkan detail di modal
        $("#popup_durasi").text(durasiHari + " hari");
        $("#popup_expired").text(expiredStr);
        $("#popup_diskon").text("Rp " + diskon.toLocaleString());
        $("#popup_totalbayar").text("Rp " + total.toLocaleString());

        // Isi nilai hidden di modal
        $("#paketID_final").val($("#paketID").val());
        $("#metode_bayar_final").val($("input[name='metode_bayar']:checked").val());
        $("#durasi_member_final").val(durasiHari);
        $("#tanggal_mulai_final").val(tanggalMulaiVal);
        $("#idSimpan_final").val($("#idSimpan").val());
        $("#tanggal_expired_final").val(expiredStr);
        $("#diskon_final").val(diskon);
        $("#total_bayar_final").val(total);
        
        // Tampilkan modal konfirmasi
        $("#confirmModal").modal('show');
    });
    </script>

</body>

</html>