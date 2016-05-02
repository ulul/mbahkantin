<?php require_once("../../php/include/Class.php");
if (Input::post("id_kantin")) {
	$id_kantin = Input::post("id_kantin", true);
	echo  Query::get_json("SELECT * FROM kantin WHERE ID_KANTIN='$id_kantin'");
}
?>