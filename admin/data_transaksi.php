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
                    	Lihat Transaksi
                    </li>
                </ol>
            </div>
        </div>

<?php
		$limit = 5;

		$query = new CnnNav($limit, 'transaksi', '*', 'id_transaksi');

		$result = $query->getResult();

?>
		<div class="table-responsive">
		<table class="table">
			<tr bgcolor="#6f6f70" style="color:white;">
				<th>No.</th>
				<th>Tanggal dan Waktu</th>
				<th>Nama Pengguna</th>
				<th>Total Transaksi</th>
				<th>Status Pembayaran</th>
				<th>Aksi</th>
			</tr>

<?php
		$nomor = ($limit * $_GET['offset'])+1;
		//$query_transaksi = mysql_query("select * from transaksi");
		$data_transaksi = mysql_fetch_array($result);
		$count_data_transaksi = mysql_num_rows($result);

		if($count_data_transaksi==0){
			echo "
				<tr>
					<td colspan='6' align='center'><i>Belum ada data</i></td>
				</tr>
			";
		}
		else{
			while($data_transaksi){
?>
			<tr valign='top'>
				<td align='center'>
					<?php
						echo $nomor;
					?>
				</td>
				<td>
					<?php
						echo $data_transaksi['tanggal_transaksi'];
					?>
				</td>
				<td>
					<?php
						$query_akun = mysql_query("select * from akun where id_akun = '$data_transaksi[id_akun]'");
						$data_akun = mysql_fetch_array($query_akun);
						echo $data_akun['nama'];
					?>
				</td>
				<td>
					<?php
						echo "Rp".$data_transaksi['total_transaksi'].",00";
					?>
				</td>
				<td>
					<?php
						echo $data_transaksi['status_transaksi'];
					?>
				</td>
				<td>
					<?php
						echo "
							<a href='index.php?mode=ubah_transaksi&id_transaksi=$data_transaksi[id_transaksi]' style='text-decoration:none'>Ubah</a> | <a href='index.php?mode=hapus_transaksi&id_transaksi=$data_transaksi[id_transaksi]' style='text-decoration:none' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data transaksi dengan ID Transaksi $data_transaksi[id_transaksi]?')\">Hapus</a>
						";
					?>
				</td>
			</tr>
<?php
				$nomor++;
				$data_transaksi = mysql_fetch_array($result);
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
