<?php
	include_once "config/koneksi.php";

	session_start();

	if(($_SESSION['id_akun']) and ($_SESSION['nomor_level']==2)){

        $id_buku = $_GET['id_buku'];

?>
<div class='col-md-12'>
        <ol class='breadcrumb'>
            <li><a href='index.php?mode=dashboard_member'>Dashboard Member</a></li>
            <li class='active'>Detail Buku</li>
        </ol>
    </div>

<?php

        $query_buku_detail = mysql_query("select * from buku where id_buku = '$id_buku'");
        $data_buku_detail = mysql_fetch_array($query_buku_detail);

        $query_kategori = mysql_query("select * from kategori where id_kategori = '$data_buku_detail[id_kategori]'");
        $data_kategori = mysql_fetch_array($query_kategori);

        $query_penerbit = mysql_query("select * from penerbit where id_penerbit = '$data_buku_detail[id_penerbit]'");
        $data_penerbit = mysql_fetch_array($query_penerbit);

?>

        <div class="col-md-2"></div>
        <div class="col-md-8">

<?php
        echo "
            <table width='100%'>
                <tr>
                    <td colspan='3' align='center'>
						<img src='assets/".$data_buku_detail['gambar_buku']."' width='150px' height='180px'/>
					<br/><br/></td>
                </tr>
                <tr valign='top'>
                    <td>Judul Buku</td>
                    <td>:</td>
                    <td>$data_buku_detail[judul_buku]</td>
                </tr>
                <tr valign='top'>
                    <td>Kategori</td>
                    <td>:</td>
                    <td>$data_kategori[nama_kategori]</td>
                </tr>
                <tr valign='top'>
                    <td>Penerbit</td>
                    <td>:</td>
                    <td>$data_penerbit[nama_penerbit]</td>
                </tr>
                <tr valign='top'>
                    <td>Nomor ISBN</td>
                    <td>:</td>
                    <td>$data_buku_detail[nomor_isbn]</td>
                </tr>
                <tr valign='top'>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td>$data_buku_detail[deskripsi_buku]</td>
                </tr>
                <tr valign='top'>
                    <td>Harga</td>
                    <td>:</td>
                    <td>Rp$data_buku_detail[harga_buku],00</td>
                </tr>
                <tr valign='top'>
                    <td>Penulis</td>
                    <td>:</td>
                    <td>$data_buku_detail[penulis_buku]</td>
                </tr>
                <tr valign='top'>
                    <td>Jumlah Halaman</td>
                    <td>:</td>
                    <td>$data_buku_detail[jumlah_halaman_buku]</td>
                </tr>
                <tr valign='top'>
                    <td>Tahun Terbit</td>
                    <td>:</td>
                    <td>$data_buku_detail[tahun_terbit_buku]</td>
                </tr>
                <tr valign='top'>
                    <td>Stok</td>
                    <td>:</td>
                    <td>$data_buku_detail[stok_buku]</td>
                </tr>
                <tr>
                    <td colspan='3' align='center'><a href='index.php?mode=aksi_keranjang&id_buku=$data_buku_detail[id_buku]'>+ Tambah ke Keranjang Belanja</a></td>
                </tr>
            </table>
        ";

?>       


<?php    
	}
    else{
        echo "
            <div class='alert alert-danger' role='alert'>
                Saat ini Anda tidak dapat melihat detail buku ini. Silakan masuk ke TBO dengan akun Anda!
                <script>window.location='index.php'</script>
            </div>
        ";
    }

?>
</div>
<div class="col-md-2"></div>

