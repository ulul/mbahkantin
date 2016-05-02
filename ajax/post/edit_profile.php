<?php
require_once("../../php/include/Class.php");
if (Input::post("user_nama") AND Input::post("username") AND Input::post("password")) {
	$user_nama = Input::post("user_nama", true);
	$username = Input::post("username", true);
	$password = Input::post("password", true);
	if ($user_nama =="" ) {
		echo "10"; //username
		
	}else{
		$id_user = $_SESSION["ID_USER"];
		$cek = Query::builder("SELECT * FROM view_users WHERE ID_USER=$id_user");
		if ($cek) {
			//echo "UPDATE user_nama SET NAMA='$user_nama' WHERE ID_USER=$id_user";exit();
			Query::builder("UPDATE user_nama SET NAMA='$user_nama' WHERE ID_USER=$id_user");
		}else{
			Query::builder("INSERT INTO user_nama VALUES($id_user,'$user_nama')");
		}
		if ($password) {
			Query::builder("UPDATE user SET  PASSWORD='$password' WHERE ID_USER=$id_user");
		}
		echo "0";
		$_SESSION["notifikasi"] = '<div class="alert alert-success alert-dismissible fade in" role="alert"><button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Update Berhasil !</strong></div>';
	}
}
?>
