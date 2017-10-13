<?php
 
	include "config/koneksi.php";
	session_start();
	error_reporting(0);

	if($_SESSION['nomor_level']==1){
		$id_buku = $_GET['id_buku'];
		
?>

		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Hapus Buku
                    </li>
                </ol>
            </div>
        </div>

<?php

		$query_buku = mysql_query("select * from buku where id_buku='$id_buku'");
		$data_buku = mysql_fetch_array($query_buku);

		if($mode==hapus_buku && $id_buku!=""){

			$query_hapus_buku = mysql_query("delete from buku where id_buku='$id_buku'");

			if($query_hapus_buku && mysql_affected_rows()>0){
				echo "
					<div class='alert alert-success' role='alert'>
						Data buku $data_buku[nama_buku] telah berhasil dihapus!
						<script>window.location='index.php?mode=lihat_buku'</script>
					</div>
				";
			}
			else{
				echo "
					<div class='alert alert-danger' role='alert'>
						Data buku gagal dihapus karena".mysql_error()."
					</div>
				";
			}
		}
		
	}
/* 	else{
		echo "Anda tidak dapat mengakses halaman ini!";
	} */


	?>
