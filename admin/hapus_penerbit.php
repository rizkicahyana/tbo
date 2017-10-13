<?php

	include "config/koneksi.php";
	session_start();
	error_reporting(0);

	if($_SESSION['nomor_level']==1){
		$id_penerbit = $_GET['id_penerbit'];
?>		

		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Hapus Penerbit
                    </li>
                </ol>
            </div>
        </div>

<?php
		$query_penerbit = mysql_query("select * from penerbit where id_penerbit='$id_penerbit'");
		$data_penerbit = mysql_fetch_array($query_penerbit);

		if($mode==hapus_penerbit && $id_penerbit!=""){

			$query_hapus_penerbit = mysql_query("delete from penerbit where id_penerbit='$id_penerbit'");

			if($query_hapus_penerbit && mysql_affected_rows()>0){
				echo "
					<div class='alert alert-success' role='alert'>
						Data penerbit $data_penerbit[nama_penerbit] telah berhasil dihapus!
						<script>window.location='index.php?mode=lihat_penerbit'</script>
					</div>
				";
			}
			else{
				echo "
					<div class='alert alert-danger' role='alert'>
						Data penerbit gagal dihapus karena".mysql_error()."
					</div>
				";
			}
		}
		
	}
/* 	else{
		echo "Anda tidak dapat mengakses halaman ini!";
	} */


	?>
