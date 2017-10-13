<div class="col-md-4"></div>
<div class="col-md-4">
	<h3 align="center">Masuk sebagai Admin</h3>
	<form action="index.php?mode=login_admin" method="POST">
		<table>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td>
					<input type="text" name="username" class="form-control" autofocus required/>
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
				<td colspan="3">
					<br/>
				</td>
			</tr>
			<tr>
				<td colspan="3" align="right">
					<input type="submit" name="masuk" class="btn btn-primary" value="Masuk"/>
				</td>
			</tr>
		</table>
	</form>
</div>
<div class="col-md-4"></div>

<?php

	if(isset($_POST['masuk']) && $mode=="login_admin"){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$enkrip_password = md5($password);
		
		$query_ambil_akun = mysql_query("select * from akun where username='$username' and password='$enkrip_password'");
		$data_akun = mysql_fetch_array($query_ambil_akun);
		$hitung_akun = mysql_num_rows($query_ambil_akun);
		
		if($hitung_akun>0){
			$status_akun = $data_akun['status_akun'];
			$nomor_level = $data_akun['nomor_level'];
			if($status_akun=="Aktif" && $nomor_level==1){
				session_start();
				$_SESSION['id_akun']=$data_akun['id_akun'];
				$_SESSION['nomor_level']=$data_akun['nomor_level'];
				$_SESSION['username']=$data_akun['username'];
				echo "Anda berhasil login di TBO..";
				header('location:admin/index.php?mode=dashboard_admin');
			}
			else{
				if($nomor_level==2){
					echo "<br/><br/>Username dan password yang Anda masukkan tidak dikenali!<br/>";
				}
				else{
					echo "<br/><br/>Akun Anda belum diaktifkan oleh Administrator.<br/>
					Silakan tunggu maksimal 1 x 24 jam setelah melakukan pendaftaran.<br/><br/>";
				}
			}
		}
		else{
			echo "<br/><br/>Username dan password yang Anda masukkan tidak dikenali!<br/>";
		}
	}

?>