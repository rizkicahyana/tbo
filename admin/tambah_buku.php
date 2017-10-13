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
                    	Tambah Buku
                    </li>
                </ol>
            </div>
        </div>

<?php
		echo "
		

			<form action='index.php?mode=tambah_buku' method='POST' enctype='multipart/form-data'>
				<table>

			";
			?>
					<tr valign='top'>
						<td>Pilih Kategori</td>
						<td>:</td>
						<td>
							<?php
								$query_kategori = mysql_query("select * from kategori");
								$data_kategori = mysql_fetch_array($query_kategori);
								echo "<select name='id_kategori' class='form-control' autofocus required>";
									echo "<option value='' disabled selected>-Pilih kategori-</option>";
									while($data_kategori){
										echo "<option value='$data_kategori[id_kategori]'>$data_kategori[nama_kategori]</option>";
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
									echo "<option value='' disabled selected>-Pilih Penerbit-</option>";
									while($data_penerbit){
										echo "<option value='$data_penerbit[id_penerbit]'>$data_penerbit[nama_penerbit]</option>";
										$data_penerbit = mysql_fetch_array($query_penerbit);
									}
								echo "</select>";
							?>
						</td>
					</tr>

			<?php
				echo "
					<tr valign='top'>
						<td>Judul Buku</td>
						<td>:</td>
						<td>
							<input type='text' name='judul_buku' class='form-control' required />
						</td>
					</tr>

					<tr valign='top'>
						<td>Nomor ISBN</td>
						<td>:</td>
						<td>
							<input type='text' name='nomor_isbn' class='form-control' required />
						</td>
					</tr>

					<tr valign='top'>
						<td>Deskripsi Buku</td>
						<td>:</td>
						<td>
							<textarea name='deskripsi_buku' class='form-control' required></textarea>
						</td>
					</tr>

					<tr valign='top'>
						<td>Harga Buku</td>
						<td>:</td>
						<td>
							<input type='number' name='harga_buku' class='form-control' required />
						</td>
					</tr>

					<tr valign='top'>
						<td>Penulis Buku</td>
						<td>:</td>
						<td>
							<input type='text' name='penulis_buku' class='form-control' required />
						</td>
					</tr>

					<tr valign='top'>
						<td>Jumlah Halaman</td>
						<td>:</td>
						<td>
							<input type='number' name='jumlah_halaman_buku' class='form-control' required />
						</td>
					</tr>

					<tr valign='top'>
						<td>Tahun Terbit</td>
						<td>:</td>
						<td>
							<input type='text' name='tahun_terbit_buku' class='form-control' required />
						</td>
					</tr>

					<tr valign='top'>
						<td>Sampul Buku</td>
						<td>:</td>
						<td>
							<input type='file' name='gambar_buku' class='form-control' required />
						</td>
					</tr>

					<tr valign='top'>
						<td>Stok</td>
						<td>:</td>
						<td>
							<input type='number' name='stok_buku' class='form-control' required />
						</td>
					</tr>

					<tr>
						<td colspan='3' align='right'>
							<br/>
							<input type='submit' name='submit' value='Simpan' class='btn btn-primary' onclick=\"return confirm('Apakah Anda yakin ingin menyimpan data buku ini?')\" />
							<input type='reset' name='reset' class='btn btn-reset' value='Bersihkan'>
						</td>
					</tr>
				</table>
			</form>

		";
	}

	if(isset($_POST['submit'])){
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
		//$gambar_buku = $_POST['gambar_buku'];

		// Cek apakah inputan gambar kosong atau tidak
        if(!empty($_FILES["gambar_buku"]["tmp_name"])){
            // Folder yang dituju
            $folder = "../assets/images";
            // Nama file
            $nama = $_FILES["gambar_buku"]["name"];
            // Ukuran file
            $ukuran_file = $_FILES["gambar_buku"]["size"];
            // Temporary pada file
            $tmp = $_FILES["gambar_buku"]["tmp_name"];
            // Tujuan
            $tujuan = $folder."/".$nama;
            // Ekstensi file
            $ekstensi_file = $_FILES["gambar_buku"]["type"];
            //echo $nama."<br/>".$ukuran_file."<br/>".$ekstensi_file."<br/>.$tujuan";

            //Ukuran file yang diperbolehkan ( 1 Mb )
            $ukuran = 1000000;

            $query_judul_buku = mysql_query("select * from buku where judul_buku='$judul_buku'");
			$count_judul_buku = mysql_num_rows($query_judul_buku);

			echo "<br/>";

			if($count_judul_buku>0){
				echo "
					<div class='alert alert-danger' role='alert'>
						Judul buku sudah terdaftar!
					</div>
				";
			}
			else{

				if(!filter_var($jumlah_halaman_buku, FILTER_VALIDATE_INT)){
                    echo "
                        <div class='alert alert-danger' role='alert'>
                            jumlah halaman buku tidak sesuai dengan format!
                        </div>
                    ";
                    }
                    else if($jumlah_halaman_buku<0){
                        echo "
                            <div class='alert alert-danger' role='alert'>
                                jumlah halaman buku tidak boleh kurang dari atau sama dengan 0
                            </div>
                        ";
                    }
                    else if($jumlah_halaman_buku==0){
                        echo "
                            <div class='alert alert-danger' role='alert'>
                                jumlah halaman buku tidak boleh sama dengan 0
                            </div>  
                        ";
                    }
                    else if(!filter_var($tahun_terbit_buku, FILTER_VALIDATE_INT)){
                    echo "
                        <div class='alert alert-danger' role='alert'>
                            Tahun terbit buku tidak sesuai dengan format!
                        </div>
                    ";
                    }
                    else if($tahun_terbit_buku<0){
                        echo "
                            <div class='alert alert-danger' role='alert'>
                                Tahun terbit buku tidak boleh kurang dari atau sama dengan 0
                            </div>
                        ";
                    }
                    else if($tahun_terbit_buku==0){
                        echo "
                            <div class='alert alert-danger' role='alert'>
                                tahun_terbit_buku tidak boleh sama dengan 0
                            </div>  
                        ";
                    }
            		else if(!filter_var($harga_buku, FILTER_VALIDATE_INT)){
                    echo "
                        <div class='alert alert-danger' role='alert'>
                            Harga buku tidak sesuai dengan format!
                        </div>
                    ";
                    }
                    else if($harga_buku<0){
                        echo "
                            <div class='alert alert-danger' role='alert'>
                                Harga buku tidak boleh kurang dari atau sama dengan 0
                            </div>
                        ";
                    }
                    else if($harga_buku==0){
                        echo "
                            <div class='alert alert-danger' role='alert'>
                                Harga buku tidak boleh sama dengan 0
                            </div>  
                        ";
                    }

            		else if(!filter_var($stok_buku, FILTER_VALIDATE_INT)){
                    echo "
                        <div class='alert alert-danger' role='alert'>
                            Stok buku tidak sesuai dengan format!
                        </div>
                    ";
                    }
                    else if($stok_buku<0){
                        echo "
                            <div class='alert alert-danger' role='alert'>
                                Stok buku tidak boleh kurang dari atau sama dengan 0
                            </div>
                        ";
                    }
                    else if($stok_buku==0){
                        echo "
                            <div class='alert alert-danger' role='alert'>
                                Stok buku tidak boleh sama dengan 0
                            </div>  
                        ";
                    }
                    else{

                    	$query_judul_buku = mysql_query("select * from buku where judul_buku='$judul_buku'");
						$count_judul_buku = mysql_num_rows($query_judul_buku);

						echo "<br/>";

						if($count_nama_kategori>0){
							echo "
								<div class='alert alert-danger' role='alert'>
									Nama kategori sudah terdaftar!
								</div>
							";
						}
						else{

							// Cek ukuran file
				            if($ukuran_file <= $ukuran){
				                // Cek ekstensi pada file, misalnya hanya diperbolehkan untuk ekstensi gambar
				                if($ekstensi_file == "image/png" or $ekstensi_file == "image/jpg" or $ekstensi_file == "image/jpeg" or $ekstensi_file == "image/gif"){
				                    // Proses upload gambar
				                    //if(move_uploaded_file($tmp, $tujuan)){
									move_uploaded_file($tmp, $tujuan);
									$query_tambah_buku = mysql_query("insert into buku values(null, '$id_kategori', '$id_penerbit', '$judul_buku', '$nomor_isbn', '$deskripsi_buku', '$harga_buku', '$penulis_buku', '$jumlah_halaman_buku', '$tahun_terbit_buku', '$stok_buku', '$nama', current_timestamp)");

									echo "<br/>";

									if($query_tambah_buku && mysql_affected_rows()>0){
										echo "
											<div class='alert alert-success' role='alert'>
												Data buku baru berhasil ditambahkan!
											</div>
											";
									}
									else{
										echo "
											<div class='alert alert-danger' role='alert'>
												Data buku buku gagal ditambahkan karena ".mysql_error()."
											</div>
										";
									}
									//mysql_query("insert into simpan values(null, '$nama', '".$_POST['keterangan']."')");
			                        //echo "Upload sukses.";
			                    //}
			                    //else{
			                    //    echo "Upload file gagal";
			                    //}
				                }
				                else{
				                    echo "
				                    	<div class='alert alert-danger' role='alert'>
				                    		Ekstensi file yang diperbolehkan adalah png, jpg, jpeg, dan gif!
				                    	</div>
				                    ";
				                }
				            }
				            else{
				                echo "
				                	<div class='alert alert-danger' role='alert'>
					                	Ukuran file tidak bisa lebih dari 1 Mb!
					                </div>
					            ";
				            }


						}

            			        	
                    }

			}

             		

            
        }
        else{
            echo "
            	<div class='alert alert-danger' role='alert'>
            		Gambar kosong, harap pilih file terlebih dahulu!
            	</div>
            ";
        }


	}

?>
