<?php

	$id_konfirmasi = $_GET['id_konfirmasi'];

	if($_SESSION['nomor_level']==1){
?>

		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Ubah konfirmasi
                    </li>
                </ol>
            </div>
        </div>

<?php		
		if(!isset($_POST['ubah']) && $id_konfirmasi!=""){
			$query_konfirmasi = mysql_query("select * from konfirmasi_transaksi where id_konfirmasi='$id_konfirmasi'");
			$data_konfirmasi = mysql_fetch_array($query_konfirmasi);
?>

			<form action="index.php?mode=ubah_konfirmasi&aksi=simpan" method="POST">
				<table>
					<tr>
						<td>ID Transaski</td>
						<td>:</td>
						<td>
							<input type="text" name="id_konfirmasi" class="form-control" value="<?php echo $data_konfirmasi['id_konfirmasi'];?>" readonly >
						</td>
					</tr>
					<tr>
						<td>Tanggal dan Waktu konfirmasi</td>
						<td>:</td>
						<td>
							<input type="text" name="tanggal_konfirmasi" class="form-control" value="<?php echo $data_konfirmasi['tanggal_konfirmasi'];?>" readonly />
						</td>
					</tr>
					<tr>
						<td>ID Transaksi</td>
						<td>:</td>
						<td>
							<input type="text" name="id_transaksi" class="form-control" value="<?php echo $data_konfirmasi['id_transaksi'];?>" readonly />
						</td>
					</tr>
					<tr>
						<td>Nomor Rekening</td>
						<td>:</td>
						<td>
							<input type="text" name="nomor_rekening" class="form-control" value="<?php echo $data_konfirmasi['nomor_rekening'];?>" readonly />
						</td>
					</tr>
					<tr>
						<td>Nama Pemegang Rekening</td>
						<td>:</td>
						<td>
							<input type="text" name="nama_pemegang_rekening" class="form-control" value="<?php echo $data_konfirmasi['nama_pemegang_rekening'];?>" readonly />
						</td>
					</tr>
					<tr>
						<td>Nominal</td>
						<td>:</td>
						<td>
							<input type="text" name="nominal" class="form-control" value="<?php echo $data_konfirmasi['nominal'];?>" readonly />
						</td>
					</tr>
					<tr>
						<td>Status konfirmasi</td>
						<td>:</td>
						<td>
						<?php
						echo "<select name='status_konfirmasi' class='form-control' required>";
							if($data_konfirmasi['status_konfirmasi']=="Belum Lunas"){
								echo "
									<option value='Belum Lunas' selected>Belum Lunas</option>
									<option value='Lunas'>Lunas</option>
								";
							}
							else{
								echo "
									<option value='Lunas' selected>Lunas</option>
									<option value='Belum Lunas'>Belum Lunas</option>
								";
							}
						echo "</select>";
						?>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="right">
							<br/>
							<input type="submit" name="ubah" class="btn btn-primary" value="Ubah" onclick="return confirm('Apakah Anda yakin ingin mengubah data konfirmasi dengan nama konfirmasi <?php echo $data_konfirmasi[nama_konfirmasi];?>?')"/>
						</td>
					</tr>
				</table>
			</form>
		
	<?php
		}
		if(isset($_POST['ubah'])){

			$id_konfirmasi = $_POST['id_konfirmasi'];
			$tanggal_konfirmasi = $_POST['tanggal_konfirmasi'];
			$id_akun = $_POST['id_akun'];
			$total_konfirmasi = $_POST['total_konfirmasi'];
			$status_konfirmasi = $_POST['status_konfirmasi'];

			$query_ubah_konfirmasi = mysql_query("update konfirmasi set status_konfirmasi = '$status_konfirmasi' where id_konfirmasi='$id_konfirmasi'");

			if($query_ubah_konfirmasi && mysql_affected_rows()>0){
				echo "
					<div class='alert alert-success' role='alert'>
					Data konfirmasi telah berhasil diubah!<br/><br/>

					Detail data konfirmasi setelah diubah:<br/>
					<table width='100%'>
						<tr valign='top'>
							<td>ID konfirmasi</td>
							<td>:</td>
							<td>$id_konfirmasi</td>
						</tr>
						<tr valign='top'>
							<td>Tanggal dan Waktu</td>
							<td>:</td>
							<td>$tanggal_konfirmasi</td>
						</tr>
						<tr valign='top'>
							<td>ID Akun</td>
							<td>:</td>
							<td>$id_akun</td>
						</tr>
						<tr valign='top'>
							<td>Total konfirmasi</td>
							<td>:</td>
							<td>$total_konfirmasi</td>
						</tr>
						<tr valign='top'>
							<td>Status konfirmasi</td>
							<td>:</td>
							<td>$status_konfirmasi</td>
						</tr>
					</table>
					</div>
				";
			}
			else{
				echo "
					<div class='alert alert-danger' role='alert'>
						Data konfirmasi gagal diubah karena tidak ada nilai yang diubah!
					</div>
				";
			}
		}
	}
/* 	else{
		echo "Anda tidak dapat mengakses halaman ini!";
	} */


	?>
