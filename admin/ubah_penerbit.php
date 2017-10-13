<?php

	include "config/koneksi.php";
	session_start();
	error_reporting(0);

	$id_penerbit = $_GET['id_penerbit'];

	if($_SESSION['nomor_level']==1){
		
?>

		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Ubah Penerbit
                    </li>
                </ol>
            </div>
        </div>

<?php
		if(!isset($_POST['ubah']) && $id_penerbit!=""){
			$query_penerbit = mysql_query("select * from penerbit where id_penerbit='$id_penerbit'");
			$data_penerbit = mysql_fetch_array($query_penerbit);
?>

			<form action="index.php?mode=ubah_penerbit&aksi=simpan" method="POST">
				<table>
					<tr valign='top'>
						<td>ID Penerbit</td>
						<td>:</td>
						<td>
							<input type="text" name="id_penerbit" class="form-control" value="<?php echo $data_penerbit['id_penerbit'];?>" readonly >
						</td>
					</tr>
					<tr valign='top'>
						<td>Nama penerbit</td>
						<td>:</td>
						<td>
							<input type="text" name="nama_penerbit" class="form-control" value="<?php echo $data_penerbit['nama_penerbit'];?>" />
						</td>
					</tr>
					<tr valign='top'>
						<td>Alamat</td>
						<td>:</td>
						<td>
							<textarea name="alamat" rows="5" class="form-control" value="<?php echo $data_penerbit['alamat'];?>"><?php echo $data_penerbit['alamat'];?></textarea>
						</td>
					</tr>
					<tr valign='top'>
						<td>E-Mail</td>
						<td>:</td>
						<td>
							<input type="email" name="email" class="form-control" value="<?php echo $data_penerbit['email'];?>" />
						</td>
					</tr>
					<tr valign='top'>
						<td>Website</td>
						<td>:</td>
						<td>
							<input type="text" name="website" class="form-control" value="<?php echo $data_penerbit['website'];?>" />
						</td>
					</tr>
					<tr valign='top'>
						<td>Nomor Telepon</td>
						<td>:</td>
						<td>
							<input type="text" name="nomor_telepon" class="form-control" value="<?php echo $data_penerbit['nomor_telepon'];?>" />
						</td>
					</tr>
					<tr>
						<td colspan="3" align="right">
							<br/>
							<input type="submit" name="ubah" class="btn btn-primary" value="Ubah" onclick="return confirm('Apakah Anda yakin ingin mengubah data penerbit dengan nama <?php echo $data_penerbit[nama_penerbit];?>?')"/>
						</td>
					</tr>
				</table>
			</form>
		
	<?php
		}
		if(isset($_POST['ubah'])){

			$id_penerbit = $_POST['id_penerbit'];
			$nama_penerbit = $_POST['nama_penerbit'];
			$alamat = $_POST['alamat'];
			$email = $_POST['email'];
			$website = $_POST['website'];
			$nomor_telepon = $_POST['nomor_telepon'];

			$query_ubah_penerbit = mysql_query("update penerbit set nama_penerbit='$nama_penerbit', alamat='$alamat', email='$email', website='$website', nomor_telepon='$nomor_telepon' where id_penerbit='$id_penerbit'");

			if($query_ubah_penerbit && mysql_affected_rows()>0){
				echo "
					<div class='alert alert-success' role='alert'>
					Data penerbit telah berhasil diubah!<br/><br/>

					Detail data penerbit setelah diubah:<br/>
					<table width='100%'>
						<tr valign='top'>
							<td>Nama Penerbit</td>
							<td>:</td>
							<td>$nama_penerbit</td>
						</tr>
						<tr valign='top'>
							<td>Alamat</td>
							<td>:</td>
							<td>$alamat</td>
						</tr>
						<tr valign='top'>
							<td>E-Mail</td>
							<td>:</td>
							<td>$email</td>
						</tr>
						<tr valign='top'>
							<td>Website</td>
							<td>:</td>
							<td>$website</td>
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
						Data penerbit gagal diubah karena tidak ada nilai yang diubah!
					</div>
				";
			}
		}
	}
/* 	else{
		echo "Anda tidak dapat mengakses halaman ini!";
	} */


	?>
