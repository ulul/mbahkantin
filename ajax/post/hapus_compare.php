<?php require_once("../../php/include/Class.php");
if (Input::post('id_menu')) {
	$id = Input::post('id_menu', true);
	unset($_SESSION["compare"]["$id"]);
	?>
<button class="right btn btn-warning glyphicon glyphicon-resize-full" aria-hidden="true" onclick="bandingkan(<?php echo $id;?>)"></button>

	
	<?php
	echo "##".count($_SESSION["compare"]);
}
?>