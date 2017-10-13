<?php

	error_reporting(0);
	session_start();
	$id_akun = $_SESSION['id_akun'];
	//$session_nomor_level = $_SESSION['nomor_level'];

	$mode=isset($_GET['mode'])?$_GET['mode']:'';
	switch($mode){
		case "daftar_admin":
			include_once "header.php";
			include_once "admin/daftar.php";
			include_once "footer.php";
			break;
		case "login_admin":
			include_once "header.php";
			include_once "admin/login.php";
			include_once "footer.php";
			break;
		case "dashboard_admin":

			include_once "admin/dashboard.php";
			break;
		case "lihat_akun":
			//include "admin/sidebar.php";
			include "admin/data_akun.php";
			break;
		case "ubah_akun":
			//include "admin/sidebar.php";
			include "admin/ubah_akun.php";
			break;
		case "hapus_akun":
			//include "admin/sidebar.php";
			include "admin/hapus_akun.php";
			break;
		case "tambah_kategori":
			//include "admin/sidebar.php";
			include "admin/tambah_kategori.php";
			break;
		case "lihat_kategori":
			//include "admin/sidebar.php";
			include "admin/data_kategori.php";
			break;
		case "ubah_kategori":
			//include "admin/sidebar.php";
			include "admin/ubah_kategori.php";
			break;
		case "hapus_kategori":
			//include "admin/sidebar.php";
			include "admin/hapus_kategori.php";
			break;
		case "tambah_penerbit":
			//include "admin/sidebar.php";
			include "admin/tambah_penerbit.php";
			break;
		case "lihat_penerbit":
			//include "admin/sidebar.php";
			include "admin/data_penerbit.php";
			break;
		case "ubah_penerbit":
			//include "admin/sidebar.php";
			include "admin/ubah_penerbit.php";
			break;
		case "hapus_penerbit":
			//include "admin/sidebar.php";
			include "admin/hapus_penerbit.php";
			break;
		case "tambah_buku":
			//include "admin/sidebar.php";
			include "admin/tambah_buku.php";
			break;
		case "lihat_buku":
			//include "admin/sidebar.php";
			include "admin/data_buku.php";
			break;
		case "ubah_buku":
			//include "admin/sidebar.php";
			include "admin/ubah_buku.php";
			break;
		case "hapus_buku":
			//include "admin/sidebar.php";
			include "admin/hapus_buku.php";
			break;
		case "lihat_transaksi":
			//include "admin/sidebar.php";
			include "admin/data_transaksi.php";
			break;
		case "ubah_transaksi":
			//include "admin/sidebar.php";
			include "admin/ubah_transaksi.php";
			break;
		case "logout_admin":
			include "admin/logout.php";
			break;

		case "daftar_member":
			include_once "header.php";
			include_once "member/daftar.php";
			include_once "footer.php";
			break;
		case "dashboard_member":
			include_once "header.php";
			include_once "member/keranjang.php";
			include_once "login.php";
			include_once "katalog_buku.php";
			include_once "footer.php";
			break;
       
        case "detail_buku":
        	include_once "header.php";
            include_once "member/detail_buku.php";
            include_once "footer.php";
            break;
		case "aksi_keranjang":
            include "member/aksi_keranjang.php";
            break;
		case "checkout":
			include_once "header.php";
			include_once "member/checkout.php";
			include_once "footer.php";
			break;
		case "lihat_tagihan":
			include_once "header.php";
			include_once "member/data_tagihan.php";
			include_once "footer.php";
			break;
		case "tambah_konfirmasi":
			include_once "header.php";
			include_once "member/tambah_konfirmasi.php";
			include_once "footer.php";
			break;
		case "view_akun":
			include_once "header.php";
			include_once "member/lihat_akun.php";
			include_once "footer.php";
			break;
		case "edit_akun":
			include_once "header.php";
			include_once "member/edit_akun.php";
			include_once "footer.php";
			break;
		case "edit_password":
			include_once "header.php";
			include_once "member/edit_password.php";
			include_once "footer.php";
			break;
		case "logout_member":
			include "member/logout.php";
			break;

		case "":
			include_once "header.php";
			include_once "welcome.php";
			include_once "slider_product.php";
			include_once "info_belanja.php";
			include_once "login.php";
			include_once "katalog_buku.php";
			include_once "footer.php";
			break;
		default:
			include_once "header.php";
			echo "
				<div class='col-md-4'></div>
				<div class='col-md-4'>
					<div class='alert alert-danger' role='alert'>
						404 Not Found!
					</div>
				</div>
				<div class='col-md-4'></div>

			";
			include_once "footer.php";
			break;
	}
?>