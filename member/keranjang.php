<?php
	include_once "config/koneksi.php";

	session_start();

	if(($_SESSION['id_akun']) and ($_SESSION['nomor_level']==2)){

		$id_akun = $_SESSION['id_akun'];
		//$id_session = $_SESSION['id_akun'];

		//echo $id_akun;

		$query_temp_keranjang = mysql_query("select * from keranjang where id_session='$id_akun' group by id_buku");
		$hitung_row_keranjang = mysql_num_rows($query_temp_keranjang);
		$hitung_buku = mysql_num_rows($query_temp_keranjang);

		$query_hitung_buku = mysql_query("select * from keranjang where id_session='$id_akun' group by id_buku");
		$data_buku = mysql_fetch_array($query_hitung_buku);
		$hitung_banyak_buku = 0;
		

		while($data_buku){
			$hitung_banyak_buku = $hitung_banyak_buku + $data_buku['jumlah_item'];
			$data_buku = mysql_fetch_array($query_hitung_buku);
		}		

		$query_session = mysql_query("select * from keranjang where id_session = '$id_akun'");
		$data_session = mysql_fetch_array($query_session);
		$hitung_session = mysql_num_rows($query_session);

			echo "
				<div class='col-md-12'>
				    <ol class='breadcrumb'>
				        <li><a href='index.php?mode=dashboard_member'>Dashboard Member</a></li>
				        <li class='active'>Lihat Katalog</li>
				    </ol>
				</div>

				<div class='col-md-8'>
				<h4>Keranjang Belanja 
					<i><h5>($hitung_buku buku dipilih dengan jumlah $hitung_banyak_buku buah)</h5></i>
				</h4>
			";

		

		if($_SESSION['id_akun'] == $data_session['id_session']){

		if($hitung_row_keranjang == 0){
			echo "<br/>";
		}
		else{
			echo"
				<div class='table-responsive'> 
				<table class='table'>
		          <tr>
		          		<th>Judul Buku</th>
						<th>Kuantitas</th>
						<th>Harga</th>
						<th>Sub Total</th>
						<th>Aksi</th>
				  </tr>
				  ";

		$sql = mysql_query("SELECT * FROM keranjang, buku WHERE id_session='$id_akun' AND keranjang.id_buku=buku.id_buku");

		$i = 0;
		while($data_keranjang = mysql_fetch_array($sql)){
				$subtotal_harga = $data_keranjang['harga_buku'] * $data_keranjang['jumlah_item'];
				$total       = $total + $subtotal_harga;

				echo "
				<form action='index.php?mode=aksi_keranjang&id_buku=$data_keranjang[id_buku]' method='POST'>
				
				<tr><td>$data_keranjang[judul_buku]</td>
					<td align='center'>
						<input type='hidden' name='id_keranjang[$i]' value='{$data_keranjang[id_keranjang]}'>
						<input type='hidden' name='id_buku[$i]' value='{$data_keranjang[id_buku]}'>
						<input type='number' name='jumlah_item[$i]' value='{$data_keranjang[jumlah_item]}' class='form-control'>
					</td>
					<td align='right'>Rp$data_keranjang[harga_buku],00</td>
					<td align='right'>
						<input type='hidden' name='subtotal_harga' value='{$data_keranjang[subtotal_harga]}'>Rp$subtotal_harga,00
					</td>
					<td><a href='index.php?mode=aksi_keranjang&aksi=hapus&id_keranjang={$data_keranjang[id_keranjang]}'>Hapus</a></td>
				";

				//

			++$i;
		}


				echo "
						</tr>
					</table>
					</div>
					<br/>
					<h4 align='right'>Total: <b>Rp$total,00</b></h4>
					<p align='right'><input type='submit' name='ubah' class='btn btn-secondary' value='Perbaharui Keranjang'> 
					<a href='index.php?mode=checkout' class='btn btn-primary'>Checkout >></a></p>
					</form>
				";



		echo "
		
		";

		echo "
			
		";
		}
		}		
	}
	else{
		echo "
			<div class='alert alert-danger' role='alert'>
				Anda tidak dapat mengakses halaman ini!<br/>	
				<script>window.location='index.php'</script>
			</div>
		";
	}



?>
</div>
			<div class='col-md-4'></div>