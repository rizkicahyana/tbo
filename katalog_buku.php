<!-- Title -->
        
        <div class="row">
            <div class="col-lg-12">
                <h3>Koleksi Buku</h3>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
<?php

    $limit = 4;
    $query = new CnnNav($limit,'buku','*','id_buku');
    $result = $query->getResult();

    //$query = mysql_query("select * from buku order by tgl_dan_waktu desc limit 4");

    $data_buku = mysql_fetch_array($result);
    $nomor = ($limit * $_GET['offset'])+1;

    echo "<center>";
    while($data_buku){
        echo "
            <!-- Page Features -->
            <div class='col-md-3 col-sm-6 hero-feature'>
                <div class='thumbnail'>
                    <img src='assets/images/".$data_buku['gambar_buku']."' alt=''>
                    <div class='caption'>
                        <h3>$data_buku[judul_buku]</h3>
                        <p>$data_buku[deskripsi_buku]</p>
                        <p>
                            <a href='index.php?mode=aksi_keranjang&id_buku=$data_buku[id_buku]' class='btn btn-primary'>Beli</a> <a href='index.php?mode=detail_buku&id_buku=$data_buku[id_buku]' class='btn btn-default'>Detail</a>
                        </p>
                    </div>
                </div>
            </div>
        ";
        $data_buku = mysql_fetch_array($result);
    }
    echo "</center>";
    
?>
    </div>

     