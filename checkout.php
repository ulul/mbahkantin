<?php require_once("php/include/Class.php");
if (isset($_SESSION["keranjang"])) {
	$jml = count($_SESSION["keranjang"]);
	if ($jml >0) {
		if (isset($_SESSION['ID_USER'])) {
	if ($_SESSION['ID_LEVEL']==3) {
		if (cek_allowed_time()) {
		$id_user = $_SESSION["ID_USER"];
		$cek_status_pesan = Query::builder("SELECT * FROM user WHERE ID_USER=$id_user");
		if ($cek_status_pesan[0]['STATUS_PESAN'] == 0) {
			$keranjang = $_SESSION["keranjang"];
			$data = array();
			foreach ($keranjang as $key) {
				$query = Query::builder("SELECT * FROM menu_utama WHERE ID_MENU=$key");
				$kantin = $query[0]["ID_KANTIN"];
				$new_max_pesan = $query[0]["max_pesan"]-1;
				Query::builder("UPDATE kantin SET max_pesan=$new_max_pesan WHERE ID_KANTIN=$kantin"); 
				array_push($data, $key);
			}
			$data1  = implode("#", $data);
			$data_query = implode(" || ID_MENU = ",$data);
			$query = Query::builder("SELECT * FROM menu WHERE ID_MENU= $data_query");
			$total =0;
			foreach ($query as $key) {
				$total +=$key["HARGA"]; 
			}
			Query::builder("UPDATE user SET STATUS_PESAN=1 WHERE ID_USER=$id_user");
			Query::builder("INSERT INTO `si_kantin`.`pesanan` (`ID`, `ID_USER`, `PESANAN`, `TOTAL_BAYAR`,`TGL`) VALUES (NULL, '$id_user', '$data1', '$total', now())");
			$_SESSION["error_akun"] = '<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button class="close" type="button" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			</button>
			<strong>Pesanan terkonfirmasi harap tunjukkan kartu pelajar untuk mengambil pesanan besok !</strong>
			</div>';
			$_SESSION["keranjang"] = null;
			header("location:index.php");
		}else{
			$_SESSION["keranjang"] = null;
			$_SESSION["error_akun"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert">
			<button class="close" type="button" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			</button>
			<strong>Pesanan tidak dapat di konfirmasi harap cek akun anda !</strong>
			</div>';
			header("location:index.php");

		}
		
}else{
	$_SESSION["error_akun"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert">
			<button class="close" type="button" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			</button>
			<strong>time not allowed to order</strong>
			</div>';
	$_SESSION["keranjang"] = null;		
			header("location:index.php");
}
	}else{
		$_SESSION["belum_login"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert">
<button class="close" aria-label="Close" data-dismiss="alert" type="button">
<span aria-hidden="true">×</span>
</button>
<strong>Anda Belum Login !</strong>
</div>';
header("location:login.php");
	}

}else{
	$_SESSION["belum_login"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert">
<button class="close" aria-label="Close" data-dismiss="alert" type="button">
<span aria-hidden="true">×</span>
</button>
<strong>Login dahulu untuk konfirmasi pesanan !</strong>
</div>';
header("location:login.php");
}
		
	}else{
		$_SESSION["error_akun"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert">
			<button class="close" type="button" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			</button>
			<strong>Keranjang masih kosong !</strong>
			</div>';
			header("location:index.php");
	}	
}else{
	if (isset($_SESSION["ID_LEVEL"])) {
		if ($_SESSION["ID_LEVEL"]==3) {
			
		}$_SESSION["error_akun"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert">
			<button class="close" type="button" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			</button>
			<strong>Keranjang masih kosong !</strong>
			</div>';
			header("location:index.php");
			
		}
		$_SESSION["error_akun"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert">
			<button class="close" type="button" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			</button>
			<strong>Keranjang masih kosong !</strong>
			</div>';
			header("location:index.php");
}
?>