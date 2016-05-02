
<?php
require_once("php/include/Class.php");
header("Content-type: application/vnd-ms-excel");
$now =  date("d-m-y");
$name = "laporan".$now.":".getdate()["hours"].":".getdate()["minutes"].":".getdate()["seconds"];
header("Content-Disposition: attachment; filename=".$name.".xls");
if (isset($_SESSION["TGL_AWAL"]) AND isset($_SESSION["TGL_AKHIR"])) {
    $tgl_1 = $_SESSION["TGL_AWAL"];
    $tgl_2 = $_SESSION["TGL_AKHIR"];
    $data = Query::builder("SELECT * FROM view_laporan WHERE  `TGL` BETWEEN '$tgl_1' AND '$tgl_2'");
}elseif (isset($_SESSION["TGL_AWAL"]) AND isset($_SESSION["TGL_AKHIR"]) AND $_SESSION["ID_KANTIN"]) {
    $tgl_1 = $_SESSION["TGL_AWAL"];
    $tgl_2 = $_SESSION["TGL_AKHIR"];
    $kantin = $_SESSION["ID_KANTIN"];
    $data = Query::builder("SELECT * FROM view_laporan WHERE  `TGL` BETWEEN '$tgl_1' AND '$tgl_2' AND ID_KANTIN='$kantin' ");
}
if ($data) {
 $no =1;
?>
    <center>Laporan Tanggal : <?php echo tgl_indo($tgl_1);?> Sampai Tanggal : <?php echo tgl_indo($tgl_2);?> </center><br />
    <center><?php if(isset($_SESSION["ID_KANTIN"])){ 
                         $kantin = $_SESSION["ID_KANTIN"];
                        $query = Query::builder("SELECT * FROM kantin WHERE ID_KANTIN='$kantin'");
                        echo ucfirst($query[0]["NAMA_KANTIN"]);
                    }else{
                      echo "Semua Kantin"; 
                    } ?>
    </center>
    <br />
	<table border="1">
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
                    $total +=$kali;
                        ?>
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
            
	</table><br>
    Di Cetak Pada : <?php echo tgl_indo(date("Y-m-d"));?> Pukul : <?php echo getdate()["hours"].":".getdate()["minutes"].":".getdate()["seconds"] ?>
    <?php } ?>