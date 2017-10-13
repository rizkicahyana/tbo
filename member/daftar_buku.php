<?php
	include_once "config/koneksi.php";
	include_once "class/ClassPaging.php";

	session_start();

	if(($_SESSION['id_akun']) and ($_SESSION['nomor_level']==2)){

		$limit = 4;

		$query = new CnnNav($limit,'buku','*','id_buku');

		$result = $query->getResult();

		echo "
            <div class='row'>
			
        ";


        //$query_buku = mysql_query("select * from buku");
        $data_buku = mysql_fetch_array($result);

		//membuat penomoran posting
		$nomor = ($limit * $_GET['offset'])+1;

        while($data_buku){

            $query_kategori = mysql_query("select * from kategori where id_kategori = '$data_buku[id_kategori]'");
            $data_kategori = mysql_fetch_array($query_kategori);

            $query_penerbit = mysql_query("select * from penerbit where id_penerbit = '$data_buku[id_penerbit]'");
            $data_penerbit = mysql_fetch_array($query_penerbit);

            echo "
                <table>
                    <tr>
                        <td valign='middle' rowspan='4'>
							<img src='assets/".$data_buku['gambar_buku']."' width='100px' height='118px'/>
						</td>
                        <td>Judul Buku</td>
                        <td>:</td>
                        <td>$data_buku[judul_buku]</td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td>$data_kategori[nama_kategori]</td>
                    </tr>
                    <tr>
                        <td>Penerbit</td>
                        <td>:</td>
                        <td>$data_penerbit[nama_penerbit]</td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td>Rp$data_buku[harga_buku],00</td>
                    </tr>
                    <tr>
                        <br/>

                        <td colspan='3' >
                            <a href='index.php?mode=aksi_keranjang&id_buku=$data_buku[id_buku]'>+ Tambah ke Keranjang Belanja</a> | <a href='index.php?mode=detail_buku&id_buku=$data_buku[id_buku]'>Detail</a>
                        </td>
                    </tr>
					<tr>
				      <td height='25' colspan='3' align='center' valign='middle'>
					";

					echo "
				  	</td>
				    </tr>

                </table>
            ";
            echo "<br/>";
            $data_buku = mysql_fetch_array($result);
        }
		?>
			<?php
				 //Cetak paging
				echo "<center>";
				echo $query->printNav();
				echo "</center>";
			?>
		<?php

        echo "
            <br/><br/>
			</div>
		";
	}

?>
