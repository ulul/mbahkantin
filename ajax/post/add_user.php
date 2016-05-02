<?php require_once("../../php/include/Class.php");
if (Input::post("username") AND Input::post("password") AND Input::post("level")) {
	$username = Input::post("username", true);
	$status = 1;
	$cek_username = Query::builder("SELECT * FROM user WHERE USERNAME='$username'");
	if ($cek_username) {

		echo "0";
	}else{
	$password = md5(Input::post("password", true));
	$level = Input::post("level", true);
	if ($level==3) {
		$status_pesan = 0;
	}else{
		$status_pesan = 1;
	}
	Query::builder("INSERT INTO user (`STATUS`,`ID_LEVEL`,`USERNAME`,`PASSWORD`,`STATUS_PESAN`) VALUES ('$status','$level','$username','$password','$status_pesan')");
	$_SESSION["pesan"] = "<div class='alert alert-success alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>Tambah user berhasil!</strong></div>";
	echo "1";
	}        																			
}

?>