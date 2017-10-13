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

		if($password==$ulang_password){
			$enkrip_password = md5($password);
			$query_daftar = mysql_query("insert into akun values(null, '$email', '$username', '$enkrip_password', '$nomor_level', '$status_akun', '$nama', '$alamat', '$nomor_telepon')");

			if($query_daftar && mysql_affected_rows()>0){
				echo "
					Registrasi Anda telah berhasil ditambahkan ke database.<br/>
				";
			}
			else{
				echo "Data registrasi Anda gagal ditambahkan ke database karena ".mysql_error();
			}
		}
		else{
			echo "Password dan Ulang Password Anda tidak sesuai.<br/>";
		}
	}
	else{
		$email = "";
		$username = "";
		$nama = "";
		$alamat = "";
		$nomor_telepon = "";
	}

?>

<div class='col-md-12'>
    <ol class='breadcrumb'>
        <li><a href='index.php?mode=dashboard_member'>Beranda</a></li>
        <li class='active'>Admin</li>
    </ol>
</div>
<div class="col-md-3"></div>
<div class="col-md-6">
<form action="index.php?mode=daftar_admin" method="POST">
	<table>
		<tr>
			<td>E-Mail</td>
			<td>:</td>
			<td>
				<input type="email" name="email" class="form-control" value="<?php echo $email;?>" autofocus required/>
			</td>
		</tr>
		<tr>
			<td>Username</td>
			<td>:</td>
			<td>
				<input type="text" name="username" class="form-control" value="<?php echo $username;?>" required/>
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
			<td>Ulang Password</td>
			<td>:</td>
			<td>
				<input type="password" name="ulang_password" class="form-control" required/>
			</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td>
				<input type="text" name="nama" class="form-control" value="<?php echo $nama;?>" required/>
			</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td>
				<textarea name="alamat" class="form-control" value="<?php echo $alamat;?>" required><?php echo $alamat;?></textarea>
			</td>
		</tr>
		<tr>
			<td>Nomor Telepon</td>
			<td>:</td>
			<td>
				<input type="text" name="nomor_telepon" class="form-control" value="<?php echo $nomor_telepon;?>" required/>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="right">
				<br/>
				<input type="hidden" name="nomor_level" value="1"/>
				<input type="hidden" name="status_akun" value="Aktif"/>
				<input type="submit" name="daftar" class="btn btn-primary" value="Daftar"/>
			</td>
		</tr>
	</table>
</form>
</div>
<div class="col-md-3"></div>