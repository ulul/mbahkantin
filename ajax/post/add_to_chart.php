<?php require_once("../../php/include/Class.php");
if (Input::post('id_menu')) {
	$id_menu = Input::post('id_menu', true);
	
	$query = Query::builder("SELECT * FROM menu_utama WHERE ID_MENU = $id_menu");
	if ($query[0] ["max_pesan"]>0) {
 	$_SESSION["keranjang"]["$id_menu"] = $id_menu;
 	$jumlah_chart = count($_SESSION["keranjang"]);
	?>
	 1#<button class="left remove btn btn-danger glyphicon glyphicon-shopping-cart" aria-hidden="true" onclick="hapus(<?php echo $id_menu; ?>)"></button>#<?php echo $jumlah_chart;?>
 
	 

<?php	
}else{
	echo "0#max_pesan=0";
}
}
?>