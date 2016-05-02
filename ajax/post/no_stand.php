<?php require_once("../../php/include/Class.php");
if (Input::post("id_kantin")) {
	$id_kantin = Input::post("id_kantin", true);
	$no_stand = Query::builder("SELECT no_stand FROM kantin WHERE ID_KANTIN=$id_kantin");
	?>
	<select class="form-control" id="no_stand">
                    <?php
                    echo "<option value='{$no_stand[0]['no_stand']}'>{$no_stand[0]['no_stand']}</option>";
                    $q = Query::builder("SELECT * FROM pengaturan_sistem");
                    $jumlah_stand = $q[0]["JUMLAH_STAND"];
                    for($i=1; $i<=$jumlah_stand; $i++){
                      $cek = Query::builder("SELECT * FROM kantin WHERE NO_STAND=$i AND STATUS_KANTIN=1 AND ID_KANTIN!= $id_kantin");
                      if (!$cek) {

                        echo "<option value='{$i}'>{$i}</option>";
                      }
                    }
                    ?>
                    </select>
	<?php
}
?>