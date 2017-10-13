<?php

	if($_SESSION['nomor_level']==1){

?>
	
		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Lihat konfirmasi
                    </li>
                </ol>
            </div>
        </div>

<?php
		$limit = 5;

		$query = new CnnNav($limit, 'konfirmasi_transaksi', '*', 'id_konfirmasi');

		$result = $query->getResult();

?>
		<div class="table-responsive">
		<table class="table">
			<tr bgcolor="#6f6f70" style="color:white;">
				<th>No.</th>
				<th>Tanggal dan Waktu</th>
				<th>ID Transaksi</th>
				<th>Nomor Rekening</th>
				<th>Nama Pemegang Rekening</th>
				<th>Nominal</th>
			</tr>

<?php
		$nomor = ($limit * $_GET['offset'])+1;
		//$query_konfirmasi = mysql_query("select * from konfirmasi");
		$data_konfirmasi = mysql_fetch_array($result);
		$count_data_konfirmasi = mysql_num_rows($result);

		if($count_data_konfirmasi==0){
			echo "
				<tr>
					<td colspan='6' align='center'><i>Belum ada data</i></td>
				</tr>
			";
		}
		else{
			while($data_konfirmasi){
?>
			<tr valign='top'>
				<td align='center'>
					<?php
						echo $nomor;
					?>
				</td>
				<td>
					<?php
						echo $data_konfirmasi['tanggal_konfirmasi'];
					?>
				</td>
				<td>
					<?php
						echo $data_konfirmasi['id_transaksi'];
					?>
				</td>
				<td>
					<?php
						echo $data_konfirmasi['nomor_rekening'];
					?>
				</td>
				<td>
					<?php
						echo $data_konfirmasi['nama_pemegang_rekening'];
					?>
				</td>
				<td>
					<?php
						echo "Rp".$data_konfirmasi['nominal'].",00";
					?>
				</td>
			</tr>
<?php
				$nomor++;
				$data_konfirmasi = mysql_fetch_array($result);
			}
		}
?>

		</table>
		</div>
		
		<?php
			 //Cetak paging
			echo "<br/><center>";
			echo $query->printNav();
			echo "</center>";
		?>

	

<?php

	}
	else{
		//echo "Anda tidak dapat mengakses halaman ini!<br/><br/>";
		//header('location:../index.php');
	}

?>
