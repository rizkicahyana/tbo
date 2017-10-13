<?php
	//session_start();

	if($_SESSION['nomor_level']==2){
?>

	<div class='col-md-12'>
	    <ol class='breadcrumb'>
	        <li><a href='index.php?mode=dashboard_member'>Dashboard Member</a></li>
	        <li class='active'>Lihat Akun</li>
	    </ol>
	</div>

	<div class="col-md-4"></div>
	<div class="col-md-4">

<?php	
	$query_akun = mysql_query("select * from akun where id_akun='$id_akun'");
	$data_akun = mysql_fetch_array($query_akun);

	echo "


		<table>
			<tr valign='top'>
				<td>Nama</td>
				<td>:</td>
				<td>$data_akun[nama]</td>
			</tr>
			<tr valign='top'>
				<td>Alamat</td>
				<td>:</td>
				<td>$data_akun[alamat]</td>
			</tr>
			<tr valign='top'>
				<td>Nomor Telepon</td>
				<td>:</td>
				<td>$data_akun[nomor_telepon]</td>
			</tr>
			<tr valign='top'>
				<td>E-Mail</td>
				<td>:</td>
				<td>$data_akun[email]</td>
			</tr>
			<tr valign='top'>
				<td>Username</td>
				<td>:</td>
				<td>$data_akun[username]</td>
			</tr>
			<tr valign='top'>
				<td>Password</td>
				<td>:</td>
				<td>
					<input type='password' value='$data_akun[password]' class='form-control' readonly/>
				</td>
			</tr>
		</table>
	";
	}


?>

</div>
<div class="col-md-4"></div>