<?php

	include "config/koneksi.php";
	session_start();
	error_reporting(0);

	$id_transaksi = $_GET['id_transaksi'];

	if($_SESSION['nomor_level']==1){
?>

		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Ubah Transaksi
                    </li>
                </ol>
            </div>
        </div>

<?php		
		if(!isset($_POST['ubah']) && $id_transaksi!=""){
			$query_transaksi = mysql_query("select * from transaksi where id_transaksi='$id_transaksi'");
			$data_transaksi = mysql_fetch_array($query_transaksi);
?>

			<form action="index.php?mode=ubah_transaksi&aksi=simpan" method="POST">
				<table>
					<tr>
						<td>ID Transaski</td>
						<td>:</td>
						<td>
							<input type="text" name="id_transaksi" class="form-control" value="<?php echo $data_transaksi['id_transaksi'];?>" readonly >
						</td>
					</tr>
					<tr>
						<td>Tanggal dan Waktu Transaksi</td>
						<td>:</td>
						<td>
							<input type="text" name="tanggal_transaksi" class="form-control" value="<?php echo $data_transaksi['tanggal_transaksi'];?>" readonly />
						</td>
					</tr>
					<tr>
						<td>ID Akun</td>
						<td>:</td>
						<td>
							<input type="text" name="id_akun" class="form-control" value="<?php echo $data_transaksi['id_akun'];?>" readonly />
						</td>
					</tr>
					<tr>
						<td>Total Transaksi</td>
						<td>:</td>
						<td>
							<input type="text" name="total_transaksi" class="form-control" value="<?php echo $data_transaksi['total_transaksi'];?>" readonly />
						</td>
					</tr>
					<tr>
						<td>Status Transaksi</td>
						<td>:</td>
						<td>
						<?php
						echo "<select name='status_transaksi' class='form-control' required>";
							if($data_transaksi['status_transaksi']=="Belum Lunas"){
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
							<input type="submit" name="ubah" class="btn btn-primary" value="Ubah" onclick="return confirm('Apakah Anda yakin ingin mengubah data transaksi dengan ID Transaksi <?php echo $data_transaksi[id_transaksi];?>?')"/>
						</td>
					</tr>
				</table>
			</form>
		
	<?php
		}
		if(isset($_POST['ubah'])){

			$id_transaksi = $_POST['id_transaksi'];
			$tanggal_transaksi = $_POST['tanggal_transaksi'];
			$id_akun = $_POST['id_akun'];
			$total_transaksi = $_POST['total_transaksi'];
			$status_transaksi = $_POST['status_transaksi'];

			$query_ubah_transaksi = mysql_query("update transaksi set status_transaksi = '$status_transaksi' where id_transaksi='$id_transaksi'");

			if($query_ubah_transaksi && mysql_affected_rows()>0){
				echo "
					<div class='alert alert-success' role='alert'>
					Data transaksi telah berhasil diubah!<br/><br/>

					Detail data transaksi setelah diubah:<br/>
					<table width='100%'>
						<tr valign='top'>
							<td>ID Transaksi</td>
							<td>:</td>
							<td>$id_transaksi</td>
						</tr>
						<tr valign='top'>
							<td>Tanggal dan Waktu</td>
							<td>:</td>
							<td>$tanggal_transaksi</td>
						</tr>
						<tr valign='top'>
							<td>ID Akun</td>
							<td>:</td>
							<td>$id_akun</td>
						</tr>
						<tr valign='top'>
							<td>Total Transaksi</td>
							<td>:</td>
							<td>$total_transaksi</td>
						</tr>
						<tr valign='top'>
							<td>Status Transaksi</td>
							<td>:</td>
							<td>$status_transaksi</td>
						</tr>
					</table>
					</div>
				";
			}
			else{
				echo "
					<div class='alert alert-danger' role='alert'>
						Data transaksi gagal diubah karena tidak ada nilai yang diubah!
					</div>
				";
			}
		}
	}
/* 	else{
		echo "Anda tidak dapat mengakses halaman ini!";
	} */


	?>
