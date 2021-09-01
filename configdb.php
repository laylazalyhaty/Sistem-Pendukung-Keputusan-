<?php
	@session_start();
	$_SESSION['judul'] = 'SPK Pemilihan Supplier';
	$_SESSION['welcome'] = 'SPK Untuk Memilih Supplier Menggunakan Metode SAW';
	$_SESSION['by'] = 'GF Collection';
	$mysqli = new mysqli('localhost','root','','spk');
	if($mysqli->connect_errno){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
?>