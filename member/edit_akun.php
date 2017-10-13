<?php

	include "config/koneksi.php";
	session_start();
	error_reporting(0);

	//$id_akun = $_GET['id_akun'];

	if($_SESSION['nomor_level']==2){
?>
	
	<div class='col-md-12'>
	    <ol class='breadcrumb'>
	        <li><a href='index.php?mode=dashboard_member'>Dashboard Member</a></li>
	        <li class='active'>Ubah Akun</li>
	    </ol>
	</div>

	<div class="col-md-4"></div>
	<div class="col-md-4">

<?php		
		if(!isset($_POST['ubah']) && $id_akun!=""){
			$query_akun = mysql_query("select * from akun where id_akun='$id_akun'");
			$data_akun = mysql_fetch_array($query_akun);
?>


			<form action="index.php?mode=edit_akun" method="POST">
				<table>
					<tr>
						<td>E-Mail</td>
						<td>:</td>
						<td>
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
							<input type="text" name="nama" class="form-control" value="<?php echo $data_akun['nama'];?>" required/>
						</td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td>
							<textarea name="alamat" class="form-control" value="<?php echo $data_akun['alamat'];?>" required><?php echo $data_akun['alamat'];?></textarea>
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
						<td>Password</td>
						<td>:</td>
						<td>
							<input type="password" name="password" class="form-control" required/>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="right">
							<br/>
							<input type="hidden" name="id_akun" value="<?php echo $data_akun['id_akun'];?>">
							<input type="hidden" name="nomor_level" value="<?php echo $data_akun['nomor_level'];?>"/>
							<input type="submit" name="ubah" class="btn btn-primary" value="Ubah" onclick="return confirm('Apakah Anda yakin ingin mengubah data akun?')" /> 
							<input type="reset" name="reset" class="btn btn-reset" value="Bersihkan">
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
			$password = $_POST['password'];
			$nomor_level = $_POST['nomor_level'];
			$status_akun = $_POST['status_akun'];
			$nama = $_POST['nama'];
			$alamat = $_POST['alamat'];
			$nomor_telepon = $_POST['nomor_telepon'];

			$query_akun = mysql_query("select * from akun where id_akun='$id_akun'");
			$data_akun = mysql_fetch_array($query_akun);

			if($password == $data_akun['password']){
				$query_ubah_akun = mysql_query("update akun set nama='$nama', alamat='$alamat' where id_akun='$id_akun'");

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
								Data akun gagal diubah karena tidak ada data yang diubah!
							</div>
						";
					}
			}
			else{
				echo "
					<div class='alert alert-danger' role='alert'>
						Password yang Anda masukkan tidak valid!
					</div>
				";	
			}
		}
	}


	?>

</div>
		<div class="col-md-4"></div>