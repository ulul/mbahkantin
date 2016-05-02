<?php require_once("../../php/include/Class.php");
if (Input::post('id_menu')) {
	$id_menu = Input::post('id_menu', true);
	unset($_SESSION["keranjang"]["$id_menu"]);
	$jumlah_chart = count($_SESSION["keranjang"]);
	?>

<button class="left  btn btn-primary glyphicon glyphicon-shopping-cart cart" aria-hidden="true" onclick="chart(<?php echo $id_menu; ?>)"></button>#<?php echo $jumlah_chart;?>

	
	<?php
}
?>