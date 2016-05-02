<?php require_once("../../php/include/Class.php");
			if (Input::post('ID_KANTIN')) {
			$id_kantin= Input::post("ID_KANTIN", true);
      $data = Query::builder("SELECT * FROM menu WHERE ID_KANTIN=$id_kantin");
      if ($data) {
                 ?>
                 
         <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Menu</h4>
              </div>
             <form enctype="multipart/form-data" method="post" action="<?php echo base_url("edit_menu.php")?>">
              <div class="modal-body">
                 
             
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">
              <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputEmail3"><font color="red">*</font>Gambar</label>

                  <div class="col-sm-9">
                    <input type="file"  name="uploaded_file" id="gambar" accept="image/*">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputEmail3">Nama Menu</label>

                  <div class="col-sm-9">
                    <input type="text" name="nama_menu"  id="nama_menu_edit" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputPassword3">Jenis</label>

                  <div class="col-sm-9">
                   <select class="form-control" name="jenis" id="jenis_edit">
                      <option value="Makanan">Makanan</option>
                      <option value="Minuman">Minuman</option>
                   </select> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputPassword3">Harga</label>

                  <div class="col-sm-9">
                    <input type="number" name="harga"  id="harga_edit" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputPassword3">Kantin</label>

                  <div class="col-sm-9">
                   <?php $kantin = Query::builder("SELECT * FROM kantin");?>
                   <select class="form-control" name="kantin" id="kantin_edit">
                      <?php if ($kantin) {
                          foreach ($kantin as $key) {
                              echo "<option value=".$key["ID_KANTIN"].">".$key["NAMA_KANTIN"]."</option>";
                          }
                      }?>
                   </select> 
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              
              <!-- /.box-footer -->
            </div>
           
              </div>
              <div class="modal-footer">
              <input type="hidden" value="edit" name="cek">
              <input type="hidden"  name="id_menu" id="id_edit">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary btn-flat" name="submit_menu" value="Simpan">
              </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
            <?php     foreach ($data as $menu ) { 
              if ($menu['JENIS'] == "Makanan") {
                $jenis = "<label class='label label-success'>Makanan</label>";
              }elseif ($menu['JENIS'] == "Minuman") {
               $jenis = "<label class='label label-warning'>Minuman</label>";
              }
              ?> 
              
        <div class="col-md-4">
            <div class="bs-component">

              <div class="tablet panel panel-primary">
                
                  <?php if (empty($menu["GAMBAR"])) {
                  	$gambar = base_url("upload/err/fdgf.jpg");
                  }else{
                  	$gambar = base_url("upload/".$menu["GAMBAR"]);
                  	}?>
                 <center><img src="<?php echo $gambar;?>" class="img-thumbnail" ></center>
                  
                    <center><?php echo $menu['NAMA_MENU'] ?></center>
                    <center><?php echo $jenis; ?></center>
                    <center><?php echo format_rupiah($menu['HARGA']);?> </center>
                <div class="panel-heading" ><center>
                  <?php if ($menu["STATUS_MENU"] == 1) { ?>
                      <div id="ganti<?php echo $menu['ID_MENU']; ?>" style="margin-bottom:10px;"><button class="left btn btn-danger glyphicon glyphicon-trash remove" aria-hidden="true" onclick="hapus(<?php echo $menu['ID_MENU'] ?>)"></button></div>
                      <div id="ganti_edit<?php echo $menu['ID_MENU']; ?>"  ><div style="margin-bottom:10px;"><button class="edit btn btn-warning glyphicon glyphicon-edit " aria-hidden="true" onclick="show_update(<?php echo $menu['ID_MENU'] ?>)"></button></div></div>
                  <?php }else{ ?>
                       <div id="ganti<?php echo $menu['ID_MENU']; ?>" style="margin-bottom:10px;"><button class="left btn btn-success glyphicon glyphicon-refresh aktif" aria-hidden="true" onclick="aktifkan(<?php echo $menu['ID_MENU'] ?>)" ></button></div>
                       <div id="ganti_edit<?php echo $menu['ID_MENU']; ?>"  ><div style="margin-bottom:10px;"><button class="edit btn btn-danger glyphicon glyphicon-edit " aria-hidden="true" onclick="modal_error('Menu dalam keadaan tidak aktif')" ></button></div> 
                  <?php } ?>
                  
                </center>
                <div class="clearfix"></div>
                </div>

              </div>
            </div>
          </div>
         <?php }?> 
         </div>
        
          
          <?php }else{
             echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button class="close" type="button" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
      </button>
      <strong>Menu masih kosong !</strong>
      </div>';
            } } ?>