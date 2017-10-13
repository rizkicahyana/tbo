<?php
 
	include "config/koneksi.php";
	session_start();
	error_reporting(0);

	if($_SESSION['nomor_level']==1){
		$id_kategori = $_GET['id_kategori'];
?>		

		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Hapus Kategori
                    </li>
                </ol>
            </div>
        </div>

<?php
		$query_kategori = mysql_query("select * from kategori where id_kategori='$id_kategori'");
		$data_kategori = mysql_fetch_array($query_kategori);

		if($mode==hapus_kategori && $id_kategori!=""){

			$query_hapus_kategori = mysql_query("delete from kategori where id_kategori='$id_kategori'");

			if($query_hapus_kategori && mysql_affected_rows()>0){
				echo "
					<div class='alert alert-success' role='alert'>
						Data kategori $data_kategori[nama_kategori] telah berhasil dihapus!
						<script>window.location='index.php?mode=lihat_kategori'</script>
					</div>
				";
			}
			else{
				echo "
					<div class='alert alert-danger' role='alert'>
						Data kategori gagal dihapus karena".mysql_error()."
					</div>
				";
			}
		}
		
	}
/* 	else{
		echo "Anda tidak dapat mengakses halaman ini!";
	} */


	?>
