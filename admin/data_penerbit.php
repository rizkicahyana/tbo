<?php

	if($_SESSION['nomor_level']==1){

		$limit = 5;

		$query = new CnnNav($limit, 'penerbit', '*', 'id_penerbit');

		$result = $query->getResult();

?>

		<div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php?mode=dashboard_admin">Dashboard</a>
                    </li>
                    <li class="active">
                    	Lihat Penerbit
                    </li>
                </ol>
            </div>
        </div>
		
		<div class="table-responsive">
		<table class="table">
			<tr bgcolor="#6f6f70" style="color:white;">
				<th>No.</th>
				<th>Nama Penerbit</th>
				<th>Alamat</th>
				<th>E-Mail</th>
				<th>Website</th>
				<th>Nomor Telepon</th>
				<th>Aksi</th>
			</tr>

<?php
		$nomor = ($limit * $_GET['offset'])+1;
		//$query_penerbit = mysql_query("select * from penerbit");
		$data_penerbit = mysql_fetch_array($result);
		$count_data_penerbit = mysql_num_rows($result);

		if($count_data_penerbit==0){
			echo "
				<tr>
					<td colspan='7' align='center'><i>Belum ada data</i></td>
				</tr>
			";
		}
		else{
			while($data_penerbit){
?>
			<tr valign='top'>
				<td align='center'>
					<?php
						echo $nomor;
					?>
				</td>
				<td>
					<?php
						echo $data_penerbit['nama_penerbit'];
					?>
				</td>
				<td>
					<?php
						echo $data_penerbit['alamat'];
					?>
				</td>
				<td>
					<?php
						echo $data_penerbit['email'];
					?>
				</td>
				<td>
					<?php
						echo $data_penerbit['website'];
					?>
				</td>
				<td>
					<?php
						echo $data_penerbit['nomor_telepon'];
					?>
				</td>
				<td>
					<?php
						echo "
							<a href='index.php?mode=ubah_penerbit&id_penerbit=$data_penerbit[id_penerbit]' style='text-decoration:none'>Ubah</a> | <a href='index.php?mode=hapus_penerbit&id_penerbit=$data_penerbit[id_penerbit]' style='text-decoration:none' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data penerbit dengan nama $data_penerbit[nama_penerbit]?')\">Hapus</a>
						";
					?>
				</td>
			</tr>
			
<?php
				$nomor++;
				$data_penerbit = mysql_fetch_array($result);
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
