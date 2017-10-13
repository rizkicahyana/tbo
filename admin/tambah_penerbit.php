<?php

	if($_SESSION['nomor_level']==1){
		
?>

		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Tambah Penerbit
                    </li>
                </ol>
            </div>
        </div>

<?php
		echo "

			<form action='index.php?mode=tambah_penerbit' method='POST'>
				<table>
					<tr valign='top'>
						<td>Nama Penerbit</td>
						<td>:</td>
						<td>
							<input type='text' name='nama_penerbit' class='form-control' autofocus required />
						</td>
					</tr>
					<tr valign='top'>
						<td>Alamat</td>
						<td>:</td>
						<td>
							<textarea name='alamat' class='form-control' required></textarea>
						</td>
					</tr>
					<tr valign='top'>
						<td>E-Mail</td>
						<td>:</td>
						<td>
							<input type='email' name='email' class='form-control' required />
						</td>
					</tr>
					<tr valign='top'>
						<td>Website</td>
						<td>:</td>
						<td>
							<input type='text' name='website' class='form-control' required />
						</td>
					</tr>
					<tr valign='top'>
						<td>Nomor Telepon</td>
						<td>:</td>
						<td>
							<input type='text' name='nomor_telepon' class='form-control' required />
						</td>
					</tr>
					<tr valign='top'>
						<td colspan='3' align='right'>
							<br/>
							<input type='submit' name='submit' value='Simpan' class='btn btn-primary' onclick=\"return confirm('Apakah Anda yakin ingin menyimpan data penerbit ini?')\" />
							<input type='reset' name='reset' class='btn btn-reset' value='Bersihkan'>
						</td>
					</tr>
				</table>
			</form>

		";
	}

	if(isset($_POST['submit'])){
		$nama_penerbit = $_POST['nama_penerbit'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];
		$website = $_POST['website'];
		$nomor_telepon = $_POST['nomor_telepon'];

		$query_nama_penerbit = mysql_query("select * from penerbit where nama_penerbit = '$nama_penerbit'");
		$count_nama_penerbit = mysql_num_rows($query_nama_penerbit);

		$query_email = mysql_query("select * from penerbit where email = '$email'");
		$count_email = mysql_num_rows($query_email);

		$query_website = mysql_query("select * from penerbit where website = '$website'");
		$count_website = mysql_num_rows($query_website);

		$query_nomor_telepon = mysql_query("select * from penerbit where nomor_telepon = '$nomor_telepon'");
		$count_nomor_telepon = mysql_num_rows($query_nomor_telepon);

		echo "<br/>";

		if($count_nama_penerbit>0){
			echo "
				<div class='alert alert-danger' role='alert'>
					Nama penerbit sudah terdaftar!
				</div>
			";
		}
		if($count_email>0){
			echo "
				<div class='alert alert-danger' role='alert'>
					E-Mail sudah terdaftar!
				</div>
			";
		}
		if($count_website>0){
			echo "
				<div class='alert alert-danger' role='alert'>
					URL Website sudah terdaftar!
				</div>
			";
		}
		if($count_nomor_telepon>0){
			echo "
				<div class='alert alert-danger' role='alert'>
					Nomor Telepon sudah terdaftar!
				</div>
			";
		}
		else{
			if($count_nama_penerbit==0 && $count_email==0 && $count_website==0 && $count_nomor_telepon==0){
				$query_tambah_penerbit = mysql_query("insert into penerbit values(null, '$nama_penerbit', '$alamat', '$email', '$website', '$nomor_telepon')");

				if($query_tambah_penerbit && mysql_affected_rows()>0){
					echo "
						<div class='alert alert-success' role='alert'>
							Data Penerbit baru berhasil ditambahkan!
						</div>
					";
				}
				else{
					echo "
						<div class='alert alert-danger' role='alert'>
							Data Penerbit buku gagal ditambahkan karena ".mysql_error()."
						</div>
					";
				}
			}
		}


	}

?>
