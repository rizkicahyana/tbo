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
	        <li class='active'>Ubah Password</li>
	    </ol>
	</div>

	<div class="col-md-4"></div>
	<div class="col-md-4">

<?php		
		if(!isset($_POST['ubah']) && $id_akun!=""){
			$query_akun = mysql_query("select * from akun where id_akun='$id_akun'");
			$data_akun = mysql_fetch_array($query_akun);
?>

			<form action="index.php?mode=edit_password" method="POST">
				<table>

					<tr>
						<td>Username</td>
						<td>:</td>
						<td>
							<input type="text" name="username" class="form-control" value="<?php echo $data_akun['username'];?>" readonly required/>
						</td>
					</tr>
					<tr>
						<td>Password Lama</td>
						<td>:</td>
						<td>
							<input type="password" name="password" class="form-control" required/>
						</td>
					</tr>
					<tr>
						<td>Password Baru</td>
						<td>:</td>
						<td>
							<input type="password" name="password_baru" class="form-control" required/>
						</td>
					</tr>
					<tr>
						<td>Konfirmasi Password Baru</td>
						<td>:</td>
						<td>
							<input type="password" name="konfirmasi_password_baru" class="form-control" required/>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="right">
							<br/>
							<input type="hidden" name="id_akun" value="<?php echo $id_akun;?>">
							<input type="submit" name="ubah" class="btn btn-primary" value="Ubah" onclick="return confirm('Apakah Anda yakin ingin mengubah Password?')" /> 
							<input type="reset" name="reset" class="btn btn-reset" value="Bersihkan">
						</td>
					</tr>
				</table>
			</form>
		
	<?php
		}
		if(isset($_POST['ubah'])){

			$id_akun = $_POST['id_akun'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$password_baru = $_POST['password_baru'];
			$konfirmasi_password_baru = $_POST['konfirmasi_password_baru'];

			$query_cek_password = mysql_query("select * from akun where password='$password'");
			$count_password = mysql_num_rows($query_cek_password);

			if($count_password>0){
				if($password_baru == $konfirmasi_password_baru){
					$query_ubah_password = mysql_query("update akun set password='$password_baru' where id_akun='$id_akun'");
					if($query_ubah_password && mysql_affected_rows()>0){
						echo "Password Anda telah berhasil diubah!<br/><br/>
						Detail data password setelah diubah:<br/>
						<table width='100%'>
							<tr valign='top'>
								<td>Username</td>
								<td>:</td>
								<td>$username</td>
							</tr>
							<tr valign='top'>
								<td>Password Lama</td>
								<td>:</td>
								<td>$password</td>
							</tr>
							<tr valign='top'>
								<td>Password Baru</td>
								<td>:</td>
								<td>$password_baru</td>
							</tr>
						</table>
						";
					}
				}
				else{
					echo "Password Baru dan Konfirmasi Password Baru tidak valid!<br/>";
				}
			}
			else{
				echo "Password Anda tidak valid!<br/>";
			}

		}
	}


	?>

</div>
<div class="col-md-4"></div>