<?php require_once("../../php/include/Class.php");
if (isset($_SESSION["keranjang"])) {
	$jml = count($_SESSION["keranjang"]);
	if ($jml >0) {
		$keranjang = $_SESSION["keranjang"];
	$data = array();
	foreach ($keranjang as $key) {
		array_push($data, $key);
	}
	$where  = implode(" || ID_MENU = ", $data);
	$query = Query::builder("SELECT * FROM menu WHERE ID_MENU=$where");
	echo '<table class="table table-bordered"><tr><td>No</td><td>Nama Menu</td><td>Harga</td></tr>';
	$no = 1;
	$total = 0;
	foreach ($query as $key) {
		 $total+= $key["HARGA"];
		echo "<tr><td>".$no."</td><td>".$key["NAMA_MENU"]."</td><td>".format_rupiah($key["HARGA"])."</td>";
	$no++;}
	  echo "<tr><td></td><td>Total</td><td>".format_rupiah($total)."</td></tr>"; 
	echo "</table>";
	}else{
		echo '<div role="alert" class="alert alert-danger alert-dismissible fade in"> 
			<strong>Keranjang masih kosong !</strong>
			</div>';
	}	
}else{
	echo '<div role="alert" class="alert alert-danger alert-dismissible fade in"> 
			<strong>Keranjang masih kosong !</strong>
			</div>';
}

?>