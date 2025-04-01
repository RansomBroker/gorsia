<?php

include_once 'v_user_config.php';
?>


<?php

if ($this->uri->segment('2') == "filterpencarian") {

    $param_tahun = $this->input->post('txt_tahun');
    $param_bulan = $this->input->post('txt_periode');
    $param_periode = $param_tahun . $param_bulan;

    if ($param_bulan == "01") {
        $nama_bulan = "Januari";
    } elseif ($param_bulan == "02") {
        $nama_bulan = "Februari";
    } elseif ($param_bulan == "03") {
        $nama_bulan = "Maret";
    } elseif ($param_bulan == "04") {
        $nama_bulan = "April";
    } elseif ($param_bulan == "05") {
        $nama_bulan = "Mei";
    } elseif ($param_bulan == "06") {
        $nama_bulan = "Juni";
    } elseif ($param_bulan == "07") {
        $nama_bulan = "Juli";
    } elseif ($param_bulan == "08") {
        $nama_bulan = "Agustus";
    } elseif ($param_bulan == "09") {
        $nama_bulan = "September";
    } elseif ($param_bulan == "10") {
        $nama_bulan = "Oktober";
    } elseif ($param_bulan == "11") {
        $nama_bulan = "November";
    } elseif ($param_bulan == "12") {
        $nama_bulan = "Desember";
    } else {
        $nama_bulan = "";
    }

    $saldo_awal = 0;
    $mutasi_saldo = 0;
    $saldo_akhir = 0;
} else {
    $param_tahun = "";
    $param_bulan = "";
    $param_periode = "";
    $nama_bulan = "";

    $saldo_awal = 0;
    $mutasi_saldo = 0;
    $saldo_akhir = 0;
}


?>

<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/backend/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Gorsia - Neraca</title>

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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Akuntansi /</span> Neraca</h4>


                        <div class="row">


                            <div class="col-12">

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Neraca</h4>
                                        <h6 class="card-subtitle">rangkuman neraca saldo</h6>
                                        <hr>


                                        <div class="row">
                                            <div class="col-sm-6 col-xs-12">
                                                <?php echo form_open_multipart(site_url() . '?/Neraca/filterpencarian'); ?>


                                                <div class="form-group row">
                                                    <label class="col-4 col-form-label">
                                                        <font style="font-size: 14px">Tahun</font>
                                                    </label>
                                                    <div class="col-8">


                                                        <select class="form-control" style="width: 100%" name="txt_tahun" id="txt_tahun" required="">
                                                            <?php if ($this->uri->segment('2') == "filterpencarian") {
                                                                print "<option value='$param_tahun'>$param_tahun</option>";
                                                            } ?>
                                                            <option value="">Pilih Tahun</option>
                                                            <?php for ($i = 2023; $i <= date('Y'); $i++) {
                                                                print "<option value='$i'>$i</option>";
                                                            } ?>
                                                        </select>

                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-4 col-form-label">
                                                        <font style="font-size: 14px">Periode</font>
                                                    </label>
                                                    <div class="col-8">


                                                        <select class="form-control" style="width: 100%" name="txt_periode" id="txt_periode" required="">
                                                            <?php if ($this->uri->segment('2') == "filterpencarian") {
                                                                print "<option value='$param_periode'>$param_periode</option>";
                                                            } ?>
                                                            <option value="">Pilih Periode</option>
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


                                        <h6 class="card-subtitle">Bulan : <?= $nama_bulan; ?> <?= $param_tahun; ?></h6>
                                        <br>




                                        <div class="table-responsive text-nowrap">
                                            <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="myTable" style="padding: 5px; font-size: 12px; white-space: nowrap;">
                                                <thead>
                                                    <tr role="row">
                                                        <th style="width: 200px;"><b>Catatan</b></th>
                                                        <th style="width: 100px;"><b>Debet</b></th>
                                                        <th style="width: 100px;"><b>Kredit</b></th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <?php

                                                    $array = array();

                                                    foreach ($get_all_parent_akun_neraca as $row) {

                                                        $id_akun_parent = $row->id_kode_akuntansi;
                                                        $kode_akun_parent = $row->kode_akun;
                                                        $nama_akun_parent = $row->nama_akun;
                                                        $saldo_normal = $row->saldo_normal;
                                                        // var_dump($kode_akun_parent);
                                                        // var_dump("<br>");
                                                        // var_dump($row_akun);
                                                        // die;

                                                        $query_akun = $this->db->query("SELECT * FROM kode_akuntansi WHERE kode_parent='" . $kode_akun_parent . "' ORDER BY kode_akun ASC");

                                                        $grand_total_saldo_awal = 0;
                                                        $grand_total_mutasi_akun = 0;


                                                        foreach ($query_akun->result() as $row_akun) {
                                                            $id_akun_level_2 = $row_akun->id_kode_akuntansi;
                                                            $nama_akun_level_2 = $row_akun->nama_akun;


                                                            #saldo awal
                                                            $query_saldo_awal = $this->db->query("SELECT sum(debet) as total_debet, sum(kredit) as total_kredit FROM jurnal_umum INNER JOIN jurnal_umum_detail ON jurnal_umum.no_bukti=jurnal_umum_detail.no_bukti WHERE id_kode_akuntansi='" . $id_akun_level_2 . "' AND periode<'" . $param_periode . "' GROUP BY id_kode_akuntansi")->row_array();
                                                            $saldo_awal_debet = $query_saldo_awal['total_debet'];
                                                            $saldo_awal_kredit = $query_saldo_awal['total_kredit'];

                                                            if ($saldo_normal == "Debet") {
                                                                $total_saldo_awal = $saldo_awal_debet - $saldo_awal_kredit;
                                                            } elseif ($saldo_normal == "Kredit") {
                                                                $total_saldo_awal = $saldo_awal_kredit - $saldo_awal_debet;
                                                            }

                                                            $grand_total_saldo_awal = $grand_total_saldo_awal + $total_saldo_awal;


                                                            #ambil nilai mutasi jurnal
                                                            $query_jurnal = $this->db->query("SELECT sum(debet) as total_debet_mutasi, sum(kredit) as total_kredit_mutasi FROM jurnal_umum INNER JOIN jurnal_umum_detail ON jurnal_umum.no_bukti=jurnal_umum_detail.no_bukti WHERE id_kode_akuntansi='" . $id_akun_level_2 . "' AND periode='" . $param_periode . "' ")->row_array();

                                                            $total_debet_mutasi = $query_jurnal['total_debet_mutasi'];
                                                            $total_kredit_mutasi = $query_jurnal['total_kredit_mutasi'];
                                                            if ($saldo_normal == "Debet") {
                                                                $total_mutasi_akun = $total_debet_mutasi - $total_kredit_mutasi;
                                                            } elseif ($saldo_normal == "Kredit") {
                                                                $total_mutasi_akun = $total_kredit_mutasi - $total_debet_mutasi;
                                                            }

                                                            $grand_total_mutasi_akun = $grand_total_mutasi_akun + $total_mutasi_akun;



                                                            #saldo akhir
                                                            //$saldo_akhir = $total_saldo_awal+$total_mutasi_akun;
                                                            //$total_debet_akhir = $saldo_awal_debet + $total_debet_mutasi;
                                                            //$total_kredit_akhir = $saldo_awal_kredit + $total_kredit_mutasi;

                                                            $saldo_akhir = $grand_total_saldo_awal + $grand_total_mutasi_akun;
                                                        }


                                                        #SALDO MODAL
                                                        $query_saldo_modal = $this->db->query("SELECT id_kode_akuntansi, sum(debet) as debet, sum(kredit) as kredit, periode  FROM perubahan_modal WHERE periode='" . $param_periode . "'")->row_array();
                                                        $id_akun_perkiraan_modal = $query_saldo_modal['id_kode_akuntansi'];
                                                        $debet_modal = $query_saldo_modal['debet'];
                                                        $kredit_modal = $query_saldo_modal['kredit'];

                                                        $query_saldo_normal_modal = $this->db->query("SELECT * FROM kode_akuntansi WHERE id_kode_akuntansi='" . $id_akun_perkiraan_modal . "'")->row_array();
                                                        $saldo_normal_modal = $query_saldo_normal_modal['saldo_normal'];

                                                        if ($saldo_normal_modal == "Debet") {
                                                            $total_modal = $debet_modal - $kredit_modal;
                                                        } elseif ($saldo_normal_modal == "Kredit") {
                                                            $total_modal = $kredit_modal - $debet_modal;
                                                        }



                                                        if ($nama_akun_parent == 'MODAL') {
                                                            if (isset($total_modal)) {
                                                                $saldo_akhir_new = $total_modal;
                                                            } else {
                                                                $saldo_akhir_new = 0;
                                                            }
                                                        } else {
                                                            $saldo_akhir_new = $saldo_akhir;
                                                        }



                                                        echo '<tr role="row">
                                              <td>' . ucwords(strtolower($nama_akun_parent)) . '</td>
                                              <td>';
                                                        if ($saldo_normal == 'Debet') {
                                                            echo number_format($saldo_akhir_new);
                                                        } else {
                                                            echo '';
                                                        }
                                                        echo '</td>
                                              <td>';
                                                        if ($saldo_normal == 'Kredit') {
                                                            echo number_format($saldo_akhir_new);
                                                        } else {
                                                            echo '';
                                                        }
                                                        echo '</td>
                                              </tr>';
                                                    }


                                                    ?>

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
        function konfirm_hapus() {
            tanya = confirm("Hapus data jurnal ?");
            if (tanya == true) return true;
            else return false;
        }
    </script>


    <script type="text/javascript">
        var table_pencarian = $('#myTable').DataTable({

            "processing": false,
            "serverSide": false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    footer: true
                },
                {
                    extend: 'csv',
                    footer: true
                },
                {
                    extend: 'excel',
                    title: "Neraca",
                    footer: true
                },
                {
                    extend: 'pdf',
                    orientation: 'landscape',
                    title: "Neraca",
                    footer: true
                },

            ],

        });
    </script>







</body>

</html>