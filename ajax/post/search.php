<?php require_once("../../php/include/Class.php");
   
	if (Input::post("cari")) {
		$keyword = Input::post("cari",true);
		$data = Query::builder("SELECT * FROM menu_utama WHERE NAMA_MENU LIKE '%$keyword%' AND max_pesan !=0 AND STATUS_KANTIN =1 AND STATUS_MENU =1 LIMIT $per_halaman");
		  }
    if ($data) {
                 ?>
                 
        <div class="row">
            <?php     foreach ($data as $menu ) { ?> 

        <div class="col-md-4">
            <div class="bs-component">

              <div class="tablet panel panel-primary">
                
                <div class="img panel-body ">
                 <?php if (empty($menu["GAMBAR"])) {
                    $gambar = base_url("upload/err/fdgf.jpg");
                  }else{
                    $gambar = base_url("upload/".$menu["GAMBAR"]);
                    }?>
                 <center><img src="<?php echo $gambar;?>" class="img-thumbnail" ></center>
                </div>
                    <center><?php echo $menu['NAMA_MENU']." - Kantin ".$menu["NAMA_KANTIN"];?></center>
                    <center><?php echo format_rupiah($menu['HARGA']);?> </center>
                <div class="panel-heading" ><center>
                <?php
               $id = $menu['ID_MENU'];
                 if (isset($_SESSION["keranjang"]["$id"])) { ?>
                    <div id="ganti<?php echo $menu['ID_MENU']; ?>" style="margin-bottom:10px;"><button class="left btn btn-danger glyphicon glyphicon-shopping-cart remove" aria-hidden="true" onclick="hapus(<?php echo $menu['ID_MENU']; ?>)"></button></div>
                    <?php if (isset($_SESSION["compare"]["$id"])) {
                        echo '<div id="compare'.$id.'"> <button class="right-danger btn btn-danger glyphicon glyphicon-minus" aria-hidden="true" onclick="hapus_compare('.$id.')"></button></div>';
                    }else {?>
                    <div id="compare<?php echo $id;?>"><button class="right btn btn-warning glyphicon glyphicon-plus" aria-hidden="true" onclick="bandingkan(<?php echo $id;?>)"></button></div>
                    
               <?php } } else {?>
                    <div id="ganti<?php echo $menu['ID_MENU']; ?>" style= "margin-bottom:10px;  "><button class="left btn btn-primary glyphicon glyphicon-shopping-cart cart" aria-hidden="true" onclick="chart(<?php echo $menu['ID_MENU']; ?>)"></button></div>
                    <?php if (isset($_SESSION["compare"]["$id"])) {
                        echo ' <div id="compare'.$id.'"><button class="right-danger btn btn-danger glyphicon glyphicon-minus" aria-hidden="true" onclick="hapus_compare('.$id.')"></button></div>';
                    }else {?>
                    <div id="compare<?php echo $id;?>"><button class="right btn btn-warning glyphicon glyphicon-plus" aria-hidden="true" onclick="bandingkan(<?php echo $id;?>)"></button></div>

                 <?php } } ?>
                 <div class="clearfix"></div>
                </center></div>
              </div>
            </div>
          </div>
         <?php }?> 
         </div>


          <?php }else{
          	echo "Tidak ada menu untuk keyword '<b>".htmlspecialchars($_POST["cari"])."'</b>";
          	} ?> 