<?php
	//session_start();

	if($_SESSION['nomor_level']==2){
?>

	<div class='col-md-12'>
	    <ol class='breadcrumb'>
	        <li><a href='index.php?mode=dashboard_member'>Dashboard Member</a></li>
	        <li class='active'>Lihat Tagihan</li>
	    </ol>
	</div>

	<div class="col-md-3"></div>
	<div class="col-md-6">

<?php
	if($hitung_tagihan > 0){
?>

	<div class='table-responsive'>
		<table class='table'>
			<tr>
				<th>No.</th>
				<th>Kode Referensi</th>
				<th>Tanggal dan Waktu</th>
				<th>Total Transaksi</th>
				<th>Aksi</th>
			</tr>

<?php
	$id_akun = $_SESSION['id_akun'];	
	$query_transaksi = mysql_query("select * from transaksi where id_akun='$id_akun' and status_transaksi='Belum Lunas'");
	$data_transaksi = mysql_fetch_array($query_transaksi);
	$nomor = 1;

	while($data_transaksi){

?>
		
			<tr>
				<td><?php echo $nomor;?></td>
				<td><?php echo $data_transaksi[id_transaksi];?></td>
				<td><?php echo $data_transaksi[tanggal_transaksi];?></td>
				<td><?php echo $data_transaksi[total_transaksi];?></td>
				<td>
					<a href='index.php?mode=tambah_konfirmasi&kode_referensi=<?php echo $data_transaksi[id_transaksi]?>'><p class='btn btn-primary'>Konfirmasi</p></a>					
				</td>
			</tr>
<?php			
		$data_transaksi = mysql_fetch_array($query_transaksi);
		$nomor++;
	
	}
	echo "
		</table>
		</div>
	";
	}
	else{
		echo "
			<div class='alert alert-danger' role='alert'>
				Belum ada tagihan pembayaran!
			</div>
		";
	}
	
	
	}

		

?>

</div>

<div class="col-md-3"></div>