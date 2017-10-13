<!--login member-->
<div class="col-md-4">
<?php

	if(isset($_POST['masuk'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$enkrip_password = md5($password);

		$query_ambil_akun = mysql_query("select * from akun where username='$username' and password='$enkrip_password'");
		$data_akun = mysql_fetch_array($query_ambil_akun);
		$hitung_akun = mysql_num_rows($query_ambil_akun);

		if($hitung_akun>0){
			$status_akun = $data_akun['status_akun'];
			$nomor_level = $data_akun['nomor_level'];
			if($status_akun=="Aktif" && $nomor_level==2){
				session_start();
				$_SESSION['id_akun']=$data_akun['id_akun'];
				$_SESSION['username']=$data_akun['username'];
				$_SESSION['nomor_level']=$data_akun['nomor_level'];
				echo "
					<br/>
					<div class='alert alert-success' role='alert'>
						<strong>Selamat!</strong> Anda berhasil masuk di Toko Buku Online.
						<script>window.location='index.php?mode=dashboard_member'</script>
					</div>
				";
			}
			else{
				if($nomor_level==1){
					echo "
						<br/>
						<div class='alert alert-danger' role='alert'>
							<strong>Mohon maaf!</strong> Username dan password yang Anda masukkan tidak dikenali!
						</div>
					";
				}
				else{
					echo "
						<br/>
						<div class='alert alert-danger' role='alert'>
							<strong>Mohon maaf!</strong> Akun Anda belum diaktifkan oleh Administrator.<br/>
							Silakan tunggu maksimal 1 x 24 jam setelah melakukan pendaftaran!
						</div>
					";
				}
			}
		}
		else{
			echo "
				<br/>
				<div class='alert alert-danger' role='alert'>
					<strong>Mohon maaf!</strong> Username dan password yang Anda masukkan tidak dikenali!
				</div>
			";
		}
	}

?>
	
		<?php
			if(($_SESSION['id_akun'])=='' or ($_SESSION['nomor_level']=='') or ($_SESSION['nomor_level']=='1')){
		?>
		<br/>
		<h4>Masuk ke Toko Buku Online</h4>
		<form action="index.php" method="POST">
		    <input type="text" class="form-control" name="username" placeholder="Username" autofocus required/>
		    <input type="password" class="form-control" name="password" placeholder="Password" required/><br/>
		    <p align="right">
		        <input type="submit" class="btn btn-primary" name="masuk" value="Masuk"/>
		    </p>
		</form>
		<p align="right">
		    Belum punya Akun TBO? 
		    <a href="index.php?mode=daftar_member"><strong>Daftar di sini</strong></a>
		</p>
		<?php
			}
		?>


	</div>
</div>
<hr/>