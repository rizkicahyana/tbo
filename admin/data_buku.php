<?php


	if($_SESSION['nomor_level']==1){

		$limit = 5;

		$query = new CnnNav($limit, 'buku', '*', 'id_buku');

		$result = $query->getResult();

?>
		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Lihat Buku
                    </li>
                </ol>
            </div>
        </div>

        <div class="table-responsive">
		<table class="table">
			<tr bgcolor="#6f6f70" style="color:white;">
				<th>No.</th>
				<th>Kategori</th>
				<th>Penerbit</th>
				<th>Judul Buku</th>
				<th>Harga</th>
				<th>Deskripsi</th>
				<th>Aksi</th>
			</tr>

<?php
		$nomor = ($limit * $_GET['offset'])+1;
		//$query_buku = mysql_query("select * from buku");
		$data_buku = mysql_fetch_array($result);
		$count_data_buku = mysql_num_rows($result);

		if($count_data_buku==0){
			echo "
				<tr>
					<td colspan='7' align='center'><i>Belum ada data</i></td>
				</tr>
			";
		}
		else{
			while($data_buku){
?>
			<tr valign='top'>
				<td align='center'>
					<?php
						echo $nomor;
					?>
				</td>
				<td>
					<?php
						$query_kategori = mysql_query("select * from kategori where id_kategori='$data_buku[id_kategori]'");
						$data_kategori = mysql_fetch_array($query_kategori);
						echo $data_kategori['nama_kategori'];
					?>
				</td>
				<td>
					<?php
						$query_penerbit = mysql_query("select * from penerbit where id_penerbit='$data_buku[id_penerbit]'");
						$data_penerbit = mysql_fetch_array($query_penerbit);
						echo $data_penerbit['nama_penerbit'];
					?>
				</td>
				<td>
					<?php
						echo $data_buku['judul_buku'];
					?>
				</td>
				<td>
					<?php
						echo $data_buku['harga_buku'];
					?>
				</td>
				<td>
					<?php
						echo $data_buku['deskripsi_buku'];
					?>
				</td>
				<td>
					<?php
						echo "
							<a href='index.php?mode=ubah_buku&id_buku=$data_buku[id_buku]' style='text-decoration:none'>Ubah</a> | <a href='index.php?mode=hapus_buku&id_buku=$data_buku[id_buku]' style='text-decoration:none' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data buku dengan judul $data_buku[judul_buku]?')\">Hapus</a>
						";
					?>
				</td>
			</tr>
<?php
				$nomor++;
				$data_buku = mysql_fetch_array($result);
			}
		}
?>

		</table>
		</div>

		<?php
			 //Cetak paging
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
