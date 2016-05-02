<?php require_once("../../php/include/Class.php");
if (Input::post("id_menu")) {
	$id = Input::post("id_menu", true);
	echo Query::get_json("SELECT * FROM menu WHERE ID_MENU='$id'");
}
?>