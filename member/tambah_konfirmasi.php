<?php
	//session_start();

	if($_SESSION['nomor_level']==2){
		if(isset($_GET['kode_referensi'])){
			$id_transaksi = $_GET['kode_referensi'];
		}
?>


<div class='col-md-12'>
	    <ol class='breadcrumb'>
	        <li><a href='index.php?mode=dashboard_member'>Dashboard Member</a></li>
	        <li class='active'>Konfirmasi Tagihan</li>
	    </ol>
	</div>
<div class="col-md-4"></div>
<div class="col-md-4">
	
	<form action="index.php?mode=tambah_konfirmasi" method="POST">
		<div class="form-group">
			<input type="hidden" name="id_transaksi" class="form-control" value="<?php echo $id_transaksi;?>" readonly>
			<input type="text" name="nomor_rekening" class="form-control" placeholder="Nomor Rekening" autofocus required/>
		</div>
		<div class="form-group">
			<input type="text" name="nama_pemegang_rekening" class="form-control" placeholder="Nama Pemegang Rekening" required/>
		</div>
		<div class="form-group">
			<input type="number" name="nominal" class="form-control" placeholder="Nominal yang Anda Masukkan" required/>
		</div>
		<div class="form-group">
			<br/>
			<p align="right">
		        <input type="submit" class="btn btn-primary" name="konfirmasi" value="Konfirmasi" onclick="return confirm('Apakah Anda yakin untuk melakukan konfirmasi pembayaran untuk Kode Referensi <?php echo $id_transaksi;?>?')"/> <input type="reset" class="btn btn-reset" value="Bersihkan"/>
		    </p>
		</div>
	</form>
		


	
<?php

	if(isset($_POST['konfirmasi'])){
		$nominal = $_POST['nominal'];

		if(!filter_var($nominal, FILTER_VALIDATE_INT)){
			echo "
				<div class='alert alert-danger' role='alert'>
					Nominal tidak sesuai dengan format!
				</div>
			";
		}
		else if($nominal<0){
			echo "
				<div class='alert alert-danger' role='alert'>
					Nominal tidak boleh kurang dari atau sama dengan 0
				</div>
			";
		}
		else if($nominal==0){
			echo "
				<div class='alert alert-danger' role='alert'>
					Nominal tidak boleh sama dengan 0
				</div>	
			";
		}
		else{
			$id_transaksi = $_POST['id_transaksi'];
			$nomor_rekening = $_POST['nomor_rekening'];
			$nama_pemegang_rekening = $_POST['nama_pemegang_rekening'];
			

			$query_transaksi = mysql_query("select * from transaksi where id_transaksi = '$id_transaksi'");
			$data_transaksi = mysql_fetch_array($query_transaksi);

			if($nominal == $data_transaksi['total_transaksi']){

				$query_insert = mysql_query("insert into konfirmasi_transaksi values(null, current_timestamp, '$id_transaksi', '$nomor_rekening', '$nama_pemegang_rekening', '$nominal')") or die(mysql_error());

				if($query_insert && mysql_affected_rows()>0){
					echo "
						<div class='alert alert-success' role='alert'>
							Konfirmasi pembayaran untuk Kode Referensi <b>$id_transaksi</b> telah diproses. Saat ini sedang menunggu validasi dari Administrator.<br/>
							Barang akan dikirim segera setelah data konfirmasi pembayaran yang Anda masukkan dinyatakan valid oleh Administrator.
						</div>
					";
				}
				else{
					echo "
						<div class='alert alert-danger' role='alert'>
							Data konfirmasi pembayaran gagal dilakukan!
						</div>
					";
				}

			}
			else{
				echo "
					<div class='alert alert-danger' role='alert'>
						Nominal yang Anda masukkan tidak valid!<br/>
						Silakan periksa kembali total transaksi Anda dengan menyesuaikan pada Kode Referensi yang bersesuaian! Untuk diperiksa kembali pada Menu Tagihan.
					</div>
				";
			}
		}
		
	}
}

?>
</div>