<?php require_once("../../php/include/Class.php");
if (Input::post("username")) {
	$username = Input::post("username", true);
	$cek = Query::builder("SELECT * FROM user WHERE USERNAME='$username'");
	if ($cek) {
		echo "0";	
	}else{
		echo "1";
	}
}
?>