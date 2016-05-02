<?php
require_once("../../php/include/Class.php");
$username = Input::post("username",true);
$password = md5(Input::post("password",true));
$cek  = Query::builder("SELECT * FROM user WHERE USERNAME='$username' AND PASSWORD='$password' AND STATUS !=100 LIMIT 1");
if ($cek) {

if ($cek[0]["STATUS"] ==1) {
	$_SESSION['ID_USER']=$cek["0"]["ID_USER"];
	echo $cek[0]["ID_LEVEL"];
	if ($cek[0]["ID_LEVEL"] == 1) {
		$_SESSION['ID_LEVEL']=$cek["0"]["ID_LEVEL"];
		$_SESSION["li_active"] = "dashboard";
	}elseif ($cek[0]["ID_LEVEL"] == 2) {
		$_SESSION['ID_LEVEL']=$cek["0"]["ID_LEVEL"];
		$_SESSION["li_active"] = "dashboard";
	}
	elseif($cek[0]["ID_LEVEL"] == 3){
		$_SESSION['ID_LEVEL']=$cek["0"]["ID_LEVEL"];
		if (isset( $_SESSION["keranjang"])) {
			$cek = count($_SESSION["keranjang"]);
			if ($cek > 0 ) {
				echo "1";
			}
		}	
	}else{
		$_SESSION['ID_LEVEL']=$cek["0"]["ID_LEVEL"];
	}
}elseif($cek[0]["STATUS"] ==0 ){
	echo "5";
}else{
	echo "0";
}
}else{
	echo "0";
}
?>