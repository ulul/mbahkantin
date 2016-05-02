<?php require_once("../../php/include/Class.php");
if (Input::post("ID_PESANAN")) {
	$id = Input::post("ID_PESANAN", true);
	$up = Query::builder("UPDATE pesanan SET STATUS=1 WHERE ID=$id");
	$all = Query::builder("SELECT * FROM view_pesanan WHERE ID=$id");
	$id_user = $all[0]["ID_USER"];
	$menu = $all[0]["PESANAN"];
	$pecah = explode("#", $menu);
	foreach ($pecah as $key) {
				$query = Query::builder("SELECT * FROM menu_utama WHERE ID_MENU=$key");
				$kantin = $query[0]["ID_KANTIN"];
				$new_max_pesan = $query[0]["max_pesan"]-1;
				$harga = $query[0]["HARGA"];
				///cek ID -> Insert/Update to laporan
				$date = date("Y-m-d");

					$data_laporan = Query::builder("SELECT * FROM laporan WHERE ID_MENU = $key AND TGL='$date' AND HARGA='$harga'");
					if ($data_laporan) {
						$jumlah = $data_laporan[0]["JUMLAH"]+1;
						Query::builder("UPDATE laporan SET JUMLAH=$jumlah WHERE ID_MENU=$key");
					}else{
						$harga = $query[0]["HARGA"];
						Query::builder("INSERT INTO laporan  VALUES ('null','$key', now() ,'1','$harga','$kantin')");
					}
	}
	Query::builder("UPDATE user SET STATUS_PESAN=0 WHERE ID_USER=$id_user");
	if ($up == 1) {
		echo '<div role="alert" class="alert alert-success alert-dismissible fade in"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button><strong>Pesanan terambil !</strong></div>';
	}

}
?>