<!--login member-->
<h4>Masuk ke Toko Buku Online</h4><br/>
<form action="index2.php" method="POST">
    <input type="text" class="form-control" name="username" placeholder="Username" autofocus required/>
    <input type="password" class="form-control" name="password" placeholder="Password" required/><br/>
    <p>
        <input type="submit" class="btn btn-primary" name="masuk" value="Masuk"/>
    </p>
</form>
<p align="right">
    Belum punya Akun TBO? 
    <a href="index2.php?mode=daftar_member" style="text-decoration:none;"><b>Daftar</b></a>
</p>
<?php

	if(isset($_POST['masuk'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$query_ambil_akun = mysql_query("select * from akun where username='$username' and password='$password'");
		$data_akun = mysql_fetch_array($query_ambil_akun);
		$hitung_akun = mysql_num_rows($query_ambil_akun);

		if($hitung_akun>0){
			$status_akun = $data_akun['status_akun'];
			$nomor_level = $data_akun['nomor_level'];
			if($status_akun=="Aktif" && $nomor_level==2){
				session_start();
				$_SESSION['id_akun']=$data_akun['id_akun'];
				$_SESSION['nomor_level']=$data_akun['nomor_level'];
				echo "Anda berhasil login di TBO..";
				header('location:index2.php?mode=dashboard_member');
			}
			else{
				if($nomor_level==1){
					echo "<br/>Username dan password yang Anda masukkan tidak dikenali!<br/>";
				}
				else{
					echo "<br/>Akun Anda belum diaktifkan oleh Administrator.<br/>
					Silakan tunggu maksimal 1 x 24 jam setelah melakukan pendaftaran.<br/><br/>";
				}
			}
		}
		else{
			echo "<br/>Username dan password yang Anda masukkan tidak dikenali!<br/>";
		}
	}

?>
</div>
