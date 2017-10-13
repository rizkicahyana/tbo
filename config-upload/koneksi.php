<?php

	$host	= "localhost";
	$user	= "k0392082_tbo";
	$pass	= "k0392082_tbo";
	$db		= "k0392082_db_tbo";
	
	mysql_connect($host, $user, $pass) or die("Gagal menghubungkan ke webserver!");
	mysql_select_db($db) or die("Database tidak ditemukan!");

?>