<?php
 
	include "config/koneksi.php";
	session_start();
	error_reporting(0);

	if($_SESSION['nomor_level']==1){
		$id_akun = $_GET['id_akun'];
?>

		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Hapus Akun
                    </li>
                </ol>
            </div>
        </div>
	

<?php
		$query_akun = mysql_query("select * from akun where id_akun='$id_akun'");
		$data_akun = mysql_fetch_array($query_akun);

		if($mode==hapus_akun && $id_akun!=""){

			$query_hapus_akun = mysql_query("delete from akun where id_akun='$id_akun'");


			if($query_hapus_akun && $data_akun && mysql_affected_rows()>0){
				echo "
					<div class='alert alert-success' role='alert'>
						Data akun atas nama $data_akun[nama] telah berhasil dihapus!
						<script>window.location='index.php?mode=lihat_akun'</script>
					</div>
				";
			}
			else{
				echo "
					<div class='alert alert-danger' role='alert'>
						Data akun gagal dihapus karena".mysql_error()."
					</div>
				";
			}
		}
		
	}
/* 	else{
		echo "Anda tidak dapat mengakses halaman ini!";
	} */


	?>
