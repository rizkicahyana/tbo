<?php

	include "config/koneksi.php";
	session_start();
	error_reporting(0);

	$id_kategori = $_GET['id_kategori'];

	if($_SESSION['nomor_level']==1){
?>

		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Ubah Kategori
                    </li>
                </ol>
            </div>
        </div>

<?php		
		if(!isset($_POST['ubah']) && $id_kategori!=""){
			$query_kategori = mysql_query("select * from kategori where id_kategori='$id_kategori'");
			$data_kategori = mysql_fetch_array($query_kategori);
?>

			<form action="index.php?mode=ubah_kategori&aksi=simpan" method="POST">
				<table>
					<tr>
						<td>ID Kategori</td>
						<td>:</td>
						<td>
							<input type="text" name="id_kategori" class="form-control" value="<?php echo $data_kategori['id_kategori'];?>" readonly >
						</td>
					</tr>
					<tr>
						<td>Nama Kategori</td>
						<td>:</td>
						<td>
							<input type="text" name="nama_kategori" class="form-control" value="<?php echo $data_kategori['nama_kategori'];?>" />
						</td>
					</tr>
					<tr>
						<td>Deskripsi</td>
						<td>:</td>
						<td>
							<textarea name="deskripsi" rows="5" class="form-control" value="<?php echo $data_kategori['deskripsi'];?>"><?php echo $data_kategori['deskripsi'];?></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="right">
							<br/>
							<input type="submit" name="ubah" class="btn btn-primary" value="Ubah" onclick="return confirm('Apakah Anda yakin ingin mengubah data kategori dengan nama kategori <?php echo $data_kategori[nama_kategori];?>?')"/>
						</td>
					</tr>
				</table>
			</form>
		
	<?php
		}
		if(isset($_POST['ubah'])){

			$id_kategori = $_POST['id_kategori'];
			$nama_kategori = $_POST['nama_kategori'];
			$deskripsi = $_POST['deskripsi'];


			$query_ubah_kategori = mysql_query("update kategori set nama_kategori='$nama_kategori', deskripsi='$deskripsi' where id_kategori='$id_kategori'");

			if($query_ubah_kategori && mysql_affected_rows()>0){
				echo "
					<div class='alert alert-success' role='alert'>
					Data kategori telah berhasil diubah!<br/><br/>

					Detail data kategori setelah diubah:<br/>
					<table width='100%'>
						<tr valign='top'>
							<td>Nama Kategori</td>
							<td>:</td>
							<td>$nama_kategori</td>
						</tr>
						<tr valign='top'>
							<td>Deskripsi</td>
							<td>:</td>
							<td>$deskripsi</td>
						</tr>
					</table>
					</div>
				";
			}
			else{
				echo "
					<div class='alert alert-danger' role='alert'>
						Data kategori gagal diubah karena tidak ada nilai yang diubah!
					</div>
				";
			}
		}
	}
/* 	else{
		echo "Anda tidak dapat mengakses halaman ini!";
	} */


	?>
