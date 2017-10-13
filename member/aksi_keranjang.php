<?php
	include_once "config/koneksi.php";
	session_start();

	if(($_SESSION['id_akun']) and ($_SESSION['nomor_level']==2)){

        $query_buku = mysql_query("select * from buku where id_buku='$id_buku'");
        $data_buku = mysql_fetch_array($query_buku);
        $id_akun = $_SESSION['id_akun'];
        
        //$id_session = $_SESSION['id_akun'];

       


        //update keranjang
        if(isset($_POST['ubah'])){
            $size = count($_POST['id_keranjang']);



            $i = 0;
            while($i < $size){
                $id_keranjang = $_POST['id_keranjang'][$i];
                $id_buku = $_POST['id_buku'][$i];
                $jumlah_item = $_POST['jumlah_item'][$i];
                

                $query_buku = mysql_query("select * from buku where id_buku = '$id_buku'");
                $data_buku = mysql_fetch_array($query_buku);
                $stok_sisa = $data_buku['stok_buku'] - $jumlah_item;
                
                if($stok_sisa >= 0){
                    if(!filter_var($jumlah_item, FILTER_VALIDATE_INT)){
                    echo "
                        <div class='alert alert-danger' role='alert'>
                            Jumlah item tidak sesuai dengan format!
                        </div>
                    ";
                    }
                    else if($jumlah_item<0){
                        echo "
                            <div class='alert alert-danger' role='alert'>
                                Jumlah item tidak boleh kurang dari atau sama dengan 0
                            </div>
                        ";
                    }
                    else if($jumlah_item==0){
                        echo "
                            <div class='alert alert-danger' role='alert'>
                                Jumlah item tidak boleh sama dengan 0
                            </div>  
                        ";
                    }
                    else{

                        $query_buku_update = mysql_query("select * from buku where id_buku='$id_buku'");
                        $data_buku_update = mysql_fetch_array($query_buku_update);
                        $subtotal_harga = $jumlah_item * $data_buku_update['harga_buku'];
                        
                        mysql_query("update keranjang set jumlah_item = '$jumlah_item', subtotal_harga = '$subtotal_harga' where id_buku='$id_buku' and id_session='$id_akun'") or die(mysql_error());
                    }
                }
                else{
                    echo "
                        <div class='alert alert-danger' role='danger'>
                            Stok buku tidak tersedia!
                        </div>
                    ";
                }
                
                $i++;
            
            }

        }
        //hapus keranjang
        else if(isset($_GET['aksi'])=="hapus"){
            $id_keranjang = $_GET['id_keranjang'];
            mysql_query("delete from keranjang where id_keranjang = '$id_keranjang'");
        }
        //tambah data keranjang
        else{
            $id_buku = $_GET['id_buku'];
            $query_hitung_buku_keranjang_by_id = mysql_query("select * from keranjang where id_buku = '$id_buku' and id_session='$id_akun'");
            $data_buku_keranjang = mysql_fetch_array($query_hitung_buku_keranjang_by_id);
            $hitung_buku_keranjang = mysql_num_rows($query_hitung_buku_keranjang_by_id);
            $jumlah_item = 1;
            $query_buku_tambah = mysql_query("select * from buku where id_buku='$id_buku'");
            $data_buku_tambah = mysql_fetch_array($query_buku_tambah);
            $subtotal_harga = $jumlah_item * $data_buku_tambah['harga_buku'];
                  
            if($hitung_buku_keranjang > 0){
                $jumlah_item = $data_buku_keranjang['jumlah_item'] + 1;
                $subtotal_harga = $jumlah_item * $data_buku_tambah['harga_buku'];
                mysql_query("update keranjang set jumlah_item = '$jumlah_item', subtotal_harga = '$subtotal_harga' where id_buku='$id_buku' and id_session='$id_akun'") or die(mysql_error());                
            }
            else{
                //$id_buku = $_GET['id_buku'];
                $query_buku_insert = mysql_query("select * from buku where id_buku='$id_buku'");
                $data_buku_insert = mysql_fetch_array($query_buku_insert);
                $mode = $_GET['mode'];
                $aksi = $_GET['aksi'];
                //$jumlah_item = 1;
                //$subtotal_harga = $jumlah_item * $data_buku_insert['harga_buku'];
                mysql_query("insert into keranjang values(null, '$id_buku', '$id_akun', '$jumlah_item', '$subtotal_harga')") or die(mysql_error());    
            }
            
        }

        //$subtotal_harga = $jumlah_item * $data_buku['harga_buku'];

        /*$query_id_buku = mysql_query("select id_buku from keranjang where id_buku = '$id_buku' and id_session='$id_session'");
        $count_id_buku = mysql_num_rows($query_id_buku);

        if($count_id_buku==0){
            //echo $subtotal_harga;
            mysql_query("insert into keranjang values(null, '$id_buku', '$id_session', '$jumlah_item', '$subtotal_harga')") or die(mysql_error());
        }
        else{
            //mysql_query("update keranjang set jumlah_item = '$jumlah_item', subtotal_harga = '$subtotal_harga' where id_buku='$id_buku' and id_session='$id_session'") or die(mysql_error());
        }*/

        //echo $id_session."<br/>".$id_buku."<br/>".$jumlah_item."<br/>".$subtotal_harga;
        header('location:index.php?mode=dashboard_member');

       
	}
    else{
        echo "
            <div class='alert alert-danger' role='alert'>
                Saat ini Anda tidak dapat melakukan transaksi! Silakan login terlebih dahulu!<br/>    
                <script>window.location='index.php'</script>
            </div>
        ";
    }

?>
