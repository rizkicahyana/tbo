<?php
    include_once '../config/koneksi.php';
    include_once '../class/ClassPaging.php';
    error_reporting(0);
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Dashboard Admin | Toko Buku Online</title>

        <!-- Bootstrap Core CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        
        <link href="../assets/css/sb-admin.css" rel="stylesheet">
        <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>  

<?php    
    if($_SESSION['nomor_level']==1){
        $query_akun = mysql_query("select * from akun where id_akun='$_SESSION[id_akun]'");
        $data_akun = mysql_fetch_array($query_akun);

        $query_akun_baru = mysql_query("select * from akun where status_akun = 'Pending'");
        $hitung_akun_baru = mysql_num_rows($query_akun_baru);

        $query_transaksi = mysql_query("select * from transaksi");
        $hitung_transaksi = mysql_num_rows($query_transaksi);

        $query_konfirmasi_transaksi = mysql_query("select * from konfirmasi_transaksi");
        $hitung_konfirmasi_transaksi = mysql_num_rows($query_konfirmasi_transaksi);        

?>

<div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php?mode=dashboard_admin">Toko Buku Online</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo "Selamat datang, ";?><i class="fa fa-user"></i> <?php echo $_SESSION['username']."!";?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <!--li class="divider"></li-->
                            <li>
                                <a href="index.php?mode=logout_admin"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="active">
                            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="index.php?mode=lihat_permintaan_akun"><i class="fa fa-fw fa-users"></i> Usulan Akun Baru <b>(<?php echo $hitung_akun_baru;?>)</b></a>
                        </li>
                        <li>
                            <a href="index.php?mode=lihat_akun"><i class="fa fa-fw fa-desktop"></i> Lihat Akun </a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#man_kategori"><i class="fa fa-fw fa-cog"></i> Manajemen Kategori <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="man_kategori" class="collapse">
                                <li>
                                    <a href="index.php?mode=tambah_kategori"><i class="fa fa-pencil"></i> Tambah Kategori</a>
                                </li>
                                <li>
                                    <a href="index.php?mode=lihat_kategori"><i class="fa fa-desktop"></i> Lihat Kategori</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#man_penerbit"><i class="fa fa-fw fa-cog"></i> Manajemen Penerbit <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="man_penerbit" class="collapse">
                                <li>
                                    <a href="index.php?mode=tambah_penerbit"><i class="fa fa-pencil"></i> Tambah Penerbit</a>
                                </li>
                                <li>
                                    <a href="index.php?mode=lihat_penerbit"><i class="fa fa-desktop"></i> Lihat Penerbit</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#man_buku"><i class="fa fa-fw fa-cog"></i> Manajemen Buku <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="man_buku" class="collapse">
                                <li>
                                    <a href="index.php?mode=tambah_buku"><i class="fa fa-pencil"></i> Tambah Buku</a>
                                </li>
                                <li>
                                    <a href="index.php?mode=lihat_buku"><i class="fa fa-desktop"></i> Lihat Buku</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#man_transaksi"><i class="fa fa-fw fa-cog"></i> Manajemen Transaksi <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="man_transaksi" class="collapse">
                                <li>
                                    <a href="index.php?mode=lihat_transaksi"><i class="fa fa-desktop"></i> Lihat Transaksi <b>(<?php echo $hitung_transaksi;?>)</b></a>
                                </li>
                                <li>
                                    <a href="index.php?mode=lihat_konfirmasi"><i class="fa fa-fw fa-desktop"></i> Lihat Konfirmasi <b>(<?php echo $hitung_konfirmasi_transaksi;?>)</b></a>
                                </li>
                            </ul>
                        </li>
                       
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">

                <div class="container-fluid">

                    


                    <?php
                        $id_akun = $_SESSION['id_akun'];
                        //$session_nomor_level = $_SESSION['nomor_level'];

                        $mode=isset($_GET['mode'])?$_GET['mode']:'';
                        switch($mode){
                            case "daftar_admin":
                                include_once "daftar.php";
                                break;
                            case "login_admin":
                                include_once "login.php";
                                break;
                            case "dashboard_admin":
                        ?>
                            <!-- Page Heading -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <ol class="breadcrumb">
                                        <li class="active">
                                            <i class="fa fa-dashboard"></i> Dashboard
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <!-- /.row -->
                        <?php        
                                //include_once "index.php";
                                break;
                            
                            case "lihat_permintaan_akun":
                                include_once "data_permintaan_akun.php";
                                break;
                                include_once "data_akun.php";
                                break;
                            case "lihat_akun":
                                include_once "data_akun.php";
                                break;
                            case "ubah_akun":
                                include_once "ubah_akun.php";
                                break;
                            case "hapus_akun":
                                include_once "hapus_akun.php";
                                break;
                            case "tambah_kategori":
                                include_once "tambah_kategori.php";
                                break;
                            case "lihat_kategori":
                                include_once "data_kategori.php";
                                break;
                            case "ubah_kategori":
                                include_once "ubah_kategori.php";
                                break;
                            case "hapus_kategori":
                                include_once "hapus_kategori.php";
                                break;
                            case "tambah_penerbit":
                                include_once "tambah_penerbit.php";
                                break;
                            case "lihat_penerbit":
                                include_once "data_penerbit.php";
                                break;
                            case "ubah_penerbit":
                                include_once "ubah_penerbit.php";
                                break;
                            case "hapus_penerbit":
                                include_once "hapus_penerbit.php";
                                break;
                            case "tambah_buku":
                                include_once "tambah_buku.php";
                                break;
                            case "lihat_buku":
                                include_once "data_buku.php";
                                break;
                            case "ubah_buku":
                                include_once "ubah_buku.php";
                                break;
                            case "hapus_buku":
                                include_once "hapus_buku.php";
                                break;
                            case "lihat_transaksi":
                                include_once "data_transaksi.php";
                                break;
                            case "ubah_transaksi":
                                include_once "ubah_transaksi.php";
                                break;
                            case "hapus_transaksi":
                                include_once "hapus_transaksi.php";
                                break;
                            case "lihat_konfirmasi":
                                include_once "data_konfirmasi.php";
                                break;
                            
                            case "hapus_kofirmasi":
                                include_once "hapus_konfirmasi.php";
                                break;
                            case "logout_admin":
                                include_once "logout.php";
                                break;
                            case "":
                                
                                break;
                            default:
                                include_once "header.php";
                                echo "
                                    <div class='col-md-4'></div>
                                    <div class='col-md-4'>
                                        <div class='alert alert-danger' role='alert'>
                                            404 Not Found!
                                        </div>
                                    </div>
                                    <div class='col-md-4'></div>

                                ";
                                include_once "footer.php";
                                break;
                        }
                    ?> 

                   <!--footer.php-->
    <!-- Footer -->
    <hr/>
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p align="center">Copyright &copy; Toko Buku Online 2015.<br/>
                Developed by Rizki Cahyana. Powered with Bootstrap.</p>
            </div>
        </div>
    </footer> 

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->



        <!-- jQuery -->
        <script src="../assets/js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../assets/js/bootstrap.min.js"></script>

    </body>

</html>

<?php          
    }
    else{
        header('location:../index.php');
    }
?>
