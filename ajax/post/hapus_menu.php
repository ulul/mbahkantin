<?php require_once("../../php/include/Class.php");
	if (Input::post('ID_MENU')) {
		$id_menu = Input::post('ID_MENU', true);
		Query::builder("UPDATE menu SET STATUS_MENU=0 WHERE ID_MENU=$id_menu");
		echo '<button class="left btn btn-success glyphicon glyphicon-refresh aktif" aria-hidden="true" onclick="aktifkan('.$id_menu.')"></button>##<div style="margin-bottom:10px;"><button class="edit btn btn-danger glyphicon glyphicon-edit " aria-hidden="true" onclick="modal_error('."'Menu dalam keadaan tidak aktif'".')" ></button>';
	}