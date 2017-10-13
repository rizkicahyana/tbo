<div class="col-md-12">
	<ol class="breadcrumb">
	    <li><a href="index.php">Beranda</a></li>
	    <li><a class="active">Daftar Member</a></li>        
	</ol>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">

<?php

	if(isset($_POST['daftar'])){
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$ulang_password = $_POST['ulang_password'];
		$nomor_level = $_POST['nomor_level'];
		$status_akun = $_POST['status_akun'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$nomor_telepon = $_POST['nomor_telepon'];

		$query_email = mysql_query("select * from akun where email='$email'");
		$count_email = mysql_num_rows($query_email);

		$query_username = mysql_query("select * from akun where username='$username'");
		$count_username = mysql_num_rows($query_username);

		$query_nomor_telepon = mysql_query("select * from akun where nomor_telepon='$nomor_telepon'");
		$count_nomor_telepon = mysql_num_rows($query_nomor_telepon);

		if($count_email>0){
			echo "
				<div class='alert alert-danger' role='alert'>
					E-mail sudah terdaftar! Silakan gunakan e-mail yang lain.
				</div>
			";
		}
		if($count_username>0){
			echo "
				<div class='alert alert-danger' role='alert'>
					Username sudah terdaftar! Silakan gunakan username yang lain.
				</div>
			";
		}
		if($count_nomor_telepon>0){
			echo "
				<div class='alert alert-danger' role='alert'>
					Nomor Telepon sudah terdaftar! Silakan gunakan nomor telepon yang lain.
				</div>
			";
		}

		if($password==$ulang_password){

			$panjang_alamat = strlen($alamat);
			
			if($panjang_alamat < 25){
				echo "
					<div class='alert alert-danger' role='alert'>
						Mohon untuk mengisi alamat Anda dengan lengkap dan sebenar-benarnya!
					</div>
				";
			}
			else{
				$enkrip_password = md5($password);
				$query_daftar = mysql_query("insert into akun values(null, '$email', '$username', '$enkrip_password', '$nomor_level', '$status_akun', '$nama', '$alamat', '$nomor_telepon')");

				if($query_daftar && mysql_affected_rows()>0){
					echo "
						<div class='alert alert-success' role='alert'>
							Registrasi Anda telah berhasil ditambahkan ke database.<br/>
							Dibutuhkan waktu maksimal 1 x 24 jam setelah registrasi untuk menggunakan akun Anda.
						</div>
					";
				}
				else{
					//echo "Data registrasi Anda gagal ditambahkan ke database karena ".mysql_error();
				}
			}
		}
		else{
			echo "
				<div class='alert alert-danger' role='alert'>
					Password dan Ulang Password Anda tidak sesuai.
				</div>
			";
		}
	}

?>
	
	<form action="index.php?mode=daftar_member" method="POST">
		<div class="form-group">
			<input type="email" name="email" class="form-control" placeholder="E-Mail" value="<?php echo $email;?>" autofocus required/>
		</div>
		<div class="form-group">
			<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $username;?>" required/>
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder="Password" required/>
		</div>
		<div class="form-group">
			<input type="password" name="ulang_password" class="form-control" placeholder="Ulang Password" required/>
		</div>
		<div class="form-group">
			<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo $nama;?>" required/>
		</div>
		<div class="form-group">
			<textarea name="alamat" class="form-control" placeholder="Alamat Lengkap" rows="5" value="<?php echo $alamat;?>" required><?php echo $alamat;?></textarea>
		</div>
		<div class="form-group">
			<input type="text" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon" value="<?php echo $nomor_telepon;?>"required/>
		</div>
		<div class="form-group">
			<input type="hidden" name="nomor_level" value="2"/>
			<input type="hidden" name="status_akun" value="Pending"/>
			<p align="right">
		        <input type="submit" class="btn btn-primary" name="daftar" value="Daftar" onclick="return confirm('Apakah Anda yakin ingin membuat Akun TBO dengan data tersebut?\n\nUntuk diperhatikan bahwa e-mail, username, dan nomor telepon bersifat unik sehingga sekali didaftarkan maka tidak dapat diubah kembali.')"/> <input type="reset" class="btn btn-reset" value="Bersihkan"/>
		    </p>
		</div>
	</form>
		
</div>
