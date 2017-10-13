<?php

	if($_SESSION['nomor_level']==1){

		$limit = 5;

		$query = new CnnNav($limit, 'kategori', '*', 'id_kategori');

		$result = $query->getResult();

?>
		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Lihat Kategori
                    </li>
                </ol>
            </div>
        </div>

        <div class="table-responsive">
		<table class="table">
			<tr bgcolor="#6f6f70" style="color:white;">
				<th>No.</th>
				<th>Nama Kategori</th>
				<th>Deskripsi</th>
				<th>Aksi</th>
			</tr>

<?php
		$nomor = 1;
		//$query_kategori = mysql_query("select * from kategori");
		$data_kategori = mysql_fetch_array($result);
		$count_data_kategori = mysql_num_rows($result);

		$nomor = ($limit * $_GET['offset'])+1;

		if($count_data_kategori==0){
			echo "
				<tr>
					<td colspan='8' align='center'><i>Belum ada data</i></td>
				</tr>
			";
		}
		else{
			while($data_kategori){
?>
			<tr valign='top'>
				<td align="center">
					<?php
						echo $nomor;
					?>
				</td>
				<td>
					<?php
						echo $data_kategori['nama_kategori'];
					?>
				</td>
				<td>
					<?php
						echo $data_kategori['deskripsi'];
					?>
				</td>
				<td>
					<?php
						echo "
							<a href='index.php?mode=ubah_kategori&id_kategori=$data_kategori[id_kategori]' style='text-decoration:none'>Ubah</a> | <a href='index.php?mode=hapus_kategori&id_kategori=$data_kategori[id_kategori]' style='text-decoration:none' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data kategori dengan nama $data_kategori[nama_kategori]?')\">Hapus</a>
						";
					?>
				</td>
			</tr>
<?php
				$nomor++;
				$data_kategori = mysql_fetch_array($result);
			}
		}
?>

		</table>
		</div>

		<?php
			echo "<br/><center>";
			echo $query->printNav();
			echo "</center>";
		?>

<?php

	}
	else{
		//echo "Anda tidak dapat mengakses halaman ini!<br/><br/>";
		//header('location:../index.php');
	}

?>
