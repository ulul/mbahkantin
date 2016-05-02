<?php
require_once("../../php/include/Class.php");

$pesanan2 = Query::builder("SELECT * FROM view_pesanan WHERE STATUS=100");
if ($pesanan2) {

 ?>
<div style="margin-top:20px;"></div>
	<table id="example2" class="table">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Pesanan</th>     
                  <th>TGL Pesan</th>
                  <th>Total Bayar</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no=1;
                 foreach ($pesanan2 as $data ) { 
                    
                 	$pesan = array();
                 	$pecah_id = explode("#",$data["PESANAN"]);
                 	$jumlah_id = count($pecah_id);
                 	for ($i=0; $i < $jumlah_id; $i++) { 
                 		$id = $pecah_id[$i];
                 		$menu = Query::builder("SELECT * FROM menu WHERE ID_MENU=$id");
                 		array_push($pesan, $menu[0]["NAMA_MENU"]);
                 	}
                 	$nama_menu = implode("," ,$pesan);
                 	?>
 
                	<tr>
                	<td><?php echo $no;?></td>
                	<td><?php echo $data["USERNAME"];?></td>
                	<td>
                        <?php if(strlen($nama_menu)>20){ ?>
                       <a data-toggle="tooltip" data-placement="top" title=" Lihat Detail "  onclick="show_detail(<?php echo $data["ID"].",'".$data["USERNAME"]."'";?>)" class="pointer"><?php echo substr($nama_menu,0,20)." ..."; ?></a>  
                       <?php }else{ echo $nama_menu; };?>
                    </td>
                	<td><?php echo tgl_indo($data["TGL"]);?></td>
                	<td><?php echo format_rupiah($data["TOTAL_BAYAR"]);?></td>
                	
                	</tr>
                <?php $no++;}?>
                </tbody>
    </table>
<?php 
}else{
	echo '<div role="alert" class="alert alert-warning alert-dismissible fade in"><strong>Data Pesanan Kosong !</strong></div>';
}
?>
