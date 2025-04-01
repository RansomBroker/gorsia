<?php
$nama_controler = $this->uri->segment('1');

?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">

                <img src="assets/backend/img/favicon/favicon.ico" width="50px">

            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Gorsia</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <?php if ($nama_controler == "Dashboard") { ?>
        <li class="menu-item active">
            <?php } else { ?>
        <li class="menu-item">
            <?php } ?>

            <a href="<?= site_url(); ?>?/Dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Master -->
        <?php if ($nama_controler == "KategoriOlahraga" || $nama_controler == "Lapangan" || $nama_controler == "HargaPaketSewa") { ?>
        <li class="menu-item active">
            <?php } else { ?>
        <li class="menu-item">
            <?php } ?>

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Master Data</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/KategoriOlahraga" class="menu-link">
                        <div data-i18n="Without menu">Kategori Olahraga</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/Lapangan" class="menu-link">
                        <div data-i18n="Without navbar">Lapangan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/HargaPaketSewa" class="menu-link">
                        <div data-i18n="Container">Harga Paket Sewa</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/JadwalSesi" class="menu-link">
                        <div data-i18n="Container">Jadwal Sesi</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/Barang" class="menu-link">
                        <div data-i18n="Without menu">Barang</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/Supplier" class="menu-link">
                        <div data-i18n="Without menu">Supplier</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/Member" class="menu-link">
                        <div data-i18n="Without menu">Member</div>
                    </a>
                </li>
                <!-- <li class="menu-item">
                        <a href="<?= site_url(); ?>?/MemberFitnes" class="menu-link">
                            <div data-i18n="Without menu">Pelanggan</div>
                        </a>
                    </li> -->

            </ul>
        </li>

        <!-- Account -->
        <?php if ($nama_controler == "HakAkses" || $nama_controler == "AkunUser") { ?>
        <li class="menu-item active">
            <?php } else { ?>
        <li class="menu-item">
            <?php } ?>
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Pengguna</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/HakAkses" class="menu-link">
                        <div data-i18n="Without menu">Hak Akses</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/AkunUser" class="menu-link">
                        <div data-i18n="Without navbar">Akun User</div>
                    </a>
                </li>

            </ul>
        </li>


        <!-- Transaksi -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Transaksi</div>
            </a>

            <ul class="menu-sub">

                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/DaftarMember" class="menu-link">
                        <div data-i18n="Without menu">Daftar Member</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/Pembelian" class="menu-link">
                        <div data-i18n="Without menu">Pembelian</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/Penyewaan" class="menu-link">
                        <div data-i18n="Without menu">Sewa Lapangan</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/RekapPenyewaan" class="menu-link">
                        <div data-i18n="Without menu">Rekap Penyewaan</div>
                    </a>
                </li>


            </ul>
        </li>
        <!-- Transaksi -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Pendapatan</div>
            </a>

            <ul class="menu-sub">

                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/PendapatanFitnes" class="menu-link">
                        <div data-i18n="Without menu">Pendapatan Fitnes</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">AKUNTANSI</span>
        </li>
        <?php if ($nama_controler == "KodeAkuntansi" || $nama_controler == "Modal" || $nama_controler == "KodeTransaksi") { ?>
        <li class="menu-item active">
            <?php } else { ?>
        <li class="menu-item">
            <?php } ?>
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Pengaturan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/KodeAkuntansi" class="menu-link">
                        <div data-i18n="Account">Kode Akuntansi</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/Modal" class="menu-link">
                        <div data-i18n="Notifications">Modal</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/KodeJurnal" class="menu-link">
                        <div data-i18n="Connections">Kode Jurnal</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/SettingPenjualanTerhadapAkuntansi" class="menu-link">
                        <div data-i18n="Account">Setting Penjualan Terhadap Akuntansi</div>
                    </a>
                </li>

            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Operasional</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/TransaksiJurnal" class="menu-link">
                        <div data-i18n="Basic">Jurnal</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/BukuBesar" class="menu-link">
                        <div data-i18n="Basic">Buku Besar</div>
                    </a>
                </li>

            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Laporan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/Neraca" class="menu-link">
                        <div data-i18n="Error">Neraca</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= site_url(); ?>?/LabaRugi" class="menu-link">
                        <div data-i18n="Under Maintenance">Laba Rugi</div>
                    </a>
                </li>
            </ul>
        </li>



    </ul>
</aside>