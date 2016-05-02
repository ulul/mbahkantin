
<?php require_once("../../php/include/Class.php");
if (Input::post("tgl_1") AND Input::post("tgl_2") AND Input::post("id_kantin")) {
	$tgl_1 = Input::post("tgl_1", true);
    $tgl_2 = Input::post("tgl_2", true);
	$kantin = Input::post("id_kantin", true);
    if ($tgl_2 == "" || $tgl_1 == "") {
        $now = date("Y-m-d");
        $data =  Query::builder("SELECT * from view_laporan WHERE TGL='$now'");
        $_SESSION["TGL_AWAL"] = $now;
        $_SESSION["TGL_AKHIR"] = $now;
    }else{
        if ($kantin == "all") {
            $data = Query::builder("SELECT * FROM view_laporan WHERE  `TGL` BETWEEN '$tgl_1' AND '$tgl_2'");
            $_SESSION["TGL_AWAL"] = $tgl_1;
            $_SESSION["TGL_AKHIR"] = $tgl_2;
        }else{
    	    $data = Query::builder("SELECT * FROM view_laporan WHERE  `TGL` BETWEEN '$tgl_1' AND '$tgl_2' AND ID_KANTIN='$kantin' ");
            $_SESSION["TGL_AWAL"] = $tgl_1;
            $_SESSION["TGL_AKHIR"] = $tgl_2;
            $_SESSION["ID_KANTIN"] = $kantin;
        }
    }
	$no = 1;
	if($data) {
	?>		   <div class="box box-solid box-primary">
                <div class="box-header">
                  <h3 class="box-title" style="margin-top:6px;"><i class="fa fa-book"></i> Laporan Panjualan</h3> 
                  <a  class="btn btn-success" href="<?php echo base_url("excel.php");?>" target="_blank" style="float:right;"><span class="pointer fa fa-file-excel-o"></span> Cetak Excel</a> 
                </div>
                <div class="box-body" style="margin-top:15px;">
	            
                <table class="table table-bordered table-hover">
                <thead>
                <tr>
                	<th>No</th>
	                <th>Tanggal</th>
	                <th>Nama Kantin</th>
	                <th>Jenis</th>
	                <th>Nama Menu</th>
	                <th>Jumlah</th>
	                <th>Harga</th>
                </tr>
                </thead>
                <tbody>
                	<?php 

                    $total = 0;
                	foreach ($data as $key ) {
                    $kali = $key["HARGA"]*$key["JUMLAH"];
                    $total +=$kali; ?>
                	<tr>
                	<td><?php echo $no; ?></td>		
                	<td><?php echo tgl_indo($key["TGL"]); ?></td>		
                	<td><?php echo $key["NAMA_KANTIN"]; ?></td>		
                	<td><?php echo $key["JENIS"]; ?></td>		
                	<td><?php echo $key["NAMA_MENU"]; ?></td>		
                	<td><?php echo $key["JUMLAH"]; ?></td>
                	<td><?php echo format_rupiah($key["HARGA"]); ?></td>
                	</tr>		
                	<?php 
                	$no++;}
                	?>
                    
                    <tr>
                    <td colspan="5"></td>
                    
                    <td>Total</td>
                    <td><?php echo format_rupiah($total);?></td>
                    </tr>
                    
                </tbody>
                
              </table>
              
              </div>
              </div>
	<?php
}else{
	echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'><button class='close' aria-label='Close' data-dismiss='alert' type='button'><span aria-hidden='true'>×</span></button><strong>Data laporan kosong!</strong></div>";
}
}
?>
