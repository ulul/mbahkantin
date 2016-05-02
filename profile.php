<?php require_once("php/include/Class.php");
if (isset($_SESSION["ID_LEVEL"])) {
	if ($_SESSION["ID_LEVEL"]==3) {

    $id_user = $_SESSION['ID_USER'];
     if (isset($_GET["batal"])) {
      if (cek_allowed_time()) {
          Query::builder("DELETE FROM pesanan WHERE ID_USER=$id_user AND STATUS=0");
          Query::builder("UPDATE user SET STATUS_PESAN=0 WHERE ID_USER=$id_user");
        $_SESSION["notifikasi_batal"] = '<div class="alert alert-success alert-dismissible fade in" role="alert"><button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Pembatalan order berhasil !</strong></div>';  
      }else{
        $_SESSION["notifikasi_batal"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>time not allowed!</strong></div>';
      }
   }
    $pesanan = Query::builder("SELECT * FROM pesanan WHERE ID_USER = $id_user AND STATUS=0");
    if ($pesanan) {
        $pesan = array();
        $pecah_id = explode("#",$pesanan[0]["PESANAN"]);
        $jumlah_id = count($pecah_id);
        for ($i=0; $i < $jumlah_id; $i++) { 
            $id = $pecah_id[$i];
            $menu = Query::builder("SELECT * FROM menu WHERE ID_MENU=$id");
            array_push($pesan, $menu[0]["NAMA_MENU"]);
        }
        $nama_menu = implode("<li>" ,$pesan);  
    }else{
    	$nama_menu = null;
    }
  
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SI.Kantin</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Nuzulul Huda">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/index.css" rel="stylesheet">

</head>
<body onunload="alert('as')">

<!--Include file header -->
<?php if (file_exists("php/view/header.php")) {
	require_once("php/view/header.php");
}else{
	echo "Oops file header.php tidak dapat di temukan";
	}?>
<div class="container">

<ul class="nav nav-tabs" role="tablist" id="myTab" style="margin-top:100px">
<div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
            	<li class=""><a data-toggle="tab" href="#profile" aria-expanded="false">Profile</a></li>
            	<li class=""><a data-toggle="tab" href="#pesanan" aria-expanded="false">Pesanan</a></li>            
            </ul>
            <div class="tab-content">
              <div id="pesanan" class="tab-pane">
              <br><br />


                <br />
                <div id="notifikasi"><?php get_flashdata("notifikasi_batal") ?></div>
                <?php 
                if($nama_menu !=null){ ?>
                <form>
                <table class="table table-striped table-hover">
	                	<tr>
	                		<th>Pesanan</th>
	      
	                		<th>Aksi</th>
	                	</tr>
	                	<tr>
	                		<td><?php echo $nama_menu; ?></td>
	                	
	                		<td>
                        <a href="profile.php?batal=true" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batalkan Pesanan</a>
                      </td>
	                	</tr>
	                </table>
                  </form>
                <?php }else{
                	echo '<div role="alert" class="alert alert-warning alert-dismissible fade in">
      <strong>Belum ada menu yang anda pesan</strong>
      </div>';
                	} ?>
              </div>
              <!-- /.tab-pane -->
              <div id="profile" class="tab-pane">
              <br><br />
   
              <br />
              <div id="notifikasi"><?php get_flashdata("notifikasi") ?></div>
	                <table class="table table-striped table-hover" id='profil'>
	                	<tr>
	                		<th width="30">Display Nama</th>
	                		<th width="30">Username</th>
	                		<th width="30">Aksi</th>
	                	</tr>
	                	<tr>
	                		<td><?php echo $user_nama; ?></td>
	                		<td><?php echo $data[0]["USERNAME"]; ?></td>
	                		<td><button class="btn btn-warning" onclick="update_profile('form');"><span data-toggle="tooltip" data-placement="top" title="Edit Data" class='pointer glyphicon glyphicon-edit'></span> Edit</button> </td>
	                	</tr>
	                </table>
                  <div id='form-edit' style="display:none;">
	                <table class="table table-striped table-hover" >
	                	<tr>
	                		<th width="30">Display Nama</th>
                      <th width="30">Username</th>
	                		<th width="30"><font color="red">*</font>Password</th>
	                		<th width="30">Aksi</th>
	                		
	                	</tr>
	                	<tr>
	                		<td><input type="text" id="user_nama" class="form-control" value="<?php echo $user_nama; ?>"></td>
                      <td><?php echo $data[0]["USERNAME"]; ?></td>
	                		<td><input type="password" id="password" class="form-control" ></td>
	                		<td>
	                			<button class="btn btn-warning" onclick="save()"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>

	                			<button onclick="update_profile('profil')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</button>
	                		</td>
	                	</tr>

	                </table>
                  <font color="red">*</font>Kosongi password jika tidak di ubah
                  </div>

                  

                
              </div>
            
            </div>
            <!-- /.tab-content -->
          </div>
</div>


</body>
<script src="assets/js/jQuery-2.1.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/index.js"></script>
<script>
  $(function () {
    <?php if (isset($_GET["batal"])) { ?>
        $('#myTab a[href="#pesanan"]').tab('show') 
    <?php }else{ ?>
        $('#myTab a:first').tab('show')
    <?php } ?>  
  })

</script>
</html>
<?php }else{
  header("location:".base_url());
} }else{
  header("location:".base_url());
} ?>