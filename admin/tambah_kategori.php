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
                    	Tambah Kategori
                    </li>
                </ol>
            </div>
        </div>

<?php		
		echo "	

			<form action='index.php?mode=tambah_kategori' method='POST'>
				<table>
					<tr valign='top'>
						<td>Nama Kategori</td>
						<td>:</td>
						<td>
							<input type='text' name='nama_kategori' class='form-control' autofocus required />
						</td>
					</tr>
					<tr valign='top'>
						<td>Deskripsi</td>
						<td>:</td>
						<td>
							<textarea name='deskripsi' class='form-control' rows='5' required></textarea>
						</td>
					</tr>
					<tr valign='top'>
						<td colspan='3' align='right'>
							<br/>
							<input type='submit' name='submit' value='Simpan' class='btn btn-primary' onclick=\"return confirm('Apakah Anda yakin ingin menyimpan data kategori ini?')\" />
							<input type='reset' name='reset' class='btn btn-reset' value='Bersihkan'>
						</td>
					</tr>
				</table>
			</form>

		";
	}

	if(isset($_POST['submit'])){
		$nama_kategori = $_POST['nama_kategori'];
		$deskripsi = $_POST['deskripsi'];

		$query_nama_kategori = mysql_query("select * from kategori where nama_kategori='$nama_kategori'");
		$count_nama_kategori = mysql_num_rows($query_nama_kategori);

		echo "<br/>";

		if($count_nama_kategori>0){
			echo "
				<div class='alert alert-danger' role='alert'>
					Nama kategori sudah terdaftar!
				</div>
			";
		}
		else{
			$query_tambah_kategori = mysql_query("insert into kategori values(null, '$nama_kategori', '$deskripsi')");

			if($query_tambah_kategori && mysql_affected_rows()>0){
				echo "
					<div class='alert alert-success' role='alert'>
						Data Kategori baru berhasil ditambahkan!
					</div>
				";
			}
			else{
				echo "
					<div class='alert alert-danger' role='alert'>
						Data Kategori buku gagal ditambahkan karena ".mysql_error()."
					</div>
				";
			}
		}

	}

?>
