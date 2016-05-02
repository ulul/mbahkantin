<?php require_once("../../php/include/Class.php");
if (Input::post("jml_stand")) {
	$jml_stand = Input::post("jml_stand", true);
	Query::builder("UPDATE pengaturan_sistem SET JUMLAH_STAND=$jml_stand");
	echo "1";
}

?>