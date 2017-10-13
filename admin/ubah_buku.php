<?php

	include "config/koneksi.php";
	session_start();
	error_reporting(0);

	$id_buku = $_GET['id_buku'];

	if($_SESSION['nomor_level']==1){
?>

		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Ubah Buku
                    </li>
                </ol>
            </div>
        </div>

<?php		
		if(!isset($_POST['ubah']) && $id_buku!=""){
			$query_buku = mysql_query("select * from buku where id_buku='$id_buku'");
			$data_buku = mysql_fetch_array($query_buku);
?>

			<form action="index.php?mode=ubah_buku&aksi=simpan" method="POST">
				<table>
					<tr valign='top'>
						<td>ID Buku</td>
						<td>:</td>
						<td>
							<input type="text" name="id_buku" class="form-control" value="<?php echo $data_buku['id_buku'];?>" readonly >
						</td>
					</tr>

					<tr valign='top'>
						<td>Pilih Kategori</td>
						<td>:</td>
						<td>
							<?php
								$query_kategori = mysql_query("select * from kategori");
								$data_kategori = mysql_fetch_array($query_kategori);

								echo "<select name='id_kategori' class='form-control' required>";
									while($data_kategori){
										echo "<option value='$data_kategori[id_kategori]'";
											if($data_kategori['id_kategori'] === $data_buku['id_kategori']){
												echo "selected='selected'";
											}
										echo ">$data_kategori[nama_kategori]</option>";
										$data_kategori = mysql_fetch_array($query_kategori);
									}
								echo "</select>";
							?>
						</td>
					</tr>

					<tr valign='top'>
						<td>Pilih Penerbit</td>
						<td>:</td>
						<td>
							<?php
								$query_penerbit = mysql_query("select * from penerbit");
								$data_penerbit = mysql_fetch_array($query_penerbit);

								echo "<select name='id_penerbit' class='form-control' required>";
									while($data_penerbit){
										echo "<option value='$data_penerbit[id_penerbit]'";
											if($data_penerbit['id_penerbit'] === $data_buku['id_penerbit']){
												echo "selected='selected'";
											}
										echo ">$data_penerbit[nama_penerbit]</option>";
										$data_penerbit = mysql_fetch_array($query_penerbit);
									}
								echo "</select>";
							?>
						</td>
					</tr>

					<tr valign='top'>
						<td>Judul Buku</td>
						<td>:</td>
						<td>
							<input type="text" name="judul_buku" class='form-control' value="<?php echo $data_buku['judul_buku'];?>" />
						</td>
					</tr>
					<tr valign='top'>
						<td>Nomor ISBN</td>
						<td>:</td>
						<td>
							<input type="text" name="nomor_isbn" class='form-control' value="<?php echo $data_buku['nomor_isbn'];?>" />
						</td>
					</tr>

					<tr valign='top'>
						<td>Deskripsi</td>
						<td>:</td>
						<td>
							<textarea name="deskripsi_buku" rows="5" class='form-control' value="<?php echo $data_buku['deskripsi_buku'];?>"><?php echo $data_buku['deskripsi_buku'];?></textarea>
						</td>
					</tr>
					<tr valign='top'>
						<td>Harga</td>
						<td>:</td>
						<td>
							<input type="text" name="harga_buku" class='form-control' value="<?php echo $data_buku['harga_buku'];?>" />
						</td>
					</tr>
					<tr valign='top'>
						<td>Penulis</td>
						<td>:</td>
						<td>
							<input type="text" name="penulis_buku" class='form-control' value="<?php echo $data_buku['penulis_buku'];?>" />
						</td>
					</tr>
					<tr valign='top'>
						<td>Jumlah Halaman</td>
						<td>:</td>
						<td>
							<input type="text" name="jumlah_halaman_buku" class='form-control' value="<?php echo $data_buku['jumlah_halaman_buku'];?>" />
						</td>
					</tr>
					<tr valign='top'>
						<td>Tahun Terbit</td>
						<td>:</td>
						<td>
							<input type="text" name="tahun_terbit_buku" class='form-control' value="<?php echo $data_buku['tahun_terbit_buku'];?>" />
						</td>
					</tr>
					<tr valign='top'>
						<td>Stok</td>
						<td>:</td>
						<td>
							<input type="text" name="stok_buku" class='form-control' value="<?php echo $data_buku['stok_buku'];?>" />
						</td>
					</tr>
					<tr>
						<td colspan="3" align="right">
							<br/>
							<input type="submit" name="ubah" class="btn btn-primary" value="Ubah" onclick="return confirm('Apakah Anda yakin ingin mengubah data buku dengan judul <?php echo $data_buku[judul_buku];?>?')"/>
						</td>
					</tr>
				</table>
			</form>
		
	<?php
		}
		if(isset($_POST['ubah'])){
			$id_buku = $_POST['id_buku'];
			$id_kategori = $_POST['id_kategori'];
			$id_penerbit = $_POST['id_penerbit'];
			$judul_buku = $_POST['judul_buku'];
			$nomor_isbn = $_POST['nomor_isbn'];
			$deskripsi_buku = $_POST['deskripsi_buku'];
			$harga_buku = $_POST['harga_buku'];
			$penulis_buku = $_POST['penulis_buku'];
			$jumlah_halaman_buku = $_POST['jumlah_halaman_buku'];
			$tahun_terbit_buku = $_POST['tahun_terbit_buku'];
			$stok_buku = $_POST['stok_buku'];

			$query_kategori = mysql_query("select * from kategori where id_kategori='$id_kategori'");
			$data_kategori = mysql_fetch_array($query_kategori);

			$query_penerbit = mysql_query("select * from penerbit where id_penerbit='$id_penerbit'");
			$data_penerbit = mysql_fetch_array($query_penerbit);

			$query_ubah_buku = mysql_query("update buku set id_kategori='$id_kategori', id_penerbit='$id_penerbit', judul_buku='$judul_buku', nomor_isbn='$nomor_isbn', deskripsi_buku='$deskripsi_buku', harga_buku='$harga_buku', penulis_buku='$penulis_buku', jumlah_halaman_buku='$jumlah_halaman_buku', tahun_terbit_buku='$tahun_terbit_buku', stok_buku='$stok_buku' where id_buku='$id_buku'");

			if($query_ubah_buku && mysql_affected_rows()>0){
				echo "
					<div class='alert alert-success' role='alert'>
					Data buku telah berhasil diubah!<br/><br/>

					Detail data buku setelah diubah:<br/>
					<table width='100%'>
						<tr valign='top'>
							<td>Judul Buku</td>
							<td>:</td>
							<td>$judul_buku</td>
						</tr>
						<tr valign='top'>
							<td>Kategori</td>
							<td>:</td>
							<td>$data_kategori[nama_kategori]</td>
						</tr>
						<tr valign='top'>
							<td>Penerbit</td>
							<td>:</td>
							<td>$data_penerbit[nama_penerbit]</td>
						</tr>
						<tr valign='top'>
							<td>Nomor ISBN</td>
							<td>:</td>
							<td>$nomor_isbn</td>
						</tr>
						<tr valign='top'>
							<td>Deskripsi</td>
							<td>:</td>
							<td>$deskripsi_buku</td>
						</tr>
						<tr valign='top'>
							<td>Harga</td>
							<td>:</td>
							<td>$harga_buku</td>
						</tr>
						<tr valign='top'>
							<td>Penulis</td>
							<td>:</td>
							<td>$penulis_buku</td>
						</tr>
						<tr valign='top'>
							<td>Jumlah Halaman</td>
							<td>:</td>
							<td>$jumlah_halaman_buku</td>
						</tr>
						<tr valign='top'>
							<td>Tahun Terbit</td>
							<td>:</td>
							<td>$tahun_terbit_buku</td>
						</tr>
						<tr valign='top'>
							<td>Stok</td>
							<td>:</td>
							<td>$stok_buku</td>
						</tr>
					</table>
					</div>
				";
			}
			else{
				echo "
					<div class='alert alert-danger' role='alert'>
						Data buku gagal diubah karena tidak ada nilai yang diubah!
					</div>
				";
			}
		}
	}
/* 	else{
		echo "Anda tidak dapat mengakses halaman ini!";
	} */


	?>
