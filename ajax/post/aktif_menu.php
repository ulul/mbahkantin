<?php require_once("../../php/include/Class.php");
if (Input::post("ID_MENU")) {
	$id_menu = Input::post("ID_MENU", true);
	Query::builder("UPDATE menu SET STATUS_MENU=1 WHERE ID_MENU=$id_menu");
	echo '<button class="left btn btn-danger glyphicon glyphicon-trash remove" aria-hidden="true" onclick="hapus('.$id_menu.')"></button>';
	}

?>