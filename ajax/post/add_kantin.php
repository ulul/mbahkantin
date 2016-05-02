<?php
require_once("../../php/include/Class.php");

if (Input::post("nama_kantin") AND Input::post("no_stand") AND Input::post("no_hp") AND Input::post("max_pesan")) {
	$nama_kantin = Input::post("nama_kantin", true);
	$no_stand = Input::post("no_stand", true);
	$no_hp = Input::post("no_hp", true);
	$max_pesan = Input::post("max_pesan", true);
	$cek = Query::builder("SELECT * FROM kantin WHERE nama_kantin='$nama_kantin'");
	if (!$cek) {
		Query::builder("INSERT INTO kantin VALUES ('null', '$nama_kantin', '$no_stand',  '$max_pesan', '$max_pesan', 1, '$no_hp')");
		$pesan = '<div role="alert" class="alert alert-success alert-dismissible fade in"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button><strong>Tambah Kantin Berhasiil !</strong></div>';
		$_SESSION["pesan"] = $pesan;
	}else{
		echo "0";
	}
	
}
?>