<?php
	include_once "config/koneksi.php";
 
	session_start();

	if(($_SESSION['id_akun']) and ($_SESSION['nomor_level']==2)){
?>


		<div class='col-md-12'>
		    <ol class='breadcrumb'>
		        <li><a href='index.php?mode=dashboard_member'>Dashboard Member</a></li>
		        <li class='active'>Checkout</li>
		    </ol>
		</div>
		<div class="col-md-3"></div>
		<div class="col-md-6">

<?php
			//$id_session = $_SESSION['id_akun'];
			$id_akun = $_SESSION['id_akun'];

		$cek_keranjang = mysql_query("select * from keranjang where id_session = '$id_akun'");
		$hitung_row = mysql_num_rows($cek_keranjang);
		


		if($hitung_row == 0){
			echo "
				<div class='alert alert-danger' role='alert'>
					Silakan lakukan pembelian terlebih dahulu!

				</div>
			";
		}
		else{

			

			function isi_keranjang(){
				$isi_keranjang = array();
				//$id_session = $_SESSION['id_akun'];
				$id_akun = $_SESSION['id_akun']; 
				$sql = mysql_query("SELECT * FROM keranjang WHERE id_session='$id_akun'");
				while ($data_keranjang=mysql_fetch_array($sql)) {
					$isi_keranjang[] = $data_keranjang;
				}
				return $isi_keranjang;
			}

			$query_generate_id = mysql_query("select * from detail_transaksi");
			$hitung_row = mysql_num_rows($query_generate_id);
			$id_transaksi = $hitung_row + 1;
			$isi_keranjang = isi_keranjang();
			$jumlah = count($isi_keranjang);

			for($i=0; $i<$jumlah; $i++){
				$query_buku = mysql_query("select * from buku where id_buku = {$isi_keranjang[$i]['id_buku']}");
				$data_buku = mysql_fetch_array($query_buku);
				$stok_buku = $data_buku['stok_buku'] - $isi_keranjang[$i]['jumlah_item'];
				mysql_query("insert into detail_transaksi values(null, '$id_transaksi', {$isi_keranjang[$i]['id_buku']}, {$isi_keranjang[$i]['jumlah_item']})") or die(mysql_error());
				mysql_query("update buku set stok_buku = $stok_buku where id_buku = {$isi_keranjang[$i]['id_buku']}") or die(mysql_error());
				mysql_query("delete from keranjang where id_keranjang = {$isi_keranjang[$i]['id_keranjang']}") or die(mysql_error());
			}


?>
		

<?php
	

		
		echo"<h4>Rincian Belanja</h4>
          Kode Referensi Anda: <b>".$id_transaksi."</b><br/>
          Nama: <b>$data_akun[nama]</b><br/>
          Alamat: <b>$data_akun[alamat]</b><br/><br/>
          <div class='table-responsive'>
          <table class='table'>
          <tr>
				<th>Nama Produk</th>
				<th>Kuantitas</th>
				<th>Harga</th>
				<th>Sub Total</th>
		  </tr>
		";

		$query_akun = mysql_query("select * from akun where id_akun = '$id_akun'") or die(mysql_error());
		$data_akun = mysql_fetch_array($query_akun);

		$sql=mysql_query("SELECT * FROM detail_transaksi, buku WHERE detail_transaksi.id_buku = buku.id_buku and id_transaksi='$id_transaksi'");
  
		while($data=mysql_fetch_array($sql)){
				$subtotal    = $data[harga_buku]* $data[jumlah_item];
				$total       = $total + $subtotal;
				echo"<tr><td>$data[judul_buku]</td>
					<td>$data[jumlah_item]</td>
					<td>Rp$data[harga_buku],00</td>
					<td>Rp$subtotal,00</td></tr>";
		}
		
		mysql_query("insert into transaksi values(null, current_timestamp, '$id_akun', '$total', 'Belum Lunas')") or die(mysql_error());
		
		echo"</table>
			</div>
			<h4>Total Belanja : Rp<b>$total,00</b></h4>
		";	

		echo "<div class='alert alert-success' role='alert'>
			Silakan lakukan pembayaran dengan nominal <i><b>$total</b></i> melalui rekening <i><b>003848329</b></i> atas nama Toko Buku Online. Barang akan dikirim kepada <i><b>$data_akun[nama]</b></i> dengan alamat <i><b>$data_akun[alamat]</b></i> setelah Anda melakukan pembayaran dan konfirmasi.
			</div>
		";

		

	}

?>
	</div>
	<div class="col-md-3"></div>
<?php	
			}


?>
