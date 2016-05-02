<?php
require_once("../../php/include/Class.php");
if (Input::post("id_pesanan")) {
	$id_pesanan = Input::post("id_pesanan", true);
	$pesanan = Query::builder("SELECT * FROM view_pesanan WHERE ID=$id_pesanan");
	if ($pesanan) {
		foreach ($pesanan as $data ) { 
                    
                 	$pesan = array();
                 	$pecah_id = explode("#",$data["PESANAN"]);
                 	$jumlah_id = count($pecah_id);
                 	for ($i=0; $i < $jumlah_id; $i++) { 
                 		$id = $pecah_id[$i];
                 		$menu = Query::builder("SELECT * FROM menu WHERE ID_MENU=$id");
                 		array_push($pesan, $menu[0]["NAMA_MENU"]);
                 	}
                 	echo "<div class='container'>";
                 	foreach ($pesan as $key => $value) {
                 		echo "<li>".$value;
                 	}
                 	echo "</div>";
                 	
                 }

	}
}
?>