<?php require_once("../../php/include/Class.php");
if (Input::post("id_kantin")) {
	$id_kantin = Input::post("id_kantin", true);
	$nama_kantin = Input::post("nama_kantin", true);
	$no_stand = Input::post("no_stand", true);
	$no_hp = Input::post("no_hp", true);
	$max_pesan = Input::post("max_pesan", true);
	if ($id_kantin == "" || $nama_kantin == "" || $no_stand == "" || $max_pesan == "") {
		$error = "Harap isi data dengan lengkap";
	}else{
		$error = "0";
		Query::builder("UPDATE kantin SET NAMA_KANTIN='$nama_kantin', NO_STAND='$no_stand', NO_TELP='$no_hp', max_pesan_default='$max_pesan' WHERE ID_KANTIN='$id_kantin'");
	}
	echo "{$error}";
}