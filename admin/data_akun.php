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
                    	Lihat Akun
                    </li>
                </ol>
            </div>
        </div>

<?php
		$limit = 5;

		$query = new CnnNav($limit, 'akun', '*', 'id_akun');

		$result = $query->getResult();

?>
		<div class="table-responsive">
		<table class="table">
			<tr bgcolor="#6f6f70" style="color:white;">
				<th>No.</th>
				<th>E-Mail</th>
				<th>Username</th>
				<th>Status Akun</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Nomor Telepon</th>
				<th>Aksi</th>
			</tr>

<?php
		$nomor = ($limit * $_GET['offset'])+1;
		//$query_akun = mysql_query("select * from akun");
		$data_akun = mysql_fetch_array($result);
		$count_data_akun = mysql_num_rows($result);

		if($count_data_akun==0){
			echo "
				<tr>
					<td colspan='8' align='center'><i>Belum ada data</i></td>
				</tr>
			";
		}
		else{
			while($data_akun){
?>
			<tr valign='top'>
				<td align='center'>
					<?php
						echo $nomor;
					?>
				</td>
				<td>
					<?php
						echo $data_akun['email'];
					?>
				</td>
				<td>
					<?php
						echo $data_akun['username'];
					?>
				</td>
				<td>
					<?php
						echo $data_akun['status_akun'];
					?>
				</td>
				<td>
					<?php
						echo $data_akun['nama'];
					?>
				</td>
				<td>
					<?php
						echo $data_akun['alamat'];
					?>
				</td>
				<td>
					<?php
						echo $data_akun['nomor_telepon'];
					?>
				</td>
				<td>
					<?php
						echo "
							<a href='index.php?mode=ubah_akun&id_akun=$data_akun[id_akun]' style='text-decoration:none'>Ubah</a> | <a href='index.php?mode=hapus_akun&id_akun=$data_akun[id_akun]' style='text-decoration:none' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data akun dengan username $data_akun[username] atas nama $data_akun[nama]?')\">Hapus</a>
						";
					?>
				</td>
			</tr>
<?php
				$nomor++;
				$data_akun = mysql_fetch_array($result);
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
