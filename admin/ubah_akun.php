<?php

	include "config/koneksi.php";
	session_start();
	error_reporting(0);

	$id_akun = $_GET['id_akun'];
	$query_akun = mysql_query("select * from akun");
	$data_akun = mysql_fetch_array($query_akun);


	if($_SESSION['nomor_level']==1){
?>

		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Ubah Akun
                    </li>
                </ol>
            </div>
        </div>

<?php		
		if(!isset($_POST['ubah']) && $id_akun!=""){
			$query_akun = mysql_query("select * from akun where id_akun='$id_akun'");
			$data_akun = mysql_fetch_array($query_akun);
?>

			<form action="index.php?mode=ubah_akun&aksi=simpan" method="POST">
				<table>
					<tr>
						<td>E-Mail</td>
						<td>:</td>
						<td>
							<input type="hidden" name="id_akun" class="form-control" value="<?php echo $data_akun['id_akun'];?>">
							<input type="email" name="email" class="form-control" value="<?php echo $data_akun['email'];?>" readonly />
						</td>
					</tr>
					<tr>
						<td>Username</td>
						<td>:</td>
						<td>
							<input type="text" name="username" class="form-control" value="<?php echo $data_akun['username'];?>" readonly />
						</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>:</td>
						<td>
							<input type="text" name="nama" class="form-control" value="<?php echo $data_akun['nama'];?>" readonly />
						</td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td>
							<textarea name="alamat" class="form-control" value="<?php echo $data_akun['alamat'];?>" readonly><?php echo $data_akun['alamat'];?></textarea>
						</td>
					</tr>
					<tr>
						<td>Nomor Telepon</td>
						<td>:</td>
						<td>
							<input type="text" name="nomor_telepon" class="form-control" value="<?php echo $data_akun['nomor_telepon'];?>" readonly />
						</td>
					</tr>
					<tr>
						<td>Status Akun</td>
						<td>:</td>
						<td>
							<?php
								echo "<select name='status_akun' class='form-control' required>";
									if($data_akun['status_akun']=="Aktif"){
										echo "
											<option value='Aktif' selected>Aktif</option>
											<option value='Pending'>Pending</option>
										";
									}
									else{
										echo "
											<option value='Pending' selected>Pending</option>
											<option value='Aktif'>Aktif</option>
										";
									}
								echo "</select>";
							?>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="right">
							<br/>
							<input type="hidden" name="nomor_level" value="<?php echo $data_akun['nomor_level'];?>"/>
							<input type="submit" name="ubah" value="Ubah" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin mengubah data akun dengan username <?php echo $data_akun['username'];?> atas nama <?php echo $data_akun['nama'];?>?')"/>
							<input type='reset' name='reset' class='btn btn-reset' value='Bersihkan'>
						</td>
					</tr>
				</table>
			</form>
		
	<?php
		}
		if(isset($_POST['ubah'])){

			$id_akun = $_POST['id_akun'];
			$email = $_POST['email'];
			$username = $_POST['username'];
			$nomor_level = $_POST['nomor_level'];
			$status_akun = $_POST['status_akun'];
			$nama = $_POST['nama'];
			$alamat = $_POST['alamat'];
			$nomor_telepon = $_POST['nomor_telepon'];


			$query_ubah_akun = mysql_query("update akun set email='$email', username='$username', nomor_level='$nomor_level', status_akun='$status_akun', nama='$nama', alamat='$alamat', nomor_telepon='$nomor_telepon' where id_akun='$id_akun'");

			if($query_ubah_akun && mysql_affected_rows()>0){
				echo "
					<div class='alert alert-success' role='alert'>
					Data akun telah berhasil diubah!<br/><br/>

					Detail data akun setelah diubah:<br/>
					<table width='100%'>
						<tr valign='top'>
							<td>E-Mail</td>
							<td>:</td>
							<td>$email</td>
						</tr>
						<tr valign='top'>
							<td>Username</td>
							<td>:</td>
							<td>$username</td>
						</tr>
						<tr valign='top'>
							<td>Status Akun</td>
							<td>:</td>
							<td>$status_akun</td>
						</tr>
						<tr valign='top'>
							<td>Nama</td>
							<td>:</td>
							<td>$nama</td>
						</tr>
						<tr valign='top'>
							<td>Alamat</td>
							<td>:</td>
							<td>$alamat</td>
						</tr>
						<tr valign='top'>
							<td>Nomor Telepon</td>
							<td>:</td>
							<td>$nomor_telepon</td>
						</tr>
					</table>
					</div>
				";
			}
			else{
				echo "
					<div class='alert alert-danger' role='alert'>
						Data akun gagal diubah karena tidak ada nilai yang diubah!
					</div>
				";
			}
		}
	}
/* 	else{
		echo "Anda tidak dapat mengakses halaman ini!";
	} */


	?>
