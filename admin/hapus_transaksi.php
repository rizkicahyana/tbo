<?php

	if($_SESSION['nomor_level']==1){
		$id_transaksi = $_GET['id_transaksi'];
?>		

		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Hapus Transaksi
                    </li>
                </ol>
            </div>
        </div>

<?php
		$query_transaksi = mysql_query("select * from transaksi where id_transaksi='$id_transaksi'");
		$data_transaksi = mysql_fetch_array($query_transaksi);

		if($mode==hapus_transaksi && $id_transaksi!=""){

			$query_hapus_transaksi = mysql_query("delete from transaksi where id_transaksi='$id_transaksi'");

			if($query_hapus_transaksi && mysql_affected_rows()>0){
				echo "
					<div class='alert alert-success' role='alert'>
						Data transaksi $data_transaksi[nama_transaksi] telah berhasil dihapus!
						<script>window.location='index.php?mode=lihat_transaksi'</script>
					</div>
				";
			}
			else{
				echo "
					<div class='alert alert-danger' role='alert'>
						Data transaksi gagal dihapus karena".mysql_error()."
					</div>
				";
			}
		}
		
	}
/* 	else{
		echo "Anda tidak dapat mengakses halaman ini!";
	} */


	?>
