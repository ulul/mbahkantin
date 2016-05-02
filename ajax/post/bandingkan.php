<?php require_once("../../php/include/Class.php");
if (Input::post("id_menu")) {
	$id_menu = Input::post("id_menu", true);
	$_SESSION["compare"]["$id_menu"] = $id_menu;
	echo '<button class="right-danger btn btn-danger glyphicon glyphicon-minus" aria-hidden="true" onclick="hapus_compare('.$id_menu.')" ></button>';
	if (isset($_SESSION["compare"])) {
		echo "##".count($_SESSION["compare"]);
	}else{
		echo "##0";
	}
}
?>