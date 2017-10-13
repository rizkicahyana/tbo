<!--header.php-->
<!-- Navigation -->
 
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php
                    if($_SESSION['nomor_level']==2){
                ?>
                    <a class="navbar-brand" href="index.php?mode=dashboard_member">Toko Buku Online</a>
                <?php       
                    }
                    else if($_SESSION['nomor_level']==''){
                ?>
                    <a class="navbar-brand" href="index.php">Toko Buku Online</a>
                <?php    
                    }
                ?>
                

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                
                    <?php
                    	if(($_SESSION['id_akun'])!='' and ($_SESSION['nomor_level']==2)){
							$query_akun = mysql_query("select * from akun where id_akun='$_SESSION[id_akun]'");
							$data_akun = mysql_fetch_array($query_akun);

                            $query_tagihan = mysql_query("select * from transaksi where status_transaksi = 'Belum Lunas' and id_akun = '$data_akun[id_akun]'");
                            $hitung_tagihan = mysql_num_rows($query_tagihan);
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php?mode=lihat_tagihan">Tagihan <b>(<?php echo $hitung_tagihan;?>)</b></a></li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Selamat datang, <?php echo $data_akun['nama'];?>! <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="index.php?mode=view_akun">Lihat Akun</a></li>
                            <li><a href="index.php?mode=edit_akun">Ubah Akun</a></li>
                            <li><a href="index.php?mode=edit_password">Ubah Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="index.php?mode=logout_member">Keluar</a></li>
                          </ul>
                        </li>
                      </ul>
                                          
                    <?php
                    	}
                    ?>
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">
        <div class="row">
    