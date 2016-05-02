<?php 
$kantin = Query::builder("SELECT * FROM kantin ORDER BY NO_STAND");
if (Input::get("reset")) {
    if ($kantin) {
      foreach ($kantin as $key) {
        $max_pesan = $key["max_pesan_default"];
        $id = $key["ID_KANTIN"];
        Query::builder("UPDATE kantin SET max_pesan='$max_pesan' WHERE ID_KANTIN='$id'");
        $_SESSION["notifikasi"] = '<div role="alert" class="alert alert-success alert-dismissible fade in"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button><strong>Reset layanan pesan kantin berhasil</strong></div>';

      }
    }
}elseif (Input::get("delete")) {
	$id_kantin = Input::get("delete", true);
	Query::builder("UPDATE kantin SET STATUS_KANTIN=0 WHERE ID_KANTIN=$id_kantin");
  $_SESSION["notifikasi"] = '<div role="alert" class="alert alert-success alert-dismissible fade in"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button><strong>Kantin berhasil di hapus</strong></div>';

}elseif (Input::get("non_aktif")) {
	$id_kantin = Input::get("non_aktif", true);
	Query::builder("UPDATE kantin SET STATUS_KANTIN=100 WHERE ID_KANTIN=$id_kantin");
  $_SESSION["notifikasi"] = '<div role="alert" class="alert alert-success alert-dismissible fade in"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button><strong>Kantin berhasil di non aktifkan!</strong></div>';

}elseif (Input::get("aktif")) {
	$id_kantin = Input::get("aktif", true);
	Query::builder("UPDATE kantin SET STATUS_KANTIN=1 WHERE ID_KANTIN=$id_kantin");
  $_SESSION["notifikasi"] = '<div role="alert" class="alert alert-success alert-dismissible fade in"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button><strong>Kantin berhasil di aktifkan !</strong></div>';

}elseif (Input::get("update")) {
  
  $_SESSION["notifikasi"] = '<div role="alert" class="alert alert-success alert-dismissible fade in"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button><strong>Update kantin berhasil !</strong></div>';

}
$kantin2 = Query::builder("SELECT * FROM kantin WHERE STATUS_KANTIN!=0 ORDER BY NO_STAND");
if($kantin2){
?>
<div id="notifikasi" style="margin-top:20px;"><?php get_flashdata("notifikasi"); ?></div>
<div class="box-body" style="margin-top:10px; float:right;">
  <button  onclick="show_confirm_dialog('reset','reset=true', 'Apakah anda yakin untuk mereset jumlah layanan pesanan ?')" class='btn btn-warning btn-flat'>Reset Jumlah Layanan Pesanan</button>
</div>

<div class="box-body" style="margin-top:50px;">
<table id="kantin_data" class="table table-hover" > 
  <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kantin</th>
                  <th>No Stand</th>     
                  <th>No HP</th>     
                  <th>Status</th>
                  <th>Sisa Layanan Pesan</th>
                  <th>Default Layanan Pesan</th>
                  <th>Action</th>
                </tr>
  </thead>
  <tbody>
  <?php $no=1; foreach ($kantin2 as $key) { 
    //print_r($key);
    if ($key["STATUS_KANTIN"] == 1) {
        $status = "<label class='label label-success'>Aktif</label>";
    }else{
        $status = "<label class='label label-danger'>Tidak Aktif</label>";
    }
   ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $key["NAMA_KANTIN"]; ?></td>
                  <td><?php echo $key["NO_STAND"]; ?></td>
                  <td><?php echo $key["NO_TELP"]; ?></td>
                  <td><?php echo $status; ?></td>
                  <td><?php echo $key["max_pesan"]; ?></td>
                  <td><?php echo $key["max_pesan_default"]; ?></td>
                  <td>
                    | <?php if ($key["STATUS_KANTIN"] == 1) {?> <a onclick="show_confirm_dialog('non_aktif','non_aktif=<?php echo $key["ID_KANTIN"]; ?>', 'Apakah anda yakin untuk menonaktifkan kantin <?php echo $key["NAMA_KANTIN"]; ?> ?')" data-toggle="tooltip" data-placement="top" title="Non Aktifkan Kantin" class='pointer fa fa-close'></a> 
                    <?php }elseif ($key["STATUS_KANTIN"] == 100){ ?><a onclick="show_confirm_dialog('aktif','aktif=<?php echo $key["ID_KANTIN"]; ?>', 'Apakah anda yakin untuk mengaktifkan kantin <?php echo $key["NAMA_KANTIN"]; ?> ?')" data-toggle="tooltip" data-placement="top" title="Aktifkan Kantin" class='pointer fa  fa-check'></a>
                    <?php } ?>
                    |
                     
                    <a data-toggle="tooltip" onclick="show_confirm_dialog('delete','delete=<?php echo $key["ID_KANTIN"]; ?>', 'Apakah anda yakin untuk menghapus kantin <?php echo $key["NAMA_KANTIN"]; ?> ?')" data-placement="top" title="Hapus Kantin" class='pointer fa   fa-trash'></a> |
                    <a data-toggle="tooltip" onclick="show_modal_update(<?php echo $key["ID_KANTIN"]; ?>)" data-placement="top" title="Edit Kantin" class='pointer fa   fa-edit '></a> |
                  </td>
                </tr>
   <?php $no++;} ?>             
  </tbody>
</table>
</div>
<?php } ?>